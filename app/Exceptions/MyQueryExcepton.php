<?php

namespace App\Exceptions;

use Illuminate\Http\Request;

use Exception;

class MyQueryExcepton extends Exception {
    
    public function __construct() {}
    
    public function render( QueryException $ex, Request $request ) {

        $this->request = $request;
        $message = $this->buildMessage( $request );
        parent::__construct( $message, 500, $ex );
    }

    private function buildMessage( Request $request ) {

        $route = $request->route();
        $modelName = collect( $route->parameterNames() )->first();
        //$value = collect( $route->parameters() )->skip( 1 )->first();
        $this->debugMessage = "Érvénytelen mező '{$modelName}'";
        $safeMessage = "Adatbázis hiba, ellenőrizze az adatokat!";

        return config( "app.debug" ) ? $this->debugMessage : $safeMessage;
    }
}
