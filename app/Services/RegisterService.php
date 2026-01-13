<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;

class RegisterService {

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
}
