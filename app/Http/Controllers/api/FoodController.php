<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Http\Resources\FoodResource;

class FoodController extends ResponseController {

    public function getFoods() {

        //$foods = MenuItem::all();

        $foods = MenuItem::with( "category" )->get();

        return $this->sendResponse( FoodResource::collection( $foods ), "" );
    }

    public function getFood( Request $request ) {

        $food = MenuItem::where( "name", $request[ "food" ] )->first();

        return $this->sendResponse( new FoodResource( $food ), "" );
    }

    public function addFood( Request $request ) {

        $request->validate([

            "name" => [ "required", "string", "max:20", "unique:menuitems" ],
        ]); 

        // $food = MenuItem::create([
        //     "name" => $request[ "name" ],
        //     "category_id" => $request[ "category_id" ],
        //     "price" => $request[ "price" ]
        // ]);

        $food = new MenuItem();

        $food->name = $request[ "name" ];
        $food->category_id = ( new CategoryController )->getId( $request[ "category" ]);
        $food->price = $request[ "price" ];

        //$food->save();

        return response()->json([ "success" => $food ]);
    }

    public function updateFood( Request $request, $id ) {

        $food = MenuItem::find( $id );

        if( is_null( $food ) ) {

            return response()->json([ "success" => "Nincs ilyen étel" ]);

        } else {

            $food->name = $request[ "name" ];
            $food->category_id = ( new CategoryController )->getId( $request[ "category" ]);
            $food->price = $request[ "price" ];

            $food->update();

            return response()->json([ "success" => $food ]);
        }
    }

    public function destroyFood( $id ) {

        $food = MenuItem::find( $id );
        if( is_null( $food )) {

            return $this->sendError( "Adathiba", ["Nincs ilyen étel"], 406 );

        }else {

            $food->delete();

            return $this->sendResponse( $food, "Sikeres törlés" );
        }
    }
}
