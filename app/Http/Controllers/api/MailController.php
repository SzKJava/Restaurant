<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {
    
    public function sendMail( User $user ): bool {

        $content = [
            "title" => "Teszt üzenet",
            "user" => $user->name,
            "time" => Carbon::now(),
        ];

        Mail::to( "laravelfejlesztes@gmail.com" )->send( new MyMail( $content ));

        return false;
    }
}
