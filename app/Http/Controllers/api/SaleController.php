<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Http\Resources\SaleResource;
use App\Http\Requests\SaleRequest;
use App\Traits\ResponseTrait;

class SaleController extends Controller {
    
    use ResponseTrait;

    public function getSales() {

        $sales = Sale::with( "menuitem.category" )->get();

        return $this->sendResponse( SaleResource::collection( $sales ), "" );
    }

    public function addSale( SaleRequest $request ) {

        $id = ( new FoodController )->getId( $request[ "name" ]);
        $price = ( new FoodController )->getPrice( $id );
        $sale = new Sale();
        $sale->menuitem_id = $id;
        $sale->user_id = $request[ "user_id" ];
        $sale->date = $request[ "date" ];
        $sale->time = $request[ "time" ];
        $sale->quantity = $request[ "quantity" ];
        $sale->totalrevenue = $request[ "quantity" ] * $price;

        $sale->save();

        return $this->sendResponse( $sale, "Sikeres írás" );
    }
}
