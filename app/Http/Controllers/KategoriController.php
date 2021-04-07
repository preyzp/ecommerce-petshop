<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $objek = \App\Kategori::latest()->where('level', 0)->paginate(10);
        $data['objek'] = $objek;
        return view('kategori_index',$data);
    }

    public function tambah()
    {
        $data['objek'] 		    =  new \App\Kategori();
        $data['action'] 		= 'KategoriController@simpan';
        $data['method'] 		= 'POST';        
        $data['btn_submit'] 	= 'SIMPAN';
        return view('kategori_form',$data);
    }

    public function simpan(Request $request)
    {
        $validasi = $this->validate($request,[
            'nama_kategori' => 'required|min:2',       
            ]);         
        $objek = new \App\Kategori();
        $objek->nama_kategori = $request->nama_kategori;
        $objek->level = 0;
        $objek->save();
        return redirect('admin/kategori/index')->with('pesan', 'Data sudah disimpan!');
    }

    public function edit($id)
    {
        $data['objek'] 		    =  \App\Kategori::findOrFail($id);  
        $data['action'] 		= ['KategoriController@update', $id]; 
        $data['method'] 		= 'PUT';        
        $data['btn_submit'] 	= 'Update';
        return view('kategori_form',$data);
    }

    public function update(Request $request, $id)
    {
        $validasi = $this->validate($request,[
            'nama_kategori' => 'required|min:2',
            ]);         
        $objek = \App\Kategori::findOrFail($id);
        $objek->nama_kategori = $request->nama_kategori;
        $objek->save();
        return redirect('admin/kategori/index')->with('pesan','Data sudah di Update!');
    }

    public function hapus($id)
    {
        $kategori = \App\Kategori::findOrFail($id);
        $kategori-> level = 1;
        $kategori->update();		
        return redirect('admin/kategori/index')->with('pesan','Data sudah dihapus!');
    }
}
