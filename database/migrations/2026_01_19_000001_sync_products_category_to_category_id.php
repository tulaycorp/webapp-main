<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Sync existing products' string 'category' field to 'category_id' based on Category model.
     */
    public function up(): void
    {
        // Get all categories
        $categories = DB::table('categories')->get();
        
        foreach ($categories as $category) {
            // Update products where category name matches but category_id is null
            DB::table('products')
                ->whereNull('category_id')
                ->where('category', $category->name)
                ->update(['category_id' => $category->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't want to remove the category_id values as they may have been set intentionally
        // This is a one-way sync migration
    }
};
