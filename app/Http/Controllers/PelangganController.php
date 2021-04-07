<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function daftar()
    {
        $data['objek'] = new \App\Pelanggan();
        $data['action'] = 'PelangganController@simpandaftar';
        $data['method'] = 'POST';

        return view('daftar', $data);
    }

    public function edit($id)
    {
        $data['objek']          =  \App\Pelanggan::findOrFail($id);
        $data['action']         = ['PelangganController@update', $id];
        $data['method']         = 'PUT';
        return view('profile',$data);
    }

    public function update(Request $request, $id)
    {
        $validasi = $this->validate($request, [
            'nama' => 'required',
            'email'    => 'required',
            'password'  => 'required',
            'alamat'   => 'required',
            'telp'          => 'required',
        ]);
        $objek = \App\Pelanggan::findOrFail($id);
        $objek->nama = $request->nama;
        $objek->email = $request->email;
        $objek->password = Hash::make($request->password);
        $objek->alamat = $request->alamat;
        $objek->telp = $request->telp;
        $objek->save();
        return redirect('pelanggan/profile')->with(['pesan' => 'Data sudah di Update!', 'type' => 'primary']);
    }

    public function simpandaftar(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'email'         => 'required|email|unique:pelanggans,email',
            'password'      => 'required',
            'alamat'        => 'required',
            'telp'          => 'required',
        ]);

        $pelanggan = new \App\Pelanggan();
        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->password = Hash::make($request->password);
        $pelanggan->alamat = $request->alamat;
        $pelanggan->telp = $request->telp;
        $pelanggan->save();

        \Auth::guard('pelanggan')->login($pelanggan);
        return redirect('/')->with(['pesan' => 'Registrasi Berhasil','type' => 'success']);
    }

    public function home()
    {
        if (\Auth::guard('pelanggan')->check()) {
            return view('pelanggan_home');
        } else {
            return redirect('form-login');
        }
    }

    public function formLogin()
    {
        if (\Auth::guard('pelanggan')->check()) {
            return redirect('pelanggan/home');
        }
        $data['objek']         =  new \App\Pelanggan();
        $data['action']     = 'PelangganController@prosesLogin';
        $data['method']     = 'POST';
        return view('login_form', $data);
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:25',
        ]);

        $credentials = [
            'email'         => $request->email,
            'password'  => $request->password
        ];

        if (\Auth::guard('pelanggan')->attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect('form-login')->with(['pesan' => 'Login Gagal','type' => 'danger']);
        }
    }

    public function logout()
    {
        \Auth::guard('pelanggan')->logout();
        return redirect('/');
    }

    public function index(Request $request)
    {
        $objek = \App\Pelanggan::latest()->paginate(10);
        $data['objek'] = $objek;
        return view('pelanggan_index', $data);
    }

    public function hapus($id)
    {
        $pelanggan = \App\Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect('admin/pelanggan/index')->with('pesan', 'Data sudah dihapus!');
    }

    public function detail($id)
    {
        $data['barang']     = \App\Barang::findOrFail($id);
        $data['obj']        = 'null';
        $data['action']     = 'PelangganController@simpanpesan';
        $data['method']     = "POST";
        $data['btn_submit'] = "Tambah ke Keranjang";
        $data['barang_id']  = $id;
        $kategori_id = $data['barang']->kategori_id;
        $data['produk'] = \App\Barang::where('kategori_id', $kategori_id)->limit(5)->get();
        $keranjang          = \App\Keranjang::where('barang_id', $id)->where('status', 1)->get();

        $total_beli = 0;

        foreach ($keranjang as $item) {
            $total_beli += $item->jlh_beli;
        }

        $data['total_beli'] = $total_beli;
        return view('shop_produk_detail', $data);
    }

    public function pesanupdate(Request $request){
        foreach($request->barang as $key => $value){

            $keranjang = \App\Keranjang::findOrFail($key);
            $barang = $keranjang->barang;

            $keranjang2 = \App\Keranjang::where('barang_id', $barang->id)->where('status',1)->get();
            
            $jlh_pembelian = 0;
            foreach($keranjang2 as $item){
                $jlh_pembelian += $item->jlh_beli;
            }

            $sisa = $barang->jumlah_stok - $jlh_pembelian;


            if($sisa >= $value){
                $barang_harga = $barang->harga_barang;
                $jlh_harga = $barang_harga * $value;
                $keranjang->update(['jlh_beli' => $value, 'jlh_harga' => $jlh_harga]);
            }else {
                return back()->with(['pesan' => 'Masukkan sesuai sisa stock!','type' => 'danger']);
            }

        }

        return redirect('pelanggan/pesan/hasil')->with(['pesan' => 'Berhasil Mengupdate Keranjang!','type' => 'success']);

    }

    public function simpanpesan(Request $request)
    {

        $request->validate(
            [
                'barang_id'              => 'required',
                'jlh_beli'               => 'required',
                'sisa_stock' => 'required',
                'id' => 'required'
            ]
        );

        if ($request->input('sisa_stock') < $request->input('jlh_beli')) {
            return redirect('shop/detail/' . $request->input('id'))->with(['pesan' => 'Masukan Sesuai Sisa Stok!','type' => 'danger']);
        }
        $request->request->remove('sisa_stock');

        $pelanggan_id = \Auth::guard('pelanggan')->user()->id;

        $data['pelanggan'] = \App\Pelanggan::All();

        $barang = \App\Barang::where('id', $request->barang_id)->first();
        $harga = $barang->harga_barang;
        $jlh_harga = $harga * $request->jlh_beli;

        $data = [
            'pelanggan_id' => $pelanggan_id,
            'barang_id' => $request->barang_id,
            'jlh_beli' => $request->jlh_beli,
            'jlh_harga' => $jlh_harga,
            'status' => 0,
            'status_chart' => 0,
        ];

        \App\Keranjang::create($data);
        return redirect('pelanggan/pesan/hasil')->with(['pesan' => 'Berhasil Memasukkan ke Keranjang!','type' => 'success']);
    }

    public function hasilpesan()
    {
        $pelanggan_id = \Auth::guard('pelanggan')->user()->id;
        //coding dibawah digunakan untuk mengambil data booking terbaru berdasarkan member id yang login
        $data['keranjang'] = \App\Keranjang::where('pelanggan_id', $pelanggan_id)->where('status', 0)->get();
        $data['pelanggan_id'] = $pelanggan_id;
        $data['judul']  = "Keranjang";
        return view('shop_chart', $data);
    }

    public function hapuspesan($id)
    {
        \App\Keranjang::findOrFail($id)->delete();
        return redirect('pelanggan/pesan/hasil')->with(['pesan'=>'Barang Telah Dihapus!', 'type'=> 'danger']);
    }

    public function bayarpesan()
    {
        $pelanggan_id = auth()->guard('pelanggan')->user()->id;
        $data['keranjang'] = \App\Keranjang::where('pelanggan_id', $pelanggan_id)->where('status_chart', 0)->get();
        $data['alamat'] = \App\Alamat::where('pelanggan_id', $pelanggan_id)->get();
        $data['bank'] = \App\Bank::where('level',0)->get();


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: b8e4dcaa90882d2d509dabe837595b9e"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $data['province'] = [];
        } else {
            $province = json_decode($response, true);
            $data['province'] = $province['rajaongkir']['results'];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: b8e4dcaa90882d2d509dabe837595b9e"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $data['kota'] = [];
        } else {
            $kota = json_decode($response, true);
            $data['kota'] = $kota['rajaongkir']['results'];
        }

        return view('shop_checkout', $data);
    }

    public function konfirmasipesan(Request $request)
    {
        $request->validate(
            [
                'nama_penerima' => 'required',
                'alamat' => 'required',
                'telp_penerima' => 'required',
                'pesan' => 'required',
                'courier' => 'required',
            ]
        );

        $pelanggan_id = \Auth::guard('pelanggan')->user()->id;
        $keranjang = \App\Keranjang::where('pelanggan_id', $pelanggan_id)->where('status_chart', 0);

        $total_harga = $keranjang->pluck('jlh_harga')->toArray();

        $courier = $request->courier;
        $courier = explode('/', $courier);
        $service_courier = $courier[0];
        $biaya_ongkir = $courier[1];

        $alamat = $request->alamat;
        $alamat = explode('/', $alamat);
        $alamat_id = $alamat[0];

        $data = [
            'pelanggan_id' => $pelanggan_id,
            'alamat_id' => $alamat_id,
            'bank_id' => $request->bank_id,
            'nama_penerima' => $request->nama_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'telp_penerima' => $request->telp_penerima,
            'pesan' => $request->pesan,
            'total_bayar' => array_sum($total_harga),
            'bukti_img' => '',
            'status' => 0,
            'biaya_ongkir' => $biaya_ongkir,
            'service_courier' => $service_courier,
            'no_resi' => '',
            'konfirmasi_img' => '',
            'pesan_reject' => '',
            'status_konfirmasi' => 0,
            'pesan_konfirmasi' => '',
        ];

        $transaksi = \App\Transaksi::create($data);
        foreach ($keranjang->pluck('id') as $item) {
            \App\TransaksiKeranjang::create(['transaksi_id' => $transaksi->id, 'keranjang_id' => $item]);
        }
        $keranjang->update(['status_chart' => 1]);
        

        return redirect('pelanggan/transaksi/' . $transaksi->id);
    }

    public function transaksi()
    {
        $pelanggan_id = \Auth::guard('pelanggan')->user()->id;
        $data['transaksi'] = \App\Transaksi::where('pelanggan_id', $pelanggan_id)->latest()->get();
        return view('transaksi', $data);
    }

    public function transaksikonfirmasi(Request $request, $id){

        if($request->status_konfirmasi == 1){
            $request->validate([
                'pesan_konfirmasi' => 'required',
                'status_konfirmasi' => 'required'
            ]);
            $data['pesan_konfirmasi'] = $request->pesan_konfirmasi;
            $data['status_konfirmasi'] = $request->status_konfirmasi;
        }elseif($request->status_konfirmasi == 2){
            $request->validate([
                'status_konfirmasi' => 'required'
            ]);
            $data['status_konfirmasi'] = $request->status_konfirmasi;

        }
        
        $transaksi = \App\Transaksi::findOrFail($id);

        $transaksi->update($data);
        return redirect('pelanggan/transaksi/' . $id)->with(['pesan'=> 'Berhasil Kirim Konfirmasi!', 'type'=>'success']);

    }

    public function transaksistatus (Request $request, $id){
    \App\Transaksi::findOrFail($id)->update(['status' => $request->status]);

    return redirect('pelanggan/transaksi/'.$id)->with(['pesan'=> 'Transaksi selesai', 'type'=>'success']);
    }
    public function transaksidetail($id)
    {
        $data['transaksi'] = \App\Transaksi::where('id', $id)->first();
        $data['transaksi_keranjang'] = \App\TransaksiKeranjang::where('transaksi_id', $id)->with(['keranjang' => function ($query) {
            $query->with('barang');
        }])->get();

        $data['id'] = $id;

        

        // dd($data['transaksi_keranjang']);
        
        return view('transaksidetail', $data);
    }

    public function transaksiupload(Request $request, $id)
    {
        $request->validate([
            'bukti_img' => 'required|mimes:png,jpg,jpeg'
        ]);

        $path = $request->file('bukti_img')->store('public/foto-bukti');
        \App\Transaksi::findOrFail($id)->update(['bukti_img' => $path, 'status' => 1]);

        return redirect('pelanggan/transaksi/' . $id)->with(['pesan'=> 'Berhasil Upload Bukti!', 'type' => 'success']);
    }

    public function profile()
    {
        $profile = auth()->guard('pelanggan')->user();
        $alamat = \App\Alamat::where('pelanggan_id', $profile->id)->get();

        $data = [
            'profile' => $profile,
            'alamat' => $alamat,
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: b8e4dcaa90882d2d509dabe837595b9e"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $data['province'] = [];
        } else {
            $province = json_decode($response, true);
            $data['province'] = $province['rajaongkir']['results'];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: b8e4dcaa90882d2d509dabe837595b9e"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $data['kota'] = [];
        } else {
            $kota = json_decode($response, true);
            $data['kota'] = $kota['rajaongkir']['results'];
        }

        return view('profile', $data);
    }

    public function simpanalamat(Request $request)
    {
        // dd('jalan');
        $request->validate([
            'provinsi' => 'required',
            'provinsi_id' => 'required',
            'kota' => 'required',
            'kota_id' => 'required',
            'alamat2' => 'required',
        ]);

        $data = [
            'pelanggan_id' => auth()->guard('pelanggan')->user()->id,
            'provinsi' => $request->provinsi,
            'provinsi_id' => $request->provinsi_id,
            'kota' => $request->kota,
            'kota_id' => $request->kota_id,
            'alamat' => $request->alamat2,
        ];

        \App\Alamat::create($data);

        return back()->with(['pesan' => 'Berhasil Menambah Alamat!','type' => 'success']);
    }

    public function hapusalamat($id)
    {
        \App\Alamat::findOrFail($id)->delete();
        return redirect('pelanggan/profile/')->with('pesan', 'Berhasil Menghapus Alamat!');
    }

    public function ongkir(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=156&destination=" . $request->destination . "&weight=1000&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: b8e4dcaa90882d2d509dabe837595b9e"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $data['ongkir'] = [];
        } else {
            $ongkir = json_decode($response, true);
            $data['ongkir'] = $ongkir['rajaongkir']['results'][0]['costs'];
        }

        return view('ongkir', $data);
    }
}
