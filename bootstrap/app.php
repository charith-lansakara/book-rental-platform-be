<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Default error messages for common status codes
        $defaultMessages = [
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            408 => 'Request Timeout',
            422 => 'Validation Error',
            429 => 'Too Many Requests',
            500 => 'Internal Server Error',
            503 => 'Service Unavailable',
        ];

        //JSON responses for API requests
        $exceptions->shouldRenderJsonWhen(function ($request, Throwable $e) {
            return $request->expectsJson() || $request->is('api/*');
        });

        // Handle ModelNotFoundException (404)
        $exceptions->renderable(function (ModelNotFoundException $e, $request) use ($defaultMessages) {
            return response()->json([
                'message' => 'The requested resource was not found.',
                'error' => $defaultMessages[404],
                'status_code' => 404
            ], 404);
        });

        // Handle NotFoundHttpException (404 for routes)
        $exceptions->renderable(function (NotFoundHttpException $e, $request) use ($defaultMessages) {
            return response()->json([
                'message' => 'The requested endpoint was not found.',
                'error' => $defaultMessages[404],
                'status_code' => 404
            ], 404);
        });

        // Handle ValidationException (422)
        $exceptions->renderable(function (ValidationException $e, $request) use ($defaultMessages) {
            return response()->json([
                'message' => $defaultMessages[422],
                'error' => $defaultMessages[422],
                'errors' => $e->errors(),
                'status_code' => 422
            ], 422);
        });

        // Handle HttpException (custom HTTP errors)
        $exceptions->renderable(function (HttpException $e, $request) use ($defaultMessages) {
            $statusCode = $e->getStatusCode();
            
            return response()->json([
                'message' => $e->getMessage() ?: ($defaultMessages[$statusCode] ?? 'An error occurred'),
                'error' => $defaultMessages[$statusCode] ?? 'HTTP Error',
                'status_code' => $statusCode
            ], $statusCode);
        });

        // Catch-all for other exceptions (500)
        $exceptions->renderable(function (Throwable $e, $request) use ($defaultMessages) {
            if (app()->has('log')) {
                app('log')->error($e->getMessage(), [
                    'exception' => $e,
                    'url' => $request->fullUrl(),
                ]);
            }

            $response = [
                'message' => config('app.debug') 
                    ? $e->getMessage() 
                    : $defaultMessages[500],
                'error' => $defaultMessages[500],
                'status_code' => 500
            ];

            if (config('app.debug')) {
                $response['exception'] = get_class($e);
                $response['file'] = $e->getFile();
                $response['line'] = $e->getLine();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        });

        $exceptions->reportable(function (Throwable $e) {
            // 
        });
    })
    ->create();