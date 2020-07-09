<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.pengelola.navbar_after_pengelola')
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
                            <a class="nav-link active mb-2" id="v-pills-beranda-tab" data-toggle="pill" href="#v-pills-beranda" role="tab" aria-controls="v-pills-beranda" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">home</i>
                                Beranda
                            </a>
                            <a class="nav-link mb-2" id="v-pills-pesanan-tab" data-toggle="pill" href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">shopping_cart</i>
                                Pesanan
                            </a>
                            <a class="nav-link mb-2" id="v-pills-saldo-tab" data-toggle="pill" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">account_balance_wallet</i>
                                Saldo
                            </a>
                            <a class="nav-link mb-2" id="v-pills-produk-tab" data-toggle="pill" href="#v-pills-produk" role="tab" aria-controls="v-pills-produk" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">print</i>
                                Produk
                            </a>
                            <a class="nav-link mb-2" id="v-pills-promo-tab" data-toggle="pill" href="#v-pills-promo" role="tab" aria-controls="v-pills-promo" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">local_offer</i>
                                Promo
                            </a>
                            <a class="nav-link mb-2" id="v-pills-atk-tab" data-toggle="pill" href="#v-pills-atk" role="tab" aria-controls="v-pills-atk" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">architecture</i>
                                Alat Tulis Kantor
                            </a>
                            <a class="nav-link mb-2" id="v-pills-info-tab" data-toggle="pill" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="true" style="font-size: 24px;">
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
    
                <div class="tab-content col-8 mt-5">
                    <div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
                        <div class="container row mb-5 ml-0">
                            <div class="container bg-light-purple p-4 col text-center mr-4" style="height:140px; border-radius:10px;">
                                <h1 class="font-weight-bold">43</h1>
                                <p class="font-weight-bold">Total Pesanan</p>
                            </div>
        
                            <div class="container bg-light-purple p-4 col text-center mr-4" style="height:140px; border-radius:10px;">
                                <h1 class="font-weight-bold">30</h1>
                                <p class="font-weight-bold">Total Pelanggan</p>
                            </div>
        
                            <div class="container bg-light-purple p-4 col text-center" style="height:140px; border-radius:10px;">
                                <h1 class="font-weight-bold">4.5</h1>
                                <p class="font-weight-bold">Rating Tempat Percetakan</p>
                            </div>
                        </div>
                        
                        <div class="container">
                            <h1 class="font-weight-bold mb-4 ml-0">Pesanan Masuk</h1>
                        </div>
                        
                        <div class="container table-scrollbar mb-5 ml-0">
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

                                    {{-- @foreach ($collection as $item) --}}
                                        <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">
                                            
                                            {{-- @foreach ($collection as $item) --}}
                                                <td scope="row">1</td>
                                                <td>09:34</td>
                                                <td>5/7/2020</td>
                                                <td>2</td>
                                                <td>Ambil Sendiri</td>
                                                <td>Pending</td>
                                            {{-- @endforeach --}}

                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-pesanan" role="tabpanel">
                        <div class="container row mb-3">
                            <div class="col-10 ml-0">
                                <div class="input-group mb-3" role="search">
                                    <input type="text" class="form-control form-control-lg" placeholder="Cari percetakan atau produk disini" 
                                    aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2" style="border-radius:30px;">
                                    <i class="fa fa-search ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                                    top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                    </i>
                                </div>
                            </div>
        
                            <div class="col-2">
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
                        
                        <div class="container table-scrollbar mb-5 ml-0 pr-2">
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

                                    {{-- @foreach ($collection as $item) --}}
                                        <tr onclick="window.location='{{ url('pengelola/pesanan-masuk/detail') }}'">

                                            {{-- @foreach ($collection as $item) --}}
                                                <td scope="row">1</td>
                                                <td>09:34</td>
                                                <td>5/7/2020</td>
                                                <td>2</td>
                                                <td>Ambil Sendiri</td>
                                                <td>Pending</td>
                                            {{-- @endforeach --}}
                                            
                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-saldo" role="tabpanel">
                        <div class="container bg-primary-purple text-white mb-5 ml-0" style="border-radius:10px;">
                            <div class="row justify-content-between ml-0">
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
        
                        <h1 class="font-weight-bold mb-4 ml-0">Riwayat Transaksi Saya</h1>
        
                        <div class="row mb-4 ml-0">
                            
                            <div class="col-auto ml-0">
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
        
                            <div class="col ml-0">
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
        
                        <div class="table-scrollbar mb-4 ml-0 pr-2">
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

                                    {{-- @foreach ($collection as $item) --}}
                                        <tr>

                                            {{-- @foreach ($collection as $item) --}}
                                                <td scope="row">1</td>
                                                <td>09:34</td>
                                                <td>5/7/2020</td>
                                                <td>Masuk</td>
                                                <td>Rp. 20.000</td>
                                                <td><a class="text-primary-purple" href="{{ url('/pengelola/transaksi/detail') }}">Lihat</a></td>
                                            {{-- @endforeach --}}
                                            
                                        </tr>
                                    {{-- @endforeach --}}
                                    
                                </tbody>
                            </table>
                        </div>
        
                        <div class="text-right mb-5">
                            <button type="button" class="btn btn-outline-purple font-weight-bold pl-5 pr-5" style="border-radius:30px;">Export Excel</button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-produk" role="tabpanel">
                        <div class="container mb-4">
                            <button type="button" class="btn btn-outline-purple font-weight-bold pl-5 pr-5"
                            onclick="window.location='{{ url('/pengelola/produk/tambah') }}'"
                            style="border-radius:30px;">Tambah Produk</button>
                        </div>
        
                        <div class="container my-custom-scrollbar mb-5">
                            <div class="row justify-content-between">
                                
                                {{-- @foreach ($collection as $item) --}}
                                    <div class="col-6">
                                        @include('card_produk_pengelola')
                                    </div>
                                {{-- @endforeach --}}
                                
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-promo" role="tabpanel">
                        <div class="mb-4">
                            <button type="button" class="btn btn-outline-purple font-weight-bold pl-5 pr-5" 
                            onclick="window.location='{{ url('pengelola/promo/tambah') }}'"
                            style="border-radius:30px; margin-right:-10px;">Tambah Promo</button>
                        </div>
        
                        <div class="table-scrollbar mb-5 ml-0 pr-2">
                            <table class="table table-hover">
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

                                    {{-- @foreach ($collection as $item) --}}
                                        <tr>
                                            {{-- @foreach ($collection as $item) --}}
                                                <td scope="row">1</td>
                                                <td>Cetak Hitam Putih Dokumen</td>
                                                <td>10%</td>
                                                <td>Rp. 2.000</td>
                                                <td>5/7/2020</td>
                                                <td>
                                                    <a href="{{url('pengelola/promo/tambah')}}" style="margin-left: -50px;"><i class="material-icons">edit</i></a>
                                                    <i class="material-icons" style="color: #FF4949;">delete</i>
                                                </td>
                                            {{-- @endforeach --}}
                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-atk" role="tabpanel">
                        <div class="mb-4">
                            <button type="button" class="btn btn-outline-purple font-weight-bold pl-5 pr-5" 
                            onclick="window.location='{{ url('pengelola/atk/tambah') }}'"
                            style="border-radius:30px; margin-right:-10px;">Tambah ATK</button>
                        </div>
        
                        <div class="table-scrollbar mb-5 ml-0 pr-2">
                            <table class="table table-hover">
                                <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                    <tr>
                                        <th class="align-middle" scope="col">No</th>
                                        <th class="align-middle" scope="col">Nama ATK</th>
                                        <th class="align-middle" scope="col">Harga</th>
                                        <th class="align-middle" scope="col">Jumlah</th>
                                        <th class="align-middle" scope="col" style="width:2%"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($collection as $item) --}}
                                        <tr onclick="window.location='{{ url('/pengelola/atk/tambah') }}'">

                                            {{-- @foreach ($collection as $item) --}}
                                                <td scope="row">1</td>
                                                <td>Pensil</td>
                                                <td>Rp. 2.000</td>
                                                <td>40</td>
                                                <td class="text-right">
                                                    <a href="{{url('pengelola/atk/tambah')}}" style="margin-left: -50px;"><i class="material-icons">edit</i></a>
                                                    <i class="material-icons" style="color: red;">delete</i>
                                                </td>
                                            {{-- @endforeach --}}
                                            
                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-info" role="tabpanel">
                        <div class="row justify-content-between mb-4">
                            <h1 class="col text-lg text-primary-purple font-weight-bold mb-4 ml-0">WAKPRINT</h1>
                            <div class="col text-right">
                                <a href="{{url('www.wakprint.com')}}"><i class="material-icons md-48 align-middle" style="color: #C4C4C4">help</i></a>
                            </div>
        
                            <div class="col mt-1">
                                <button type="button" class="col btn btn-danger bg-primary-danger font-weight-bold pl-4 pr-4" style="border-radius:30px;">Laporkan</button>
                            </div>
                        </div>
        
                        <h4 class="font-weight-bold mb-4 ml-0">Wakprint - Web Versi 1.0</h4>
                        <p class="mb-4 ml-0">Wakprint adalah platform yang menghubungkan semua printer di seluruh Indonesia secara online untuk menjawab kebutuhan pencetakan dokumen Anda. Ribuan printer yang telah menjadi rekanan Wakprint, dapat diakses oleh Anda dengan mudah. Kirimkan dokumen dan ambil serta bayar dokumen anda langsung ke rekanan kami. Sekarang, mencetak dokumen dapat dilakukan di mana pun dengan
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
        

    </div>
@endsection
