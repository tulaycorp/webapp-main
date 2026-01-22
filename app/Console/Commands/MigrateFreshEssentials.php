<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateFreshEssentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:fresh-essentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables, re-run migrations, and seed only essential data (no sample products/categories)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Dropping all tables and running migrations...');
        
        Artisan::call('migrate:fresh', [], $this->output);

        $this->info('Seeding essential data...');

        $essentialSeeders = [
            \Database\Seeders\AdminSeeder::class,
            \Database\Seeders\CouponSeeder::class,
            \Database\Seeders\SettingsSeeder::class,
        ];

        foreach ($essentialSeeders as $seeder) {
            Artisan::call('db:seed', ['--class' => $seeder], $this->output);
        }

        $this->info('Done! Database ready with essential data only.');

        return Command::SUCCESS;
    }
}
