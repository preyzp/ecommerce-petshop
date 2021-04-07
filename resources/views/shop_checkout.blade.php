@extends('layouts.app2')

@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home </a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Pengiriman Details</h4>
            <form action="{{ url('pelanggan/pesan/bayar') }}" method="POST">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="form-group">
                            <label for="nama_penerima">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama_penerima" id="" aria-describedby="helpId"
                                placeholder="Nama Penerima">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            @if(!empty($alamat->toArray()))
                            <select class="alamat form-control w-100 mb-2" name="alamat">
                                <option value="0/0">-- Pilih Alamat --</option>
                                @foreach($alamat as $item)
                                <option value="{{ $item->id }}/{{ $item->kota_id }}">Provinsi : {{ $item->provinsi }} |
                                    Kota : {{ $item->kota }} | Alamat : {{ $item->alamat }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modelId">
                                Tambah Alamat
                            </button>
                            <!-- Modal -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Jasa Kirim</label>
                            </div>
                        </div>
                        <div class="row" id="jasa_kirim">
                            <div class="col-12 mb-2">
                                <div class="card shadow">
                                    <div class="card-body" id="jasa_ongkir_loading">
                                        <span class="card-text">Silakan Pilih Alamat</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bank_id">Bank</label>
                            <select class="form-control w-100 mb-2" name="bank_id">
                                <option value="">-- Pilih Bank --</option>
                                @foreach($bank as $item)
                                <option value="{{ $item->id }}">{{$item->nama_bank}} | {{$item->no_rekening}} | A.N {{$item->atas_nama}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telp_penerima">Nomor Telepon Penerima</label>
                            <input type="text" class="form-control" name="telp_penerima" id="" aria-describedby="helpId"
                                placeholder="Nomor Telepon Penerima">
                        </div>
                        <div class="form-group">
                            <label for="pesan">Pesan</label>
                            <textarea class="form-control" name="pesan" id="" rows="3" placeholder="Pesan"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @foreach ($keranjang as $item)
                                <li>{{$item->barang->nama_barang}}<span>({{$item->jlh_beli}}x)</span>
                                    <span>{{ "Rp " . number_format($item->jlh_harga,2,',','.') }}</span>
                                </li>
                                @endforeach
                            </ul>
                            @php
                            $total = 0;
                            foreach ($keranjang as $item) {
                            $total += $item->jlh_harga;
                            }
                            @endphp
                            <div class="checkout__order__subtotal">Ongkir
                                <span id="ongkir">Rp.0</span>
                            </div>
                            <div class="checkout__order__total" data-total="{{$total}}">Total
                                <span id="total_bayar">{{ "Rp " . number_format($total,2,',','.') }}</span>
                            </div>
                            <button type="submit" class="site-btn">Konfirmasi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Alamat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('pelanggan/profile/alamat/simpan') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <input class="form-control" list="provinsilist" name="provinsi" id="provinsi" placeholder="Ketik untuk mencari provinsi...">
                        <datalist id="provinsilist">
                            @foreach($province as $item)
                            <option data-value="{{ $item['province_id'] }}" value="{{ $item['province'] }}">
                                @endforeach
                        </datalist>
                        <input type="hidden" name="provinsi_id" id="provinsi-hidden">
                    </div>
                    <div class="form-group">
                        <label for="kota" class="form-label">Kota</label>
                        <input class="form-control" list="kotalist" name="kota" id="kota" placeholder="Ketik untuk mencari kota...">
                        <datalist id="kotalist">
                            @foreach($kota as $item)
                            <option data-value="{{ $item['city_id'] }}" value="{{ $item['city_name'] }}">
                                @endforeach
                        </datalist>
                        <input type="hidden" name="kota_id" id="kota-hidden">
                    </div>
                    <div class="form-group">
                        <label for="alamat2">Alamat</label>
                        <input type="text" class="form-control" name="alamat2" placeholder="Masukkan Alamat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

    $('#provinsi').keyup(function() {
        const provinsi = $(this).val();
        const provinsi_id = $("#provinsilist option[value='" + provinsi + "']").data('value');

        if (provinsi_id) {
            $('#provinsi-hidden').val(provinsi_id);
        }
    });

    $('#kota').keyup(function() {
        const kota = $(this).val();
        const kota_id = $("#kotalist option[value='" + kota + "']").data('value');

        if (kota_id) {
            $('#kota-hidden').val(kota_id);
        }
    });

    function serviceFunction(biaya_ongkir) {
        var	number_string = biaya_ongkir.toString(),
	    sisa 	= number_string.length % 3,
	    rupiah 	= number_string.substr(0, sisa),
	    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
        if (ribuan) {
	        separator = sisa ? '.' : '';
	        rupiah += separator + ribuan.join('.');
        }
        $("#ongkir").html('Rp.' + rupiah + ',00');

        const total = $(".checkout__order__total").data('total');
        const jumlah = total + biaya_ongkir;

        var	number_string = jumlah.toString(),
	    sisa 	= number_string.length % 3,
	    rupiah 	= number_string.substr(0, sisa),
	    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
        if (ribuan) {
	        separator = sisa ? '.' : '';
	        rupiah += separator + ribuan.join('.');
        }

        $("#total_bayar").html('Rp.' + rupiah + ',00');

    }

    $('select.alamat').change(function() {

        $('#jasa_kirim').html(
            "<div class='col-12 mb-2'>" +
            "<div class='spinner-border text-primary' role='status'>" +
            "<span class='visually-hidden'></span>" +
            "</div>" +
            "</div>"
        );

        const data = $(this).val().split('/');
        const provinsi_id = data[0];
        const kota_id = data[1];

        if (kota_id == 0) {
            $('#jasa_kirim').html(
                "<div class='col-12 mb-2'>" +
                "<div class='card shadow'>" +
                "<div class='card-body'>" +
                "<span class='card-text'>Silakan Pilih Alamat</span>" +
                "</div>" +
                "</div>" +
                "</div>");
        } else if(kota_id == 156) {
            $('#jasa_kirim').html(
                "<div class='col-12 mb-2'>" +
                "<div class='card shadow'>" +
                "<div class='card-body'>" +
                "<span class='card-text'>Ongkir Gratis</span>" +
                "</div>" +
                "</div>" +
                "</div>" + 
                "<input type='hidden' value='Gratis/0' name='courier'>");

            $('#ongkir').html('Gratis');
        } else {
            $.ajax({
                type: "post",
                url: "{{ url('pelanggan/pesan/bayar/ongkir') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    destination: kota_id,
                },
                success: function(data) {
                    $('#jasa_kirim').html(data);
                }
            });
        }
    });
</script>
@endsection