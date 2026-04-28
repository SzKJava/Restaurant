<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Traits\ResponseTrait;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class CategoryController extends Controller {
    
    use ResponseTrait;
    protected CategoryService $categoryService;

    public function __construct( CategoryService $categoryService ) {

        $this->categoryService = $categoryService;
    }

    public function getCategories() {

        Gate::authorize( "viewAny", Category::class );

        $categories = Category::all();

        return $this->sendResponse( $categories );
    }

    public function createCategory( CategoryRequest $request, User $user ) {

        Gate::authorize( "create", Category::class );

        $validated = $request->validated();
        
        return $this->categoryService->create( $validated, auth()->user() );
    }

    public function updateCategory( CategoryRequest $request, Category $category ) {

        $validated = $request->validated();

        return $this->categoryService->update( $validated, $category );
    }

    public function destroyCategory( Category $category ) {

        Gate::authorize( "delete", $category );
        
        return $this->categoryService->delete( $category );
    }
}
