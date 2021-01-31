@extends('layouts.pengelola')
@section('content')
    <div class="container">
        <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5" style="border-radius: 10px;">
            <label class="font-weight-bold text-center" style="font-size: 36px;">{{__('Masuk')}}</label>
            <form method="POST" action="{{ route('partner.login') }}" style="font-size: 18px;">
                @csrf
                <div class="form-group">
                    <label for="email" class="">{{ __('Email') }}</label>
                    <div>
                        <input id="email" type="email" class="form-control form-control-lg mb-3 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mb-0">
                    <label for="password" class="">{{ __('Password') }}</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" required autocomplete="current-password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="input-group-append">
                            <span class="input-group-text bg-white"
                                style="border-radius: 0px 5px 5px 0px;">
                                <i id="togglePassword"
                                    toggle="#password-field"
                                    class="fa fa-fw fa-eye field_icon toggle-password">
                                </i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right mb-5">
                    @if (Route::has('partner.password.request'))
                        <a class="text-primary-purple ml-0" href="{{ route('partner.password.request') }}" style="font-size: 14px;">
                            {{__('Lupa kata sandi ?') }}
                        </a>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-primary-wakprint btn-block SemiBold" style="font-size: 18px;">
                        {{ __('Masuk') }}
                    </button>
                </div>
                <label class="row justify-content-center mb-0" style="font-size: 18px; text-align:center">
                    {{__('Atau')}}
                </label>
                <br>
                <button class="btn btn-outline-purple btn-lg btn-block font-weight-bold mb-4" onclick="window.location.href='partner/login'"
                    style="border-radius:30px;font-size: 24px;">
                    {{__('Masuk sebagai Member')}}
                </button>
                <label class="row justify-content-center mb-4" style="font-size: 16px;">
                    {{__('Belum punya akun ?')}}
                    <a class="text-primary-purple ml-2" href="{{route('partner.register')}}">
                        {{__('Daftar')}}
                    </a>
                </label>
            </form>
        </div>
    </div>
    <script>
        $("body").on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
