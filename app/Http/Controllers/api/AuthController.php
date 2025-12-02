<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller {
    
    public function register( AuthRequest $request ) {

        $validated = $request->validated();
    }

    public function login() {


    }

    public function logout() {


    }
}
