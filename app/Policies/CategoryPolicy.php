<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Category;

class CategoryPolicy {

    public function __construct(){}

    public function before( User $user, string $ability ): ?bool {

        if( $user->role === "super" ) {

            return true;

        }

        return null;
    }

    public function viewAny( User $user ): Response {

        if( $user->isAdmin() || $user->tokenCan( "categories:read" ) ) {

            return Response::allow();
        }

        return Response::deny( "Nincs jogosultság" );
    }

    public function create( User $user ): Response {

        if( $user->isAdmin() && $user->tokenCan( "categories:create" )) {

            return Response::allow();
        }

        return Response::deny( "Nincs jogosultsága létrehozáshoz" );
    }

    public function delete( User $user, Category $category ): Response {

        if( $user->isAdmin() && $user->tokenCan( "categories:delete" )) {

            return Response::allow();
        }

        return Response::deny( "Nincs joga törölni" );
    }
}
