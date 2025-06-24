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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'company.setup' => \App\Http\Middleware\CheckCompanySetup::class,
            'guard' => \App\Http\Middleware\GuardSwitcher::class,
            'guard.role' => \App\Http\Middleware\CheckGuardRole::class,
            'guard.permission' => \App\Http\Middleware\CheckGuardPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
