<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Traits\ResponseTrait;

class FoodService {
   
    use ResponseTrait;
    protected CategoryService $categoryService;

    public function __construct( CategoryService $categoryService ) {
        
        $this->categoryService = $categoryService;
    }

    public function create( $data ) {

        $food = new MenuItem();
        $food->name = $data[ "name" ];
        $food->category_id = $this->categoryService->getId( $data[ "category" ]);
        $food->price = $data[ "price" ];

        $food->save();

        return $this->sendResponse( $food->name, "Sikeres írás" );
    }

    public function update( $data, MenuItem $menuItem ) {

        $menuItem->name = $data[ "name" ];
        $menuItem->category_id = $this->categoryService->getId( $data[ "category" ]);
        $menuItem->price = $data[ "price" ];

        $menuItem->update();

        return $this->sendResponse( $menuItem, "Sikeres módosítás" );
    }

    public function delete( MenuItem $menuItem ) {

        $menuItem->delete();

        return $this->sendResponse( $menuItem->name, "Sikeres törlés" );
    }
}
