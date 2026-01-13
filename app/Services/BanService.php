<?php

namespace App\Services;

use App\Models\User;

class BanService {
    /**
     * Create a new class instance.
     */
    public function __construct() {
        
    }

    public function resetLoginCounter( User $user ) {

        $user->loginCounter = 0;
        $user->update();
    }

    public function getLoginCounter( User $user ) {

        return $user->logincounter;
    }

    public function setLoginCounter( User $user ) {

        $user->increment( "logincounter" );
        $user->update();
    }


}
