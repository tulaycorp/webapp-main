<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add performance indexes for frequently queried columns.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->index('status');
            $table->index('created_at');
            $table->index(['status', 'created_at']); // Composite for dashboard queries
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->index('stock_quantity'); // For low stock queries
            $table->index('featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status', 'created_at']);
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['stock_quantity']);
            $table->dropIndex(['featured']);
        });
    }
};
