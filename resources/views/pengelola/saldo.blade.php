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
                            <a class="nav-link active mb-2" id="v-pills-saldo-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/saldo') }}'" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="true" style="font-size: 24px;">
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
                    
                    <div class="container bg-primary-purple text-white mb-5 ml-3" style="border-radius:10px;">
                        <div class="row justify-content-between">
                            <div class="container text-center align-self-center col-2 mr-0">
                                <i class="material-icons md-48 align-middle">account_balance_wallet</i>
                            </div>
    
                            <div class="col-10">
                                <div class="card-body">
                                    <div class="row justify-content-between">
                                        <div class="container col-auto" style="margin-left:-50px;">
                                            <h2 class="card-title font-weight-bold mb-0">Rp. 57.000</h2>
                                        </div>
                                        <div class="container col-4 mr-2">
                                            <button type="button" class="btn btn-primary-yellow btn-lg btn-block font-weight-bold text-center"
                                            onclick="window.location='{{ url('/pengelola/saldo/tarik') }}'"
                                            style="border-radius:30px">
                                                Tarik
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <h1 class="font-weight-bold mb-4 ml-3">Riwayat Transaksi Saya</h1>
    
                    <div class="row mb-4 ml-0">
                        
                        <div class="container col-auto">
                            <div class="dropdown">
                                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Jenis Dana
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Dana Masuk</a>
                                    <a class="dropdown-item" href="#">Dana Keluar</a>
                                </div>
                            </div>
                        </div>
    
                        <div class="container col">
                            <div class="row justify-content-left">
                                <p class="col-2 font-weight-bold mb-0">Rentang Tanggal</p>
                                <div class="col-auto dropdown">
                                    <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        17/08/2020
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Terbaru</a>
                                        <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                        <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                    </div>
                                </div>
    
                                <div class="col-1 row-bordered mb-4"></div>
    
                                <div class="col-auto dropdown">
                                    <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        17/08/2020
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Terbaru</a>
                                        <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                        <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        
                    </div>
    
                    <div class="table-scrollbar mb-4 ml-3 pr-2">
                        <table class="table table-hover">
                            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jenis Dana</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Detail Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>Masuk</td>
                                    <td>Rp. 20.000</td>
                                    <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">2</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>Masuk</td>
                                    <td>Rp. 20.000</td>
                                    <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">3</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>Masuk</td>
                                    <td>Rp. 20.000</td>
                                    <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">4</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>Masuk</td>
                                    <td>Rp. 20.000</td>
                                    <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>Masuk</td>
                                    <td>Rp. 20.000</td>
                                    <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>Masuk</td>
                                    <td>Rp. 20.000</td>
                                    <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>Masuk</td>
                                    <td>Rp. 20.000</td>
                                    <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <div class="container text-right mb-5">
                        <button type="button" class="btn btn-outline-purple font-weight-bold pl-5 pr-5" style="border-radius:30px; margin-right:-30px;">Export Excel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

