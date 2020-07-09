<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.navbar')
@endsection

@section('konten')
    <div class="container-fluid">
                
        <div class="container-fluid pt-5 pb-5" style="margin-top:72px">
            <div class="container mb-5">
                <h1 class="font-weight-bold">Daftar sebagai Pengelola Percetakan</h1>
            </div>
            
            <form class="needs-validation mb-4" novalidate>
                <div class="container mb-4">
                    <label for="validationCustomNama" class="font-weight-bold mb-2">Nama Lengkap</label>
                    <div class="mb-3">
                        <input id="validationCustomNama" type="text" class="form-control form-control-lg" placeholder="Masukkan Nama Lengkap" required>
                        <div class="valid-feedback">
                            Format nama sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi nama dengan format yang benar !
                        </div>
                    </div>
    
                    <label for="validationCustomEmail" class="font-weight-bold mb-2">Email</label> 
                    <div class="mb-3">
                        <input id="validationCustomEmail" type="text" class="form-control form-control-lg" placeholder="wakprint@gmail.com" required>
                        <div class="valid-feedback">
                            Format email sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi email dengan format yang benar !
                        </div>
                    </div>
    
                    <label for="validationCustomNoHP" class="font-weight-bold mb-2">Nomor HP</label> 
                    <div class="mb-3">
                        <input id="validationCustomNoHP" type="text" class="form-control form-control-lg" placeholder="Masukkan Nomor HP Anda" required>
                        <div class="valid-feedback">
                            Format Nomor HP sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi Nomor HP dengan format yang benar !
                        </div>
                    </div>
    
                    <div class="row justify-content-between mb-3">
                        <div class="col-3">
                            <label for="validationCustomBank" class="font-weight-bold mb-2">Nama Bank</label> 
                            <div id="validationCustomBank" class="dropdown">
                                <button class="btn btn-default btn-lg dropdown-toggle border border-gray pl-4 pr-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-required="true" aria-haspopup="true" aria-expanded="false">
                                    Pilih Nama Bank
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">BRI</a>
                                    <a class="dropdown-item" href="#">BNI</a>
                                    <a class="dropdown-item" href="#">CIMB Niaga</a>
                                </div>
                            </div>
                            <div class="valid-feedback">
                                Format Nama Bank sudah benar
                            </div>
                            <div class="invalid-feedback">
                                Silahkan pilih nama Bank Anda !
                            </div>
                        </div>
                        
                        <div class="col-9">
                            <label for="validationCustomNoRek" class="font-weight-bold mb-2">Nomor Rekening</label> 
                            <div class="mb-3">
                                <input id="validationCustomNoRek" type="text" class="form-control form-control-lg" placeholder="Masukkan NomorRekening Anda" required>
                                <div class="valid-feedback">
                                    Format Nomor Rekening sudah benar
                                </div>
                                <div class="invalid-feedback">
                                    Silahkan isi Nomor Rekening dengan format yang benar !
                                </div>
                            </div>
                        </div>
                    </div>

                    <label for="validationCustomNamaToko" class="font-weight-bold mb-2">Nama Tempat Percetakan</label> 
                    <div class="mb-3">
                        <input id="validationCustomNamaToko" type="text" class="form-control form-control-lg" placeholder="Masukkan Nama Tempat Percetakan Anda" required>
                        <div class="valid-feedback">
                            Format Nama Tempat Percetakan sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi Nama Tempat Percetakan dengan format yang benar !
                        </div>
                    </div>

                    <label for="validationCustomDeskripsiToko" class="font-weight-bold mb-2">Deskripsi Tempat Percetakan</label> 
                    <div class="mb-3">
                        <textarea id="validationCustomDeskripsiToko" type="text" class="form-control form-control-lg" required></textarea>
                        <div class="valid-feedback">
                            Format Deskripsi Tempat Percetakan sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi Deskripsi Tempat Percetakan !
                        </div>
                    </div>

                    <label for="validationCustomAlamatToko" class="font-weight-bold mb-2">Alamat Tempat Percetakan</label> 
                    <div class="mb-3">
                        <textarea id="validationCustomAlamatToko" type="text" class="form-control form-control-lg" required></textarea>
                        <div class="valid-feedback">
                            Format Alamat Tempat Percetakan sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi Alamat Tempat Percetakan !
                        </div>
                    </div>
    
                    <label for="validationCustomPassword" class="font-weight-bold mb-2">Password</label>   
                    <div class="input-group mb-3">
                        <input required="true" id="validationCustomPassword" type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan Kata Sandi"
                        data-toggle="password">
                        <div class="input-group-append" onclick="showPassword()">
                            <span class="input-group-text bg-white" style="border-radius: 0px 5px 5px 0px;">
                                <i id="togglePassword" toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></i>
                            </span>
                        </div>
                        <div class="valid-feedback">
                            Format password sudah benar
                        </div>
                        <div class="invalid-feedback">
                            Silahkan isi password dengan format yang benar !
                        </div>
                    </div>
    
                    <label for="validationCustomKonfirmasiPassword" class="font-weight-bold mb-2">Konfirmasi Password</label>   
                    <div class="input-group mb-3">
                        <input required="true" id="validationCustomKonfirmasiPassword" type="password" name="password" class="form-control form-control-lg"
                        placeholder="Konfirmasi Kata Sandi"
                        data-toggle="password">
                        <div class="input-group-append" onclick="showPassword()">
                            <span class="input-group-text bg-white" style="border-radius: 0px 5px 5px 0px;">
                                <i id="togglePassword" toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></i>
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
                            <label class="form-check-label custom-control-label" for="termsCheck">Saya sudah membaca dan setuju dengan Wakprint.com</label>
                            <div class="invalid-feedback">
                                Anda harus mencentang syarat dan ketentuan diatas
                            </div>
                        </div>
                    </div>
    
                    <button type="submit" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold" onclick="window.location='{{ url('/pengelola') }}'" style="border-radius:30px">Daftar</button>
    
                </div>
            </form>
            
            <div class="container-fluid mb-5">
                <p class="mb-4 text-center">Sudah punya akun ? <a class="text-primary-purple font-weight-bold" href="{{ url('/pengelola/login') }}">Masuk</a></p>
            </div>
        </div>
    </div>
@endsection
