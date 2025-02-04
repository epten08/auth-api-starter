<?php


namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $exception, $request) {
            if ($request->expectsJson()) {
                return $this->handleApiException($request, $exception);
            }
        });
    }

    /**
     * Handle API-specific exceptions and return JSON responses.
     */
    private function handleApiException($request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $exception->errors(),
            ], 422);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => 'Unauthenticated. Please log in.',
            ], 401);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'message' => 'Unauthorized access.',
            ], 403);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'Resource not found.',
            ], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'Endpoint not found.',
            ], 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'message' => 'HTTP method not allowed.',
            ], 405);
        }

        if ($exception instanceof TooManyRequestsHttpException) {
            return response()->json([
                'message' => 'Too many requests. Please slow down.',
            ], 429);
        }

        return response()->json([
            'message' => 'An unexpected error occurred.',
            'error' => $exception->getMessage(),
        ], 500);
    }
}
