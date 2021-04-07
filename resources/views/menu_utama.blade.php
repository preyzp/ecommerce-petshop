<nav class="header__menu">
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('shop/index') }}">Shop</a></li>
        <li><a href="{{ url('pelanggan/pesan/hasil') }}">Cart</a></li>
        <li><a href="{{ url('pelanggan/transaksi') }}">Transaksi</a></li>
        @if (\Auth::guard('pelanggan')->check())
        <li><a href="{{ url('logout') }}">Logout</a></li>
        @else
        <li><a href="#">Login/Daftar</a>
            <ul class="header__menu__dropdown">
                <li><a href="{{ url('form-login') }}">Login</a></li>
                <li><a href="{{ url('form-daftar') }}">Daftar</a></li>
            </ul>
        </li>
        @endif

    </ul>
</nav>