<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;

class AuthService{

    protected BanService $banService;
    protected TokenService $tokenService;

    use ResponseTrait;

    public function __construct( BanService $banService, TokenService $tokenService ) {

        $this->banService = $banService;
        $this->tokenService = $tokenService;
    }

    public function userLogin( User $user ) {

        $banningTime = $user->banningtime;
        if( Carbon::now()->addHour() < $banningTime ) {

            $messages = [
                "Felhasználói fiók zárolva",
                "Következő bejelentkezési lehetőség: ",
                $banningTime
            ];
            return $this->sendError( "Bejelentkezési hiba", $messages, 403 );

        }else {

            $this->banService->resetLoginCounter( $user );
            $this->banService->resetBanningTime( $user );
            //$token = $this->tokenService->generateToken( $user );
            $response = [
            //"token" => $token,
            "user" => $user->name
            ];

            return $this->sendResponse( $response, "Sikeres bejelentkezés." );
        }
        
    }

    public function userLogout( User $user ) {

        $success = $this->tokenService->destroyToken( $user );

        if( !$success ) {

            return $this->sendError( "Végrehajtási hiba", [ "Hiba a kijelentkezés során" ], 422 );
        }

        return $this->sendResponse( $user->name, "Sikeres kijelentkezés" );
    }
}
