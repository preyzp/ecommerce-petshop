@extends('layouts.app2')

@section('content')
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Kategori</span>
                    </div>
                    <ul>
                        <li><a href="{{ url('shop') }}">Semua</a></li>
                        @foreach($kategori as $item)
                        <li><a href="{{ url('shop?kategori='. $item->id) }}">{{ $item->nama_kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                   
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+628123456789</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="ogani/img/hero/banner.png">
                    <div class="hero__text">
                        @if(auth()->guard('pelanggan')->check())
                        <span>Welcome, {{Auth()->guard('pelanggan')->user()->nama}}</span>
                        @else
                        <span>BEST PRODUCT</span>
                        @endif
                        <h2> WELCOME TO<br /> JAMBI PETSHOP</h2>    
                        <p></p>             
                        <a href="{{ url('shop') }}" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<section class="categories">
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="section-title">
                    <h2>New Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="categories__slider owl-carousel">
                @foreach( $barang as $item )
                <div class="col-lg-3">
                    <div class="categories__item set-bg shadow" data-setbg="{{ \Storage::url($item->foto) }}">
                        <h5 class="shadow"><a href="{{ url('shop/detail/'. $item->id) }}">{{ $item->nama_barang }}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection