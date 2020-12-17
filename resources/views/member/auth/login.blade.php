@extends('layouts.member')

@section('content')
    <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5"
    style="border-radius: 10px;">
        <h1 class="font-weight-bold text-center" style="font-size: 48px;">{{__('Masuk')}}</h1>
        <form method="POST" action="{{ route('login') }}" style="font-size: 24px;">
            @csrf
            <div class="form-group">
                <label for="email" class="">{{ __('Email') }}</label>
                <div>
                    <input id="email"
                    type="email"
                    class="form-control form-control-lg mb-3
                    @error('email')
                    is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
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
                    <input id="password"
                    type="password"
                    class="form-control form-control-lg
                    @error('password')
                    is-invalid
                    @enderror"
                    name="password"
                    required
                    autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group text-right mb-5">
                @if (Route::has('password.request'))
                        <a class="text-primary-purple ml-0"
                        href="{{ route('password.request') }}"
                        style="font-size: 14px;">
                            {{__('Lupa kata sandi ?') }}
                        </a>
                @endif
            </div>
            <div class="form-group mb-4">
                <button type="submit"
                    class="btn btn-primary-wakprint btn-block SemiBold"
                    style="font-size: 24px;">
                    {{ __('Masuk') }}
                </button>
            </div>
        </form>
        <div class="mb-2">
            <label class="row justify-content-center mb-0"
            style="font-size: 18px; text-align:center">
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
            <button class="btn btn-outline-primary btn-lg btn-block font-weight-bold mb-4"
            style="border-radius:30px;font-size: 24px;">
                {{__('Masuk sebagai Pengelola Percetakan')}}
            </button>
            <label class="row justify-content-center mb-4"
            style="font-size: 18px;">
                {{__('Belum punya akun ?')}}
                <a class="text-primary-purple ml-2" href="{{ route('register') }}">
                    {{__('Daftar')}}
                </a>
            </label>
        </div>
    </div>
@endsection
