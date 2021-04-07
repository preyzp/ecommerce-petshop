<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $data['objek'] = \App\Transaksi::with('pelanggan', 'transaksi_keranjang')->latest()->get();
        return view('transaksi_index', $data);
    }

    public function detail($id)
    {
        $data['transaksi'] = \App\Transaksi::where('id', $id)->first();
        $data['transaksi_keranjang'] = \App\TransaksiKeranjang::where('transaksi_id', $id)->get();

        $data['id'] = $id;

        return view('transaksi_detail', $data);
    }

    
    public function status(Request $request, $id)
    {
        $konfirmasi_img = $request->konfirmasi_img;
        if ($konfirmasi_img) {
            $data['konfirmasi_img'] = $request->file('konfirmasi_img')->store('public/foto-konfirmasi');
            $data['status_konfirmasi'] = 0;
        }

        if($request->status == 2){
            $transaksikeranjang = \App\TransaksiKeranjang::where('transaksi_id', $id)->get();
            foreach ($transaksikeranjang as $item) {
                foreach ($item->keranjang->get() as $item2){
                    $item2->where('status', 0)->update(['status' => 1]);
                }
            }

        }

        if($request->status == -1){
            $request->validate([
                'pesan_reject' => 'required'
            ]);
            $data['pesan_reject'] = $request->pesan_reject;
        }
        if($request->status == 4){
            $request->validate([
                'no_resi' => 'required'
            ]);
            $data['no_resi'] = $request->no_resi;
        }

        $data['status'] = $request->input('status');
        \App\Transaksi::findOrFail($id)->update($data);

        return redirect('admin/transaksi/' . $id);
    }

    public function print(Request $request)
    {
        $request->validate([
            'first_date' => 'required',
            'last_date' => 'required',
        ]);

        $first_date = $request->input('first_date');
        $last_date = $request->input('last_date');

        if($request->status > -2){
            $transaksi = \App\Transaksi::whereBetween('created_at', [$first_date, $last_date])->where('status', $request->status)->get();
        }else{
            $transaksi = \App\Transaksi::whereBetween('created_at', [$first_date, $last_date])->get();
        }


        $data = [
            'transaksi' => $transaksi,
            'first_date' => $first_date,
            'last_date' => $last_date,
            'status' => $request->status,
        ];

        return view('transaksi_laporan', $data);
    }
}
