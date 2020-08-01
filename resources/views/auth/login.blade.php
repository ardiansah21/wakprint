@extends('layouts.member')

@section('content')
<div class="container">
    <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5" style="border-radius: 10px;">
        <h1 class="font-weight-bold text-center" style="font-size: 48px;">{{__('Masuk')}}</h1>
        <form method="POST" action="{{ route('login') }}" style="font-size: 24px;">
            @csrf
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email" class="">{{ __('Email') }}</label>
                <div>
                    <input id="email" type="email" class="form-control form-control-lg mb-3
                        @error('email')
                        is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                        autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-0">
                <label for="password" class="">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="form-control form-control-lg
                        @error('password')
                        is-invalid
                        @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
                <button type="submit" class="btn btn-primary-wakprint btn-block SemiBold" style="font-size: 24px;">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
        <div class="mb-2">
            <label class="row justify-content-center mb-0" style="font-size: 18px; text-align:center">
                {{__('Atau')}}
            </label>
            <br>
            <button class="btn btn-outline-danger btn-lg btn-block font-weight-bold mb-4"
                style="border-radius:30px;font-size: 24px;">
                {{__('Masuk dengan Google')}}
            </button>
            <button class="btn btn-outline-primary btn-lg btn-block font-weight-bold mb-4"
                style="border-radius:30px;font-size: 24px;">
                {{__('Masuk dengan Facebook')}}
            </button>
            <label class="row justify-content-center mb-4" style="font-size: 18px;">
                {{__('Belum punya akun ?')}}
                <a class="text-primary-purple ml-2" href="">
                    {{__('Daftar')}}
                </a>
            </label>
        </div>
    </div>
</div>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

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