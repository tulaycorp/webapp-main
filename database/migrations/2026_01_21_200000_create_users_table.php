<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('password_hash');
                $table->text('address1')->nullable();
                $table->text('address2')->nullable();
                $table->string('country_code', 10)->nullable();
                $table->string('phone', 50)->nullable();
                $table->string('role', 50)->default('customer');
                $table->timestamps();

                $table->index('email');
                $table->index('role');
            });

            // Insert default admin user matches init.sql
            DB::table('users')->insert([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@email.com',
                'password_hash' => '$2y$12$Kq3hG7pJ.kFz8A1xCwE5YOfiSz5nR8J1V0K2m9QxT6L4wN3pY.abc', // password: 'password'
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

             // Insert admin@example.com for convenience matches screenshot placeholder
             DB::table('users')->insert([
                'first_name' => 'Admin',
                'last_name' => 'Example',
                'email' => 'admin@example.com',
                'password_hash' => '$2y$12$Kq3hG7pJ.kFz8A1xCwE5YOfiSz5nR8J1V0K2m9QxT6L4wN3pY.abc', // password: 'password'
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
