<?php

namespace App\Services;

use App\Models\Category;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class CategoryService {
    
    use ResponseTrait;

    public function __construct() {
        //
    }

    public function create( $data, User $user ) {

        $category = new Category();
        $category->name = $data[ "name" ];

        // $category->save();

        Log::channel( "create_log" )->info( "új kategória felvéve", [ "name" => $user->name, "category" => $category->name ]);

        return $this->sendResponse( $category->name, "Sikeres írás" );
    }

    public function update( $data, Category $category ) {

        $category->name = $data[ "name" ];

        $category->update();

        return $this->sendResponse( $category->name, "Sikeres módosítás" );
    }

    public function delete( Category $category ) {

        // $category->delete();

        return $this->sendResponse( $category->name, "Sikeres törlés" );
    }

    public function getId( $name ) {

        $category = Category::where( "name", $name )->first();
        $id = $category->id;

        return $id;
    }
}
