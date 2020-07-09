<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.admin.navbar_after_admin')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top: 120px;">
            <h1 class="font-weight-bold ml-0 mb-5">Alasan Penolakan</h1>
        
            <div class="short-scrollbar mb-4" style="margin-left:-15px;">
                <div class="container mb-3">
                    <button type="button" class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0" style="margin-right:35px;">Minimal Topup</button>
                </div>

                <div class="container mb-3">
                    <button type="button" class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0" style="">Ada kendala pada verifikasi pendaftaran</button>
                </div>

                <div class="container mb-3">
                    <button type="button" class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0" style="">Saldo untuk ditarik tidak cukup</button>
                </div>

                <div class="container mb-3">
                    <button type="button" class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0" style="">Saldo untuk ditarik tidak cukup</button>
                </div>
            </div>

            <p class="mb-2">Isi Sendiri</p>
            <div class="input-group mb-4">
                <textarea type="text" class="form-control pt-2 pb-2"></textarea>
            </div>

            <div class="row justify-content-between">
                            
                <div class="container col text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0" 
                        onclick="window.location='{{ url('/admin/konfirmasi-saldo') }}'"
                        style="border-radius:30px; margin-right:0px;">Batal</button>
                    </div>
                </div>

                <div class="container col-auto text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                        onclick="window.location='{{ url('/admin/konfirmasi-saldo') }}'"
                        style="border-radius:30px; margin-right:-20px;">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
