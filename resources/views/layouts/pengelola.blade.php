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
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{asset('dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('dropzone/dist/min/dropzone.min.css')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
    <link href="https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_bZF3gnD_g.woff2" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Righteous" />

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"> </script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    {{-- dropzone --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a id="logo" class="navbar-brand wakprint" href="/partner"
                    style="font-size: 24px;">{{ __('Wakprint') }}</a>
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
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::currentRouteName() == 'partner.login')
                        <li class="nav-i, i8tem">
                            <a class="nav-link SemiBold text-primary-purple mr-4" href="{{route('partner.register')}}"
                                style="color:#BC41BE; font-size: 24px;">{{__('Daftar')}}</a>
                        </li>
                        @elseif(Route::currentRouteName() == 'partner.register')
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary-wakprint btn-sm pt-2 pb-2 pl-5 pr-5 font-weight-bold"
                                href="{{ route('partner.login') }}"
                                style="border-radius:30px; font-size: 24px; color:white">
                                {{ __('Masuk') }}
                            </a>
                        </li>
                        @endif

                        @else
                        <li class="nav-item mr-2" style="display: flex; align-items:center;">
                            <a class="nav-link SemiBold" href="#"
                                style="color: black; font-size: 18px;">{{ __('Chat') }}</a>
                        </li>
                        <li class="nav-item mr-0" style="display: flex; align-items:center;">
                            <a class="nav-link" href="#" style="color: black">
                                <i class="material-icons md-24 mt-2 mr-2">notifications</i>
                            </a>
                        </li>
                        <li class="nav-item mr-0">
                            <a class="nav-link" href="{{ route('partner.profile') }}"
                                style="display: flex; align-items:center; font-weight:bold; font-size: 18px;">
                                {{-- <span class="text-primary-purple mr-2">{{Auth::user()->nama_lengkap}}</span> --}}
                                <span class="text-primary-purple mr-2">{{__('Rp. 10.000')}}</span>
                                <img class="align-middle ml-2" src="https://ptetutorials.com/images/user-profile.png"
                                    width="45" height="45" alt="no logo">
                            </a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @guest
            <main>
                @yield('content')
            </main>
        @endguest

        @auth
            <main>
                @if (Route::currentRouteName() == 'partner.profile.edit')
                    @yield('content')
                @elseif(Route::currentRouteName() == 'partner.detail.pesanan')
                    @yield('content')
                @elseif(Route::currentRouteName() == 'partner.produk.create')
                    @yield('content')
                @elseif(Route::currentRouteName() == 'partner.promo.create')
                    @yield('content')
                @elseif(Route::currentRouteName() == 'partner.atk.create')
                    @yield('content')
                @else
                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row justify-content-left ml-0 mb-3"
                                    style="font-size: 18px;">
                                    <label class="font-weight-bold mr-3">
                                        {{__('Percetakan')}}
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="nav flex-column nav-pills"
                                    id="v-pills-tab"
                                    role="tablist"
                                    aria-orientation="vertical"
                                    style="font-size: 18px;">
                                    <a class="nav-link active mb-2"
                                        id="v-pills-beranda-tab"
                                        data-toggle="pill"
                                        href="#v-pills-beranda"
                                        role="tab"
                                        aria-controls="v-pills-beranda"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            home
                                        </i>
                                        {{__('Beranda')}}
                                    </a>
                                    <a class="nav-link mb-2"
                                        id="v-pills-pesanan-tab"
                                        data-toggle="pill"
                                        href="#v-pills-pesanan"
                                        role="tab"
                                        aria-controls="v-pills-pesanan"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            shopping_cart
                                        </i>
                                        {{__('Pesanan')}}
                                    </a>
                                    <a class="nav-link mb-2"
                                        id="v-pills-saldo-tab"
                                        data-toggle="pill"
                                        href="#v-pills-saldo"
                                        role="tab"
                                        aria-controls="v-pills-saldo"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            account_balance_wallet
                                        </i>
                                        {{__('Saldo')}}
                                    </a>
                                    <a class="nav-link mb-2"
                                        id="v-pills-produk-tab"
                                        data-toggle="pill"
                                        href="#v-pills-produk"
                                        role="tab"
                                        aria-controls="v-pills-produk"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            print
                                        </i>
                                        {{__('Produk')}}
                                    </a>
                                    <a class="nav-link mb-2"
                                        id="v-pills-promo-tab"
                                        data-toggle="pill"
                                        href="#v-pills-promo"
                                        role="tab"
                                        aria-controls="v-pills-promo"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            local_offer
                                        </i>
                                        {{__('Promo')}}
                                    </a>
                                    <a class="nav-link mb-2"
                                        id="v-pills-atk-tab"
                                        data-toggle="pill"
                                        href="#v-pills-atk"
                                        role="tab"
                                        aria-controls="v-pills-atk"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            architecture
                                        </i>
                                        {{__('Alat Tulis Kantor')}}
                                    </a>
                                    <a class="nav-link mb-2"
                                        id="v-pills-info-tab"
                                        data-toggle="pill"
                                        href="#v-pills-info"
                                        role="tab"
                                        aria-controls="v-pills-info"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            contact_support
                                        </i>
                                        {{__('Info dan Bantuan')}}
                                    </a>
                                    <a class="nav-link mb-2 mt-4"
                                        id="v-pills-keluar-tab"
                                        data-toggle="pill"
                                        href="#v-pills-keluar"
                                        role="tab"
                                        aria-controls="v-pills-keluar"
                                        aria-selected="true"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="material-icons text-primary-danger md-36 align-middle mr-2">
                                            exit_to_app
                                        </i>
                                        {{__('Keluar')}}
                                    </a>
                                    <form id="logout-form" action="{{ route('partner.logout') }}" method="POST" style="display: none;">
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
        @endauth
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
{{-- ...Some more scripts... --}}
<script src="{{ asset('js/scriptPengelola.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@yield('script')

</html>