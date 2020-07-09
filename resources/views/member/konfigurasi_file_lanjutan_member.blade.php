<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container">
        <div class="container mb-5" style="margin-top:120px;">

            <h1 class="font-weight-bold" style="margin-top:120px; margin-left:-15px">Konfigurasi File</h1>

            <div class="row justify-content-between mb-5">
                <div class="container col mt-5 mr-4" style="margin-left:-15px;">
                    <div class="container border-primary-purple pl-2 pr-4 pt-4 pb-1 mb-4" style="height:500px;">
                        <div class="row bg-dark justify-content-between align-bottom p-4" style="margin-top:401px;
                            margin-left:-8px;
                            margin-right:-25px;
                            opacity:80%;
                            border-radius: 0px 0px 5px  5px;
                            ">
                            <h4 class="col font-weight-bold text-white" style="margin-left:-10px; margin-bottom:-5px;">Hitam
                                Putih</h4>
                            <h4 class="col text-right font-weight-bold text-white"
                                style="margin-left:-10px; margin-bottom:-5px;">
                                <i class="fa fa-chevron-left text-white mr-2"></i>
                                12 / 16
                                <i class="fa fa-chevron-right ml-2"></i>
                            </h4>
                        </div>
                    </div>

                </div>

                <div class="container col mt-5" style="margin-left:-20px;">
                    <div class="container bg-light-purple pl-3 pr-3 pt-0 pb-0 mb-4" style="border-radius:5px;">
                        <div class="row justify-content-between">
                            <div class="container text-center align-self-center col-2 mr-0">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                                    width="48" height="48" alt="no logo">
                            </div>

                            <div class="col-10">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container col-9" style="margin-left:-30px;">
                                            <h5 class="card-title text-truncate mb-0"><a href="#">Skripsilagee.pdf</a></h5>
                                            <label class="card-text"><small class="text-muted">16 Halaman</small></label>
                                        </div>
                                        <div class="container align-self-center text-right col-2 mr-5">
                                            <button type="button"
                                                class="btn btn-primary-yellow btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center"
                                                style="border-radius:30px">
                                                Ubah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-7">
                            <label class="mb-0">16 Halaman Hitam Putih</label><br>
                            <label class="mb-2">6 Halaman Berwarna</label><br>
                            <label class="mb-0"><small class="text-muted">*Hitam Putih Rp. 2K / lembar</small></label><br>
                            <label class="mb-4"><small class="text-muted">*Berwarna Rp. 3K / lembar</small></label>

                            <h4 class="card-title font-weight-bold mb-3">Pilih Halaman</h4>
                            <div class="container custom-control custom-radio mb-4">
                                <input id="rbSemuaHal" name="radio" class="custom-control-input" type="radio">
                                <label class="custom-control-label" for="rbSemuaHal">Semua</label>
                            </div>

                            <div class="container custom-control custom-radio mb-4">
                                <input id="rbSampaiHal" name="radio" class="custom-control-input" type="radio">
                                <label class="custom-control-label" for="rbSampaiHal">
                                    <input type="text mr-4" class="form-input" style="width:48px;">
                                    Sampai</label>
                                <input type="text mr-4" class="form-input" style="width:48px;">
                            </div>

                            <div class="container custom-control custom-radio mb-4">
                                <input id="rbKustomHal" name="radio" class="custom-control-input" type="radio">
                                <label class="custom-control-label" for="rbKustomHal">Kustom</label><br>
                                <input type="text mr-4" class="form-input">
                            </div>
                        </div>

                        <div class="col-5">
                            <h4 class="card-title font-weight-bold mb-4">Jumlah Salinan</h4>
                            <div class="form-group" style="margin-bottom:40px;">

                                <label class="label"><i class="fa fa-minus ml-2 mr-2"></i></label>

                                <input type="text" class="form-input" style="width:48px;">

                                <label class="label"><i class="fa fa-plus ml-2 mr-2"></i></label>

                            </div>

                            <h4 class="card-title font-weight-bold mb-2">Cetak</h4>
                            <div class="custom-control custom-checkbox mt-2 ml-0">
                                <input type="checkbox" class="custom-control-input" id="checkboxTimbalBalik">
                                <label class="custom-control-label" for="checkboxTimbalBalik">Timbal Balik</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-2 ml-0">
                                <input type="checkbox" class="custom-control-input" id="checkboxPaksaHitamPutih">
                                <label class="custom-control-label" for="checkboxPaksaHitamPutih">Paksa Hitam Putih</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-left mb-3" style="margin-left:-30px;">
                <div class="container col">
                    <div class="input-group mb-3" role="search">
                        <input type="text" class="form-control form-control-lg pl-4 pr-4"
                            placeholder="Cari percetakan atau produk disini" style="border-radius:30px;">
                        <i class="material-icons md-32 ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute;
                                    top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            search
                        </i>
                    </div>
                </div>
                <div class="container col-auto" style="margin-left:-10px;">
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Urutkan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Terbaru</a>
                            <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                            <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                        </div>
                    </div>
                </div>
                <div class="container col-auto" style="margin-left:-10px;">
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Printer
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            {{-- @foreach ($collection as $item) --}}
                            <a class="dropdown-item" href="#">Ink Jet</a>
                            {{-- @endforeach --}}

                        </div>
                    </div>
                </div>
                <div class="container col-auto" style="margin-left:-10px;">
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kertas
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            {{-- @foreach ($collection as $item) --}}
                            <a class="dropdown-item" href="#">A4</a>
                            {{-- @endforeach --}}

                        </div>
                    </div>
                </div>
            </div>

            <div class="container bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4" style="border-radius:5px;">
                <label class="font-weight-bold mb-3 ml-0">Paket</label><br>
                <div class="container">

                    {{-- @foreach ($collection as $item) --}}
                    <label class="font-weight-bold mb-3 ml-0">Jilid</label>
                    <div class="row justify-content-left" style="margin-left:-5px; margin-top:-15px;">

                        {{-- @foreach ($collection as $item) --}}
                        <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                            <input type="checkbox" class="custom-control-input" id="checkboxJilid">
                            <label class="custom-control-label" for="checkboxJilid">Jilid <i
                                    class="material-icons md-18 align-middle ml-2">help</i></label>
                        </div>
                        {{-- @endforeach --}}

                    </div>
                    {{-- @endforeach --}}

                </div>

                <label class="font-weight-bold mt-3 mb-3 ml-0">Non-Paket</label>
                <div class="row justify-content-left" style="margin-left:-5px; margin-top:-15px;">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                        <input type="checkbox" class="custom-control-input" id="checkboxLakban">
                        <label class="custom-control-label" for="checkboxLakban">Jilid Lakban <i
                                class="material-icons md-18 align-middle ml-2">help</i></label>
                    </div>
                    {{-- @endforeach --}}

                </div>

            </div>

            <div class="container border-primary-purple my-custom-scrollbar-2 p-5 mb-5" style="border-radius:5px;">
                <div class="card shadow mt-0 ml-0 mb-4 p-4">
                    <div class="row justify-content-between">
                        <div class="col-8">
                            <h1 class="text-truncate-multiline font-weight-bold">Percetakan IMAHA Productions
                                asdsadsdsadasadsadadsdsasadsaddaasd</h1>
                            <h4 class="text-truncate-multiline mb-4" style="margin-left:5px;">
                                Jalan Seksama No 95A Medan Denai, Medan, Sumatera Utara asdssdadsadadsaasdasasadadsad
                            </h4>

                            <div class="row justify-content-left mb-4" style="margin-left:5px;">

                                {{-- @foreach ($collection as $item) --}}
                                <label class="mr-4"><i class="align-middle material-icons mr-1">directions_run</i>Ambil di
                                    Tempat</label>
                                <label class="mr-4"><i class="align-middle material-icons mr-1">local_shipping</i>Antar ke
                                    Rumah</label>
                                <label class=""><i class="align-middle material-icons mr-1">architecture</i>Alat Tulis
                                    Kantor</label>
                                {{-- @endforeach --}}

                            </div>
                        </div>
                        <div class="col-auto mt-2">
                            <div class="row justify-content-right">
                                <i class="text-right material-icons md-36 mr-2" style="margin-left:20px;">location_on</i>
                                <i class="text-right material-icons md-36 mr-5" style="margin-left:20px;">favorite</i>
                                <i class="text-right material-icons md-36 mr-4" style="margin-left:20px;">close</i>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="container col-6">
                            <div class="container mb-4" style="margin-left:0px; position:relative;">
                                <img class="img-responsive"
                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt=""
                                    style="width:420px;">
                                <h5 class="text-truncate font-weight-bold" style="position: absolute; top: 10%; left: 16%;
                                        width: 300px;
                                        height: 100%;
                                        color: black;
                                        display:flex;
                                        justify-content: top;
                                        flex-direction: column;
                                        text-align: center;">
                                    Cetak Dokumen Hitam Putih
                                </h5>
                            </div>

                            <div class="row justify-content-center mb-5" style="margin-left:0px;">
                                <span class="align-self-center col-1 mr-0">
                                    <a class="text-primary-purple" href="#multi-item-foto-produk" role="button"
                                        data-slide="prev"><i class="material-icons md-32">chevron_left</i></a>
                                </span>

                                <!--Carousel Wrapper-->
                                <div id="multi-item-foto-produk" class="carousel slide carousel-multi-item col-9"
                                    data-ride="carousel">

                                    <!--Slides-->
                                    <div class="carousel-inner" role="listbox">

                                        {{-- @foreach ($collection as $item) --}}
                                        <div class="carousel-item active">

                                            <div class="row">

                                                {{-- @foreach ($collection as $item) --}}
                                                <div class="container col mr-0">
                                                    <img class="img-responsive"
                                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                        alt="" style="width:56px; height:56px;">
                                                </div>
                                                {{-- @endforeach --}}


                                            </div>
                                        </div>
                                        {{-- @endforeach --}}

                                    </div>
                                    <!--/.Slides-->

                                </div>
                                <!--/.Carousel Wrapper-->

                                <span class="align-self-center col-2">
                                    <a class="text-primary-purple" href="#multi-item-foto-produk" role="button"
                                        data-slide="next"><i class="material-icons md-32">chevron_right</i></a>
                                </span>
                            </div>

                            <h4 class="font-weight-bold mb-4">Fitur</h4>
                            <div class="container bg-light-purple pl-4 pr-4 pt-2 pb-2 mb-4" style="border-radius:5px;">
                                <p class="mb-2">Harga Produk</p>
                                <p class="font-weight-bold mb-4">Rp. 2.000 / hal</p>
                                <div class="row justify-content-left ml-0 mb-4">

                                    {{-- @foreach ($collection as $item) --}}
                                    <p class="card-text mr-4"><i class="material-icons align-middle mr-2">note</i> A4 HVS
                                    </p>
                                    <p class="card-text mr-4"><i class="material-icons align-middle mr-2">print</i> Ink Jet
                                    </p>
                                    {{-- @endforeach --}}

                                </div>

                                <div class="row justify-content-between mb-2">
                                    <div class="container col text-left">
                                        <p class="mb-0 ml-0">Timbal Balik</p>
                                    </div>
                                    <div class="container col text-right">
                                        <p class="font-weight-bold mb-0">+ Rp. 2k / Hal</p>
                                    </div>
                                </div>
                            </div>

                            <p class="card-text font-weight-bold mb-2">Paket</p>

                            {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between mb-2">
                                <div class="container col text-left">
                                    <p class="mb-2 ml-0">Jilid <i class="material-icons md-18 align-middle ml-2">help</i>
                                    </p>
                                </div>
                                <div class="container col text-right">
                                    <p class="font-weight-bold">+ Rp. 2k / Hal</p>
                                </div>
                            </div>
                            {{-- @endforeach --}}

                            <p class="card-text font-weight-bold mb-2">Non-Paket</p>

                            {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between mb-2">
                                <div class="container col text-left">
                                    <p class="mb-1 ml-0">Kertas Jeruk <i
                                            class="material-icons md-18 align-middle ml-2">help</i></p>
                                </div>
                                <div class="container col text-right">
                                    <p class="font-weight-bold">+ Rp. 2k / Lbr</p>
                                </div>
                            </div>
                            {{-- @endforeach --}}

                            <div class="container bg-light-purple pl-4 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">
                                <p class="font-weight-bold mb-2">Deskripsi Produk</p>
                                <p class="mb-4">
                                    Produk ini sudah dibuat 1 paket dengan keterangan yang ada diatas, apabila kamu ingin
                                    membuat permintaan khusus silahkan tulis di kolom catatan tambahan yang sudah disediakan
                                    pada konfigurasi file kamu sebelum melakukan pemesanan atau apabila produk ini kurang
                                    sesuai dengan keinginan tambahan kamu maka silahkan kamu memilih produk lain yang sesuai
                                    dengan tambahan yang anda inginkan. Terimakasih:):)
                                </p>
                            </div>
                        </div>

                        <div class="container col-6" style="margin-left:0px;">
                            <div class="container mb-4" style="margin-left:0px; position:relative;">
                                <img class="img-responsive"
                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt=""
                                    style="width:420px;">
                                <h5 class="text-truncate font-weight-bold" style="position: absolute; top: 10%; left: 16%;
                                        width: 300px;
                                        height: 100%;
                                        color: black;
                                        display:flex;
                                        justify-content: top;
                                        flex-direction: column;
                                        text-align: center;">
                                    Toko Bang Ali
                                </h5>
                            </div>

                            <div class="row justify-content-center mb-5" style="margin-left:0px;">
                                <span class="align-self-center col-1 mr-0">
                                    <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button"
                                        data-slide="prev"><i class="material-icons md-32">chevron_left</i></a>
                                </span>

                                <!--Carousel Wrapper-->
                                <div id="multi-item-foto-percetakan" class="carousel slide carousel-multi-item col-9"
                                    data-ride="carousel">

                                    <!--Slides-->
                                    <div class="carousel-inner" role="listbox">

                                        {{-- @foreach ($collection as $item) --}}
                                        <div class="carousel-item active">

                                            <div class="row">

                                                {{-- @foreach ($collection as $item) --}}
                                                <div class="container col mr-0">
                                                    <img class="img-responsive"
                                                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                        alt="" style="width:56px; height:56px;">
                                                </div>
                                                {{-- @endforeach --}}

                                            </div>
                                        </div>
                                        {{-- @endforeach --}}

                                    </div>
                                    <!--/.Slides-->

                                </div>
                                <!--/.Carousel Wrapper-->

                                <span class="align-self-center col-2">
                                    <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button"
                                        data-slide="next"><i class="material-icons md-32">chevron_right</i></a>
                                </span>
                            </div>

                            <div class="row justify-content-left mb-4">
                                <div class="col-2 mr-3">
                                    <img src="{{ url('buka.png') }}"
                                        class="align-middle img-responsive mt-2" alt="" width="80px" height="40px">
                                </div>
                                <div class="col-4">
                                    <p class="mt-0">Sampai Jam 22:00 WIB</p>
                                </div>
                                <div class="col-auto ml-0 mb-2">
                                    <div class="row justify-content-between">
                                        <p class="col font-weight-bold mr-4"><i class="material-icons md-32 align-middle"
                                                style="color:#FCFF82;">star</i> 2 / 5</p>
                                        <small>
                                            <p class="col text-right mt-2"><a class="text-primary-purple"
                                                    href="{{ url('member/ulasan-produk') }}">Ulasan</a>
                                            </p>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-left ml-0 mb-4">
                                <img src="https://ptetutorials.com/images/user-profile.png" width="48" height="48"
                                    alt="no logo">
                                <p class="align-self-center font-weight-bold mb-0 ml-4">Ali Susi</p>
                            </div>

                            <div class="card pl-4 pr-4 pt-2 pb-2 mb-4">
                                <p class="card-text">“ Kami menawarkan produk-produk berkualitas tinggi yang sudah
                                    dipercayai oleh artis-artis top seperti; Chris Evans, Lucinta Luna (yang baru saja kena
                                    tangkap), Toby Maguire (mantan pemeran Spiderman), dan masih banyak lagi. Pokoknya
                                    mantappu jiwa produk yang kami tawarkan. “</p>
                            </div>

                            <div class="container text-right mb-0" style="margin-right:-15px;">
                                <button type="button" class="btn btn-primary-yellow font-weight-bold pl-4 pr-4"
                                    onclick="window.location='{{ url('/member/laporkan-produk') }}'"
                                    style="border-radius:30px;">Laporkan</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-5">
                <div class="container col-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">
                    <h4 class="font-weight-bold mb-2 ml-0S">Catatan Tambahan</h4>
                    <div class="input-group mb-3" style="height:120px; margin-left:0px;">
                        <textarea class="form-control" aria-label="Deskripsi Ulasan"></textarea>
                    </div>
                </div>

                <div class="container col-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;">
                    <h4 class="font-weight-bold mb-4" style="margin-left:-5px;">Rincian Harga</h4>
                    <div class="row justify-content-between mb-2">
                        <div class="container col text-left">
                            <p class="mb-2">Total Halaman</p>
                            <p class="mb-2">Harga Cetak per Halaman</p>
                        </div>
                        <div class="container col text-right">
                            <p class="mb-2">2</p>
                            <p class="mb-2">Rp. 2.000</p>
                        </div>
                    </div>

                    <p class="font-weight-bold mb-2">Fitur Tambahan</p>
                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between">
                        <div class="container col text-left">
                            <p class="mb-2">Jilid Lem</p>
                        </div>
                        <div class="container col text-right">
                            <p class="mb-2">Rp. 2.000</p>
                        </div>
                    </div>
                    {{-- @endforeach --}}

                    <div class="row row-bordered"></div>

                    <div class="row justify-content-between font-weight-bold mt-2">
                        <div class="container col text-left">
                            <p>Total Harga Pesanan Kamu</p>
                        </div>
                        <div class="container col text-right">
                            <p>Rp. 20.000</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-5" style="margin-right:-15px;">
                <div class="row">
                    <div class="container text-right col-md-9 mr-0 mb-0">
                        <button type="button" class="btn btn-outline-purple font-weight-bold pl-4 pr-4"
                            style="margin-right:-30px;">Simpan Konfigurasi</button>
                    </div>
                    <div class="container text-right col-md-auto mb-0">
                        <button type="button" class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4"
                            onclick="window.location='{{ url('/member/konfigurasi-pesanan') }}'"
                            style="border-radius:30px; margin-right:-30px;">Simpan dan Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer_member')
@endsection
