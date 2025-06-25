<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminAuthenticate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan middleware alias (route middleware)
        $middleware->alias([
            'admin.auth' => AdminAuthenticate::class,
        ]);

        // Tambahkan middleware global jika perlu:
        // $middleware->append(\App\Http\Middleware\ExampleGlobalMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tambahkan custom exception handler di sini jika dibutuhkan
    })
    ->create();
