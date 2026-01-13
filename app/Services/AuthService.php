<?php

namespace App\Services;

class AuthService{

    public function __construct() {
    }

    public function userLogin( User $user ) {

        $this->banService->resetLoginCounter( $user );
        $this->banService->resetBanningTime( $user );
        $token = $this->tokenService->generateToken( $user );
        $response = [
            "token" => $token,
            "user" => $user->name
        ];

        return $this->sendResponse( $response, "Sikeres bejelentkezés." );
    }

    public function userLogout( User $user ) {

        // $user = auth( "sanctum" )->user();
        $success = $this->tokenService->destroyToken( $user );

        if( !$success ) {

            return $this->sendError( "Végrehajtási hiba", [ "Hiba a kijelentkezés során" ], 422 );
        }

        return $this->sendResponse( $user->name, "Sikeres kijelentkezés" );
    }
}
