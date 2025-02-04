<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller {
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function register(Request $request): JsonResponse {
        $user = $this->userService->registerUser($request->all());
        return response()->json(['message' => 'User registered', 'user' => $user], 201);
    }

    public function login(Request $request): JsonResponse {
        $token = $this->userService->authenticateUser($request->all());
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',

        ]);
    }
}
