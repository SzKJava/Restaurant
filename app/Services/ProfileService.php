<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use App\Http\Resources\UserResource;

class ProfileService {

    public function __contstruct() {
        
    }

    public function view() {

        $users = Profile::all();

        return UserResource::collection( $users );
    }
}