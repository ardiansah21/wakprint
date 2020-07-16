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
                            <a class="nav-link active mb-2" id="v-pills-promo-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/kelola-promo') }}'" href="#v-pills-promo" role="tab" aria-controls="v-pills-promo" aria-selected="true" style="font-size: 24px;">
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
                    <div class="container mb-4">
                        <button type="button" class="btn btn-outline-purple font-weight-bold pl-5 pr-5" 
                        onclick="window.location='{{ url('pengelola/promo/tambah') }}'"
                        style="border-radius:30px; margin-right:-10px;">Tambah Promo</button>
                    </div>
    
                    <div class="table-scrollbar mb-5 ml-3 pr-2">
                        <table class="table table-hover table-responsive">
                            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                <tr>
                                    <th class="align-middle" scope="col">No</th>
                                    <th class="align-middle" scope="col">Produk</th>
                                    <th class="align-middle" scope="col">Jumlah Diskon</th>
                                    <th class="align-middle" scope="col">Maksimal Diskon</th>
                                    <th class="align-middle" scope="col">Tanggal Berakhir</th>
                                    <th class="align-middle" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>Cetak Hitam Putih Dokumen</td>
                                    <td>10%</td>
                                    <td>Rp. 2.000</td>
                                    <td>5/7/2020</td>
                                    <td>
                                        <a href="{{url('pengelola/promo/tambah')}}" style="margin-left: -50px;"><i class="material-icons">edit</i></a>
                                        <i class="material-icons" style="color: #FF4949;">delete</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">2</td>
                                    <td>Cetak Hitam Putih Dokumen</td>
                                    <td>10%</td>
                                    <td>Rp. 2.000</td>
                                    <td>5/7/2020</td>
                                    <td>
                                        <a href="{{url('pengelola/promo/tambah')}}" style="margin-left: -50px;"><i class="material-icons">edit</i></a>
                                        <i class="material-icons" style="color: #FF4949;">delete</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">3</td>
                                    <td>Cetak Hitam Putih Dokumen</td>
                                    <td>10%</td>
                                    <td>Rp. 2.000</td>
                                    <td>5/7/2020</td>
                                    <td>
                                        <a href="{{url('pengelola/promo/tambah')}}" style="margin-left: -50px;"><i class="material-icons">edit</i></a>
                                        <i class="material-icons" style="color: #FF4949;">delete</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">4</td>
                                    <td>Cetak Hitam Putih Dokumen</td>
                                    <td>10%</td>
                                    <td>Rp. 2.000</td>
                                    <td>5/7/2020</td>
                                    <td>
                                        <a href="{{url('pengelola/promo/tambah')}}" style="margin-left: -50px;"><i class="material-icons">edit</i></a>
                                        <i class="material-icons" style="color: #FF4949;">delete</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">5</td>
                                    <td>Cetak Hitam Putih Dokumen</td>
                                    <td>10%</td>
                                    <td>Rp. 2.000</td>
                                    <td>5/7/2020</td>
                                    <td>
                                        <a href="{{url('pengelola/promo/tambah')}}" style="margin-left: -50px;"><i class="material-icons">edit</i></a>
                                        <i class="material-icons" style="color: #FF4949;">delete</i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

