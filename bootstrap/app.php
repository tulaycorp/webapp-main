<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.api' => \App\Http\Middleware\AdminApiAuth::class,
            'web.token.optional' => \App\Http\Middleware\WebTokenAuthOptional::class,
            'maintenance' => \App\Http\Middleware\CheckMaintenanceMode::class,
        ]);
        
        $middleware->append(\App\Http\Middleware\CheckMaintenanceMode::class);
        
        // Exclude eshop_session_id from cookie encryption so JavaScript can read it
        $middleware->encryptCookies(except: ['eshop_session_id']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
