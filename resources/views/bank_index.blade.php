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
                <div class="card-header">Data Semua Bank</div>

                <div class="card-body">
                    
                    <h2>Data Bank</h2>
                    <a href="{{ url('admin/bank/tambah') }}" class="btn btn-primary btn-sm">Tambah</a>
                    <a href="{{ url('admin/bank/index') }}" class="btn btn-primary btn-sm">Refresh</a>
                    <a href="{{ url('/home') }}" class="btn btn-danger btn-sm">Kembali</a><p></p>
                    <table class="table table-light">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Bank</th>
                            <th>Atas Nama</th>
                            <th>No Rekening</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($objek as $row)
                        <tr>
                            <td>{{ $loop ->iteration }}</td>
                            <td>{{ $row ->nama_bank }}</td>
                            <td>{{ $row ->atas_nama }}</td>
                            <td>{{ $row ->no_rekening }}</td>

                            <td>
                                <a href="{{ url('admin/bank/edit/'.$row->id, []) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/bank/hapus/'.$row->id, []) }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</a>
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
