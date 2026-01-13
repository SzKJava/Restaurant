<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

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

    public function getBanningTime( User $user ) {

        return $user->banningtime;
    }

    public function setBanningTime( User $user ) {

        $user->banningtime = Carbon::now()->addHour()->addMinute();
        
        $user->update();
    }

    public function resetBanningTime( User $user ) {

        $user->banningtime = null;

        $user->update();
    }
}
