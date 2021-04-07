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
                <div class="card-header">Data Semua Admin</div>

                <div class="card-body">
                    
                    <h2>Data Admin</h2>
                    @if (auth()->user()->level == 1)           
                    <a href="{{ url('admin/admin/tambah') }}" class="btn btn-primary btn-sm">Tambah</a>
                    @endif
                    <a href="{{ url('admin/admin/index') }}" class="btn btn-primary btn-sm">Refresh</a>
                    <a href="{{ url('/home') }}" class="btn btn-danger btn-sm">Kembali</a>
                    <p></p>
                    <table class="table table-light">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Email</th> 
                            @if (auth()->user()->level == 1)    
                            <th>Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($objek as $row)
                        <tr>
                            <td>{{ $loop ->iteration }}</td>
                            <td>{{ $row ->name }}</td>
                            <td>{{ $row ->email }}</td>
                            @if (auth()->user()->level == 1)    
                            <td>
                                <a href="{{ url('admin/admin/edit/'.$row->id, []) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('admin/admin/hapus/'.$row->id, []) }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</a>
                            </td>
                            @endif
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
