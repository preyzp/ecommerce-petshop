@extends('layouts.app2')

@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Kategori</h4>
                        <ul>
                            <li><a href="{{ url('shop') }}">Semua</a></li>
                            @foreach($kategori as $item)
                            <li><a href="{{ url('shop?kategori='. $item->id) }}">{{ $item->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount mb-0 pb-0">
                    <div class="section-title product__discount__title mb-4 pb-0">
                        <h2>Product</h2>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        Kategori : {{ isset($select) ? $select : 'Semua' }}
                    </div>
                </div>
                <div class="row">
                    @if(empty($barang->toArray()))
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <div class="card-text">Barang Tidak Ada</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($barang as $item)
                    @php
                    $keranjang = \App\Keranjang::where('barang_id', $item->id)->where('status', 1)->get(); 
                    $total_beli = 0;
                        foreach ($keranjang as $item5) {
                            $total_beli += $item5->jlh_beli;
                        }
                    $stock = $item->jumlah_stok - $total_beli;
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item pb-3 shadow rounded">
                            <div class="product__item__pic set-bg shadow rounded" data-setbg="{{ \Storage::url($item->foto) }}">
                                {{-- <a href="{{ url('shop/detail/'. $item->id) }}"> --}}
                                <ul class="product__item__pic__hover">
                                    <li><span class="badge badge-pill badge-primary">Stock : @if($stock > 0)
                                        {{$stock}}
                                        @else
                                        Habis
                                        @endif</span></a></li>
                                    {{-- <li><a href="{{ url('shop/detail/'. $item->id) }}"><i class="fa fa-retweet">Detail</i></a></li> --}}
                                    <li><a href="{{ url('shop/detail/'. $item->id) }}" class="bg-primary text-white"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            {{-- </a> --}}
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ url('shop/detail/'. $item->id) }}">{{$item->nama_barang}}</a></h6>
                                <h5>{{"Rp " . number_format( $item->harga_barang  ,2,',','.') }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              {{$barang->links()}}
            </div>
        </div>
    </div>
</section>
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