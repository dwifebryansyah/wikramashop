<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable= [
        'jenis_laporan',
        'tanggal',
        'product_id',
        'order_id',
        'code_report',
        'harga',
        'keterangan',
        'status',
        'jumlah_awal',
        'jumlah_jual',
        'jumlah_akhir',
        'bm_jumlah',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
