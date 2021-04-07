@extends('layouts.app2')
<!-- Hero Section End -->
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Transaksi</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home </a>
                        <span>Transaksi</span>
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
                <div class="col">
                    <h4>Transaksi</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @foreach ($transaksi as $item)
                    <div class="card mb-2 shadow">
                        <div class="card-header">
                            {{ $item->created_at->format('d M y | H:i') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">

                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Total Bayar</td>
                                                <td>&ensp;: {{"Rp " . number_format( $item->total_bayar + $item->biaya_ongkir   ,2,',','.') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6 text-right">
                                    @if($item->status == -1)
                                    <button type="menu" class="btn btn-danger btn-sm">Reject</button>
                                    @elseif($item->status == 0)
                                    <button type="menu" class="btn btn-primary btn-sm">Belum Bayar</button>
                                    @elseif($item->status == 1)
                                    <button type="menu" class="btn btn-primary btn-sm">Sudah Bayar</button>
                                    @elseif($item->status == 2)
                                    <button type="menu" class="btn btn-primary btn-sm">Konfirmasi</button>
                                    @elseif($item->status == 3)
                                    <button type="menu" class="btn btn-primary btn-sm">Pengemasan</button>
                                    @elseif($item->status == 4)
                                    <button type="menu" class="btn btn-primary btn-sm">Pengiriman</button>
                                    @elseif($item->status == 5)
                                    <button type="menu" class="btn btn-success btn-sm">Selesai</button>
                                    @endif
                                </div>
                            </div>

                            @php
                            $transaksi_barang = \App\TransaksiKeranjang::where('transaksi_id',
                            $item->id)->with(['keranjang' => function ($query) {
                            $query->with('barang');
                            }])->get();
                            @endphp
                            <table class="table table-sm my-4">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi_barang as $item2)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item2->keranjang->barang->nama_barang }}</td>
                                        <td>{{ $item2->keranjang->jlh_beli }}</td>
                                        <td>{{"Rp " . number_format( $item2->keranjang->jlh_harga   ,2,',','.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <a class="btn btn-primary btn-sm" href="{{ url('pelanggan/transaksi/'. $item->id) }}" role="button">Detail</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

@endsection