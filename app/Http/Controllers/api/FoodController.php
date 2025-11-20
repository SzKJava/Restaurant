<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;

class FoodController extends Controller {

    public function getFoods() {

        //$foods = MenuItem::all();

        $foods = MenuItem::with( "category" )->get();

        return response()->json([ "foods" => $foods ]);
    }

    public function getFood() {

        $food = MenuItem::where( "name", "Tiramisu" )->first();

        return response()->json([ "food" => $food ]);
    }

    public function addFood( Request $request ) {

        // $food = MenuItem::create([
        //     "name" => $request[ "name" ],
        //     "category_id" => $request[ "category_id" ],
        //     "price" => $request[ "price" ]
        // ]);

        $food = new MenuItem();

        $food->name = $request[ "name" ];
        $food->category_id = $request[ "category_id" ];
        $food->price = $request[ "price" ];

        $food->save();

        return response()->json([ "success" => $food ]);
    }

    public function updateFood( Request $request, $id ) {

        $food = MenuItem::find( $id );

        if( is_null( $food ) ) {

            return response()->json([ "success" => "Nincs ilyen étel" ]);

        } else {

            $food->name = $request[ "name" ];
            $food->category_id = $request[ "category_id" ];
            $food->price = $request[ "price" ];

            $food->update();

            return response()->json([ "success" => $food ]);
        }
    }

    public function destroyFood( $id ) {

        $food = MenuItem::find( $id );
        if( is_null( $food )) {

            return response()->json([ "success" => false, "message" => "Nincs ilyen étel" ]);

        }else {

            $food->delete();

            return response()->json([ "success" => true, "message" => "Sikeres törlés"]);
        }
    }
}
