@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('pesan'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show m-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{ session('pesan') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Data</div>

                <div class="card-body">
                    {{ Form::model($objek, array('action' => $action, 'method' => $method, 'files' => true)) }}

                        <div class="form-group">
                            {{ Form::label('nama_barang', 'Nama Barang') }}
                            {{ Form::text('nama_barang',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('nama_barang') }}</span>
                        </div>

                        <div class="form-group">
                            {{ Form::label('keterangan', 'Keterangan') }}
                            {{ Form::textarea('keterangan',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                        </div>

                        <div class="form-group">
                            {{ Form::label('harga_barang', 'Harga Barang') }}
                            {{ Form::text('harga_barang',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('harga_barang') }}</span>
                        </div>

                        <div class="form-group">
                            {{ Form::label('jumlah_stok', 'Jumlah Stok') }}
                            {{ Form::text('jumlah_stok',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('jumlah_stok') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Barang</label>
                            {{ Form::file('foto',['class' =>'form-control']) }}
                            <span class="text-danger">{{ $errors->first('foto') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Pilih Kategori</label>
                            {{ Form::select('kategori_id', \App\Kategori::pluck('nama_kategori','id') , null,['class' =>'form-control']) }}
                            <span class="text-danger">{{ $errors->first('kategori_id') }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ $btn_submit }}</button>
                        
                    {!! Form::close() !!}
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
