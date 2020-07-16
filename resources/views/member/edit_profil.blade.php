<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container">

        <div class="row" style="margin-top:72px">
            <div class="container col-4 mt-5 ml-0">
                <div class="container bg-light-purple text-center"
                    style="border-radius:0px 25px 25px 0px; position: relative;">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                        class="img-responsive justify-content-center align-self-center center-block" alt="" width="172px"
                        height="194px" style="border-radius:8px 8px 8px 8px;">

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
                        <a class="nav-link" onclick="window.location='{{ url('/member/alamat') }}'"
                            id="v-pills-alamat-tab" data-toggle="pill" role="tab" aria-controls="v-pills-alamat"
                            aria-selected="true"><i class="material-icons align-middle md-32 mr-2">location_on</i>Medan
                            ID</a>

                        <div class="mt-3">
                            <a class="nav-link font-weight-bold mb-2" id="v-pills-saldo-tab"
                                onclick="window.location='{{ url('/member/saldo/topup') }}'"
                                data-toggle="pill" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo"
                                aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">account_balance_wallet</i>Rp. 12.000</a>
                            <a class="nav-link" id="v-pills-riwayat-tab"
                                onclick="window.location='{{ url('/member/riwayat') }}'"
                                data-toggle="pill" href="#v-pills-riwayat" role="tab" aria-controls="v-pills-riwayat"
                                aria-selected="false"><i class="material-icons align-middle md-32 mr-2">history</i>Riwayat
                                Transaksi</a>
                        </div>

                        <div class="mt-3">
                            <a class="nav-link mb-2"
                                onclick="window.location='{{ url('/member/konfigurasi-pesanan') }}'"
                                id="v-pills-konfigurasi-tab" data-toggle="pill" href="#v-pills-konfigurasi" role="tab"
                                aria-controls="v-pills-konfigurasi" aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">phonelink_setup</i>Konfigurasi File</a>
                            <a class="nav-link" id="v-pills-pesanan-tab"
                                onclick="window.location='{{ url('/member/pesanan') }}'"
                                data-toggle="pill" href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan"
                                aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">shopping_cart</i>Pesanan</a>
                        </div>

                        <div class="mt-3 mb-3">
                            <a class="nav-link mb-2" id="v-pills-favorit-tab"
                                onclick="window.location='{{ url('/member/favorit') }}'"
                                data-toggle="pill" href="#v-pills-favorit" role="tab" aria-controls="v-pills-favorit"
                                aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">favorite</i>Favorit</a>
                            <a class="nav-link" id="v-pills-ulasan-tab"
                                onclick="window.location='{{ url('/member/ulasan') }}'"
                                data-toggle="pill" href="#v-pills-ulasan" role="tab" aria-controls="v-pills-ulasan"
                                aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">rate_review</i>Ulasan</a>
                        </div>

                        <a class="nav-link" onclick="window.location='{{ url('/index') }}'"
                            id="v-pills-keluar-tab" data-toggle="pill" href="#v-pills-keluar" role="tab"
                            aria-controls="v-pills-keluar" aria-selected="true"><i
                                class="material-icons align-middle md-32 mr-2">exit_to_app</i>Keluar</a>

                    </div>
                </div>

            </div>

            <div class="container-fluid col-md-8 mt-5">
                <div class="container-fluid mb-4 ml-1">
                    <h1 class="font-weight-bold mb-0" style="margin-left: -5px;">Ubah Profil</h1>
                    <small>
                        <p class="">Kelola informasi pribadi kamu untuk mengobrol, melindungi, dan mengamankan akun</p>
                    </small>
                </div>

                <div class="container mb-4 ml-1" style="position: relative; 
                        width: 100%;">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                        class="img-responsive shadow-sm justify-content-center align-self-center center-block" alt=""
                        width="72px" height="72px" style="border-radius:8px 8px 8px 8px;">

                    <div class="container" style="position: absolute; 
                                top: 40%; left: 50%; 
                                transform: translate(-44%, 50%); 
                                opacity:90%;
                                color: #BC41BE;">
                        <i class="bg-light-purple material-icons" style="border-radius: 3px;">edit</i>
                    </div>
                </div>

                <div class="container ml-1">
                    <h4 class="font-weight-bold mb-1">Biodata Diri</h4>
                    <label class="mb-2">Nama Lengkap</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap"
                            aria-label="Masukkan Nama Lengkap" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <label class="mb-2">Tanggal Lahir</label>
                    <div class="row mb-3" style="margin-left:-25px">
                        <div class="container col-md-2">
                            <div class="dropdown" style="padding-left:10px;">
                                <button class="btn btn-default dropdown-toggle border border-gray" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Tanggal
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">1</a>
                                    <a class="dropdown-item" href="#">2</a>
                                    <a class="dropdown-item" href="#">3</a>
                                </div>
                            </div>
                        </div>

                        <div class="container text-center col-md-3">
                            <div class="dropdown" style="">
                                <button class="btn btn-default dropdown-toggle border border-gray" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Bulan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Januari</a>
                                    <a class="dropdown-item" href="#">Februari</a>
                                    <a class="dropdown-item" href="#">Maret</a>
                                </div>
                            </div>
                        </div>

                        <div class="container col-md-7">
                            <div class="dropdown" style="margin-left:-20px;">
                                <button class="btn btn-default dropdown-toggle border border-gray" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Tahun
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">2000</a>
                                    <a class="dropdown-item" href="#">2001</a>
                                    <a class="dropdown-item" href="#">2002</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <label class="mb-2">Jenis Kelamin</label>
                    <div class="row mb-4 ml-0" style="margin-left:-25px">
                        <div class="container custom-control custom-radio col-md-3">
                            <input id="rbLK" name="radio" class="custom-control-input" type="radio">
                            <label class="custom-control-label" for="rbLK">Laki-Laki</label>
                        </div>

                        <div class="container custom-control custom-radio col-md-9">
                            <input id="rbPR" name="radio" class="custom-control-input" type="radio">
                            <label class="custom-control-label" for="rbPR">Perempuan</label>
                        </div>
                    </div>

                    <h4 class="font-weight-bold mb-1">Password</h4>
                    <label class="mb-2">Password Lama</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control pt-2 pb-2" placeholder="Masukkan Kata Sandi Lama"
                            aria-label="Masukkan Kata Sandi Lama" aria-describedby="inputGroup-sizing-sm">
                        <span class="input-group-text bg-white" style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field"
                                class="fa fa-fw fa-eye field_icon toggle-password"></i>
                        </span>
                    </div>

                    <label class="mb-2">Password Baru</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control pt-2 pb-2" placeholder="Masukkan Kata Sandi Baru"
                            aria-label="Masukkan Kata Sandi Baru" aria-describedby="inputGroup-sizing-sm">
                        <span class="input-group-text bg-white" style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field"
                                class="fa fa-fw fa-eye field_icon toggle-password"></i>
                        </span>
                    </div>

                    <label class="mb-2">Konfirmasi Password Baru</label>
                    <div class="input-group mb-5">
                        <input type="password" class="form-control pt-2 pb-2" placeholder="Konfirmasi Kata Sandi Baru"
                            aria-label="Konfirmasi Kata Sandi Baru" aria-describedby="inputGroup-sizing-sm">
                        <span class="input-group-text bg-white" style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field"
                                class="fa fa-fw fa-eye field_icon toggle-password"></i>
                        </span>
                    </div>

                    <div class="container mb-5" style="margin-left:-15px">
                        <button type="button" class="btn btn-primary-yellow shadow-sm btn-md font-weight-bold mb-4"
                            onclick="window.location='{{ url('/member/profil') }}'"
                            style="border-radius:30px">Simpan Perubahan</button>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('footer')
    @include('member.footer_member')
@endsection
