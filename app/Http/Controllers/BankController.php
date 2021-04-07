<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $objek = \App\Bank::latest()->paginate(10)->where('level',0);
        $data['objek'] = $objek;
        return view('bank_index',$data);
    }

    public function tambah()
    {
        $data['objek'] 		    =  new \App\Bank();
        $data['action'] 		= 'BankController@simpan';
        $data['method'] 		= 'POST';        
        $data['btn_submit'] 	= 'SIMPAN';
        return view('bank_form',$data);
    }

    public function simpan(Request $request)
    {
        $validasi = $this->validate($request,[
            'nama_bank' => 'required|min:2',
            'atas_nama' => 'required|min:2',
            'no_rekening' => 'required|min:2',       
            ]);         
        $objek = new \App\bank();
        $objek->nama_bank = $request->nama_bank;
        $objek->atas_nama = $request->atas_nama;
        $objek->no_rekening = $request->no_rekening;
        $objek->save();
        return redirect('admin/bank/index')->with('pesan', 'Data sudah disimpan!');
    }

    public function edit($id)
    {
        $data['objek'] 		    =  \App\Bank::findOrFail($id);  
        $data['action'] 		= ['BankController@update', $id]; 
        $data['method'] 		= 'PUT';        
        $data['btn_submit'] 	= 'Update';
        return view('bank_form',$data);
    }

    public function update(Request $request, $id)
    {
        $validasi = $this->validate($request,[
            'nama_bank' => 'required|min:2',
            ]);         
        $objek = \App\Bank::findOrFail($id);
        $objek->nama_bank = $request->nama_bank;
        $objek->atas_nama = $request->atas_nama;
        $objek->no_rekening = $request->no_rekening;
        $objek->save();
        return redirect('admin/bank/index')->with('pesan','Data sudah di Update!');
    }

    public function hapus($id)
    {
        $bank = \App\Bank::findOrFail($id);
        $bank->level = 1;
        $bank->update();		
        return redirect('admin/bank/index')->with('pesan','Data sudah dihapus!');
    }
}
