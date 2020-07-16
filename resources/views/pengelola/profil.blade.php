<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:72px">
            <div class="row">
                <div class="container col-4 mt-5">
                    <div class="container">
                        <div class="row justify-content-left">
                            <h4 class="font-weight-bold mr-3">Percetakan</h4>
                            <!-- Rounded switch -->
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
    
                    <div class="mt-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2" id="v-pills-home-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola') }}'" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">home</i>
                                Beranda
                            </a>
                            <a class="nav-link mb-2" id="v-pills-pesanan-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/pesanan') }}'" href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">shopping_cart</i>
                                Pesanan
                            </a>
                            <a class="nav-link mb-2" id="v-pills-saldo-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/saldo') }}'" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">account_balance_wallet</i>
                                Saldo
                            </a>
                            <a class="nav-link mb-2" id="v-pills-produk-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/kelola-produk') }}'" href="#v-pills-produk" role="tab" aria-controls="v-pills-produk" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">print</i>
                                Produk
                            </a>
                            <a class="nav-link mb-2" id="v-pills-promo-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/kelola-promo') }}'" href="#v-pills-promo" role="tab" aria-controls="v-pills-promo" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">local_offer</i>
                                Promo
                            </a>
                            <a class="nav-link mb-2" id="v-pills-atk-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/kelola-atk') }}'" href="#v-pills-atk" role="tab" aria-controls="v-pills-atk" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">architecture</i>
                                Alat Tulis Kantor
                            </a>
                            <a class="nav-link mb-2" id="v-pills-info-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/info-bantuan') }}'" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">contact_support</i>
                                Info dan Bantuan
                            </a>
                            <a class="nav-link mb-2 mt-4" id="v-pills-keluar-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/login') }}'" href="#v-pills-keluar" role="tab" aria-controls="v-pills-keluar" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons text-primary-danger md-32 align-middle mr-2">exit_to_app</i>
                                Keluar
                            </a>
                            
                        </div>
                    </div>
                        
                </div>
    
                <div class="container col-8 mt-5">
    
                    <div class="container justify-content-between pl-2 pr-2 pt-2 pb-2 mb-4" style="height:200px; 
                        border-radius:5px; 
                        background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg');
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;">
                        <h2 class="font-weight-bold mb-5 ml-2">Percetakan IMAHA Productions</h2>
    
                        <div class="container text-right">
                            <button type="button" class="btn btn-outline-yellow font-weight-bold pl-5 pr-5" 
                            onclick="window.location='{{ url('/pengelola/profil/edit') }}'"
                            style="border-radius:30px; margin-right:0px; margin-top:50px;">Ubah Profil</button>
                        </div>
                    </div>

                    <div class="table-scrollbar">
                        <div class="row justify-content-left mb-0">
                            <p class="col-3 ml-0">Nama Pemilik</p>
                            <p class="col-9 font-weight-bold ml-0">Wayne Rooney</p>
                        </div>
        
                        <div class="row justify-content-left mb-0">
                            <p class="col-3 ml-0">Nomor HP</p>
                            <p class="col-9 font-weight-bold ml-0">+628314567382</p>
                        </div>
        
                        <div class="row justify-content-left mb-0">
                            <p class="col-3 ml-0">Nama Bank</p>
                            <p class="col-9 font-weight-bold ml-0">BRI</p>
                        </div>
        
                        <div class="row justify-content-left mb-0">
                            <p class="col-3 ml-0">Nomor Rekening</p>
                            <p class="col-9 font-weight-bold ml-0">061235483222</p>
                        </div>
        
                        <div class="row justify-content-left mb-2">
                            <p class="col-3 ml-0">Alamat</p>
                            <p class="col-9 font-weight-bold ml-0">Jalan Seksama Medan Denai, Medan, Sumatera Utara (20228)</p>
                        </div>
        
                        <div class="row justify-content-left mb-4">
                            <p class="col-3 ml-0">Deskripsi Tempat Percetakan</p>
                            <p class="col-9 font-weight-bold">Tempat percetakan yang sangat bersahabat di kantong para pelajar<br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis temporibus aliquam quia illo! Tempore impedit eligendi quia fugit maiores eius saepe tempora, et distinctio, omnis iure quidem reiciendis, soluta enim?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

