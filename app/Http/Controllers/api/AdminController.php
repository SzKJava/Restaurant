<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\ProfileService;

class AdminController extends Controller {
    
    public function __construct( protected ProfileService $profileService ) {}

    public function getUsers() {

        $users = $this->profileService->view();

        return $users;
    }

    public function getUser() {

    }

    public function createUser() {

    }

    public function updateUser() {

    }

    public function destroyUser() {

    }

    public function setNewPassword() {

    }
}
