<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller {

    public function getFoods() {

        $foods = DB::table( "menuitems" )->orderBy( "name" )->get();

        return $foods;
    }

    public function getFood() {

        $food = DB::table( "menuitems" )->where( "name", "Tiramisu" )->first();

        return $food;
    }

    public function food() {

        //$food = DB::table( "menuitems" )->where( "id", 9 )->where( "name", "Tiramisu" )->first();

        $food = DB::table( "menuitems" )->select( "name as Név", "price as Ár" )->
                         where( "id", 9 )->first();
        return $food;
    }

    public function getFoodsWithCategory() {

        $foods = DB::table( "menuitems" )->select( "menuitems.name as Név",
                                                   "menuitems.price as Ár",
                                                   "categories.name as Kategória" )
                                                   ->join( "categories", "menuitems.category_id", "=", "categories.id" )
                                                   ->orderBy( "categories.name" )->get();
        return $foods;
    }

    public function addFood() {

        $data = [
            "name" => "Mákos tészta",
            "category_id" => 4,
            "price" => 1200
        ];

        DB::table( "menuitems" )->insert( $data );

        return "Sikeres írás";
    }

     public function updateFood() {

        $data = [

            "price" => 1500
        ];

        DB::table( "menuitems" )->where( "name", "Mákos tészta" )->update( $data );

        return "Sikeres módosítás";
     }

     public function destroyFood() {

        $food = DB::table( "menuitems" )->where( "id", 21 )->delete();

        return "Sikeres törlés";
     }
}
