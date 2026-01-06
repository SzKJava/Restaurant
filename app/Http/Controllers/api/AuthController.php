<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Services\UserService;

class AuthController extends Controller {
    
    protected UserService $userService;

    public function __construct( UserService $userService ) {

        $this->userService = $userService;
    }

    public function register( AuthRequest $request ) {

        $validated = $request->validated();
        
        return $this->userService->userRegister( $validated );
    }

    public function login( Request $request ) {

        if( Auth::attempt([ "name" => $request[ "name"], "password" => $request[ "password" ]])) {

            $user = Auth::user();
            return $this->userService->userLogin( $user );

        }else {

            return $this->userService->failedLogin( $request[ "name" ]);
        }
    }

    public function logout() {

        $user = auth( "sanctum" )->user();
        
        return $this->userService->userLogout( $user );
    }
}
