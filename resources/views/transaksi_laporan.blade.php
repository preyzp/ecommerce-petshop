<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="bg-white">
    <div class="container my-3">
        <div class="row my-2">
            <div class="col">
                <h1>Laporan Data Transaksi</h1>
                <span>Dari Tanggal {{ $first_date }} Sampai Tanggal {{ $last_date }}</span>
                <div> Status : 
                    @if($status == -2)
                    Semua
                    @elseif($status == -1)
                    Reject
                    @elseif($status == -0)
                    Belum Bayar
                    @elseif($status == 1)
                    Sudah Bayar
                    @elseif($status == 2)
                    Konfirmasi
                    @elseif($status == 3)
                    Pengemasan
                    @elseif($status == 4)
                    Pengiriman
                    @elseif($status == 5)
                    Selesai
                    @endif </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Barang</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>{{ $item->pelanggan->nama }}
                            <td>
                                @foreach($item->transaksi_keranjang as $item2)
                                <li>{{ $item2->keranjang->barang->nama_barang }} ({{$item2->keranjang->jlh_beli}}x)
                                    {{"Rp " . number_format( $item2->keranjang->jlh_harga   ,2,',','.') }}</li>
                                @endforeach
                            </td>
                            <td>{{"Rp " . number_format( $item->total_bayar   ,2,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div>
                    @php
                    $total = 0;
                    $total_barang = 0;
                    foreach($transaksi as $item) {
                    $total += $item->total_bayar;
                    foreach ($item->transaksi_keranjang as $item2) {
                    $total_barang++;
                    }
                    }
                    @endphp
                    <h3>Jumlah Total : {{"Rp " . number_format( $total   ,2,',','.') }}</h3>
                    <h3>Jumlah Barang : {{$total_barang}}</h3>
                    <h3>Jumlah Transaksi : {{ $transaksi->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>