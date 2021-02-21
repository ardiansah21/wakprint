@extends('layouts.pengelola')

@section('content')
    <div class="container">
        <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5"
            style="border-radius: 10px;">
            <label class="font-weight-bold text-center mb-4"
                style="font-size: 36px;">
                {{__('Daftar')}}
            </label>
            <form method="POST"
                action="{{ route('partner.register') }}"
                style="font-size: 16px;">
                @csrf
                <div class="form-group">
                    <label for="nama"
                        class="mb-2">
                        {{__('Nama Lengkap')}}
                    </label>
                    <br>
                    <input id="nama"
                        type="text"
                        class="form-control form-control-lg {{ $errors->has('nama') ? ' is-invalid' : '' }}"
                        placeholder="Masukkan Nama Lengkap Anda"
                        name="nama"
                        value="{{ old('nama') }}"
                        autocomplete="nama"
                        autofocus>
                    @if ($errors->has('nama'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email"
                        class="mb-2">
                        {{__('Email')}}
                    </label>
                    <input id="email"
                        type="email"
                        class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        placeholder="Masukkan Email Anda">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nomor_hp"
                        class="mb-2">
                        {{__('Nomor HP')}}
                    </label>
                    <input id="nomor_hp"
                        type="nomor_hp"
                        class="form-control form-control-lg {{ $errors->has('nomor_hp') ? ' is-invalid' : '' }}"
                        name="nomor_hp"
                        value="{{ old('nomor_hp') }}"
                        autocomplete="nomor_hp"
                        placeholder="Masukkan Nomor HP Anda">
                        @if ($errors->has('nomor_hp'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nomor_hp') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="row justify-content-between mb-0">
                    <div class="form-group col-md-5">
                        <label for="nama_bank"
                            class="mb-2">
                            {{__('Nama Bank')}}
                        </label>
                        <select id="nama_bank" class="btn btn-default dropdown dropdown-toggle custom-select select border border-gray {{ $errors->has('nama_bank') ? ' is-invalid' : '' }}"
                            name="nama_bank" style="font-size: 18px;">
                                <option value="BRI">
                                    {{__('BRI')}}
                                </option>
                                <option value="BNI">
                                    {{__('BNI')}}
                                </option>
                                <option value="Mandiri">
                                    {{__('Mandiri')}}
                                </option>
                                <option value="BCA">
                                    {{__('BCA')}}
                                </option>
                        </select>
                        @if ($errors->has('nama_bank'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama_bank') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-7">
                        <label for="nomor_rekening"
                            class="mb-2">
                            {{__('Nomor Rekening')}}
                        </label>
                        <input id="nomor_rekening"
                                type="text"
                                name="nomor_rekening"
                                value="{{ old('nomor_rekening') }}"
                                class="form-control form-control-lg {{ $errors->has('nomor_rekening') ? ' is-invalid' : '' }}"
                                placeholder="Masukkan Nomor Rekening Anda"
                                >
                            @if ($errors->has('nomor_rekening'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nomor_rekening') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_toko"
                        class="mb-2">
                        {{__('Nama Tempat Percetakan')}}
                    </label>
                    <div class="mb-3">
                        <input id="nama_toko"
                            type="text"
                            name="nama_toko"
                            value="{{ old('nama_toko') }}"
                            class="form-control form-control-lg {{ $errors->has('nama_toko') ? ' is-invalid' : '' }}"
                            placeholder="Masukkan Nama Tempat Percetakan Anda"
                            >
                        @if ($errors->has('nama_toko'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama_toko') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi_toko"
                        class="mb-2">
                        {{__('Deskripsi Tempat Percetakan')}}
                    </label>
                    <div class="mb-3">
                        <textarea id="deskripsi_toko"
                            type="text"
                            name="deskripsi_toko"
                            class="form-control form-control-lg {{ $errors->has('deskripsi_toko') ? ' is-invalid' : '' }}"
                            placeholder="Masukkan Deskripsi Percetakan Anda"
                            >{{ old('deskripsi_toko') }}</textarea>
                        @if ($errors->has('deskripsi_toko'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deskripsi_toko') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat_percetakan"
                        class="mb-2">
                        {{__('Alamat Tempat Percetakan')}}
                    </label>
                    <div class="mb-3">
                        <textarea id="alamat_toko"
                            type="text"
                            name="alamat_toko"
                            class="form-control form-control-lg {{ $errors->has('alamat_toko') ? ' is-invalid' : '' }}"
                            placeholder="Masukkan Alamat Percetakan Anda"
                            >{{ old('alamat_toko') }}</textarea>
                        @if ($errors->has('alamat_toko'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('alamat_toko') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"
                        class="mb-2">{{__('Password')}}</label>
                    <div class="input-group mb-3">
                        <input id="password"
                            type="password"
                            class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password"

                            autocomplete="new-password"
                            data-toggle="password"
                            placeholder="Masukkan Kata Sandi">
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
                                class="fa fa-fw fa-eye field_icon toggle-password1">
                                </i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation"
                        class="mb-2">
                        {{__('Konfirmasi Password')}}
                    </label>
                    <div class="input-group mb-3">
                        <input id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-control form-control-lg {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                            placeholder="Konfirmasi Kata Sandi"
                            data-toggle="password"
                            autocomplete="new-password">
                            @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                            <div class="input-group-append">
                                <span class="input-group-text bg-white"
                                    style="border-radius: 0px 5px 5px 0px;">
                                    <i id="togglePassword"
                                        toggle="#password-field"
                                        class="fa fa-fw fa-eye field_icon toggle-password2">
                                    </i>
                                </span>
                            </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check custom-checkbox mb-5 ml-1">
                        <input id="termsCheck"
                            type="checkbox"
                            name="termsCheck"
                            class="form-check-input custom-control-input"

                            autofocus>
                        <label for="termsCheck"
                            class="form-check-label custom-control-label"
                            style="font-size: 14px;">
                            {{__('Saya sudah membaca dan setuju dengan Wakprint.com')}}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary-wakprint btn-lg btn-block SemiBold"
                        style="font-size: 16px;">
                        {{__('Daftar')}}
                    </button>
                </div>
                <label class="row justify-content-center mb-4"
                    style="font-size: 14px;">
                    {{__('Sudah punya akun ?')}}
                    <a class="text-primary-purple ml-2"
                        href="{{route('partner.login')}}">
                        {{__('Masuk')}}
                    </a>
                </label>
            </form>
        </div>
    </div>
    <script>
        $("body").on('click', '.toggle-password1', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var inputPassword = $("#password");
            if (inputPassword.attr("type") === "password") {
                inputPassword.attr("type", "text");
            } else {
                inputPassword.attr("type", "password");
            }
        });
        $("body").on('click', '.toggle-password2', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var inputKonfirmasiPassword = $("#password_confirmation");
            if (inputKonfirmasiPassword.attr("type") === "password") {
                inputKonfirmasiPassword.attr("type", "text");
            } else {
                inputKonfirmasiPassword.attr("type", "password");
            }
        });
    </script>
@endsection
