<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;

use Exception;

class MyQueryExcepton extends Exception {
    
    use ResponseTrait;

    public function __construct( protected QueryException $ex, protected Request $request ) {

        $message = $this->buildMessage( $request );
        parent::__construct( $message, 500, $ex );
    }
    
    public function render( Request $request ) {

        return $this->sendError( "Végrehajtási hiba", [ $this->getMessage()], 500 );
    }

    private function buildMessage( Request $request ) {

        $route = $request->segment( 2 );
        $this->debugMessage = "Érvénytelen mező a(z) '{$route}' útvonalon.";
        $safeMessage = "Adatbázis hiba, ellenőrizze az adatokat!";

        return config( "app.debug" ) ? $this->debugMessage : $safeMessage;
    }
}
