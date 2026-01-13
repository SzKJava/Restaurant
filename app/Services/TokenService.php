<?php

namespace App\Services;

use App\Models\User;

class TokenService {
    /**
     * Create a new class instance.
     */
    public function __construct() {
    }

    public function generateToken( User $user ) {

        $token = $user->createToken( $user->name . "Token" )->plainTextToken;

        return $token;
    }
    
    public function destroyToken( User $user ) {

        $success = $user->currentAccessToken()->delete();

        return $success;
    }
}
