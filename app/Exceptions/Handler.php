<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        // Handle Validation Errors
        $this->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'error' => $e->errors()
            ], 422);
        });

        // Handle Custom User Already Exists Exception
        $this->renderable(function (UserAlreadyExistsException $e, $request) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'error' => $e->getMessage()
            ], 409);
        });

        // Handle Resource Not Found
        $this->renderable(function (ResourceNotFoundException|NotFoundHttpException $e, $request) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'error' => "Resource not found"
            ], 404);
        });

        // Handle Method Not Allowed
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'error' => "Method not allowed"
            ], 405);
        });

        // Handle Authentication Exception
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'error' => 'Unauthenticated'
            ], 401);
        });
    }
}
