@extends('layouts.app2')

@section('content')
    <!-- Breadcrumb Section End -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Registrasi</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home </a>
                            <span>Registrasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Silahkan Isi Data Registrasi</h2>
                    </div>
                </div>
            </div>
            {!! Form::model($objek, ['action' => $action, 'method' => $method, 'files' => true]) !!}

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            {!! Form::text('nama',null,['class' =>'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nama') }}</span>
						</div>
						<div class="form-group">
                            <label for="email">Email</label>
                            {!! Form::text('email',null,['class' =>'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('email') }}</span>
						</div>
						<div class="form-group">
                            <label for="password">Password</label>
                            {!! Form::password('password',null,['class' =>'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('password') }}</span>
						</div>
						<div class="form-group">
                            <label for="alamat">Alamat</label>
                            {!! Form::text('alamat',null,['class' =>'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
						</div>
						<div class="form-group">
                            <label for="telp">Telpon</label>
                            {!! Form::text('telp',null,['class' =>'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('telp') }}</span>
						</div>
						{!! Form::submit('Daftar Sekarang',['class' => 'site-btn']) !!}
                        {!! Form::close() !!}
        </div>
    </div>

@endsection