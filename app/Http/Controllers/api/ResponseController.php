<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResponseController extends Controller {
    
    public function sendResponse( $data, $message ) {

        $sending = [
            "success" => true,
            "message" => $message,
            "data" => $data
        ];

        return response()->json( $sending );
    }

    public function sendError( $type, $message = [], $code = 404 ) {

        $sending = [
            "success" => false,
            "error" => $type,
            "messages" => $message,
        ];

        return response()->json( $sending, $code );
    }
}
