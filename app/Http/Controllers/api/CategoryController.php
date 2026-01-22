<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Traits\ResponseTrait;
use App\Services\CategoryService;

class CategoryController extends Controller {
    
    use ResponseTrait;
    protected CategoryService $categoryService;

    public function __construct( CategoryService $categoryService ) {

        $this->categoryService = $categoryService;
    }

    public function getCategories() {

        $categories = Category::all();

        return $this->sendResponse( $categories );
    }

    public function createCategory( CategoryRequest $request ) {

        $validated = $request->validated();
        
        return $this->categoryService->create( $validated );
    }

    public function updateCategory( CategoryRequest $request, Category $category ) {

        $validated = $request->validated();

        return $this->categoryService->update( $validated, $category );
    }

    public function destroyCategory( Category $category ) {

        return $this->categoryService->delete( $category );
    }
}
