<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds JSON images field to store multiple product images.
     * Migrates existing image_url data to images array.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add images JSON field after image_url
            $table->json('images')->nullable()->after('image_url');
        });
        
        // Migrate existing image_url data to images array
        DB::table('products')->whereNotNull('image_url')->get()->each(function ($product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update(['images' => json_encode([$product->image_url])]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
