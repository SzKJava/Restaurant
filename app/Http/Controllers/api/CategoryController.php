<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends ResponseController {
    
    public function getCategories() {

        $categories = Category::all();

        return $this->sendResponse( $categories, "" );
    }

    public function addCategory( CategoryRequest $request ) {

        //$request->validated();
        $category = new Category();
        $category->name = $request[ "name" ];

        //$category->save();

        return $this->sendResponse( $category, "Sikeres kiírás" );
    }

    public function updateCategory( Request $request, $id ) {

        $category = Category->find( $id );
        $category->name = $request[ "name" ];

        return $this->sendResponse( $category, "Sikeres módosítás" );
    }

    public function destroyCategory( $id ) {

        $category = Category->find( $id );
        $category->delete();

        return $this->sendResponse( $category, "Sikeres törlés" );
    }

    public function getId( $name ) {

        $category = Category::where( "name", $name )->first();
        if( is_null( $category )) {

            return false;

        }else {

            $id = $category->id;
            return $id;
        }
    }
}
