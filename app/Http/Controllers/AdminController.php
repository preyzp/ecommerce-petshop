<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index()
    {
        $data['objek'] = \App\User::latest()->paginate(10);
        return view('admin_index', $data);
    }

    public function tambah()
    {
        if (auth()->user()->level == 0){
            return back()->with('pesan','Anda tidak diizinkan!');
        }    

                            

        $data['objek'] 		    =  new \App\User();
        $data['action'] 		= 'AdminController@simpan';
        $data['method'] 		= 'POST';        
        $data['btn_submit'] 	= 'SIMPAN';
        return view('Admin_form',$data);
    }

    public function simpan(Request $request)
    {
        $validasi = $this->validate($request,[
            'name' => 'required|min:2',
            'email' => 'required|unique:users',
            'password' => 'required|min:2',
                   
            ]);         
        $objek = new \App\User();
        $objek->name = $request->name;
        $objek->email = $request->email;
        $objek->password =  Hash::make($request->password);
        $objek->level = 0;
        $objek->save();
        return redirect('admin/admin/index')->with('pesan', 'Data sudah disimpan!');
    }

    public function edit($id)
    {
        if (auth()->user()->level == 0){
            return back()->with('pesan','Anda tidak diizinkan!');
        }    
        $data['objek'] 		    =  \App\User::findOrFail($id);  
        $data['action'] 		= ['AdminController@update', $id]; 
        $data['method'] 		= 'PUT';        
        $data['btn_submit'] 	= 'Update';
        return view('admin_form',$data);
    }

    public function update(Request $request, $id)
    {
        $validasi = $this->validate($request,[
            'name' => 'required|min:2',
            'email' => 'required',
            'password' => 'required|min:2',
            ]);         
        $objek = \App\User::findOrFail($id);
        $objek->name = $request->name;
        $objek->email = $request->email;
        $objek->password = Hash::make($request->password);
        $objek->save();
        return redirect('admin/admin/index')->with('pesan','Data berhasil di Update!');
    }

    public function hapus($id)
    {
        if (auth()->user()->level == 0){
            return back()->with('pesan','Anda tidak diizinkan!');
        }    
        $Admin = \App\User::findOrFail($id);
        if (auth()->user()->id == $id){
            return back()->with('pesan','Hapus tidak diijinkan!');
        }
        elseif ($Admin->level == 1 ){
            return back()->with('pesan','Hapus tidak diijinkan!');
        }  
        $Admin->delete();		
        return redirect('admin/admin/index')->with('pesan','Data sudah dihapus!');
    }
}
