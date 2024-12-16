<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\InstructorMiddleware;
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
            'admin' => AdminMiddleware::class,
            'user' => UserMiddleware::class,
            'auth' => AuthMiddleware::class,
            'instructor' => InstructorMiddleware::class
        ]);
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();