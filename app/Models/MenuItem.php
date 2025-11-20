<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model {

    protected $table = "menuitems";
    public $timestamps = false;

    // protected $fillable = [

    //     "name", "category_id", "price"
    // ];

    public function category() {

        return $this->belongsTo( Category::class );
    }
}
