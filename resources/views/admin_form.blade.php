@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('pesan'))
    <div class="alert alert-success" role="alert">
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
                            {{ Form::label('name', 'Nama Admin') }}
                            {{ Form::text('name',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email',null,array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password',array('class'=>'form-control')) }}
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>

                      

                        <button type="submit" class="btn btn-primary">{{ $btn_submit }}</button>
                        
                    {!! Form::close() !!}
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
