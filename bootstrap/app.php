<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\Other\UpdateLastSeen;
use App\Http\Middleware\Other\CheckUserBanned;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(
            append: [
                UpdateLastSeen::class,
                CheckUserBanned::class
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
