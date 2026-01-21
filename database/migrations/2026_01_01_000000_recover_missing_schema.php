<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Categories
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 2. Products (Base Schema, BEFORE add_images_to_products)
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->string('sku')->nullable()->unique();
                $table->string('barcode')->nullable()->index();
                $table->string('name');
                $table->text('description')->nullable();
                $table->decimal('price', 10, 2)->default(0.00);
                $table->decimal('compare_at_price', 10, 2)->nullable();
                $table->decimal('cost_per_item', 10, 2)->nullable();
                $table->integer('stock_quantity')->default(0)->index();
                $table->boolean('track_inventory')->default(true);
                $table->boolean('continue_selling_when_out_of_stock')->default(false);
                $table->boolean('featured')->default(false)->index();
                $table->enum('status', ['active', 'draft', 'archived'])->default('active')->index();
                
                $table->string('category')->nullable();
                $table->unsignedBigInteger('category_id')->nullable()->index();
                
                $table->string('vendor')->nullable()->index();
                $table->string('product_type')->nullable();
                $table->text('tags')->nullable();
                $table->text('image_url')->nullable();
                
                $table->decimal('weight', 10, 3)->nullable();
                $table->enum('weight_unit', ['kg', 'g', 'lb', 'oz'])->default('kg');
                $table->boolean('requires_shipping')->default(true);
                $table->decimal('length', 10, 2)->nullable();
                $table->decimal('width', 10, 2)->nullable();
                $table->decimal('height', 10, 2)->nullable();
                $table->enum('dimension_unit', ['cm', 'in', 'm'])->default('cm');
                
                $table->boolean('taxable')->default(true);
                $table->string('tax_code')->nullable();
                
                $table->string('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                
                // Metafields JSON
                $table->longText('metafields')->nullable(); // JSON checked in SQL but longText here

                $table->timestamps();
            });
        }

        // 3. Product Images
        if (!Schema::hasTable('product_images')) {
            Schema::create('product_images', function (Blueprint $table) {
                $table->id();
                $table->string('product_id');
                $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
                $table->string('url');
                $table->string('alt_text')->nullable();
                $table->integer('position')->default(0);
                $table->timestamps();
            });
        }

        // 4. Carts
        if (!Schema::hasTable('carts')) {
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable()->unique();
                $table->text('session_id')->nullable(); // Using text for session_id as per init.sql, or string? init.sql says TEXT.
                // Note: user_id index handled by unique? init.sql has KEY too.
                $table->timestamps();
            });
        }

        // 5. Cart Items
        if (!Schema::hasTable('cart_items')) {
            Schema::create('cart_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cart_id')->constrained('carts')->cascadeOnDelete();
                $table->string('product_id')->index(); // No FK to products? init.sql doesn't enforce FK here surprisingly? 
                // Wait, init.sql lines 273: CONSTRAINT `cart_items_cart_id_foreign` ...
                // But `product_id`? Line 272 KEY, but no CONSTRAINT for product_id?
                // init.sql doesn't show constraint for product_id on cart_items. 
                // But typically it should. I'll stick to init.sql: just index.
                $table->integer('quantity')->default(1);
                $table->timestamps();

                $table->unique(['cart_id', 'product_id']);
            });
        }

        // 6. Personal Access Tokens (Sanctum)
        if (!Schema::hasTable('personal_access_tokens')) {
            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->id();
                $table->string('tokenable_type'); // polymorphic
                $table->unsignedBigInteger('tokenable_id');
                $table->string('name');
                $table->string('token', 64)->unique();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();
                
                $table->index(['tokenable_type', 'tokenable_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
