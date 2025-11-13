<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProbaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get( "/teszt", function(){

    return "Saját végpont";
});

Route::get( "/proba", [ ProbaController::class, "proba" ]);
