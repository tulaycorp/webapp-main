<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds full Shopify-like product metadata fields:
     * - Vendor (brand/manufacturer)
     * - Barcode (UPC, EAN, ISBN, etc.)
     * - Weight and weight unit for shipping
     * - Requires shipping flag
     * - Taxable flag and tax code
     * - Metafields for custom key-value data
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Vendor/Brand information
            $table->string('vendor')->nullable()->after('category_id');
            
            // Barcode (UPC, EAN, ISBN, etc.)
            $table->string('barcode')->nullable()->after('sku');
            
            // Shipping information
            $table->decimal('weight', 10, 3)->nullable()->after('image_url');
            $table->enum('weight_unit', ['kg', 'g', 'lb', 'oz'])->default('kg')->after('weight');
            $table->boolean('requires_shipping')->default(true)->after('weight_unit');
            
            // Physical dimensions (for shipping calculations)
            $table->decimal('length', 10, 2)->nullable()->after('requires_shipping');
            $table->decimal('width', 10, 2)->nullable()->after('length');
            $table->decimal('height', 10, 2)->nullable()->after('width');
            $table->enum('dimension_unit', ['cm', 'in', 'm'])->default('cm')->after('height');
            
            // Tax settings
            $table->boolean('taxable')->default(true)->after('dimension_unit');
            $table->string('tax_code')->nullable()->after('taxable');
            
            // Custom metafields (JSON storage for flexible key-value pairs)
            // Mimics Shopify metafields for custom product attributes
            $table->json('metafields')->nullable()->after('seo_description');
            
            // Indexes for common queries
            $table->index('vendor');
            $table->index('barcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['vendor']);
            $table->dropIndex(['barcode']);
            
            $table->dropColumn([
                'vendor',
                'barcode',
                'weight',
                'weight_unit',
                'requires_shipping',
                'length',
                'width',
                'height',
                'dimension_unit',
                'taxable',
                'tax_code',
                'metafields',
            ]);
        });
    }
};
