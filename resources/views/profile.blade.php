@extends('layouts.app2')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('ogani') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Profile</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home </a>
                        <span>Profile</span>
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
            <h4>Profile</h4>
            <table>
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>&ensp;: {{ Auth::guard('pelanggan')->user()->nama }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>&ensp;: {{ Auth::guard('pelanggan')->user()->email }}</td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>&ensp;: {{ Auth::guard('pelanggan')->user()->telp }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modelId"><i class="fa fa-address-book" aria-hidden="true"></i>
                Tambah Alamat
            </button>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modelEdit"><i class="fa fa-user" aria-hidden="true"></i>
               Edit Profil
            </button>

            <!-- Modal -->
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
            <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ url('pelanggan/profile/update/'. Auth::guard('pelanggan')->user()->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Masukkan Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Masukkan Password">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="telp">Telpon</label>
                                    <input type="text" class="form-control" name="telp" placeholder="Masukkan Telpon">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sync    "></i>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alamat as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->provinsi }}</td>
                        <td>{{ $item->kota }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <a class="btn btn-danger" href="{{ url('pelanggan/profile/alamat/'. $item->id.'/hapus') }}" role="button"><i class="fas fa-trash-alt    "></i>Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
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
</script>
@endsection