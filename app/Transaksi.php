<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    public function pelanggan()
    {
        return $this->belongsTo('App\Pelanggan')->withDefault();
    }

    public function transaksi_keranjang()
    {
        return $this->hasMany('App\TransaksiKeranjang');
    }

    public function kota()
    {
        return $this->belongsTo('App\Kota')->withDefault();
    }

    public function alamat()
    {
        return $this->belongsTo('App\Alamat')->withDefault();
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank')->withDefault();

    }
}
