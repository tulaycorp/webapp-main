<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

try {
    if (!Schema::hasTable('settings')) {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
        echo "Table created.\n";
    } else {
        echo "Table already exists.\n";
    }

    if (DB::table('migrations')->where('migration', 'like', '%create_settings_table')->doesntExist()) {
        DB::table('migrations')->insert([
            'migration' => '2026_01_21_072254_create_settings_table', 
            'batch' => DB::table('migrations')->max('batch') + 1
        ]);
        echo "Migration marked.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
