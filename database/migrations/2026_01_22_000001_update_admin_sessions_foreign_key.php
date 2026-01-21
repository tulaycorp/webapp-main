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
        Schema::dropIfExists('admin_sessions');

        Schema::create('admin_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->string('session_token')->unique();
            $table->timestamp('expires_at');
            $table->timestamp('created_at')->nullable();
            
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_sessions');

        // Note: We cannot easily restore the old table with data, 
        // but we can restore the schema if needed.
        Schema::create('admin_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('session_token')->unique();
            $table->timestamp('expires_at');
            $table->timestamp('created_at')->nullable();
            
            $table->index('expires_at');
        });
    }
};
