<?php

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'set.language' => \App\Http\Middleware\SetLanguage::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withEvents(discover: [
        __DIR__ . '/../app/Listeners',
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AccessDeniedHttpException|AuthorizationException $e, Request $request) {
            if ($request->is('api/*')) {
                return ResponseHelper::error('This action is unauthorized', 403);
            }
        });
    })->create();
