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
                            <a class="nav-link SemiBold" href="#"
                                style="color: black; font-size: 24px;">{{ __('Chat') }}</a>
                        </li>
                        <li class="nav-item mr-0" style="display: flex; align-items:center;">
                            <a class="nav-link" href="#" style="color: black">
                                <i class="material-icons md-32 mt-2 mr-2">notifications</i>
                            </a>
                        </li>
                        <li class="nav-item mr-0">
                            <a class="nav-link" href="{{ route('profile') }}"
                                style="display: flex; align-items:center; font-weight:bold; font-size: 24px;">
                                <span class="text-primary-purple text-truncate mr-2"
                                    style="width: 250px;">{{Auth::user()->email}}</span>
                                <img class="align-middle ml-2" src="https://ptetutorials.com/images/user-profile.png"
                                    width="50" height="50" alt="no logo">
                            </a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
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
    </div>
    <!-- Script -->
    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone",{ 
            maxFilesize: 3,  // 3 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        });
        myDropzone.on("sending", function(file, xhr, formData) {
           formData.append("_token", CSRF_TOKEN);
        }); 
    </script>

    <script src="{{asset('dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>
</body>

</html>