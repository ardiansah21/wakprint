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
                            <a class="nav-link active mb-2" id="v-pills-produk-tab" data-toggle="pill" onclick="window.location='{{ url('/pengelola/kelola-produk') }}'" href="#v-pills-produk" role="tab" aria-controls="v-pills-produk" aria-selected="true" style="font-size: 24px;">
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
                    
                    <div class="container mb-4">
                        <button type="button" class="btn btn-outline-purple font-weight-bold pl-5 pr-5"
                        onclick="window.location='{{ url('/pengelola/produk/tambah') }}'"
                        style="border-radius:30px; margin-right:-10px;">Tambah Produk</button>
                    </div>
    
                    <div class="container my-custom-scrollbar mb-5">
                        <div class="card-columns-2">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-4">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-title font-weight-bold">Deskripsi Produk</p>
                                    <p class="card-text text-truncate-multiline">Mencetak dokumen dengan tinta hitam putih yang berkualitas tinggi dan menggunakan jenis kertas yang bagus</p>
                                </div>
                                <div class="card-footer bg-primary-purple">
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <p class="card-text font-weight-bold text-white">Rp. 1.500</p>
                                        <p> 
                                            <i class="material-icons md-18 badge-sm badge-light p-1 mr-2" style="border-radius: 5px;">file_copy</i>
                                            <a href="{{url('pengelola/produk/tambah')}}" style="color: black;"><i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;">edit</i></a>
                                            <i class="material-icons md-18 badge-sm bg-primary-danger p-1 mr-2" style="border-radius: 5px;">delete</i>
                                        </p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-4">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-title font-weight-bold">Deskripsi Produk</p>
                                    <p class="card-text text-truncate-multiline">Mencetak dokumen dengan tinta hitam putih yang berkualitas tinggi dan menggunakan jenis kertas yang bagus</p>
                                </div>
                                <div class="card-footer bg-primary-purple">
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <p class="card-text font-weight-bold text-white">Rp. 1.500</p>
                                        <p> 
                                            <i class="material-icons md-18 badge-sm badge-light p-1 mr-2" style="border-radius: 5px;">file_copy</i>
                                            <a href="{{url('pengelola/produk/tambah')}}" style="color: black;"><i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;">edit</i></a>
                                            <i class="material-icons md-18 badge-sm bg-primary-danger p-1 mr-2" style="border-radius: 5px;">delete</i>
                                        </p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-4">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-title font-weight-bold">Deskripsi Produk</p>
                                    <p class="card-text text-truncate-multiline">Mencetak dokumen dengan tinta hitam putih yang berkualitas tinggi dan menggunakan jenis kertas yang bagus</p>
                                </div>
                                <div class="card-footer bg-primary-purple">
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <p class="card-text font-weight-bold text-white">Rp. 1.500</p>
                                        <p> 
                                            <i class="material-icons md-18 badge-sm badge-light p-1 mr-2" style="border-radius: 5px;">file_copy</i>
                                            <a href="{{url('pengelola/produk/tambah')}}" style="color: black;"><i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;">edit</i></a>
                                            <i class="material-icons md-18 badge-sm bg-primary-danger p-1 mr-2" style="border-radius: 5px;">delete</i>
                                        </p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-4">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-title font-weight-bold">Deskripsi Produk</p>
                                    <p class="card-text text-truncate-multiline">Mencetak dokumen dengan tinta hitam putih yang berkualitas tinggi dan menggunakan jenis kertas yang bagus</p>
                                </div>
                                <div class="card-footer bg-primary-purple">
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <p class="card-text font-weight-bold text-white">Rp. 1.500</p>
                                        <p> 
                                            <i class="material-icons md-18 badge-sm badge-light p-1 mr-2" style="border-radius: 5px;">file_copy</i>
                                            <a href="{{url('pengelola/produk/tambah')}}" style="color: black;"><i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;">edit</i></a>
                                            <i class="material-icons md-18 badge-sm bg-primary-danger p-1 mr-2" style="border-radius: 5px;">delete</i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

