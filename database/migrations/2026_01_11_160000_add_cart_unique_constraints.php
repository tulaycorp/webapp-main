<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Add unique constraints to prevent duplicate carts for same user or session.
     */
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Add unique index on user_id (nullable - only one cart per user)
            $table->unique('user_id', 'carts_user_id_unique');
            
            // Add unique index on session_id (nullable - only one cart per guest session)
            $table->unique('session_id', 'carts_session_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropUnique('carts_user_id_unique');
            $table->dropUnique('carts_session_id_unique');
        });
    }
};
