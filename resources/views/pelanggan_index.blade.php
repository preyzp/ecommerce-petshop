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
                <div class="card-header">Data Semua pelanggan</div>

                <div class="card-body">
                    
                    <h2>Data Pelanggan</h2>
                     <a href="{{ url('/home') }}" class="btn btn-danger btn-sm">Kembali</a>
                     <a href="{{ url('admin/pelanggan/index') }}" class="btn btn-primary btn-sm">Refresh</a>
                    <p></p>
                    <table class="table table-light">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($objek as $row)
                        <tr>
                            <td>{{ $loop ->iteration }}</td>
                            <td>{{ $row ->nama }}</td>
                            <td>{{ $row ->email }}</td>
                            <td>{{ $row ->alamat }}</td>
                            <td>{{ $row ->telp }}</td>

                            {{-- <td>
                                <a href="{{ url('admin/pelanggan/hapus/'.$row->id, []) }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">Hapus</a>
                            </td> --}}
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
