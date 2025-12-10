<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait {
    
    protected function sendResponse( $data, $message = "", $code = 200 ): JsonResponse {

        // siker, adat, üzenet, kód
        $response = [
            "success" => true,
            "data" => $data,
            "message" => $message
        ];

        return response()->json( $response, $code );
    }

    protected function sendError( $errorType, $errorMessages = [], $code = 404 ): JsonResponse {

        $response = [
            "success" => false,
            "errorType" => $errorType,
        ];

        if( !empty( $errorMessages )) {

            $response[ "error" ] = $errorMessages;
        }

        return response()->json( $response, $code );
    }

    protected function sendValidationErrors( $validatorErrors ): JsonResponse {

        $error = "Adatbeviteli hiba!";

        return $this->sendError( $error, $validatorErrors, 422 );
    }
}
