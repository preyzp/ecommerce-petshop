@extends('layouts.app2')
@section('content')
@php
$stock = $barang->jumlah_stok - $total_beli;
@endphp
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Detail Produk</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Detail Produk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="{{ \Storage::url($barang->foto) }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="img/product/details/product-details-2.jpg" src="img/product/details/thumb-1.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-3.jpg" src="img/product/details/thumb-2.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-5.jpg" src="img/product/details/thumb-3.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-4.jpg" src="img/product/details/thumb-4.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{$barang->nama_barang}}</h3>
                  
                    <div class="product__details__price">
                    {{ "Rp " . number_format($barang->harga_barang,2,',','.') }}
                    </div>
                    <p>{{ $barang->keterangan }}</p>
                    @if (Auth::guard('pelanggan')->check() == false)
                    <a href="{{ url('form-login') }}" class="primary-btn"><i class="fas fa-sign-in-alt"></i>Silahkan Login/Registrasi untuk
                        melakukan
                        pemesanan</a>
                    @elseif($stock < 0) <a href="#" class="primary-btn">Stock Habis</a>
                        @else
                        {{ Form::model($obj, array('action' => $action, 'method' => $method)) }}
                        <input type="hidden" name="sisa_stock" value="{{$stock}}">
                        <input type="hidden" name="id" value="{{$barang_id}}">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="jlh_beli" value="1">
                                </div>
                                <input type="hidden" name="barang_id" value="{{$barang_id}}">
                            </div>
                        </div>
                        {!! Form::submit($btn_submit, ['class' => 'primary-btn text-uppercase','style' => 'border:0']) !!}
                        @endif
                        <ul>
                            <li><b>Stok Tersedia</b> <span>
                                    @if($stock > 0)
                                    {{$stock}}
                                    @else
                                    Habis
                                    @endif
                                </span></li>
                            <li><b>Kategori</b> 
                            <span> {{$barang->kategori->nama_kategori}}</span></li>
                          
                          
                        </ul>
                </div>
            </div>
            {{-- <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                        </li>
                    </ul>
                    
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- Product Details Section End -->
<section class="categories">
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="section-title">
                    <h2>Produk Terkait</h2>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="categories__slider owl-carousel">
                @foreach( $produk as $item )
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
@endsection