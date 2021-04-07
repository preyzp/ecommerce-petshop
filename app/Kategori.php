<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = [];

    public function barang(){
    	return $this->hasMany('App\Barang')->withDefault();
    }

}
