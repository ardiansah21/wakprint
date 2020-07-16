<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container">
            <div class="container mb-5" style="margin-top:120px;">
                <div class="row justify-content-between mb-2">
                    <h1 class="font-weight-bold">Percetakan IMAHA Productions</h1>
                    <img src="{{ url('buka.png') }}" class="align-middle img-responsive mr-0" alt=""
                        width="100px" height="50px">
                </div>

                <h4 class="mb-4" style="margin-left:-20px;"><i
                        class="material-icons md-32 align-middle mr-2">location_on</i>Jalan Seksama No 95A Medan Denai,
                    Medan, Sumatera Utara</h4>

                <div class="row justify-content-left mb-0" style="margin-left:-15px;">
                    <p class="mr-4"><i class="material-icons align-middle mr-2" style="color:#FCFF82;">star</i>3.5 / 5</p>

                    {{-- @foreach ($collection as $item) --}}
                        <label class="mr-4"><i class="align-middle material-icons mr-1">directions_run</i>Ambil di Tempat</label>
                        <label class="mr-4"><i class="align-middle material-icons mr-1">local_shipping</i>Antar ke Rumah</label>
                        <label class=""><i class="align-middle material-icons mr-1">architecture</i>Alat Tulis Kantor</label>
                    {{-- @endforeach --}}

                </div>


                <div class="row justify-content-between">
                    <div class="container bg-light-purple col-4 p-3 mt-5 mr-0 ml-0" style="border-radius:10px;">

                        <div class="container text-center mb-4" style="position:relative;">
                            <img class="img-responsive"
                                src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt=""
                                style="width:300px;">
                        </div>

                        <div class="row justify-content-left mb-5" style="margin-left:0px;">
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

                            <span class="align-self-center">
                                <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button"
                                    data-slide="next"><i class="material-icons md-32">chevron_right</i></a>
                            </span>
                        </div>

                        <div class="container">
                            <p class="font-weight-bold mb-2">Pemilik Percetakan</p>
                            <label class="text-truncate mb-4" style="width: 300px;"><img
                                    class="img-responsive align-self-center mr-2"
                                    src="https://ptetutorials.com/images/user-profile.png" width="32" height="32"
                                    alt="no logo">Mohammed
                                Salahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</label>
                            <p class="font-weight-bold mb-2">Deskripsi Percetakan</p>
                            <p class="mb-4">
                                Percetakan IMAHA Productions adalah akun resmi dari Percetakan IMAHA Productions di
                                Wakprint.
                                Kami juga menyediakan beberapa layanan percetakan seperti mencetak dokumen lengkap dengan
                                paket penjIlidan dan paket tambahan lainnya.
                            </p>

                            <p class="font-weight-bold mb-2">Jam Operasional Percetakan</p>
                            <p class="mb-4"><i class="material-icons md-18 align-middle mr-3">fiber_manual_record</i>Pukul
                                08:00 - 19:00 WIB</p>

                            <p class="font-weight-bold mb-2">Syarat & Ketentuan Percetakan</p>
                            <div class="row justify-content-left mb-2">
                                <i class="col-1 material-icons md-18 mr-1 mt-1">fiber_manual_record</i>
                                <p class="col-10 mb-2">Membayar pembayar melalui saldo tunai kamu secara penuh</p>
                            </div>

                            <p class="font-weight-bold mb-2">ATK</p>

                            {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between">
                                <div class="container col text-left">
                                    <p class="mb-2">Pensil <i class="material-icons md-18 align-middle ml-2 mr-4">help</i>x
                                        34</p>
                                </div>
                                <div class="container col text-right">
                                    <p class="mb-2">Rp. 2.000</p>
                                </div>
                            </div>
                            {{-- @endforeach --}}

                        </div>

                    </div>

                    <div class="my-custom-scrollbar-2 col-8 mt-5 ml-0 pl-4 pr-4">
                        <div class="card shadow-sm p-4">

                            <div class="row justify-content-between mb-2">
                                <h4 class="col-10 text-justify text-truncate-multiline font-weight-bold">Cetak Hitam Putih
                                    Dokumen by Percetakan IMAHA Productions</h4>
                                <a class="col-auto ml-0"
                                    href="{{ url('member/detail/tempat-percetakan') }}"
                                    style="color: black;"><i class="material-icons md-36">close</i></a>
                            </div>

                            <div class="row justify-content-between ml-0 mb-5">
                                <div class="col-auto" style="margin-left:-20px;">
                                    <label style="color:#FCFF82;">
                                        <!-- <input type="radio" name="stars" value="5" /> -->
                                        <span class="material-icons align-middle">star</span>
                                        <span class="material-icons align-middle">star</span>
                                        <span class="material-icons align-middle">star</span>
                                        <span class="material-icons align-middle">star</span>
                                        <span class="material-icons align-middle">star</span>
                                        <span class="ml-4"><a class="text-primary-purple align-middle"
                                                href="{{ url('member/ulasan-produk') }}">10
                                                Ulasan</a></span>

                                    </label>
                                    <label>

                                    </label>
                                </div>

                                <i class="col-auto text-right material-icons md-36 mr-0"
                                    style="margin-left:220px; color:#FF4949;">favorite</i>
                                <i class="col-auto text-right material-icons md-36 ml-0">forward</i>
                            </div>

                            <div class="row justify-content-between">

                                <div class="container col-6" style="margin-left:-20px;">
                                    <div class="container mb-4" style="position:relative;">
                                        <img class="img-responsive"
                                            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                            alt="" style="width:270px;">
                                    </div>

                                    <div class="row justify-content-left mb-5" style="margin-left:0px;">
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
                                                                alt="" style="width:48px; height:48px;">
                                                        </div>
                                                        {{-- @endforeach --}}

                                                    </div>
                                                </div>
                                                {{-- @endforeach --}}

                                            </div>
                                            <!--/.Slides-->

                                        </div>
                                        <!--/.Carousel Wrapper-->

                                        <span class="align-self-center">
                                            <a class="text-primary-purple" href="#multi-item-foto-produk" role="button"
                                                data-slide="next"><i class="material-icons md-32">chevron_right</i></a>
                                        </span>
                                    </div>
                                </div>

                                <div class="container col-6" style="margin-left:-20px;">
                                    <h4 class="text-truncate font-weight-bold mb-4">Rp. 2.000 / hal</h4>

                                    {{-- @foreach ($collection as $item) --}}
                                    <p class="card-text text-truncate mb-2"><i
                                            class="material-icons align-middle mr-2">palette</i> Hitam Putih</p>
                                    <p class="card-text text-truncate mb-2"><i
                                            class="material-icons align-middle mr-2">print</i> Ink Jet</p>
                                    {{-- @endforeach --}}

                                    <div class="row justify-content-between mb-4">
                                        <div class="row justift-content-left col">
                                            <p class="col-9 text-truncate mb-2">Timbal Balik</p>
                                            <i class="col-3 material-icons align-middle">help</i>
                                        </div>
                                        <div class="container col text-right">
                                            <p class="text-truncate font-weight-bold mb-2">+ Rp. 2k / Hal</p>
                                        </div>
                                    </div>
                                    <p class="card-text font-weight-bold mb-2">Paket</p>

                                    {{-- @foreach ($collection as $item) --}}
                                    <div class="row justify-content-between mb-4">
                                        <div class="row justift-content-left col">
                                            <p class="col-9 text-truncate mb-2">Jilid</p>
                                            <i class="col-3 material-icons align-middle">help</i>
                                        </div>
                                        <div class="container col text-right">
                                            <p class="text-truncate font-weight-bold mb-2">+ Rp. 2k / Hal</p>
                                        </div>
                                    </div>
                                    {{-- @endforeach --}}


                                    <p class="card-text font-weight-bold mb-2">Non-Paket</p>

                                    {{-- @foreach ($collection as $item) --}}
                                    <div class="row justify-content-between mb-4">
                                        <div class="row justift-content-left col">
                                            <p class="col-9 text-truncate mb-2">Kertas Jeruk</p>
                                            <i class="col-3 material-icons align-middle">help</i>
                                        </div>
                                        <div class="container col text-right">
                                            <p class="text-truncate font-weight-bold mb-2">+ Rp. 2k / Hal</p>
                                        </div>
                                    </div>
                                    {{-- @endforeach --}}

                                </div>
                            </div>

                            <div class="container bg-light-purple pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">
                                <p class="font-weight-bold mb-2 ml-4">Deskripsi Produk</p>
                                <p class="mb-4 ml-4">
                                    Produk ini sudah dibuat 1 paket dengan keterangan yang ada diatas, apabila kamu ingin
                                    membuat permintaan khusus silahkan tulis di kolom catatan tambahan yang sudah disediakan
                                    pada konfigurasi file kamu sebelum melakukan pemesanan atau apabila produk ini kurang
                                    sesuai dengan keinginan tambahan kamu maka silahkan kamu memilih produk lain yang sesuai
                                    dengan tambahan yang anda inginkan. Terimakasih:):)
                                </p>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="container text-right col-7 mr-0 mb-0">
                                        <button type="button"
                                            class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-4 pr-4"
                                            onclick="window.location='{{ url('member/laporkan-produk') }}'"
                                            style="border-radius:30px;">Laporkan</button>
                                    </div>
                                    <div class="container text-right col-auto mr-3 mb-0">
                                        <button type="button"
                                            class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
                                            onclick="window.location='{{ url('/member/konfigurasi-file/lanjutan') }}'"
                                            style="border-radius:30px; margin-right:-30px;">Gunakan Produk</button>
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
    @include('member.footer')
@endsection
