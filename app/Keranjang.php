<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $guarded = [];

    public function pelanggan(){
    	return $this->belongsTo('\App\Pelanggan')->withDefault();
    }
    
    public function barang(){
    	return $this->belongsTo('\App\Barang')->withDefault();
    }
}
