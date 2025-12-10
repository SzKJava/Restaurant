<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

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
        $user->role = 0;
        $user->banningtime = null;

        $user->save();

        return $this->sendResponse( $user->name, "Sikeres regisztráció" );
    }

    public function userLogin() {

    }
}
