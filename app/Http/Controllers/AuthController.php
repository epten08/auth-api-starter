<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegisterUserRequest;

/**
 * @OA\Info(
 *     title="Auth APi",
 *     version="1.0.0",
 *     description="Auth API"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 */

class AuthController extends Controller {
      /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User Login",
     *     description="Authenticates a user and returns a token.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", example="1|token")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     security={{"bearerAuth":{}}}
     * )
     */

    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request): JsonResponse {


        $user = $this->userService->registerUser($request->validated());
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
