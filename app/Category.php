<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name',
    ];

    public function units(){
        return $this->hasMany('App\Unit');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }
}
