<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.navbar')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container-fluid pt-5 pb-5" style="margin-top:72px">

            <div class="container mb-5">
                <h1 class="font-weight-bold">Daftar</h1>
            </div>

            <form class="needs-validation mb-4" novalidate>
                <div class="container">
                    <label for="validationCustomNama" class="font-weight-bold mb-2">Nama Lengkap</label>
                    <div class="mb-3">
                        <input id="validationCustomNama" type="text" class="form-control form-control-lg"
                            placeholder="Masukkan Nama Lengkap" required>
                        <div class="valid-feedback">
                            Format nama sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi nama dengan format yang benar !
                        </div>
                    </div>

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

                    <label for="validationCustomNoHP" class="font-weight-bold mb-2">Nomor HP</label>
                    <div class="mb-3">
                        <input id="validationCustomNoHP" type="text" class="form-control form-control-lg"
                            placeholder="Masukkan Nomor HP Anda" required>
                        <div class="valid-feedback">
                            Format Nomor HP sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi Nomor HP dengan format yang benar !
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

                    <label for="validationCustomKonfirmasiPassword" class="font-weight-bold mb-2">Konfirmasi
                        Password</label>
                    <div class="input-group mb-3">
                        <input required="true" id="validationCustomKonfirmasiPassword" type="password" name="password"
                            class="form-control form-control-lg" placeholder="Konfirmasi Kata Sandi" data-toggle="password">
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

                    <div class="form-group">
                        <div class="form-check custom-control custom-checkbox mb-5">
                            <input id="termsCheck" type="checkbox" class="form-check-input custom-control-input" required>
                            <label class="form-check-label custom-control-label" for="termsCheck">Saya sudah membaca dan
                                setuju dengan Wakprint.com</label>
                            <div class="invalid-feedback">
                                Anda harus mencentang syarat dan ketentuan diatas
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
                        onclick="window.location='{{ url('/index') }}'">Daftar</button>
                </div>
            </form>


            <div class="container mb-5">
                <p class="mb-4 text-center">Atau</p>
                <button type="button" class="btn btn-outline-danger btn-lg btn-block font-weight-bold mb-4"
                    style="border-radius:30px">Daftar dengan Google</button>
                <button type="button" class="btn btn-outline-primary btn-lg btn-block font-weight-bold mb-4"
                    style="border-radius:30px">Daftar dengan Facebook</button>
                <p class="mb-4 text-center">Sudah punya akun ? <a class="text-primary-purple"
                        href="{{ url('/member/login') }}">Masuk</a></p>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection
