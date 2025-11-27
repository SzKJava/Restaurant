<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
    
    public function menuitem() {

        return $this->belongsTo( MenuItem::class );
    }
}
