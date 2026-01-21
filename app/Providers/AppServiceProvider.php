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
            storage_path('framework/cache/data'),
            storage_path('framework/sessions'),
            storage_path('framework/views'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                try {
                    @mkdir($directory, 0755, true);
                    if (!is_dir($directory)) {
                        error_log("Failed to create directory: {$directory}");
                    }
                } catch (\Exception $e) {
                    error_log("Error creating directory {$directory}: " . $e->getMessage());
                }
            }
        }
    }
}
