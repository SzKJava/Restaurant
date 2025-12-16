<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\SaleController;
use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\AuthController;

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
Route::post( "/addcategory", [ CategoryController::class, "addCategory" ]);

// Sale
Route::get( "/sales", [ SaleController::class, "getSales" ]);
Route::post( "/addsale", [ SaleController::class, "addSale" ]);

// Admin
Route::get( "/users", [ AdminController::class, "getUsers" ]);

// User
Route::post( "/register", [ AuthController::class, "register" ]);
Route::post( "/login", [ AuthController::class, "login" ]);