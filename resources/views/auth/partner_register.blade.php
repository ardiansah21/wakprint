@extends('layouts.pengelola')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Partner {{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('partner.register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
@endsection

{{-- @section('content')
    <div class="container">
        <div class="card shadow col-md-6 mx-auto pt-4 pl-4 pr-4 mt-5 mb-5"
            style="border-radius: 10px;">
            <label class="font-weight-bold text-center mb-4"
                style="font-size: 36px;">
                {{__('Daftar')}}
            </label>
            <form method="POST"
                action="{{ route('register') }}"
                style="font-size: 16px;">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nama"
                        class="mb-2">
                        {{__('Nama Lengkap')}}
                    </label>
                    <br>
                    <input id="nama"
                        type="text"
                        class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                        placeholder="Masukkan Nama Lengkap Anda"
                        name="nama"
                        value="{{ old('nama') }}"
                        required
                        autocomplete="nama"
                        autofocus>
                    @error('nama')
                    <span class="invalid-feedback"
                        role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email"
                        class="mb-2">
                        {{__('Email')}}
                    </label>
                    <input id="email"
                        type="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required autocomplete="email"
                        placeholder="Masukkan Email Anda">
                    @error('email')
                    <span class="invalid-feedback"
                        role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nomor_hp"
                        class="mb-2">
                        {{__('Nomor HP')}}
                    </label>
                    <input id="nomor_hp"
                        type="nomor_hp"
                        class="form-control form-control-lg @error('nomor_hp') is-invalid @enderror" 
                        name="nomor_hp"
                        value="{{ old('nomor_hp') }}" 
                        required 
                        autocomplete="nomor_hp"
                        placeholder="Masukkan Nomor HP Anda">
                        @error('nomor_hp')
                        <span class="invalid-feedback"
                            role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="form-group row justify-content-between mb-0">
                    <div class="col-md-5">
                        <label for="namaBank"
                            class="mb-2">
                            {{__('Nama Bank')}}
                        </label> 
                        <div id="namaBank"
                            class="dropdown">
                            <button class="btn btn-default btn-lg dropdown-toggle border border-gray pl-3 pr-3"
                                id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-required="true"
                                aria-haspopup="true"
                                aria-expanded="false">
                                {{__('Pilih Nama Bank')}}
                            </button>
                            <div class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                    href="#">
                                    {{__('BRI')}}
                                </a>
                                <a class="dropdown-item"
                                    href="#">
                                    {{__('BNI')}}
                                </a>
                                <a class="dropdown-item"
                                    href="#">
                                    {{__('CIMB Niaga')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label for="nomor-rekening"
                            class="mb-2">
                            {{__('Nomor Rekening')}}
                        </label> 
                        <div class="mb-3">
                            <input id="nomor-rekening"
                                type="text"
                                class="form-control form-control-lg"
                                placeholder="Masukkan Nomor Rekening Anda"
                                required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama-percetakan"
                        class="mb-2">
                        {{__('Nama Tempat Percetakan')}}
                    </label> 
                    <div class="mb-3">
                        <input id="nama-percetakan"
                            type="text"
                            class="form-control form-control-lg"
                            placeholder="Masukkan Nama Tempat Percetakan Anda"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi-percetakan"
                        class="mb-2">
                        {{__('Deskripsi Tempat Percetakan')}}
                    </label> 
                    <div class="mb-3">
                        <textarea id="deskripsi-percetakan"
                            type="text"
                            placeholder="Masukkan Deskripsi Percetakan Anda"
                            class="form-control form-control-lg"
                            required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat-percetakan"
                        class="mb-2">
                        {{__('Alamat Tempat Percetakan')}}
                    </label> 
                    <div class="mb-3">
                        <textarea id="alamat-percetakan"
                            type="text"
                            placeholder="Masukkan Alamat Percetakan Anda"
                            class="form-control form-control-lg"
                            required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"
                        class="mb-2">{{__('Password')}}</label>
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
                    <label for="password-confirm"
                        class="mb-2">
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
                        <input id="termsCheck"
                            type="checkbox"
                            name="termsCheck"
                            class="form-check-input custom-control-input"
                            required
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
                        href="">
                        {{__('Masuk')}}
                    </a>
                </label>
            </form>
        </div>
    </div>
@endsection --}}
