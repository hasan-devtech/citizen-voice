<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        \Log::info('Handler received exception: ' . get_class($exception));
        if (request()->is('api/*')) {

            if ($exception instanceof \App\Exceptions\BaseApiException) {
                \Log::info('BaseApiException detected');
                return ResponseHelper::error(
                    $exception->getMessage(),
                    $exception->getStatusCode(),
                    $exception->getErrors()
                );
            }
            if ($exception instanceof AuthenticationException || $exception instanceof RouteNotFoundException) {
                return ResponseHelper::error(
                    'Unauthenticated',
                    401
                );
            }
            if ($exception instanceof ModelNotFoundException) {
                $modelName = class_basename($exception->getModel());
                return ResponseHelper::error("{$modelName} not found", 404);
            }
            if ($exception instanceof ValidationException) {
                return ResponseHelper::error(
                    'Validation failed',
                    422,
                    $exception->errors()
                );
            }
            if ($exception instanceof HttpResponseException) {
                return ResponseHelper::error($exception->getMessage(), $exception->getCode());
            }
            if ($exception instanceof ThrottleRequestsException) {
                return ResponseHelper::error("Too many requests. Please slow down", 429);
            }
        }

        return parent::render($request, $exception);
    }

}
