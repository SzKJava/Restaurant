<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ResponseTrait;

class FailedLoginService {

    use ResponseTrait;

    protected BanService $banService;

    public function __construct( BanService $banService ) {
        
        $this->banService = $banService;
    }

    public function failedLogin( $name ) {

        $user = User::where( "name", $name )->first();

        if( !is_null( $user )) {

            $counter = $this->banService->getLoginCounter( $user );
            
            if( $counter < 3 ) {

                $this->banService->setLoginCounter( $user );
                
            }else {

                $this->banService->setBanningTime( $user );

                return $this->sendError( "Azonosítási hiba", [ "Fiók zárolva"], 403 );
            }
            
            return $this->sendError( "Autentikációs hiba", "Hibás felhasználónév vagy jelszó", 403 );
        }
    }
}
