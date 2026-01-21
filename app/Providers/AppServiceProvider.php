<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-create required storage directories if they don't exist
        $directories = [
            storage_path('app'),
            storage_path('framework/cache'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
        }

        // Share settings with all views (or specifically navbar)
        try {
            // Check if table exists first to avoid migration issues during setup
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::all()->pluck('value', 'key');
                
                view()->share('announcement_enabled', filter_var($settings['announcement_enabled'] ?? 'false', FILTER_VALIDATE_BOOLEAN));
                view()->share('announcement_message', $settings['announcement_message'] ?? '');
            } else {
                view()->share('announcement_enabled', false);
                view()->share('announcement_message', '');
            }
        } catch (\Exception $e) {
            // Fallback if DB connection fails
            view()->share('announcement_enabled', false);
            view()->share('announcement_message', '');
        }
    }
}
