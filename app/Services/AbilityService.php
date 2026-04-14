<?php

namespace App\Services;

class AbilityService {
    
    public function __construct(){}

    public function getSuperAbility() {

        return [ "*" ];
    }

    public function getAdminAbility() {

        return [
            "users:read",
            "users:update",
            "users:create",
            "users:delete",
            "categories:read",
            "categories:update",
            "categories:create",
            "menuitems:read",
            "menuitems:update",
            "menuitems:create",
            "sales:read",
            "sales:update",
            "sales:create",
            "sales:delete",
        ];
    }

    public function getUserAbility() {

        return [
            "users:read",
            "users:update",
            "users:create",
            "categories:read",
            "menuitems:read",
        ];
    }
}
