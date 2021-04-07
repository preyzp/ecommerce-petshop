@extends('layouts.app2')
@section('content')
<!-- Hero Section End -->
<!-- Breadcrumb Section End -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Login</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home </a>
                        <span>Login</span>
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
                    <h2>Silahkan Melakukan Login</h2>
                </div>

            </div>
        </div>
        {!! Form::model($objek, ['action' => $action, 'method' => $method, 'files' => true]) !!}
        <input type="hidden" name="user" value="pelanggan">
        <div class="form-group">
            <label for="email">E-mail</label>
            {!! Form::email('email',null,['class' =>'form-control']) !!}
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            {{ Form::password('password',['class' =>'form-control']) }}
            <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>

        {!! Form::submit('LOGIN',['class' => 'primary-btn']) !!}
        {!! Form::close() !!}
        Silahkan daftar disini <a href="" class="primary-btn">REGISTRASI</a>
    </div>
</div>

@endsection