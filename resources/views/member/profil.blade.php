<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid" style="margin-top:72px">
        <div class="container">
            <div class="row">
                <div class="container col-4 mt-5 ml-0">
                    <div class="container bg-light-purple text-center"
                        style="border-radius:0px 25px 25px 0px; position: relative;">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                            class="img-responsive justify-content-center align-self-center center-block" alt=""
                            width="172px" height="194px" style="border-radius:8px 8px 8px 8px;">

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
                            <a class="nav-link" id="v-pills-alamat-tab"
                                onclick="window.location='{{ url('/member/alamat') }}'"
                                data-toggle="pill" href="#v-pills-alamat" role="tab" aria-controls="v-pills-alamat"
                                aria-selected="true"><i class="material-icons align-middle md-32 mr-2">location_on</i>Medan
                                ID</a>

                            <a class="nav-link font-weight-bold mb-2 mt-3" id="v-pills-saldo-tab" data-toggle="pill"
                                href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">account_balance_wallet</i>Rp. 12.000</a>
                            <a class="nav-link" id="v-pills-riwayat-tab mb-3" data-toggle="pill" href="#v-pills-riwayat"
                                role="tab" aria-controls="v-pills-riwayat" aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">history</i>Riwayat Transaksi</a>

                            <a class="nav-link mb-2 mt-3"
                                onclick="window.location='{{ url('/member/konfigurasi-pesanan') }}'"
                                id="v-pills-konfigurasi-tab" data-toggle="pill" href="#v-pills-konfigurasi" role="tab"
                                aria-controls="v-pills-konfigurasi" aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">phonelink_setup</i>Konfigurasi File</a>
                            <a class="nav-link mb-2" id="v-pills-pesanan-tab" data-toggle="pill" href="#v-pills-pesanan"
                                role="tab" aria-controls="v-pills-pesanan" aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">shopping_cart</i>Pesanan</a>

                            <a class="nav-link mb-2 mt-3" id="v-pills-favorit-tab" data-toggle="pill"
                                href="#v-pills-favorit" role="tab" aria-controls="v-pills-favorit" aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">favorite</i>Favorit</a>
                            <a class="nav-link mb-2" id="v-pills-ulasan-tab" data-toggle="pill" href="#v-pills-ulasan"
                                role="tab" aria-controls="v-pills-ulasan" aria-selected="false"><i
                                    class="material-icons align-middle md-32 mr-2">rate_review</i>Ulasan</a>

                            <a class="nav-link" onclick="window.location='{{ url('/index') }}'"
                                id="v-pills-keluar-tab" data-toggle="pill" href="#v-pills-keluar" role="tab"
                                aria-controls="v-pills-keluar" aria-selected="true"><i
                                    class="material-icons align-middle md-32 mr-2">exit_to_app</i>Keluar</a>

                        </div>
                    </div>

                </div>

                <div class="tab-content col-8 mt-5 ml-0">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="row justify-content-between mb-2 ml-0 mr-0">
                            <div class="col">
                                <h1 class="font-weight-bold">Profil Saya</h1>
                            </div>

                            <div class="col-auto">
                                <p class="align-middle text-right"><a class="text-primary-purple"
                                        href="{{ url('member/profil/edit') }}">Ubah Profil</a></p>
                            </div>
                        </div>

                        <div class="row mb-5 ml-0">
                            <div class="container col-3">
                                <p class="font-weight-bold mb-1">Nama Lengkap</p>
                                <p class="font-weight-bold mb-1">Tanggal Lahir</p>
                                <p class="font-weight-bold mb-1">Jenis Kelamin</p>
                                <p class="font-weight-bold mb-1">Email</p>
                                <p class="font-weight-bold mb-1">Nomor HP</p>
                            </div>
                            <div class="container col-9">

                                {{-- @foreach ($collection as $item) --}}
                                <p class="mb-1">Raditya Dika</p>
                                <p class="mb-1">21 Februari 1997</p>
                                <p class="mb-1">Laki-Laki</p>
                                <p class="mb-1"><a class="text-danger" href="#">radit@gmail.com <i
                                            class="fa fa-warning ml-2"></i></a></p>
                                <p class="mb-1">+628126754899</p>
                                {{-- @endforeach --}}

                            </div>
                        </div>

                        <h1 class="font-weight-bold mb-5 ml-2">Konfigurasi Terakhir</h1>

                        <div class="table-scrollbar mb-5 mr-0">
                            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                                <thead class="bg-primary-purple text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Kapan</th>
                                        <th scope="col">Biaya</th>
                                        <th scope="col">Sisa Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($collection as $item) --}}
                                    <tr>

                                        {{-- @foreach ($collection as $item) --}}
                                        <td scope="row">00000001</td>
                                        <td><a href="#">Skripsilageee.pdf</a></td>
                                        <td>5 hour ago</td>
                                        <td>Rp. 12.000</td>
                                        <td>1h 5m <span
                                                class="material-icons md-18 align-middle text-danger ml-2">delete</span>
                                        </td>
                                        {{-- @endforeach --}}

                                    </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-saldo" role="tabpanel">

                        <h1 class="font-weight-bold mb-5 ml-1">Top Up Saldo</h1>
                        <div class="container bg-primary-yellow p-4 ml-1 mb-5" style="border-radius:5px;">

                            <label class="mb-2">Masukkan Nominal</label>

                            <div class="input-group mb-4">
                                <input type="text" class="form-control form-control-lg form-control-yellow pt-2 pb-2"
                                    placeholder="Contoh : 1.000.000" aria-label="Contoh : 1.000.000"
                                    aria-describedby="inputGroup-sizing-sm"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>

                            <div class="container pl-0 pr-0 mb-4">
                                <button type="button" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
                                    style="border-radius:30px"><i class="material-icons md-36 align-middle mr-3">upgrade</i>
                                    Top Up</button>
                            </div>

                        </div>

                        <h1 class="font-weight-bold mb-5 ml-1">Transaksi Terakhir Kamu</h1>

                        <div class="table-scrollbar pr-3 mb-5 ml-1">
                            <table class="table table-hover">
                                <thead class="bg-primary-purple text-white " style="border-radius:25px 25px 15px 15px;">
                                    <tr>
                                        <td class="align-middle" scope="col">ID</td>
                                        <th class="align-middle" scope="col">Jenis Transaksi</th>
                                        <th class="align-middle" scope="col">Biaya</th>
                                        <th class="align-middle" scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($collection as $item) --}}
                                    <tr>

                                        {{-- @foreach ($collection as $item) --}}
                                        <td class="align-middle" scope="row">00000001</td>
                                        <td class="align-middle">Saldo Keluar</td>
                                        <td class="align-middle">Rp. 12.000</td>
                                        <td class="align-middle">Cetak Hitam Putih Toko Uwak</td>
                                        {{-- @endforeach --}}

                                    </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="v-pills-riwayat" role="tabpanel">
                        <h1 class="font-weight-bold mb-5 ml-1">Riwayat Transaksi Saya</h1>
                        <div class="container ml-0 mb-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Semua
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Terbaru</a>
                                    <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                    <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-scrollbar mb-5 ml-1">
                            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                                <thead class="bg-primary-purple text-white">
                                    <tr>
                                        <th class="align-middle" scope="col">ID</th>
                                        <th class="align-middle" scope="col">Jenis Transaksi</th>
                                        <th class="align-middle" scope="col">Kapan</th>
                                        <th class="align-middle" scope="col">Biaya</th>
                                        <th class="align-middle" scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($collection as $item) --}}
                                    <tr>

                                        {{-- @foreach ($collection as $item) --}}
                                        <td class="align-middle" scope="row">00000001</td>
                                        <td class="align-middle">Saldo Keluar</td>
                                        <td class="align-middle">5 hour ago</td>
                                        <td class="align-middle">Rp. 12.000</td>
                                        <td class="align-middle">Cetak Hitam Putih Toko Uwak</td>
                                        {{-- @endforeach --}}

                                    </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-pesanan" role="tabpanel">
                        <h1 class="font-weight-bold mb-5 ml-1">Pesanan Saya</h1>
                        <div class="row mb-3 ml-0">
                            <div class="col-3">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Semua
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Terbaru</a>
                                        <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                        <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="input-group mb-3" role="search">
                                    <input type="text" class="form-control form-control-lg shadow-sm"
                                        placeholder="Cari percetakan atau produk disini" style="border-radius:30px;">
                                    <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                                        style="position: absolute;
                                        top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                        search
                                    </i>
                                </div>
                            </div>
                        </div>

                        <div class="table-scrollbar mb-5 ml-0 pr-2">
                            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                                <thead class="bg-primary-purple text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Metode</th>
                                        <th scope="col">Biaya</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($collection as $item) --}}
                                    <tr>

                                        {{-- @foreach ($collection as $item) --}}
                                        <td scope="row">00000001</td>
                                        <td>5 hour ago</td>
                                        <td>10 file</td>
                                        <td>Ambil di Tempat</td>
                                        <td>Rp. 12.000</td>
                                        <td>Diproses</td>
                                        {{-- @endforeach --}}

                                    </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-favorit" role="tabpanel">
                        <h1 class="font-weight-bold mb-5 ml-1">Produk Favorit</h1>
                        <div class="my-custom-scrollbar">
                            <div class="row justify-content-between">

                                {{-- @foreach ($collection as $item) --}}
                                <div class="col-6 mb-4">
                                    <div class="col mb-4">
                                        @include('card_produk')
                                    </div>
                                </div>
                                {{-- @endforeach --}}

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-ulasan" role="tabpanel">
                        <h1 class="font-weight-bold mb-5 ml-2">Ulasan</h1>
                        <div class="container ml-0 mb-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Untuk Diulas (3)
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Sudah Diulas</a>
                                    <a class="dropdown-item" href="#">Tidak Diulas</a>
                                </div>
                            </div>
                        </div>
                        <div class="container my-custom-scrollbar">

                            {{-- @foreach ($collection as $item) --}}
                            @include('card_ulasan_member')
                            {{-- @endforeach --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection
