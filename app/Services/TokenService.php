<?php

namespace App\Services;

use App\Models\User;

class TokenService {
    /**
     * Create a new class instance.
     */
    public function __construct( protected AbilityService $abilityService ) {}

    public function generateToken( User $user ) {

        $ability = [];
        if(  $user->role == "super" ) {

            $ability = $this->abilityService->getSuperAbility();

        }else if( $user->role == "admin" ) {

            $ability = $this->abilityService->getAdminAbility();

        }else {

            $ability = $this->abilityService->getUserAbility();
        }

        $token = $user->createToken( $user->name . "Token", $ability )->plainTextToken;

        return $token;
    }
    
    public function destroyToken( User $user ) {

        $success = $user->currentAccessToken()->delete();

        return $success;
    }
}
