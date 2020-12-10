<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Wakprint') </title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script>
    --}}
    //TODO cek ada error atau enggak aku tambahain ini
    <script src="{{ asset('js/bootsrap.js') }}"></script>


    <!-- Data Tables Import Local -->

    {{-- <script src="{{ asset('DataTables/datatables.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.21/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js') }}"></script>
    <link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('DataTables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('DataTables/DataTables-1.10.21/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    --}}

    <!-- Data Tables Import Online -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{--
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    --}}
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{-- <script
        src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    --}}

    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
    <link href="https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_bZF3gnD_g.woff2" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Righteous" />

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a id="logo" class="navbar-brand wakprint" href="/" style="font-size: 24px;">{{ __('Wakprint') }}</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item mr-0">
                                <a class="nav-link" href="{{ route('profile') }}"
                                    style="display: flex; align-items:center; font-weight:bold; font-size: 18px;">
                                    {{-- <span
                                        class="text-primary-purple mr-2">{{ Auth::user()->nama_lengkap }}</span>
                                    --}}
                                    <span class="text-primary-purple mr-2">
                                        {{ auth()->user()->nama }}
                                    </span>
                                    <img class="align-middle ml-2" src="https://ptetutorials.com/images/user-profile.png"
                                        width="45" height="45" alt="no logo">
                                </a>
                            </li>
                        @endauth
                        {{-- @endguest --}}
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @if (Route::currentRouteName() == 'admin.login')
                @yield('content')
            @else
                <div class="container mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link {{ set_active('admin.home') }} mb-2" id="v-pills-beranda-tab"
                                    href="{{ route('admin.home') }}" role="tab" aria-controls="v-pills-beranda"
                                    aria-selected="true" style="font-size:18px;">
                                    <i class="material-icons md-36 align-middle mr-2">
                                        home
                                    </i>
                                    {{ __('Beranda') }}
                                </a>
                                <a class="nav-link {{ set_active('admin.member') }} mb-2" id="v-pills-data-member-tab"
                                    href="{{ route('admin.member') }}" role="tab" aria-controls="v-pills-data-member"
                                    aria-selected="true" style="font-size:18px;">
                                    <i class="material-icons md-36 align-middle mr-2">
                                        history_edu
                                    </i>
                                    {{ __('Data Member') }}
                                </a>
                                <a class="nav-link {{ set_active('admin.partner') }} mb-2"
                                    id="v-pills-data-pengelola-tab" href="{{ route('admin.partner') }}" role="tab"
                                    aria-controls="v-pills-data-pengelola" aria-selected="true" style="font-size:18px;">
                                    <i class="material-icons md-36 align-middle mr-2">
                                        print
                                    </i>
                                    {{ __('Data Pengelola') }}
                                </a>
                                <a class="nav-link {{ set_active('admin.saldo') }} mb-2" id="v-pills-saldo-tab"
                                    href="{{ route('admin.saldo') }}" role="tab" aria-controls="v-pills-saldo"
                                    aria-selected="true" style="font-size:18px;">
                                    <i class="material-icons md-36 align-middle mr-2">
                                        account_balance_wallet
                                    </i>
                                    {{ __('Saldo') }}
                                </a>
                                <a class="nav-link {{ set_active('admin.keluhan') }} mb-4" id="v-pills-keluhan-tab"
                                    href="{{ route('admin.keluhan') }}" role="tab" aria-controls="v-pills-keluhan"
                                    aria-selected="true" style="font-size:18px;">
                                    <i class="material-icons md-36 align-middle mr-2">
                                        chat
                                    </i>
                                    {{ __('Keluhan Pelanggan') }}
                                </a>
                                <a class="nav-link mb-2" id="v-pills-keluar-tab" href="" role="tab"
                                    aria-controls="v-pills-keluar" aria-selected="true" style="font-size:18px;"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons text-primary-danger md-36 align-middle mr-2">
                                        exit_to_app
                                    </i>
                                    {{ __('Keluar') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                        <div class="tab-content col-md-8">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
</body>
<script src="{{ asset('js/appAdmin.js') }}"></script>
<script src="{{ asset('js/bootsrap.js') }}"></script>

@yield('script')

</html>
