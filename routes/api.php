<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Food
Route::get( "/foods", [ FoodController::class, "getFoods" ]);
Route::get( "/catfoods", [ MenuItemController::class, "getFoodsWithCategory" ]);
Route::get( "/food", [ FoodController::class, "getFood" ]);
Route::post( "/newfood", [ FoodController::class, "addFood" ]);
Route::put( "/updatefood/{id}", [ FoodController::class, "updateFood" ]);
Route::get( "/destroyfood/{id}", [ FoodController::class, "destroyfood" ]);
Route::get( "/testfood", [ MenuItemController::class, "food" ]);

// Category
Route::get( "/categories", [ CategoryController::class, "getCategories" ]);
