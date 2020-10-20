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
    <script src="{{asset('dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>

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



    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js|https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script> --}}

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a id="logo" class="navbar-brand wakprint" href="/" style="font-size: 36px;">{{ __('Wakprint') }}</a>
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
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link SemiBold text-primary-purple mr-4" href="{{ route('register') }}"
                                style="color:#BC41BE; font-size: 24px;">{{__('Daftar')}}</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary-wakprint btn-sm pt-2 pb-2 pl-5 pr-5 font-weight-bold"
                                href="{{ route('login') }}" style="border-radius:30px; font-size: 24px; color:white">
                                {{ __('Masuk') }}
                            </a>
                        </li>
                        @else
                        <li class="nav-item mr-2" style="display: flex; align-items:center;">
                            <a class="nav-link SemiBold" href="{{ route('chat') }}"
                                style="color: black; font-size: 24px;">{{ __('Chat') }}</a>
                        </li>
                        <li class="nav-item dropdown mr-0" style="display: flex; align-items:center;">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" style="color: black">
                                <span class="badge badge-danger" style="border-radius: 30px;top:0px;">0</span>
                                <span class="material-icons md-32 mt-2 mr-2">notifications</span>
                            </a>
                            <ul class="dropdown-menu p-2" style="top: 60px;
                                right: 0px;
                                left: unset;
                                width: 500px;
                                box-shadow: 0px 5px 7px -1px #c1c1c1;
                                padding-bottom: 0px;
                                padding: 0px;">
                                <li class="notification-box mb-2">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-3 col-3 text-center">
                                            <img src="https://ptetutorials.com/images/user-profile.png"
                                                class="w-50 rounded-circle my-auto">
                                        </div>
                                        <div class="col-lg-9 col-sm-9 col-9">
                                            <strong class="text-black">David John</strong>
                                            <div>
                                                Lorem ipsum dolor sit amet, consectetur
                                            </div>
                                            <small class="text-light-gray">27.11.2015, 15:00</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification-box mb-2">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-3 col-3 text-center">
                                            <img src="https://ptetutorials.com/images/user-profile.png"
                                                class="w-50 rounded-circle my-auto">
                                        </div>
                                        <div class="col-lg-9 col-sm-9 col-9">
                                            <strong class="text-black">David John</strong>
                                            <div>
                                                Lorem ipsum dolor sit amet, consectetur
                                            </div>
                                            <small class="text-light-gray">27.11.2015, 15:00</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification-box mb-2">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-3 col-3 text-center">
                                            <img src="https://ptetutorials.com/images/user-profile.png"
                                                class="w-50 rounded-circle my-auto">
                                        </div>
                                        <div class="col-lg-9 col-sm-9 col-9">
                                            <strong class="text-black">David John</strong>
                                            <div>
                                                Lorem ipsum dolor sit amet, consectetur
                                            </div>
                                            <small class="text-light-gray">27.11.2015, 15:00</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item mr-0">
                            <a class="nav-link" href="{{ route('profile') }}"
                                style="display: flex; align-items:center; font-weight:bold; font-size: 18px;">
                                <span class="text-primary-purple text-truncate text-right mr-2"
                                    style="width:80%;">{{Auth::user()->nama_lengkap}}</span>
                                @if (!empty(Auth::user()->getFirstMediaUrl()))
                                <img class="align-middle border border-gray ml-2"
                                    src="{{Auth::user()->getFirstMediaUrl()}}" width="45" height="45" alt="no logo"
                                    style="border-radius: 30px;">
                                @else
                                <img class="align-middle ml-2" src="https://ptetutorials.com/images/user-profile.png"
                                    width="45" height="45" alt="no logo">
                                @endif
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
        <footer class="footer">
            <div class="shadow-sm" style="width: 100%"></div>
            <div class="container pt-2 pb-5">
                <div class="row">
                    <div class="col-md-3 mt-0">
                        <a id="logo" style="font-size: 36px;">{{ __('WAKPRINT') }}</a>
                    </div>
                    <div class="col-md-3 mt-3">
                        <h4 class="row mb-2 font-weight-bold" style="font-size: 24px;">{{ __('Kontak') }}</h4>
                        <a class="row mb-0" style="font-size: 16px;">{{ __('+6281263638') }}</a>
                        <a class="row mb-0" style="font-size: 16px;">{{ __('dev@wakprint.com') }}</a>
                    </div>
                    <div class="col-md-3 mt-3">
                        <h4 class="row mb-2 font-weight-bold" style="font-size: 24px;">{{ __('Informasi Umum') }}</h4>
                        <a class="row text-dark mb-0" href="#" style="font-size: 16px;">{{ __('Tentang Kami') }}</a>
                        <a class="row text-dark" href="#" style="font-size: 16px;">{{ __('Kebijakan Privasi') }}</a>
                        <a class="row text-dark" href="#" style="font-size: 16px;">{{ __('Syarat & Ketentuan') }}</a>
                        <a class="row text-dark" href="" style="font-size: 16px;">{{ __('FAQ') }}</a>
                    </div>
                    <div class="col-md-3 mt-3">
                        <h4 class="row font-weight-bold mb-2" style="font-size: 24px;">{{ __('Sosial Media') }}</h4>
                        <div class="row mb-2">
                            <img src="{{url('img/instagram.png')}}" class="img-responsive ml-0" alt="" width="24"
                                height="24">
                            <img src="{{url('img/facebook.png')}}" class="img-responsive ml-4" alt="" width="24"
                                height="24">
                            <img src="{{url('img/youtube.png')}}" class="img-responsive ml-4" alt="" width="24"
                                height="24">
                            <img src="{{url('img/whatsapp.png')}}" class="img-responsive ml-4" alt="" width="24"
                                height="24">
                        </div>
                        <div class="row">
                            <a>
                                <i class="fa fa-copyright"
                                    style="font-size: 16px;">{{__(' Copyright Wakprint 2020') }}</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        @endguest
        @auth
        <main>
            @switch(Route::currentRouteName())
            @case('profile')
            @case('profile.edit')
            @case('saldo')
            @case('riwayat')
            @case('pesanan')
            @case('favorit')
            @case('ulasan')
            <div class="container">
                <div class="row mt-5 mb-5">
                    <div class="col-md-4">
                        <div class="bg-light-purple text-center"
                            style="height:300px; border-radius:0px 25px 25px 0px; position: relative;">
                            @if (!empty($member->getFirstMediaUrl()))
                            <img src="{{ $member->getFirstMediaUrl() }}" class="img-responsive" alt="" width="300px"
                                height="300px" style="border-radius:8px 8px 8px 8px;">
                            @else
                            <img src="https://unsplash.it/600/400" class="img-responsive" alt="" width="300px"
                                height="300px" style="border-radius:8px 8px 8px 8px;">
                            @endif

                            <div class="bg-dark" style="position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, 140%); opacity:80%;
                                            color: white;
                                            width:300px;
                                            border-radius:0px 0px 8px 8px;">
                                <label class="font-weight-bold text-truncate mx-auto"
                                    style="font-size: 30px; width:100%;">{{ $member->nama_lengkap }}</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link {{set_active('alamat')}} SemiBold text-truncate mb-4"
                                    id="v-pills-alamat-tab" href="{{ route('alamat') }}" role="tab"
                                    aria-controls="v-pills-alamat" aria-selected="true"
                                    style="font-size: 24px; width:100%;">
                                    <i class="material-icons align-middle md-32 mr-2">
                                        location_on
                                    </i>
                                    @if (!empty($member->alamat['alamat']))
                                    @for($i=0 ; $i < count($member->alamat['alamat']);$i++)
                                        @if ($member->alamat['alamat'][$i]['id'] === $member->alamat['IdAlamatUtama'])
                                        {{ $member->alamat['alamat'][$i]['Alamat Jalan'] }},
                                        {{ $member->alamat['alamat'][$i]['Kelurahan'] }},
                                        {{ $member->alamat['alamat'][$i]['Kecamatan'] }},
                                        {{ $member->alamat['alamat'][$i]['Kabupaten Kota'] }},
                                        {{ $member->alamat['alamat'][$i]['Provinsi'] }},
                                        {{ $member->alamat['alamat'][$i]['Kode Pos'] }}
                                        @endif
                                        @endfor
                                        @else
                                        <label>-</label>
                                        @endif
                                </a>
                                <a class="nav-link {{set_active('saldo')}} SemiBold mb-2" id="v-pills-saldo-tab"
                                    href="{{ route('saldo') }}" role="tab" aria-controls="v-pills-saldo"
                                    aria-selected="false" style="font-size: 24px; color:#BC41BE">
                                    <i class="material-icons align-middle md-32 mr-2"
                                        style="color:#BC41BE">account_balance_wallet</i>
                                    Rp. {{ $member->jumlah_saldo ?? 0 }}
                                </a>
                                <a class="nav-link {{set_active('riwayat')}} SemiBold mb-4"
                                    id="v-pills-riwayat-tab mb-3" href="{{ route('riwayat') }}" role="tab"
                                    aria-controls="v-pills-riwayat" aria-selected="false" style="font-size: 24px;">
                                    <i class="material-icons align-middle md-32 mr-2">history</i>
                                    {{__('Riwayat Transaksi') }}
                                </a>
                                <a class="nav-link {{set_active('konfigurasiPesanan')}} SemiBold mb-2"
                                    id="v-pills-konfigurasi-tab" href="{{ route('konfigurasiPesanan') }}" role="tab"
                                    aria-controls="v-pills-konfigurasi" aria-selected="false" style="font-size: 24px;">
                                    <i class="material-icons align-middle md-32 mr-2">phonelink_setup</i>
                                    {{__('Konfigurasi File') }}
                                </a>
                                <a class="nav-link {{set_active('pesanan')}} SemiBold mb-4" id="v-pills-pesanan-tab"
                                    href="{{ route('pesanan') }}" role="tab" aria-controls="v-pills-pesanan"
                                    aria-selected="false" style="font-size: 24px;">
                                    <i class="material-icons align-middle md-32 mr-2">shopping_cart</i>
                                    {{__('Pesanan') }}
                                </a>
                                <a class="nav-link {{set_active('favorit')}} SemiBold mb-2" id="v-pills-favorit-tab"
                                    href="{{ route('favorit') }}" role="tab" aria-controls="v-pills-favorit"
                                    aria-selected="false" style="font-size: 24px;">
                                    <i class="material-icons align-middle md-32 mr-2">favorite</i>
                                    {{__('Favorit') }}
                                </a>
                                <a class="nav-link {{set_active('ulasan')}} SemiBold mb-4" id="v-pills-ulasan-tab"
                                    href="{{ route('ulasan') }}" role="tab" aria-controls="v-pills-ulasan"
                                    aria-selected="false" style="font-size: 24px;">
                                    <i class="material-icons align-middle md-32 mr-2">rate_review</i>
                                    {{__('Ulasan') }}
                                </a>
                                <a class="nav-link {{set_active('logout')}} SemiBold" id="v-pills-keluar-tab"
                                    data-toggle="pill" href="{{ route('logout') }}" role="tab"
                                    aria-controls="v-pills-keluar" aria-selected="true" style="font-size: 24px;"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons align-middle md-32 mr-2">exit_to_app</i>
                                    {{__('Keluar') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content col-md-8">
                        @yield('content')
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="shadow-sm" style="width: 100%"></div>
                <div class="container pt-2 pb-5">
                    <div class="row">
                        <div class="col-md-3 mt-0">
                            <a id="logo" style="font-size: 36px;">{{ __('WAKPRINT') }}</a>
                        </div>
                        <div class="col-md-3 mt-3">
                            <h4 class="row mb-2 font-weight-bold" style="font-size: 24px;">{{ __('Kontak') }}</h4>
                            <a class="row mb-0" style="font-size: 16px;">{{ __('+6281263638') }}</a>
                            <a class="row mb-0" style="font-size: 16px;">{{ __('dev@wakprint.com') }}</a>
                        </div>
                        <div class="col-md-3 mt-3">
                            <h4 class="row mb-2 font-weight-bold" style="font-size: 24px;">{{ __('Informasi Umum') }}
                            </h4>
                            <a class="row text-dark mb-0" href="{{route('tentang')}}"
                                style="font-size: 16px;">{{ __('Tentang Kami') }}</a>
                            <a class="row text-dark" href="#" style="font-size: 16px;">{{ __('Kebijakan Privasi') }}</a>
                            <a class="row text-dark" href="#"
                                style="font-size: 16px;">{{ __('Syarat & Ketentuan') }}</a>
                            <a class="row text-dark" href="{{route('faq')}}"
                                style="font-size: 16px;">{{ __('FAQ') }}</a>
                        </div>
                        <div class="col-md-3 mt-3">
                            <h4 class="row font-weight-bold mb-2" style="font-size: 24px;">{{ __('Sosial Media') }}</h4>
                            <div class="row mb-2">
                                <img src="{{url('img/instagram.png')}}" class="img-responsive ml-0" alt="" width="24"
                                    height="24">
                                <img src="{{url('img/facebook.png')}}" class="img-responsive ml-4" alt="" width="24"
                                    height="24">
                                <img src="{{url('img/youtube.png')}}" class="img-responsive ml-4" alt="" width="24"
                                    height="24">
                                <img src="{{url('img/whatsapp.png')}}" class="img-responsive ml-4" alt="" width="24"
                                    height="24">
                            </div>
                            <div class="row">
                                <a>
                                    <i class="fa fa-copyright"
                                        style="font-size: 16px;">{{__(' Copyright Wakprint 2020') }}</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            @break
            @default
            @yield('content')
            <footer class="footer">
                <div class="shadow-sm" style="width: 100%"></div>
                <div class="container pt-2 pb-5">
                    <div class="row">
                        <div class="col-md-3 mt-0">
                            <a id="logo" style="font-size: 36px;">{{ __('WAKPRINT') }}</a>
                        </div>
                        <div class="col-md-3 mt-3">
                            <h4 class="row mb-2 font-weight-bold" style="font-size: 24px;">{{ __('Kontak') }}</h4>
                            <a class="row mb-0" style="font-size: 16px;">{{ __('+6281263638') }}</a>
                            <a class="row mb-0" style="font-size: 16px;">{{ __('dev@wakprint.com') }}</a>

                        </div>
                        <div class="col-md-3 mt-3">
                            <h4 class="row mb-2 font-weight-bold" style="font-size: 24px;">{{ __('Informasi Umum') }}
                            </h4>
                            <a class="row text-dark mb-0" href="{{route('tentang')}}"
                                style="font-size: 16px;">{{ __('Tentang Kami') }}</a>
                            <a class="row text-dark" href="#" style="font-size: 16px;">{{ __('Kebijakan Privasi') }}</a>
                            <a class="row text-dark" href="#"
                                style="font-size: 16px;">{{ __('Syarat & Ketentuan') }}</a>
                            <a class="row text-dark" href="{{route('faq')}}"
                                style="font-size: 16px;">{{ __('FAQ') }}</a>
                        </div>
                        <div class="col-md-3 mt-3">
                            <h4 class="row font-weight-bold mb-2" style="font-size: 24px;">{{ __('Sosial Media') }}</h4>
                            <div class="row mb-2">
                                <img src="{{url('img/instagram.png')}}" class="img-responsive ml-0" alt="" width="24"
                                    height="24">
                                <img src="{{url('img/facebook.png')}}" class="img-responsive ml-4" alt="" width="24"
                                    height="24">
                                <img src="{{url('img/youtube.png')}}" class="img-responsive ml-4" alt="" width="24"
                                    height="24">
                                <img src="{{url('img/whatsapp.png')}}" class="img-responsive ml-4" alt="" width="24"
                                    height="24">
                            </div>
                            <div class="row">
                                <a>
                                    <i class="fa fa-copyright"
                                        style="font-size: 16px;">{{__(' Copyright Wakprint 2020') }}</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            @endswitch
        </main>
        @endauth
    </div>
    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    @yield('script')
</body>

</html>
