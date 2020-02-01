<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable= [
        'product_id',
        'harga_beli',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
