<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Shopify-style fields (simplified - no barcode, weight, vendor)
            $table->string('sku')->nullable()->unique()->after('id');
            $table->decimal('compare_at_price', 10, 2)->nullable()->after('price');
            $table->decimal('cost_per_item', 10, 2)->nullable()->after('compare_at_price');
            $table->boolean('track_inventory')->default(true)->after('stock_quantity');
            $table->boolean('continue_selling_when_out_of_stock')->default(false)->after('track_inventory');
            $table->enum('status', ['active', 'draft', 'archived'])->default('active')->after('featured');
            $table->string('product_type')->nullable()->after('category');
            $table->text('tags')->nullable()->after('product_type');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable()->after('category');
            
            $table->index('category_id');
            $table->index('status');
            $table->index('sku');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'sku', 'compare_at_price', 'cost_per_item', 
                'track_inventory', 'continue_selling_when_out_of_stock',
                'status', 'product_type', 'tags',
                'seo_title', 'seo_description', 'category_id'
            ]);
        });
    }
};
