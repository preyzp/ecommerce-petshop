<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                JPS Master<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('admin/barang/index') }}">
                                    Data Barang
                                </a>
                                <a class="dropdown-item" href="{{ url('admin/kategori/index') }}">
                                    Data Kategori
                                </a>
                                <a class="dropdown-item" href="{{ url('admin/bank/index') }}">
                                    Data Bank
                                </a>
                               
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ url('admin/pelanggan/index') }}" class="nav-link">Data Pelanggan</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ url('admin/admin/index') }}" class="nav-link">Data Admin</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ url('admin/transaksi/index') }}" class="nav-link">Data Transaksi</a>
                        </li>
                        <li class="nav-item ">
                            <a href="" class="nav-link" data-toggle="modal" data-target="#modelId">Laporan</a>
                        </li>
                        @endauth
                    </ul>
                   
                </div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
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
</body>

</html>