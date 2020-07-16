<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.navbar')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container-fluid pt-5 pb-5" style="margin-top:72px">

            <div class="container mb-5">
                <h1 class="font-weight-bold">Masuk</h1>
            </div>

            <form class="needs-validation" novalidate>
                <div class="container mb-4">
                    <label for="validationCustomEmail" class="font-weight-bold mb-2">Email</label>
                    <div class="mb-3">
                        <input id="validationCustomEmail" type="text" class="form-control form-control-lg"
                            placeholder="wakprint@gmail.com" required>
                        <div class="valid-feedback">
                            Format email sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi email dengan format yang benar !
                        </div>
                    </div>

                    <label for="validationCustomPassword" class="font-weight-bold mb-2">Password</label>
                    <div class="input-group mb-3">
                        <input required="true" id="validationCustomPassword" type="password" name="password"
                            class="form-control form-control-lg" placeholder="Masukkan Kata Sandi" data-toggle="password">
                        <div class="input-group-append" onclick="showPassword()">
                            <span class="input-group-text bg-white" style="border-radius: 0px 5px 5px 0px;">
                                <i id="togglePassword" toggle="#password-field"
                                    class="fa fa-fw fa-eye field_icon toggle-password"></i>
                            </span>
                        </div>
                        <div class="valid-feedback">
                            Format password sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi password dengan format yang benar !
                        </div>
                    </div>

                    <small>
                        <p class="mb-5 text-right"><a class="text-primary-purple"
                                href="{{ url('http://www.wakprint.com/') }}">Lupa Kata Sandi ?</a>
                        </p>
                    </small>

                    <button type="submit" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold mb-0"
                        onclick="window.location='{{ url('/index') }}'">Masuk</button>
                </div>
            </form>

            <div class="container mb-5">

                <p class="mb-4 text-center">Atau</p>
                <button type="button" class="btn btn-outline-danger btn-lg btn-block font-weight-bold mb-4"
                    style="border-radius:30px">Masuk dengan Google</button>
                <button type="button" class="btn btn-outline-primary btn-lg btn-block font-weight-bold mb-4"
                    style="border-radius:30px">Masuk dengan Facebook</button>
                <p class="mb-4 text-center">Belum punya akun ? <a class="text-primary-purple"
                        href="{{ url('/member/register') }}">Daftar</a></p>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer_member')
@endsection
