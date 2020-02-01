<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable= [
        'product_id',
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
