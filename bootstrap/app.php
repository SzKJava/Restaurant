<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\MyQueryExcepton;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        $exceptions->reportable( function( QueryException $ex ){

            Log::channel( "create_log" )->error( "Sikertelen adatfelvétel. ". $ex->getMessage() );
        });

        $exceptions->renderable( function( QueryException $exc, Request $request ) {

            throw new MyQueryExcepton( $exc, $request );

            // $safeMessage = "Próbálja késöbb";
            // $debugMessage = $exc->getMessage();

            // if( $request->is( "api/*" )) {

            //     return response()->json([
            //         "success" => false,
            //         "message" => "Adatbázis hiba",
            //         "details" => config( "app.debug" ) ? $debugMessage : $safeMessage,
            //     ]);
            // }
        });

    })->create();
