<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data['barang'] = \App\Barang::latest()->limit(5)->get()->where('level', 0);
        $data['kategori'] = \App\Kategori::all();
        return view('beranda', $data);
    }

    public function detail($id)
    {
        $data['barang'] = \App\barang::findOrFail($id);

        return view('front_detail_barang', $data);
    }
}
