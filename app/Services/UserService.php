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

    

    

    public function failedLogin( $name ) {

        $user = User::where( "name", $name )->first();

        if( !is_null( $user )) {

            $counter = $this->banService->getLoginCounter( $user );
            
            if( $counter < 3 ) {

                $this->banService->setLoginCounter( $user );

            }else {

                return $this->banService->setBanningTime( $user );
            }
            
            
            return $this->sendResponse( $counter );
        }
    }

    
}
