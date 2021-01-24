<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5" style="border-radius: 10px;">
        <h1 class="font-weight-bold text-center mb-5" style="font-size: 48px;">{{__('Daftar')}}</h1>
        <form method="POST" action="{{ route('register') }}" style="font-size: 24px;">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nama" class="mb-2">{{__('Nama Lengkap')}}</label>
                <br>
                <input id="nama" type="text" class="form-control form-control-lg
                    @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap Anda"
                    name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                @error('nama')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="mb-2">{{__('Email')}}</label>
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="Masukkan Email Anda">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="nomor_hp" class="mb-2">{{__('Nomor HP')}}</label>
                <input id="nomor_hp" type="numeric"
                        class="form-control form-control-lg
                        @error('nomor_hp') is-invalid
                        @enderror"
                        name="nomor_hp"
                        value="{{ old('nomor_hp') }}"
                        required
                        autocomplete="nomor_hp"
                        placeholder="Masukkan Nomor HP Anda">
                    @error('nomor_hp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="password" class="mb-2">{{__('Password')}}</label>
                <div class="input-group mb-3">
                    <input id="password"
                        type="password"
                        class="form-control form-control-lg
                        @error('password') is-invalid
                        @enderror"
                        name="password"
                        required
                        autocomplete="new-password"
                        data-toggle="password"
                        placeholder="Masukkan Kata Sandi">
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
            <div class="form-group">
                <label for="password-confirm" class="mb-2">
                    {{__('Konfirmasi Password')}}
                </label>
                <div class="input-group mb-3">
                    <input id="password-confirm"
                        required
                        type="password"
                        name="password_confirmation"
                        class="form-control form-control-lg"
                        placeholder="Konfirmasi Kata Sandi"
                        data-toggle="password"
                        autocomplete="new-password">
                    <div class="input-group-append">
                        <span class="input-group-text bg-white" style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password">
                            </i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check custom-checkbox mb-5 ml-1">
                    <input id="termsCheck" type="checkbox" name="termsCheck" class="form-check-input custom-control-input"
                        required autofocus>
                    <label for="termsCheck" class="form-check-label custom-control-label" style="font-size: 14px;">
                        {{__('Saya sudah membaca dan setuju dengan Wakprint.com')}}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit"
                    class="btn btn-primary-wakprint btn-lg btn-block SemiBold"
                    style="font-size: 24px;">
                    {{__('Daftar')}}
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
                {{__('Daftar dengan Google')}}
            </button>
            <button class="btn btn-outline-primary btn-lg btn-block font-weight-bold mb-4"
                style="border-radius:30px;font-size: 24px;">
                {{__('Daftar dengan Facebook')}}
            </button>
            <label class="row justify-content-center mb-4" style="font-size: 18px;">
                {{__('Sudah punya akun ?')}}
                <a class="text-primary-purple ml-2" href="{{ route('login') }}">
                    {{__('Masuk')}}
                </a>
            </label>
        </div>
    </div>
</div>
@endsection

{{-- @extends('layouts.member')

@section('title','Daftar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nomor_hp" class="col-md-4 col-form-label text-md-right">{{ __('Nomor HP') }}</label>

                            <div class="col-md-6">
                                <input id="nomor_hp" type="nomor_hp"
                                    class="form-control @error('nomor_hp') is-invalid @enderror" name="nomor_hp"
                                    value="{{ old('nomor_hp') }}" required autocomplete="nomor_hp">

                                @error('nomor_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
