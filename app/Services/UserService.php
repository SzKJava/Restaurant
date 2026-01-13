<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use App\Services\TokenService;
//use App\Services\BanService;

class UserService {
    
    use ResponseTrait;
    protected TokenService $tokenService;
    protected BanService $banService;

    public function __construct( TokenService $tokenService, BanService $banService ) {

        $this->tokenService = $tokenService;
        $this->banService = $banService;
    }

    public function userRegister( $data ) {

        $user = new User();
        $user->name = $data[ "name" ];
        $user->email = $data[ "email" ];
        $user->password = bcrypt( $data[ "password" ]);
        //$user->password = Hash::make( $data[ "password" ]);
        $user->role = "user";
        $user->banningtime = null;

        $user->save();

        return $this->sendResponse( $user->name, "Sikeres regisztráció" );
    }

    public function userLogin( User $user ) {

        $this->banService->resetLoginCounter( $user );
        //$token = $this->tokenService->generateToken( $user );
        $response = [
            //"token" => $token,
            "user" => $user->name
        ];

        return $this->sendResponse( $response, "Sikeres bejelentkezés." );
    }

    public function failedLogin( $name ) {

        $user = User::where( "name", $name )->first();

        if( !is_null( $user )) {

            $counter = $this->banService->getLoginCounter( $user );
            
            if( $counter < 3 ) {

                $this->banService->setLoginCounter( $user );
            }
            
            
            return $this->sendResponse( $counter );
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
