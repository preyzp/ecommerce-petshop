@extends('layouts.app2')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <form method="POST" action="{{ url('pelanggan/pesan/update') }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product" width="200px">Products</th>
                                <th width="200px">Price</th>
                                <th>Quantity</th>
                                <th width="300px">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keranjang as $row)
                            <tr>
                                @php 
                                $barang = $row->barang;
                                $keranjang2 = \App\Keranjang::where('barang_id', $barang->id)->where('status',1)->get();
                                
                                $jlh_pembelian = 0;
                                foreach($keranjang2 as $item2){
                                    $jlh_pembelian += $item2->jlh_beli;
                                }
                                $sisa = $barang->jumlah_stok - $jlh_pembelian;
                                @endphp
                                <td class="shoping__cart__item">
                                    <img width="100px" src="{{ \Storage::url($row->barang->foto) }}" alt="">
                                    <h5>{{ $row->barang->nama_barang }} ( Stock : {{ $sisa }} )</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{ "Rp " . number_format($row->barang->harga_barang,2,',','.') }}
                                </td>
                                {{-- <td class="shoping__cart__quantity">
                                    <span>{{ $row->jlh_beli }}</span>
                                </td> --}}
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="barang[{{$row->id}}]" value="{{ $row->jlh_beli }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    {{ "Rp " . number_format($row->jlh_harga,2,',','.') }}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a class="btn btn-danger btn-sm" href="{{ url('pelanggan/pesan/hapus/'. $row->id) }}" role="button" onclick="return confirm('Anda yakin?')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{ url('shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <button type="submit" class="btn primary-btn cart-btn cart-btn-right">Update Cart</button>
                </div>
            </div>
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        @php
                        $total = 0;
                        foreach ($keranjang as $item) {
                        $total += $item->jlh_harga;
                        }
                        @endphp
                        <li>Subtotal <span>{{ "Rp " . number_format($total,2,',','.') }}</span></li>
                        <li>Total<span> {{"Rp " . number_format( $total ,2,',','.') }}</span></li>
                    </ul>
                    @if($keranjang->count() > 0)
                    <a href="{{ url('pelanggan/pesan/bayar') }}" class="primary-btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i>PROCEED TO CHECKOUT</a>
                    @else
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    </div>
</section>
<!-- Shoping Cart Section End -->
@endsection