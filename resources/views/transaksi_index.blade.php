@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('pesan'))
    <div class="alert alert-success" role="alert">
        {{ session('pesan') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Semua transaksi</div>
                <div class="card-body">
                    <h2>Data Transaksi</h2>
                    <div class="row mb-2">
                        <div class="col-6">
                            <a href="{{ url('/home') }}" class="btn btn-danger btn-sm">Kembali</a>
                            <a href="{{ url('admin/transaksi/index') }}" class="btn btn-primary btn-sm">Refresh</a>
                            <p>
                                
                                </p>
                        </div>
                        <div class="col-6 text-right">
                             <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modelId">
                                Print Laporan
                            </button> 

                            <!-- Modal -->
                            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Print Laporan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form target="_blank" method="GET" action="{{ url('admin/transaksi/print') }}">
                                            <div class="modal-body text-left">
                                                <div class="form-group">
                                                    <label for="first_date">Dari Tanggal</label>
                                                    <input type="date" class="form-control" name="first_date" id="first_date">
                                                    <small id="helpId" class="form-text text-muted">Masukkan Dari
                                                        Tanggal</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="last_date">Sampai Tanggal</label>
                                                    <input type="date" class="form-control" name="last_date" id="last_date">
                                                    <small id="helpId" class="form-text text-muted">Masukkan Sampai
                                                        Tanggal</small>
                                                </div>
                                                <div class="form-group">
                                                  <label for="">Status</label>
                                                  <select class="form-control" name="status">
                                                    <option value="-2">Semua</option>
                                                    <option value="-1">Reject</option>
                                                    <option value="0">Belum Bayar</option>
                                                    <option value="1">Sudah Bayar</option>
                                                    <option value="2">Konfirmasi</option>
                                                    <option value="3">Pengemasan</option>
                                                    <option value="4">Pengiriman</option>
                                                    <option value="5">Selesai</option>
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Print</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Tanggal</th>
                                <th width="200px">Total Bayar</th>
                                <th>Barang</th>
                                <th>Status</th>
                                <th width="200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($objek as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->pelanggan->nama }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>{{"Rp " . number_format($row->total_bayar + $row->biaya_ongkir  ,2,',','.') }}</td>
                                <td>
                                    @foreach ($row->transaksi_keranjang as $item)
                                    <li>
                                        {{ $item->keranjang->barang->nama_barang }}({{ $item->keranjang->jlh_beli }})

                                    </li>
                                    @endforeach
                                </td>
                                <td>
                                    @if($row->status == -1)
                                    <h4><span class="badge badge-pill badge-danger badge-lg">Reject</span></h4>
                                    @elseif($row->status == 0)
                                    <h4><span class="badge badge-pill badge-danger badge-lg">Belum Bayar</span></h4>
                                    @elseif($row->status == 1)
                                    <h4><span class="badge badge-pill badge-primary badge-lg">Sudah Bayar</span></h4>
                                    @elseif($row->status == 2)

                                    {{-- ini diubah --}}
                                    <h4><span class="badge badge-pill badge-success badge-lg">Konfirmasi</span></h4>
                                    {{-- ini diubah --}}

                                    @elseif($row->status == 3)
                                    <h4><span class="badge badge-pill badge-primary badge-lg">Pengemasan</span></h4>
                                    @elseif($row->status == 4)
                                    <h4><span class="badge badge-pill badge-primary badge-lg">Pengiriman</span></h4>
                                    @elseif($row->status == 5)
                                    <h4><span class="badge badge-pill badge-success badge-lg">Selesai</span></h4>
                                    @endif
                                </td>
                                <td>
                                    <a name="" id="" class="btn btn-primary btn-sm" href="{{ url('admin/transaksi/'. $row->id) }}" role="button">Detail</a>
                                    @if($row->status > 0)
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal{{$row->id}}">
                                        Bukti Pembayaran
                                    </button>
                                    @endif


                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img class="img-fluid" src="{{ \Storage::url($row->bukti_img) }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection