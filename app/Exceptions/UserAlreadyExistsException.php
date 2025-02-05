<?php

namespace App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    
    public function __construct($message = "User already exists.", $code = 409)
    {
        parent::__construct($message, $code);
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render()
    {
        return response()->json([
            'status' => 'error',
            'data' => null,
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
