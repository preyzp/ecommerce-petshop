<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $guarded = [];
    
    public function kategori(){
    	return $this->belongsTo('App\Kategori')->withDefault();
    }

    public function keranjang(){
    	return $this->hasMany('App\Keranjang')->withDefault();
    }
}
