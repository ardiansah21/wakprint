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
                            <a class="nav-link active mb-2" id="v-pills-info-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/info-bantuan') }}'" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="true" style="font-size: 24px;">
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
    
                    <div class="row justify-content-between mb-4">
                        <h1 class="col text-lg text-primary-purple font-weight-bold mb-4 ml-2">WAKPRINT</h1>
                        <div class="container col text-right">
                            <a href="{{url('www.wakprint.com')}}"><i class="material-icons md-48 align-middle" style="color: #C4C4C4">help</i></a>
                        </div>
    
                        <div class="container col-auto mt-1">
                            <button type="button" class="col btn btn-danger bg-primary-danger font-weight-bold pl-4 pr-4" style="border-radius:30px;">Laporkan</button>
                        </div>
                    </div>
    
                    <h4 class="font-weight-bold mb-4 ml-3">Wakprint - Web Versi 1.0</h4>
                    <p class="mb-4 ml-3">Wakprint adalah platform yang menghubungkan semua printer di seluruh Indonesia secara online untuk menjawab kebutuhan pencetakan dokumen Anda. Ribuan printer yang telah menjadi rekanan Wakprint, dapat diakses oleh Anda dengan mudah. Kirimkan dokumen dan ambil serta bayar dokumen anda langsung ke rekanan kami. Sekarang, mencetak dokumen dapat dilakukan di mana pun dengan
                        mudah pada jaringan printer di Wakprint.com<br>
                        Untuk informasi lebih lanjut dapat Anda lihat selengkapnya di sosial media kami dibawah dan support terus karya anak bangsa untuk Indonesia lebih maju dan sejahtera.    
                    </p>
    
                    <div class="row justify-content-left mb-5 ml-0">
                        <div class="col-auto">
                            <img src="{{url('instagram.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                        </div>
    
                        <div class="col-auto">
                            <img src="{{url('facebook.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                        </div>
    
                        <div class="col-auto">
                            <img src="{{url('youtube.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                        </div>

                        <div class="col">
                            <img src="{{url('whatsapp.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
@endsection

