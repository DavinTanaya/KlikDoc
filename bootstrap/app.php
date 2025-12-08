<?php

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isAdminOrDoctor;
use App\Http\Middleware\isDoctor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['isAdmin' => isAdmin::class, 'isDoctor' => isDoctor::class, 'isAdminOrDoctor' => isAdminOrDoctor::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withSchedule(function ($schedule) {
        $schedule->command('medicine:send-reminder')->everyMinute()->withoutOverlapping();
    })
    ->create();
