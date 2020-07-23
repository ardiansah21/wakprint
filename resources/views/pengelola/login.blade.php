@extends('layouts.pengelola')

@section('content')
    <div class="container">
        <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5" style="border-radius: 10px;">
            <label class="font-weight-bold text-center" style="font-size: 36px;">{{__('Masuk')}}</label>
            <form method="POST" action="{{ route('login') }}" style="font-size: 18px;">
                {{-- @csrf --}}
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
                    <div class="input-group">
                        <input id="password" type="password" class="form-control form-control-lg
                            @error('password')
                            is-invalid
                            @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
