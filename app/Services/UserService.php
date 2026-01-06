<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService {
    
    use ResponseTrait;

    public function __construct() {
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

        $token = $user->createToken( $user->name . "Token" )->plainTextToken;
        $response = [
            "token" => $token,
            "user" => $user->name
        ];

        return $this->sendResponse( $response, "Sikeres bejelentkezés." );
    }

    public function failedLogin( $name ) {

        $user = User::where( "name", $name )->first();

        if( !is_null( $user )) {

            $user->increment( "logincounter" );
            $user->update();
            
            return $this->sendResponse( $user );
        }
    }

    public function userLogout( User $user ) {

        $success = $user->currentAccessToken()->delete();

        if( !$success ) {

            return $this->sendError( "Végrehajtási hiba", [ "Hiba a kijelentkezés során" ], 422 );
        }

        return $this->sendResponse( $user->name, "Sikeres kijelentkezés" );
    }
}
