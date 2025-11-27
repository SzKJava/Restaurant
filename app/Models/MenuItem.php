<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model {

    protected $table = "menuitems";
    public $timestamps = false;

    public function category() {

        return $this->belongsTo( Category::class );
    }

    public function sale() {

        return $this->hasMany( Sale::class );
    }
}
