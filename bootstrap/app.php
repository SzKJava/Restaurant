<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\MyQueryExcepton;
use App\Exceptions\InvalidModelException;

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
        
        $exceptions->renderable( function( QueryException $exc, Request $request ) {

            if( $request->is( "api/*" )) {

                throw new MyQueryExcepton( $exc, $request );
            }
        });

        $exceptions->renderable( function( NotFoundHttpException $ex, Request $request ) {

            if( $request->is( "api/*" )) {

                throw new InvalidModelException( $ex, $request );
            }
        });

    })->create();
