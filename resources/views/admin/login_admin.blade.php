<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('konten')
    <div class="container">
        <div class="container pt-5 pb-5">
            <h1 class="font-weight-bold text-primary-purple text-center mb-5">WAKPRINT</h1>
            <div class="container-fluid mb-5">
                
                <form class="needs-validation" novalidate>
                    <div class="container mb-4">
                        <label for="validationCustomEmail" class="font-weight-bold mb-2">Nama Pengguna atau Alamat Email</label> 
                        <div class="mb-3">
                            <input id="validationCustomEmail" type="text" class="form-control form-control-lg" placeholder="wakprint@gmail.com" required>
                            <div class="valid-feedback">
                                Format email sudah benar
                            </div>
                            <div class="invalid-feedback">
                                Silahkan isi email dengan format yang benar !
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
                    </div>
                </form>
                
                <div class="container">
                    <div class="row justify-content-between ml-0 mr-0">
                    
                        <div class="form-group">
                            <div class="custom-control custom-checkbox mb-5">
                                <input id="termsCheck" type="checkbox" class="custom-control-input">
                                <label class="custom-control-label" for="termsCheck">Ingat Saya</label>
                            </div>
                        </div>
    
                        <div class="text-right">
                            <small>
                                <p class="mb-2"><a class="text-primary-purple" href="www.wakprint.com">Lupa Kata Sandi ?</a></p>
                            </small>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold mb-0 ml-0 mr-0" onclick="window.location='{{ url('/admin') }}'">Masuk</button>
                </div>
            </div>
        </div>
    </div>
@endsection
