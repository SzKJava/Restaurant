<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Http\Resources\FoodResource;
use App\Http\Requests\FoodRequest;
use App\Traits\ResponseTrait;
use App\Services\FoodService;

class FoodController extends Controller {

    use ResponseTrait;
    protected FoodService $foodService;

    public function __construct( FoodService $foodService ) {

        $this->foodService = $foodService;
    }

    public function getFoods() {

        $foods = MenuItem::with( "category" )->get();

        return $this->sendResponse( FoodResource::collection( $foods ) );
    }

    public function getFood( MenuItem $menuItem ) {

        return $this->sendResponse( new FoodResource( $menuItem ));
    }

    public function createFood( FoodRequest $request ) {

        $validated = $request->validated();

        return $this->foodService->create( $validated );
    }

    public function updateFood( FoodRequest $request, MenuItem $menuItem ) {

        $validated = $request->validated();

        return $this->foodService->update( $validated, $menuItem );
        
    }

    public function destroyFood( MenuItem $menuItem ) {

        return $this->foodService->delete( $menuItem );
    }
}
