@extends('layouts.member')

@section('content')
    <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5"
    style="border-radius: 10px;">
        <h1 class="font-weight-bold text-center mb-5" style="font-size: 48px;">{{__('Daftar')}}</h1>
        <form method="POST" action="{{ route('register') }}" style="font-size: 24px;">
            <div class="form-group">
                <label for="nama" class="mb-2">{{__('Nama Lengkap')}}</label>
                <input type="text" name="nama" class="form-control form-control-lg mb-3"
                placeholder="Masukkan Nama Lengkap" required autofocus>
            </div>
            <div class="form-group">
                <label for="email" class="mb-2">{{__('Email')}}</label>
                <input type="text" name="email" class="form-control form-control-lg mb-3"
                placeholder="wakprint@gmail.com" required autofocus>
            </div>
            <div class="form-group">
                <label for="nomorHP" class="mb-2">{{__('Nomor HP')}}</label>
                <input type="text" name="nomorHP" class="form-control form-control-lg mb-3"
                placeholder="Masukkan Nomor HP Anda" required autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="mb-2">{{__('Password')}}</label>
                <div class="input-group mb-3">
                    <input type="password"
                    name="password"
                    class="form-control form-control-lg"
                    placeholder="Masukkan Kata Sandi"
                    data-toggle="password"
                    required autofocus>
                    <div class="input-group-append">
                        <span class="input-group-text bg-white"
                        style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field"
                            class="fa fa-fw fa-eye field_icon toggle-password">
                            </i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm-password" class="mb-2">
                    {{__('Konfirmasi Password')}}
                </label>
                <div class="input-group mb-3">
                    <input required
                    type="password"
                    name="confirm-password"
                    class="form-control form-control-lg {{ $errors->has('confirm-password') ? ' is-invalid' : '' }}"
                    placeholder="Konfirmasi Kata Sandi"
                    data-toggle="password">
                    @if ($errors->has('confirm-password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('confirm-password') }}</strong>
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
            <div class="form-group">
                <div class="form-check custom-checkbox mb-5 ml-1">
                    <input id="termsCheck" type="checkbox" name="termsCheck" class="form-check-input custom-control-input" required autofocus>
                    <label for="termsCheck" class="form-check-label custom-control-label"
                    style="font-size: 14px;">
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
            <label class="row justify-content-center mb-4"
            style="font-size: 18px;">
                {{__('Sudah punya akun ?')}}
                <a class="text-primary-purple ml-2" href="{{ route('login') }}">
                    {{__('Masuk')}}
                </a>
            </label>
        </div>
    </div>
@endsection
