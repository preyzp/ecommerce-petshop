@extends('layouts.app2')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Transaksi Detail</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home </a>
                        <span>Transaksi Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-12">
                    <h4>Transaksi Details<a href="{{ url('pelanggan/transaksi') }}"
                            class="btn btn-danger btn-sm float-right">Kembali</a></h4>
                </div>
            </div>
            <div class="row p-3 shadow mb-4 rounded">
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
                                <td>&emsp;: {{"Rp " . number_format( $transaksi->biaya_ongkir    ,2,',','.') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Total Harga Barang</td>
                                <td>&emsp;: {{"Rp " . number_format( $transaksi->total_bayar   ,2,',','.') }}
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
                                     <span class="badge badge-pill badge-danger badge-lg">Reject</span>
                                    @elseif($transaksi->status == 0)
                                    <span class="badge badge-pill badge-danger badge-lg">Belum Bayar</span>
                                    @elseif($transaksi->status == 1)
                                    <span class="badge badge-pill badge-primary badge-lg">Sudah Bayar</span>
                                    @elseif($transaksi->status == 2)
                                   <span class="badge badge-pill badge-success badge-lg">Konfirmasi</span>
                                    {{-- @if($transaksi->status_konfirmasi == 0)
                                    <button type="menu" class="btn btn-primary btn-sm">Foto Belum DiKonfirmasi</button>
                                    @elseif($transaksi->status_konfirmasi == 1)
                                    <button type="menu" class="btn btn-danger btn-sm">Foto di Reject</button>
                                    @elseif($transaksi->status_konfirmasi == 2)
                                    <button type="menu" class="btn btn-success btn-sm">Foto di Terima</button>
                                    @endif --}}
                                    {{-- @elseif($transaksi->status == 3)
                                     <span class="badge badge-pill badge-primary badge-lg">Pengemasan</span>
                                    @elseif($transaksi->status == 4)
                                     <span class="badge badge-pill badge-primary badge-lg">Pengiriman</span>
                                    @elseif($transaksi->status == 5)
                                    <span class="badge badge-pill badge-success badge-lg">Selesai</span>
                                    @endif --}}
                                    @else
                                    <span class="badge badge-pill badge-success badge-lg">Konfirmasi</span>
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td>Status Pengiriman</td>
                                <td>&emsp;:
                                    @if($transaksi->status_konfirmasi == 0)
                                    <span class="badge badge-pill badge-danger badge-lg">Foto Belum DiKonfirmasi</span>
                                    @elseif($transaksi->status_konfirmasi == 1)
                                    <span class="badge badge-pill badge-danger badge-lg">Foto di Reject</span>
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
                            @if($transaksi->status == 2 && $transaksi->status_konfirmasi == 1 )
                            <tr><td>Pesan Konfirmasi</td><td>&emsp;: {{ $transaksi->pesan_konfirmasi }}</td></tr>
                            @endif
                            @if($transaksi->status == -1 )
                            <tr><td>Pesan Reject</td><td>&emsp;: {{ $transaksi->pesan_reject }}</td></tr>
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
                    @if($transaksi->status < 2) <button type="button" class="btn btn-primary my-3 btn-sm"
                        data-toggle="modal" data-target="#exampleModal"><i class="fa fa-upload" aria-hidden="true"> </i>
                        Upload Bukti Pembayaran
                        </button>
                        @endif
                        @if($transaksi->status > 0)
                        <button type="button" class="btn btn-success my-3 btn-sm" data-toggle="modal"
                            data-target="#exampleModal2"><i class="fas fa-eye    "></i>
                            Lihat Bukti Pembayaran
                        </button>
                        @endif
                        @if($transaksi->status == 2)
                        <button type="button" class="btn btn-success my-3 btn-sm" data-toggle="modal"
                            data-target="#exampleModal3">
                            Foto Konfirmasi
                        </button>
                        @endif
                        @if($transaksi->status > 3)
                        <form action="{{ url('pelanggan/transaksi/'. $id.'/status') }}" class="mt-2" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <button name="status" value="5" type="submit" class="btn btn-success btn-sm {{ $transaksi->status == 5 ? 'active' : '' }}"><i class="fas fa-user-check    "></i>
                            Selesai
                        </button>
                    </form>
                    @endif
                </div>
                <div class="col-12 text-right my-3">
                    <span class="h3 shadow px-2 rounded font-weight-bold border">Total Bayar :
                        {{"Rp " . number_format( $transaksi->total_bayar + $transaksi->biaya_ongkir   ,2,',','.') }}</span> 
                </div>
            </div>
            <table class="table">
                <thead>
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
                        <td>{{"Rp " . number_format( $item->keranjang->jlh_harga,2,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                   </button>
            </div>
            
            <form action="{{ url('pelanggan/transaksi/'. $id . '/upload') }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
               
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Upload Foto</label>
                        <input type="file" class="form-control-file" name="bukti_img" id="" placeholder=""
                            aria-describedby="fileHelpId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"> </i>Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ \Storage::url($transaksi->bukti_img) }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ \Storage::url($transaksi->konfirmasi_img) }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form method="POST" action="{{ url('pelanggan/transaksi/'. $id .'/konfirmasi') }}">
                    @method('PUT')
                    @csrf
                <button type="submit" value="2" name="status_konfirmasi" class="btn btn-primary">Terima</button>
                </form>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                  Tolak
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alasan Penolakan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <form method="POST" action="{{ url('pelanggan/transaksi/'. $id .'/konfirmasi') }}">
                                @method('PUT')
                                @csrf
                            <div class="modal-body">
                                    <div class="form-group">
                                      <label for="pesan_konfirmasi">Pesan Penolakan</label>
                                      <input type="text"
                                        class="form-control" name="pesan_konfirmasi" id="pesan_konfirmasi" placeholder="Masukkan Pesan Penolakan">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" value="1" name="status_konfirmasi" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection