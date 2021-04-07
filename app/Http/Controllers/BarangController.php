<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $objek = \App\Barang::orderBy('kategori_id')->where('level', 0)->paginate(10);
        $data['objek'] = $objek;
        return view('barang_index', $data);
    }

    public function tambah()
    {
        $data['objek']          =  new \App\Barang();
        $data['action']         = 'BarangController@simpan';
        $data['method']         = 'POST';
        $data['btn_submit']     = 'SIMPAN';
        return view('barang_form', $data);
    }

    public function simpan(Request $request)
    {
        $validasi = $this->validate($request, [
            'nama_barang'   => 'required|min:2',
            'keterangan'    => 'required',
            'harga_barang'  => 'required',
            'jumlah_stok'   => 'required',
            'foto'          => 'required|mimes:png,jpg,jpeg',
            'kategori_id'   => 'required',
        ]);
        $path = $request->file('foto')->store('public/foto-barang');
        $objek = new \App\Barang();
        $objek->nama_barang = $request->nama_barang;
        $objek->keterangan = $request->keterangan;
        $objek->harga_barang = $request->harga_barang;
        $objek->jumlah_stok = $request->jumlah_stok;
        $objek->foto = $path;
        $objek->kategori_id = $request->kategori_id;
        $objek->level = 0;
        $objek->save();
        return redirect('admin/barang/index')->with(['pesan'=> 'Data sudah disimpan!', 'type'=>'success']);
    }

    public function edit($id)
    {
        $data['objek']             =  \App\Barang::findOrFail($id);
        $data['action']         = ['BarangController@update', $id];
        $data['method']         = 'PUT';
        $data['btn_submit']     = 'Update';
        return view('barang_form', $data);
    }

    public function update(Request $request, $id)
    {
        $validasi = $this->validate($request, [
            'nama_barang' => 'required|min:2',
            'keterangan'    => 'required',
            'harga_barang'  => 'required',
            'jumlah_stok'   => 'required',
            'foto'          => 'required|mimes:png,jpg,jpeg',
            'kategori_id'   => 'required',
        ]);
        $path = $request->file('foto')->store('public/foto-barang');
        $objek = \App\Barang::findOrFail($id);
        $objek->nama_barang = $request->nama_barang;
        $objek->keterangan = $request->keterangan;
        $objek->harga_barang = $request->harga_barang;
        $objek->jumlah_stok = $request->jumlah_stok;
        $objek->foto = $path;
        $objek->kategori_id = $request->kategori_id;
        $objek->level = 0;
        $objek->save();
        return redirect('admin/barang/index')->with(['pesan'=> 'Data sudah di Update!', 'type'=> 'success']);
    }

    public function cari(Request $ambildata)
	{
		$cari = $ambildata->get('search');
		$data['objek']= \App\Barang::where('nama_barang','LIKE','%'.$cari.'%')
                                        ->orwhere('kategori_id','LIKE','%'.$cari.'%')->paginate(10);
		return view('barang_index',$data);
	}

    public function hapus($id)
    {
        $barang = \App\Barang::findOrFail($id);
        $barang-> level = 1;
        $barang->update();
        return redirect('admin/barang/index')->with('pesan', 'Data sudah dihapus!');
    }

    public function shop(Request $request)
    {
        if (isset($request->kategori)) {
            $data['barang'] = \App\Barang::where('kategori_id', $request->kategori)->where('level', 0)->paginate(9);
            $data['select'] = \App\Kategori::findOrFail($request->kategori)->nama_kategori;
        } else {
            $data['barang'] = \App\Barang::where('level', 0)->paginate(9);
        }
        $data['kategori'] = \App\Kategori::all();
        $data['produk'] = \App\Barang::latest()->limit(5)->get()->where('level', 0);

        return view('shop_produk', $data);
    }
}
