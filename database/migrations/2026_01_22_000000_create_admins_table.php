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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        // Migrate existing users with 'admin' in email to admins table
        $adminUsers = DB::table('users')->where('email', 'like', '%admin%')->get();

        foreach ($adminUsers as $user) {
            DB::table('admins')->insert([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'password_hash' => $user->password_hash,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }

        // Delete migrated users from users table
        DB::table('users')->where('email', 'like', '%admin%')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Move admins back to users table before dropping
        $admins = DB::table('admins')->get();

        foreach ($admins as $admin) {
            DB::table('users')->insert([
                'first_name' => $admin->first_name,
                'last_name' => $admin->last_name,
                'email' => $admin->email,
                'password_hash' => $admin->password_hash,
                'role' => 'admin', // Restore role
                'created_at' => $admin->created_at,
                'updated_at' => $admin->updated_at,
            ]);
        }

        Schema::dropIfExists('admins');
    }
};
