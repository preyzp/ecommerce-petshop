<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKeranjang extends Model
{
    protected $guarded = [];

    public function keranjang()
    {
        return $this->belongsTo('App\Keranjang')->withDefault();
    }

    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi')->withDefault();
    }
}
