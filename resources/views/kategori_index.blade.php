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
                <div class="card-header">Data Semua kategori</div>

                <div class="card-body">
                    
                    <h2>Data kategori</h2>
                    <a href="{{ url('admin/kategori/tambah') }}" class="btn btn-primary btn-sm">Tambah</a>
                    <a href="{{ url('admin/kategori/index') }}" class="btn btn-primary btn-sm">Refresh</a>
                    <a href="{{ url('/home') }}" class="btn btn-danger btn-sm">Kembali</a>
                    <p></p>
                    <table class="table table-light">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($objek as $row)
                        <tr>
                            <td>{{ $loop ->iteration }}</td>
                            <td>{{ $row ->nama_kategori }}</td>

                            <td>
                                <a href="{{ url('admin/kategori/edit/'.$row->id, []) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/kategori/hapus/'.$row->id, []) }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
