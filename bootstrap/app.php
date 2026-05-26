<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //route middleware
        $middleware->alias([
            'maintenance'=>App\Http\Middleware\DownForMaintenance::class,
            'auth.session'=>App\Http\Middleware\AuthSession::class,
            'role'=>App\Http\Middleware\RoleMiddleware::class,
        ]);
        //middleware group
        $middleware->group('groupMiddleware', [
         App\Http\Middleware\MiddlewareOne::class,  
         App\Http\Middleware\MiddlewareTwo::class
        ]);

        $middleware->append(App\Http\Middleware\promotionMW::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
