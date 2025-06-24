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
        // Global Middleware jika ada
        // $middleware->append(SomeGlobalMiddleware::class);

        // Daftarkan route middleware alias (opsional)
        $middleware->alias([
            'admin.auth' => AdminAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Bisa dibiarkan kosong jika belum custom exception
    })
    ->create();
