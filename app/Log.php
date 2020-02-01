<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'histories';
    protected $fillable= [
        'user_id',
        'product_change',
        'supplier_change',
        'order_change',
        'debt_change',
        'convert_change',
        'category_change',
        'unit_change',
        'infomation_change',
        'role_change',
        'account_change',
        'tanggal',
        'activity',
        'detail_activity',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
