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
                            <a class="nav-link active mb-2" id="v-pills-pesanan-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/pesanan') }}'" href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan" aria-selected="true" style="font-size: 24px;">
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
                    <div class="row mb-3 ml-0">
                        <div class="container col-10">
                            <div class="input-group mb-3" role="search">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari percetakan atau produk disini" 
                                aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2" style="border-radius:30px;">
                                <i class="fa fa-search ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                                top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                            </div>
                        </div>
    
                        <div class="container col-2">
                            <div class="dropdown">
                                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" 
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" 
                                aria-haspopup="true" aria-expanded="false">
                                    Semua
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Terbaru</a>
                                    <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                    <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="table-scrollbar mb-5 ml-3 pr-2">
                        <table class="table table-hover">
                            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jumlah Dokumen</th>
                                    <th scope="col">Pengambilan</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">1</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">2</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">3</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">4</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                                <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                    <td scope="row">5</td>
                                    <td>09:34</td>
                                    <td>5/7/2020</td>
                                    <td>2</td>
                                    <td>Ambil Sendiri</td>
                                    <td>Pending</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
@endsection

