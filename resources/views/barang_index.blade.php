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
                <div class="card-header">Data Semua barang</div>

                <div class="card-body">
                    
                    <h2>Data Barang</h2>
                    <a href="{{ url('admin/barang/tambah') }}" class="btn btn-primary btn-sm">Tambah</a>
                    <a href="{{ url('admin/barang/index') }}" class="btn btn-primary btn-sm">Refresh</a>
                    <a href="{{ url('/home') }}" class="btn btn-danger btn-sm">Kembali</a>
                    <p>
                     {{-- <form action="{{url('admin/barang/cari')}}" method="get" role="search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" name="search"  placeholder="Cari Data...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"> Cari Data </button>
                            </span>
                        </div>
                    </form>  --}}
                    </p>
                    <table class="table table-bordered" >
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th width="200px">Nama Barang</th>
                            {{-- <th>Keterangan</th> --}}
                            <th width="200px">Harga Barang</th>
                            <th>Stok</th>
                            <th>Sisa</th>
                            <th width="200px">Kategori</th>
                            <th width="200px">Aksi</th>
                        </tr>
                        </thead>
                        <tbody rules="cols">
                        @foreach($objek as $row)
                        @php
                        $keranjang = \App\Keranjang::where('barang_id', $row->id)->where('status', 1)->get(); 
                        $total_beli = 0;
                            foreach ($keranjang as $item5) {
                                $total_beli += $item5->jlh_beli;
                            }
                        $stock = $row->jumlah_stok - $total_beli;
                        @endphp
                        <tr>
                            <td>{{ $loop ->iteration }}.</td>
                            <td>{{ $row ->nama_barang }}</td>
                            {{-- <td>{{ $row ->keterangan }}</td> --}}
                            <td>{{"Rp " . number_format( $row ->harga_barang  ,2,',','.') }}</td>
                            <td>{{ $row ->jumlah_stok }}</td>
                            <td>{{ $stock }}</td>
                            <td>{{ $row ->kategori->nama_kategori }}</td>
                            
                            

                            <td>
                                <a href="{{ url('admin/barang/edit/'.$row->id, []) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/barang/hapus/'.$row->id, []) }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</a>
                                {{-- <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
                                    <button type="button" class="btn btn-outline-secondary btn-sm">Tambah Stok</button>
                                    
                                  </div> --}}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $objek->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
