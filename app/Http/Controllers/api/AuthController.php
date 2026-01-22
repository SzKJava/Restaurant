<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Services\RegisterService;
use App\Services\AuthService;
use App\Services\FailedLoginService;

class AuthController extends Controller {
    
    protected RegisterService $registerService;
    protected AuthService $authService;
    protected FailedLoginService $failedLoginService;

    public function __construct( RegisterService $registerService, AuthService $authService, FailedLoginService $failedLoginService ) {

        $this->registerService = $registerService;
        $this->authService = $authService;
        $this->failedLoginService = $failedLoginService;
    }

    public function register( AuthRequest $request ) {

        $validated = $request->validated();
        
        return $this->registerService->userRegister( $validated );
    }

    public function login( Request $request ) {

        if( Auth::attempt([ "name" => $request[ "name"], "password" => $request[ "password" ]])) {

            $user = Auth::user();
            return $this->authService->userLogin( $user );

        }else {

            return $this->failedLoginService->failedLogin( $request[ "name" ]);
        }
    }

    public function logout() {

        $user = auth( "sanctum" )->user();
        
        return $this->authService->userLogout( $user );
    }
}
