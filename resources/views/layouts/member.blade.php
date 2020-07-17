<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wakprint') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
     <!-- Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Montserrat:200,600" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Righteous" />

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a id="logo" class="navbar-brand wakprint" href="{{ url('/') }}">{{ __('Wakprint') }}</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                                <li class="nav-i, i8tem">
                                    <a class="nav-link text-primary-purple mr-4" href="">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary-wakprint btn-sm pt-2 pb-2 pl-5 pr-5 font-weight-bold" href="" style="border-radius:30px; color:white">{{ __('Masuk') }}</a>
                            </li>
                        @else
                            <li class="nav-item mr-0"><a class="nav-link" href="{{url('member/chat')}}">Chat</a></li>
                            <li class="nav-item mr-0"><a class="nav-link" href="#"><i class="fa fa-bell mr-2"></i></a></li>
                            <li class="nav-item mr-2">
                                <a class="nav-link" style=" display: flex; align-items:center;">
                                    <span style="">Rp.12121212</span>
                                    <img class="align-middle ml-2" src="https://ptetutorials.com/images/user-profile.png" width="24" height="24" alt="no logo">
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
        <footer class="footer">
            <div class="shadow-sm" style="width: 100%"></div>
            <div class="container pt-2 pb-2">
                <div class="row">
                    <div class="col-md-3">
                            <a id="logo">WAKPRINT</a>
                    </div>
                    <div class="col-md-3">
                            <h4 class="row mb-2 font-weight-bold">Kontak</h4>
                            
                            <a class="row mb-0">+6281263638</a>
                            <a class="row mb-0">dev@wakprint.com</a>
                                    
                    </div>
                    <div class="col-md-3">
                            <h4 class="row mb-2 font-weight-bold">Informasi Umum</h4>
                            <a class="row text-dark mb-0">Tentang Kami</a>
                            <a class="row text-dark" href="#">Kebijakan Privasi</a>
                            <a class="row text-dark" href="#">Syarat & Ketentuan</a>
                            <a class="row text-dark" href="{{ url('/member/faq') }}">FAQ</a>
                    </div>
                    <div class="col-md-3">
                            <h4 class="row font-weight-bold mb-2">Sosial Media</h4>
                            <div class="row mb-2">
                                <img src="{{url('instagram.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                                <img src="{{url('facebook.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('youtube.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('whatsapp.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                            </div>
                            <div class="row">
                                <a>
                                    <i class="fa fa-copyright"> Copyright Wakprint 2020</i>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>