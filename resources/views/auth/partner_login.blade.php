@extends('layouts.pengelola')

{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Partner {{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('partner.login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

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
                    @if (Route::has('password.request'))
                        <a class="text-primary-purple ml-0" href="{{ route('password.request') }}" style="font-size: 14px;">
                            {{__('Lupa kata sandi ?') }}
                        </a>
                    @endif
                </div>
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-primary-wakprint btn-block SemiBold" style="font-size: 18px;">
                        {{ __('Login') }}
                    </button>
                </div>
                <label class="row justify-content-center mb-4" style="font-size: 16px;">
                    {{__('Belum punya akun ?')}}
                    <a class="text-primary-purple ml-2" href="">
                        {{__('Daftar')}}
                    </a>
                </label>
            </form>
        </div>
    </div>
@endsection
