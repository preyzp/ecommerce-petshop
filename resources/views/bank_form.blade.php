@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('pesan'))
    <div class="alert alert-success" role="alert">
        <span class="sr-only">Close</span>
    {{ session('pesan') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Data</div>

                <div class="card-body">
                    {{ Form::model($objek, array('action' => $action, 'method' => $method)) }}

                        <div class="form-group">
                            {{ Form::label('nama_bank', 'Nama Bank') }}
                            {{ Form::text('nama_bank',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('nama_bank') }}</span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('atas_nama', 'Atas Nama') }}
                            {{ Form::text('atas_nama',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('atas_nama') }}</span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('no_rekening', 'Nomor Rekening') }}
                            {{ Form::text('no_rekening',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('no_rekening') }}</span>
                        </div>

                      

                        <button type="submit" class="btn btn-primary">{{ $btn_submit }}</button>
                        
                    {!! Form::close() !!}
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
