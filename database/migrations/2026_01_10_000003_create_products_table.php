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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('category')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('image_url')->nullable();
            $table->json('additional_images')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('active');
            $table->integer('stock_quantity')->default(0);
            $table->string('sku')->nullable()->unique();
            $table->json('sizes')->nullable();
            $table->string('color')->nullable();
            $table->string('material')->nullable();
            $table->text('care_instructions')->nullable();
            $table->string('brand')->nullable();
            $table->string('tags')->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->timestamps();
            
            $table->index(['status', 'featured']);
            $table->index('category');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
