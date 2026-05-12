<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

use Exception;

class InvalidModelException extends Exception {
    
    use ResponseTrait;

    protected string $debugMessage;

    public function __construct( NotFoundHttpException $ex, protected Request $request ) {

        $this->debugMessage = $this->buildMessage( $request );
        parent::__construct( $this->debugMessage, 405, $ex );
    }

    public function render() {

        return $this->sendError( "Végrehajtási hiba", [ $this->getMessage() ], 405 );
    }

    public function report() {

        Log::channel( "invalid_model" )->error( "Model hiba", [

            "message" => $this->debugMessage,
            "method" => $this->getFriendlyMethodName(),
            "url" => $this->request->url(),
            "ip" => $this->request->ip(),
        ]);
    }
    
    private function buildMessage( Request $request ) {

        $route = $request->route();
        $modelName = collect( $route->parameterNames() )->first();
        $value = collect( $route->parameters() )->first();
        $this->debugMessage = "HIÁNYZÓ REKORD: A(z) '{$modelName}' táblában a(z) 'id' = '{$value}' feltétellel.";
        $safeMessage = "Műveleti hiba, ellenőrizze az adatokat.";

        return config( "app.debug" ) ? $this->debugMessage : $safeMessage;
    }

    private function getFriendlyMethodName(): string {

        return match( $this->request->method() ) {

            "GET" => "Lekérés",
            "POST" => "Létrehozás",
            "PUT", "PATCH" => "Módosítás",
            "DELETE" => "Törlés",
            default => "Ismeretlen művelet"
        };
    }
}
