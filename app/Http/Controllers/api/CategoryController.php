<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends ResponseController {
    
    public function getCategories() {

        $categories = Category::all();

        return $this->sendResponse( $categories, "" );
    }

    public function addCategory() {

    }

    public function updateCategory() {

    }

    public function destroyCategory() {

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
