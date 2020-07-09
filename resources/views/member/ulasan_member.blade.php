<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container">
                
        <div class="row" style="margin-top:72px">
            <div class="container col-4 mt-5 ml-0">
                <div class="container bg-light-purple text-center" style="border-radius:0px 25px 25px 0px; position: relative;">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" 
                        class="img-responsive justify-content-center align-self-center center-block" 
                        alt="" 
                        width="172px" 
                        height="194px"
                        style="border-radius:8px 8px 8px 8px;">

                        <div class="container bg-dark" style="position: absolute; 
                        top: 50%; 
                        left: 50%; 
                        transform: translate(-50%, 247%); opacity:80%;
                        color: white;
                        width:174px;
                        border-radius:0px 0px 8px 8px;">
                            <p class="font-weight-bold mb-1">Raditya Dika</p>
                        </div>
                </div>

                <div class="mt-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="v-pills-alamat-tab" onclick="window.location='{{ url('/member/alamat') }}'" data-toggle="pill" href="#v-pills-alamat" role="tab" aria-controls="v-pills-alamat" aria-selected="true"><i class="material-icons align-middle md-32 mr-2">location_on</i>Medan ID</a>
                        
                        <div class="mt-3">
                            <a class="nav-link font-weight-bold mb-2" id="v-pills-saldo-tab" onclick="window.location='{{ url('/member/saldo/topup') }}'" data-toggle="pill" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="false"><i class="material-icons align-middle md-32 mr-2">account_balance_wallet</i>Rp. 12.000</a>
                            <a class="nav-link" id="v-pills-riwayat-tab" onclick="window.location='{{ url('/member/riwayat') }}'" data-toggle="pill" href="#v-pills-riwayat" role="tab" aria-controls="v-pills-riwayat" aria-selected="false"><i class="material-icons align-middle md-32 mr-2">history</i>Riwayat Transaksi</a>
                        </div>

                        <div class="mt-3">
                            <a class="nav-link mb-2" onclick="window.location='{{ url('/member/konfigurasi-pesanan') }}'" id="v-pills-konfigurasi-tab" data-toggle="pill" href="#v-pills-konfigurasi" role="tab" aria-controls="v-pills-konfigurasi" aria-selected="false"><i class="material-icons align-middle md-32 mr-2">phonelink_setup</i>Konfigurasi File</a>
                            <a class="nav-link" id="v-pills-pesanan-tab" onclick="window.location='{{ url('/member/pesanan') }}'" data-toggle="pill" href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan" aria-selected="false"><i class="material-icons align-middle md-32 mr-2">shopping_cart</i>Pesanan</a>
                        </div>

                        <div class="mt-3 mb-3">
                            <a class="nav-link mb-2" id="v-pills-favorit-tab" onclick="window.location='{{ url('/member/favorit') }}'" data-toggle="pill" href="#v-pills-favorit" role="tab" aria-controls="v-pills-favorit" aria-selected="false"><i class="material-icons align-middle md-32 mr-2">favorite</i>Favorit</a>
                            <a class="nav-link active" id="v-pills-ulasan-tab" onclick="window.location='{{ url('/member/ulasan') }}'" data-toggle="pill" href="#v-pills-ulasan" role="tab" aria-controls="v-pills-ulasan" aria-selected="false"><i class="material-icons align-middle md-32 mr-2">rate_review</i>Ulasan</a>
                        </div>

                        <a class="nav-link" onclick="window.location='{{ url('/index') }}'" id="v-pills-keluar-tab" data-toggle="pill" href="#v-pills-keluar" role="tab" aria-controls="v-pills-keluar" aria-selected="true"><i class="material-icons align-middle md-32 mr-2">exit_to_app</i>Keluar</a>
                    </div>
                </div>
            </div>

            <div class="container-fluid col-8 mt-5">
                <h1 class="font-weight-bold mb-5 ml-2">Ulasan</h1>
                <div class="container ml-0 mb-4">
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Untuk Diulas (3)
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Sudah Diulas</a>
                                <a class="dropdown-item" href="#">Tidak Diulas</a>
                        </div>
                    </div>
                </div>
                <div class="container my-custom-scrollbar">
                    <div class="card shadow-sm mb-3 pl-2 pr-2">
                        <div class="row no-gutters">
                            <div class="container text-center align-self-center col-md-2">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="80" height="80" alt="no logo">
                            </div>

                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-1">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-text text-truncate mb-2">Toko Uwak</p>
                                    <div class="row">
                                        <div class="container mt-1 col-md-9">
                                            <p class="card-text"><small class="text-muted">Dipesan pada: &nbsp;&nbsp;&nbsp;&nbsp;21 Februari 2020&nbsp;&nbsp;&nbsp;&nbsp;20:35 WIB</small></p>
                                        </div>
                                        <div class="container text-right col-md-3">
                                            <button type="button" class="btn btn-primary-wakprint btn-rounded
                                            ml-1 pt-1 pb-1 pl-4 pr-4
                                            font-weight-bold text-center"
                                            onclick="window.location='{{ url('/member/ulas') }}'"
                                            style="border-radius:30px">Ulas</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card shadow-sm mb-3 pl-2 pr-2">
                        <div class="row no-gutters">
                            <div class="container text-center align-self-center col-md-2">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="80" height="80" alt="no logo">
                            </div>

                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-1">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-text text-truncate mb-2">Toko Uwak</p>
                                    <div class="row">
                                        <div class="container mt-1 col-md-9">
                                            <p class="card-text"><small class="text-muted">Dipesan pada: &nbsp;&nbsp;&nbsp;&nbsp;21 Februari 2020&nbsp;&nbsp;&nbsp;&nbsp;20:35 WIB</small></p>
                                        </div>
                                        <div class="container text-right col-md-3">
                                            <button type="button" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">Ulas</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card shadow-sm mb-3 pl-2 pr-2">
                        <div class="row no-gutters">
                            <div class="container text-center align-self-center col-md-2">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="80" height="80" alt="no logo">
                            </div>

                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-1">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-text text-truncate mb-2">Toko Uwak</p>
                                    <div class="row">
                                        <div class="container mt-1 col-md-9">
                                            <p class="card-text"><small class="text-muted">Dipesan pada: &nbsp;&nbsp;&nbsp;&nbsp;21 Februari 2020&nbsp;&nbsp;&nbsp;&nbsp;20:35 WIB</small></p>
                                        </div>
                                        <div class="container text-right col-md-3">
                                            <button type="button" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">Ulas</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-3 pl-2 pr-2">
                        <div class="row no-gutters">
                            <div class="container text-center align-self-center col-md-2">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="80" height="80" alt="no logo">
                            </div>

                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-1">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-text text-truncate mb-2">Toko Uwak</p>
                                    <div class="row">
                                        <div class="container mt-1 col-md-9">
                                            <p class="card-text"><small class="text-muted">Dipesan pada: &nbsp;&nbsp;&nbsp;&nbsp;21 Februari 2020&nbsp;&nbsp;&nbsp;&nbsp;20:35 WIB</small></p>
                                        </div>
                                        <div class="container text-right col-md-3">
                                            <button type="button" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">Ulas</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-3 pl-2 pr-2">
                        <div class="row no-gutters">
                            <div class="container text-center align-self-center col-md-2">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="80" height="80" alt="no logo">
                            </div>

                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-1">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-text text-truncate mb-2">Toko Uwak</p>
                                    <div class="row">
                                        <div class="container mt-1 col-md-9">
                                            <p class="card-text"><small class="text-muted">Dipesan pada: &nbsp;&nbsp;&nbsp;&nbsp;21 Februari 2020&nbsp;&nbsp;&nbsp;&nbsp;20:35 WIB</small></p>
                                        </div>
                                        <div class="container text-right col-md-3">
                                            <button type="button" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">Ulas</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-3 pl-2 pr-2">
                        <div class="row no-gutters">
                            <div class="container text-center align-self-center col-md-2">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="80" height="80" alt="no logo">
                            </div>

                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate font-weight-bold mb-1">Cetak Hitam Putih Dokumen</h5>
                                    <p class="card-text text-truncate mb-2">Toko Uwak</p>
                                    <div class="row">
                                        <div class="container mt-1 col-md-9">
                                            <p class="card-text"><small class="text-muted">Dipesan pada: &nbsp;&nbsp;&nbsp;&nbsp;21 Februari 2020&nbsp;&nbsp;&nbsp;&nbsp;20:35 WIB</small></p>
                                        </div>
                                        <div class="container text-right col-md-3">
                                            <button type="button" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">Ulas</button>
                                        </div>
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

@section('footer')
        <footer>
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-3">
                            <h4 id="judulLogoWakprint" class="font-weight-bold">WAKPRINT</h4>
                    </div>

                    <div class="col-3">
                            <h4 class="mb-4 font-weight-bold">Kontak</h4>
                            <p class="mb-2">+6281263638</p>
                            <p class="mb-2">dev@wakprint.com</p>
                                    
                    </div>

                    <div class="col-3">
                            <h4 class="mb-4 font-weight-bold">Informasi Umum</h4>
                            <p class="mb-2"><a class="text-dark" href="">Tentang Kami</a></p>
                            <p><a class="text-dark" href="#">Kebijakan Privasi</a></p>
                            <p><a class="text-dark" href="#">Syarat & Ketentuan</a></p>
                            <p><a class="text-dark" href="{{ url('/member/faq') }}">FAQ</a></p>
                    </div>

                    <div class="col-md-3">
                            <h4 class="font-weight-bold mb-3">Sosial Media</h4>
                            <div class="row justify-content-left mb-4">
                                <img src="{{url('instagram.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('facebook.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('youtube.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('whatsapp.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                            </div>
                            <div class="" style="margin-left:-0px; margin-top:-10px">
                                <p>
                                    <i class="fa fa-copyright"> Copyright Wakprint 2020</i>
                                </p>
                            </div>
                    </div>
                </div>
            </div>
        </footer>
@endsection