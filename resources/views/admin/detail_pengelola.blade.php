<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.admin.navbar_after_admin')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:72px">
            <div class="row">
                <div class="col-4 mt-5">
                    <div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2" id="v-pills-home-tab" data-toggle="pill" onclick="window.location='{{ url('/admin') }}'" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">home</i>
                                Beranda
                            </a>
                            <a class="nav-link mb-2" id="v-pills-data-member-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/data-member') }}'" href="#v-pills-data-member" role="tab" aria-controls="v-pills-data-member" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">history_edu</i>
                                Data Member
                            </a>
                            <a class="nav-link active mb-2" id="v-pills-data-pengelola-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/data-pengelola') }}'" href="#v-pills-data-pengelola" role="tab" aria-controls="v-pills-data-pengelola" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">print</i>
                                Data Pengelola
                            </a>
                            <a class="nav-link mb-2" id="v-pills-saldo-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/konfirmasi-saldo') }}'" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">account_balance_wallet</i>
                                Saldo
                            </a>
                            <a class="nav-link mb-4" id="v-pills-keluhan-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/keluhan') }}'" href="#v-pills-keluhan" role="tab" aria-controls="v-pills-keluhan" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">chat</i>
                                Keluhan Pelanggan
                            </a>
                            <a class="nav-link mb-2" id="v-pills-keluar-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/login') }}'" href="#v-pills-keluar" role="tab" aria-controls="v-pills-keluar" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons text-primary-danger md-32 align-middle mr-2">exit_to_app</i>
                                Keluar
                            </a>
                            
                        </div>
                    </div>
                </div>
    
                <div class="container col-8 mt-5">
                    
                    <div class="card shadow-sm mb-5 pl-3 pr-3 ml-3" style="border-radius:10px;">
                        <div class="row justify-content-between mb-4 mt-3 ml-0">
                            <h1 class="col font-weight-bold">000000736</h1>
                            <a class="text-dark" href=""><i class="col text-right material-icons md-48">close</i></a>
                        </div>
    
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive ml-3 mr-3 mb-4" style="height:300px; border-radius:5px;">
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Nama Tempat Percetakan</p>
                            <p class="col mb-0">Toko Uwak</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Nama Pemilik</p>
                            <p class="col mb-0">Agus</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Nomor HP</p>
                            <p class="col mb-0">+6281263547763</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Nama Bank</p>
                            <p class="col mb-0">BRI</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Nomor Rekening</p>
                            <p class="col mb-0">0538549202057</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Alamat</p>
                            <p class="col mb-0">Jln. Seksama Medan Denai, Medan, Sumatera Utara (20228)<br>
                                <a href="">https:/goo.gle/AhfjeuaDHfkean</a>
                            </p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Deskripsi Tempat Percetakan</p>
                            <p class="col mb-0">Tempat percetakan yang sangat bersahabat untuk kalangan pelajar</p>
                        </div>
    
                        <div class="row justify-content-between mb-4 ml-0">
                            <p class="col font-weight-bold">Status Tempat Percetakan</p>
                            <p class="col">BUKA</p>
                        </div>
    
                        <div class="row mb-2" style="margin-right:-50px">
                            <div class="col-8 text-right mb-2 ml-0">
                                <button type="button" class="btn btn-default btn-lg text-primary-danger font-weight-bold mb-4 pl-5 pr-5 " 
                                onclick="window.location='{{ url('/admin/tolak-pengelola') }}'"
                                style="border-radius:30px">Tolak</button>
                            </div>
                            <div class="col-4 mb-2 ml-0">
                                <button type="button" class="col-auto btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-4"
                                onclick="window.location='{{ url('/admin/data-pengelola') }}'"
                                style="border-radius:30px;">Setujui</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
