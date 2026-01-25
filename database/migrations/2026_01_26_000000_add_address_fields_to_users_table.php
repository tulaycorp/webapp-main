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
        Schema::table('users', function (Blueprint $table) {
            $table->string('city', 100)->nullable()->after('address2');
            $table->string('state', 100)->nullable()->after('city');
            $table->string('zip', 20)->nullable()->after('state');
            $table->string('country', 100)->nullable()->after('zip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['city', 'state', 'zip', 'country']);
        });
    }
};
