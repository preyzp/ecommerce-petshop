@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('pesan'))
    <div class="alert alert-success" role="alert">
        {{ session('pesan') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data transaksi
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/transaksi/index') }}" class="btn btn-danger btn-sm mb-3">Kembali</a>
                    <div class="card">
                        <div class="card-body shadow">
                            <div class="row">
                                <div class="col-6">
                                    <div class="h4">Informasi Pengiriman</div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Nama Penerima</td>
                                                <td>&emsp;: {{$transaksi->nama_penerima}}</td>
                                            </tr>
                                            <tr>
                                                <td>Telepon</td>
                                                <td>&emsp;: {{$transaksi->telp_penerima}}</td>
                                            </tr>
                                            <tr>
                                                <td>Pesan</td>
                                                <td>&emsp;: {{$transaksi->pesan}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <div class="h4">Informasi Pembayaran</div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Total Barang</td>
                                                @php
                                                $total_barang = 0;
                                                foreach ($transaksi_keranjang as $item) {
                                                $total_barang += $item->keranjang->jlh_beli;
                                                }
                                                @endphp
                                                <td>&emsp;: {{ $total_barang }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Biaya Ongkir</td>
                                                <td>&emsp;: {{"Rp " . number_format( $transaksi->biaya_ongkir  ,2,',','.') }} 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Harga Barang</td>
                                                <td>&emsp;: {{"Rp " . number_format( $transaksi->total_bayar  ,2,',','.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Bank</td>
                                                <td>&emsp;: {{ $transaksi->bank->nama_bank }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No Rek</td>
                                                <td>&emsp;: {{ $transaksi->bank->no_rekening }} | {{ $transaksi->bank->atas_nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status Pembayaran</td>
                                                <td>&emsp;:
                                                    @if($transaksi->status == -1)
                                                     <span class="badge badge-pill badge-denger badge-lg">Reject</span>
                                                    @elseif($transaksi->status == 0)
                                                    <span class="badge badge-pill badge-primary badge-lg">Belum Bayar</span>
                                                    @elseif($transaksi->status == 1)
                                                    <span class="badge badge-pill badge-primary badge-lg">Sudah Bayar</span>
                                                    @elseif($transaksi->status == 2)
                                                    <span class="badge badge-pill badge-success badge-lg">Konfirmasi</span>
                                                    @else
                                                    <span class="badge badge-pill badge-success badge-lg">Konfirmasi</span>
                                                    @endif
                                                    {{-- @if($transaksi->status_konfirmasi == 0)
                                                    <button type="menu" class="btn btn-primary btn-sm">Foto Belum DiKonfirmasi</button>
                                                    @elseif($transaksi->status_konfirmasi == 1)
                                                    <button type="menu" class="btn btn-danger btn-sm">Foto di Reject</button>
                                                    @elseif($transaksi->status_konfirmasi == 2)
                                                    <button type="menu" class="btn btn-success btn-sm">Foto di Terima</button>
                                                    @endif --}}
                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status Pengiriman</td>
                                                <td>&emsp;:  
                                                    @if($transaksi->status_konfirmasi == 0)
                                                    <span class="badge badge-pill badge-primary badge-lg">Foto Belum DiKonfirmasi</span>
                                                    @elseif($transaksi->status_konfirmasi == 1)
                                                    <span class="badge badge-pill badge-primary badge-lg">Foto di Reject</span>
                                                    @elseif($transaksi->status_konfirmasi == 2)
                                                    <span class="badge badge-pill badge-primary badge-lg">Foto di Terima</span>
                                                    @endif
                                                    @if($transaksi->status == 3)
                                                    <span class="badge badge-pill badge-primary badge-lg">Pengemasan</span>
                                                   @elseif($transaksi->status == 4)
                                                    <span class="badge badge-pill badge-primary badge-lg">Pengiriman</span>
                                                   @elseif($transaksi->status == 5)
                                                   <span class="badge badge-pill badge-success badge-lg">Selesai</span>
                                                   @endif
                                                </td>
                                            </tr>
                                            @if($transaksi->status_konfirmasi == 1 )
                                            <tr><td>Pesan Penolakan</td><td>&emsp;: {{ $transaksi->pesan_konfirmasi }}</td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 my-3">
                                </div>
                                <div class="col-6">
                                    <div class="h4">Service Pengiriman</div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Service</td>
                                                <td>&ensp;: {{ $transaksi->service_courier }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kota</td>
                                                <td>&ensp;: {{ $transaksi->alamat->kota }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>&ensp;: {{ $transaksi->alamat->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td>No Resi</td>
                                                <td>&ensp;: {{ $transaksi->status >= 4 ? $transaksi->no_resi : '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <div class="h4 m-0 p-0">Aksi</div>
                                   
                                    @if($transaksi->status > 0)
                                    <button type="button" class="btn btn-primary mt-2 btn-sm" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-camera" aria-hidden="true">
                                        Lihat Bukti Pembayaran
                                    </button></i>
                                    @endif

                                    <form action="{{ url('admin/transaksi/'. $id) }}" class="mt-2" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <!-- Button trigger modal -->
                                        {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject">
                                          Reject
                                        </button> --}}
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>Konfirmasi Pembayaran</td>
                                                    <td>&ensp;:
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject"><i class="fa fa-exclamation" ></i>
                                                            Reject
                                                        </button>
                                                        <button name="status" value="2" type="submit" class="btn btn-success btn-sm {{ $transaksi->status == 2 ? 'active' : '' }}"><i class="fa fa-check" aria-hidden="true"></i>
                                                            Konfirmasi
                                                        </button>
                                                      
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Konfirmasi Pengiriman</td>
                                                    <td>&ensp;:
                                                        <button type="button" class="btn btn-success btn-sm {{ $transaksi->status == 2 ? 'active' : '' }}" data-toggle="modal" data-target="#modelId"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                                            Konfirmasi
                                                        </button>
                                                        <button name="status" value="3" type="submit" class="btn btn-success btn-sm {{ $transaksi->status == 3 ? 'active' : '' }}"><i class="fas fa-shopping-bag    "></i>
                                                            Kemas
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kirim"><i class="fa fa-truck" aria-hidden="true"></i>
                                                            Kirim
                                                        </button>
                                                        <button name="status" value="5" type="submit" class="btn btn-success btn-sm {{ $transaksi->status == 5 ? 'active' : '' }}"><i class="fas fa-user-check    "></i>
                                                            Selesai
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Modal -->
                                        <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Pesan Reject</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                              <label for="pesan_reject">Pesan Reject </label>
                                                              <input type="text"
                                                                class="form-control" name="pesan_reject" id="pesan_reject" placeholder="Masukkan Pesan Reject">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" value="-1" name="status" class="btn btn-primary">Kirim</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button trigger modal -->
                                        {{-- <button type="button" class="btn btn-success btn-sm {{ $transaksi->status == 2 ? 'active' : '' }}" data-toggle="modal" data-target="#modelId">
                                            Konfirmasi
                                        </button> --}}
                                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="konfirmasi_img">Foto</label>
                                                            <input type="file" class="form-control-file" name="konfirmasi_img" id="konfirmasi_img">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button name="status" value="2" type="submit" class="btn btn-success">Konfirmasi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <!-- Button trigger modal -->
                                        {{-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kirim">
                                          Kirim
                                        </button> --}}
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="kirim" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Pengiriman</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                          <label for="no_resi">Nomor Resi</label>
                                                          <input type="text"
                                                            class="form-control" name="no_resi" id="no_resi" placeholder="Masukkan Nomor Resi">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" value="4" name="status" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <button name="status" value="5" type="submit" class="btn btn-success btn-sm {{ $transaksi->status == 5 ? 'active' : '' }}">Selesai</button> --}}
                                    </form>
                                </div>
                                <div class="col-12 text-right mt-3">
                                    <span class="h3 shadow px-2 rounded font-weight-bold border">Total Bayar : {{"Rp " . number_format( $transaksi->total_bayar + $transaksi->biaya_ongkir ,2,',','.') }} </span> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered mt-3">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi_keranjang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ \Storage::url($item->keranjang->barang->foto) }}" width="50px"></td>
                                <td>{{ $item->keranjang->barang->nama_barang }}</td>
                                <td>{{ $item->keranjang->jlh_beli }}</td>
                                <td>{{"Rp " . number_format($item->keranjang->jlh_harga  ,2,',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img class="img-fluid" src="{{ \Storage::url($transaksi->bukti_img) }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection