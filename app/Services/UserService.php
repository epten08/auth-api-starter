<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UserService {
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function authenticateUser(array $credentials) {
        Log::info("Attempting login for: " . $credentials['email']);
        $user = $this->userRepository->findByEmail($credentials['email']);
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Log::info("Login successful for: " . $credentials['email']);
            return $user->createToken('API Token')->plainTextToken;
        }
        Log::warning("Failed login attempt: " . $credentials['email']);
        return null;
    }
}
