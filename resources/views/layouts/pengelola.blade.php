<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="user_id" content="{{ auth()->guard('partner')->user()->id_pengelola }}">
        <meta name="user_login" content="{{ auth()->guard('partner')->user() }}">
    @endauth

    <title>@yield('title','Wakprint') </title>

    <script src="{{ asset('js/bootstrap.js') }}"></script>


    {{-- <script src="{{ asset('dropzone/dist/min/dropzone.min.js') }}"
        type="text/javascript"></script> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dropzone/dist/min/dropzone.min.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
    <link href="https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_bZF3gnD_g.woff2" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Righteous" />

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}" />

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    {{-- dropzone --}}
    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    --}}

</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="{{ asset('OwlCarousel2-2.3.4/dist/owl.carousel.js') }}"></script>
    <script src="{{ asset('OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/scriptPengelola.js') }}"></script>
    <script src="{{ asset('dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


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
                                    <a class="nav-link SemiBold text-primary-purple mr-4"
                                        href="{{ route('partner.register') }}"
                                        style="color:#BC41BE; font-size: 24px;">{{ __('Daftar') }}</a>
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
                            <li class="nav-item mr-1" style="display: flex; align-items:center;">

                                <a class="nav-link SemiBold" href="{{ route('chat') }}"
                                    style="color: black; font-size: 24px;">{{ __('Chat') }}
                                    <span v-show="notifChat>0" v-text="notifChat" class="badge badge-danger"
                                        style="font-size: 16px;color: white;text-align: center;width: 24px;height: 24px;border-radius: 30%;top: -20px;left: -10px;position: relative;">
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown mr-0" style="display: flex; align-items:center;">
                                <a class="nav-link material-icons md-32" href="" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black">
                                    notifications
                                </a>
                                <span v-show="notif>0" v-text="notif" class="badge badge-danger"
                                    style="background-color: red;font-size: 16px;color: white;text-align: center;width: 24px;height: 24px;border-radius: 35%;position: absolute;top: 3px;right: 0;"></span>
                                <ul class="dropdown-menu "
                                    style="top: 60px; right: 0px; left: unset; width: 500px; box-shadow: 0px 5px 7px -1px #c1c1c1; padding-bottom: 0px; padding: 0px;">
                                    <li class="text-right mr-3">
                                        <h5 v-if="notif>0" @click="readAll" class="pointer"
                                            onMouseOver="this.style.color='#BC41BE'" onMouseOut="this.style.color='#000'">
                                            Tandai sudah dibaca semua
                                        </h5>

                                        <h5 v-else class=" m-4">Anda tidak memiliki notifikasi saat ini</h5>
                                    </li>
                                    <li v-for="(notif, i) in notification" v-bind:key="i" @click="readchat(notif)"
                                        class="list-group-item list-group-item-action pointer">
                                        <div class="col">
                                            <strong class="text-black">@{{ notif . title }}</strong>
                                            <div>
                                                @{{ notif . description }}
                                            </div>
                                            <small class="text-light-gray">@{{ notif . created_at }}</small>
                                        </div>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item mr-0">
                                <a class="nav-link" href="{{ route('partner.profile') }}"
                                    style="display: flex; align-items:center; font-weight:bold; font-size: 18px;">
                                    <span class="text-primary-purple text-truncate mr-2" style="width:80%;">
                                        {{ Auth::user()->nama_lengkap }}
                                    </span>
                                    @if (!empty(Auth::user()->getFirstMediaUrl()))
                                        <img class="align-middle border border-gray ml-2"
                                            src="{{ Auth::user()->getFirstMediaUrl() }}" width="45" height="45"
                                            alt="no logo" style="border-radius: 30px; object-fit:contain;">
                                    @else
                                        <img class="align-middle ml-2"
                                            src="https://ptetutorials.com/images/user-profile.png" width="45" height="45"
                                            alt="no logo">
                                    @endif
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @auth
                @switch(Route::currentRouteName())
                    @case('partner.profile.edit')
                    @case('partner.detail.pesanan')
                    @case('partner.produk.create')
                    @case('partner.produk.edit')
                    @case('partner.promo.create')
                    @case('partner.promo.edit')
                    @case('partner.atk.create')
                    @case('partner.atk.edit')
                    @case('partner.chat')
                    @yield('content')
                    @break
                    @default
                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row justify-content-left ml-0 mb-3" style="font-size: 18px;">
                                    <label class="font-weight-bold mr-3">
                                        {{ __('Percetakan') }}
                                    </label>
                                    <form id="status-form" action="{{ route('partner.ubah-status') }}" method="POST">
                                        @csrf
                                        <label class="switch">
                                            <input id="statusToko" class="statusToko" type="checkbox" value="Buka"
                                                name="status_toko"
                                                onchange="event.preventDefault(); document.getElementById('status-form').submit();"
                                                @if (Auth::user()->status_toko == 'Buka')
                                            checked
                                            @endif
                                            >
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </div>
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical" style="font-size: 18px;">
                                    <a class="nav-link mb-2 {{ set_active('partner.home') }}" id="v-pills-beranda-tab"
                                        href="{{ route('partner.home') }}" role="tab" aria-controls="v-pills-beranda"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            home
                                        </i>
                                        {{ __('Beranda') }}
                                    </a>
                                    <a class="nav-link mb-2 {{ set_active('partner.pesanan') }}" id="v-pills-pesanan-tab"
                                        href="{{ route('partner.pesanan') }}" role="tab" aria-controls="v-pills-pesanan"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            shopping_cart
                                        </i>
                                        {{ __('Pesanan') }}
                                    </a>
                                    <a class="nav-link mb-2 {{ set_active('partner.saldo') }}" id="v-pills-saldo-tab"
                                        href="{{ route('partner.saldo') }}" role="tab" aria-controls="v-pills-saldo"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            account_balance_wallet
                                        </i>
                                        {{ __('Saldo') }}
                                    </a>
                                    <a class="nav-link mb-2 {{ set_active('partner.produk.index') }}" id="v-pills-produk-tab"
                                        href="{{ route('partner.produk.index') }}" role="tab" aria-controls="v-pills-produk"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            print
                                        </i>
                                        {{ __('Produk') }}
                                    </a>
                                    <a class="nav-link mb-2 {{ set_active('partner.promo.index') }}" id="v-pills-promo-tab"
                                        href="{{ route('partner.promo.index') }}" role="tab" aria-controls="v-pills-promo"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            local_offer
                                        </i>
                                        {{ __('Promo') }}
                                    </a>
                                    <a class="nav-link mb-2 {{ set_active('partner.atk.index') }}" id="v-pills-atk-tab"
                                        href="{{ route('partner.atk.index') }}" role="tab" aria-controls="v-pills-atk"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            architecture
                                        </i>
                                        {{ __('Alat Tulis Kantor') }}
                                    </a>
                                    <a class="nav-link mb-2 {{ set_active('partner.info') }}" id="v-pills-info-tab"
                                        href="{{ route('partner.info') }}" role="tab" aria-controls="v-pills-info"
                                        aria-selected="true">
                                        <i class="material-icons md-36 align-middle mr-2">
                                            contact_support
                                        </i>
                                        {{ __('Info dan Bantuan') }}
                                    </a>
                                    <a class="nav-link mb-2 mt-4" id="v-pills-keluar-tab" data-toggle="pill"
                                        href="#v-pills-keluar" role="tab" aria-controls="v-pills-keluar" aria-selected="true"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="material-icons text-primary-danger md-36 align-middle mr-2">
                                            exit_to_app
                                        </i>
                                        {{ __('Keluar') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('partner.logout') }}" method="POST"
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
                @endswitch
            @else
                @yield('content')
            @endauth
        </main>
    </div>
</body>




<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/appPartner.js') }}"></script>
<script src="{{ asset('js/scriptPengelola.js') }}"></script>
<script src="{{ asset('dropzone/dist/min/dropzone.min.js') }}"></script>


{{-- <script
    src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
--}}

@yield('script')

</html>
