<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_before_member')
@endsection

@section('konten')
    <div class="container">
        <div class="container pt-5 pb-5" style="background-image: url(bg-unggah.png); margin-top:72px">

            <div class="row">
                <div id="areaUnggah" class="container border border-white col-auto ml-5" style="height:150px;">
                    <p class="align-items-center" style="margin-top:60px;">Letak Dokumen Disini</p>
                </div>

                <div id="kamuMauPrintApa" class="container justify-content-center align-middle col-9">
                    <h1 class="display-4 font-weight-bold mb-0">Kamu mau print apa ?</h1>
                    <p class="font-weight-bold mb-4 ml-1">Letak dokumen kamu disamping atau pilih unggah</p>
                    <button type="button"
                        onclick="window.location='{{ url('/member/konfigurasi-file') }}'"
                        class="btn btn-primary-yellow btn-rounded shadow ml-1 pt-1 pb-1 pl-5 pr-5 font-weight-bold text-center"
                        style="border-radius:30px"><i class="material-icons md-24 align-middle mb-1 mr-1">cloud_upload</i>
                        Unggah</button>
                </div>
            </div>
        </div>

        <div class="container pt-5 pb-5">
            <h1 class="font-weight-bold text-center mb-5">Cara Pemesanan</h1>
            <div class="row">
                <div class="col">
                    <img src="uploaddata.png" class="img-responsive center mb-4" alt="" width="80px" height="80px">
                    <h4 class="font-weight-bold text-center ">Unggah Data</h4>
                    <p class="text-center">Unggah data dan masukan detail pesanan</p>
                </div>

                <div class="col">
                    <img src="caripercetakan.png" class="img-responsive center mb-4" alt="" width="80px" height="80px">
                    <h4 class="font-weight-bold text-center">Cari Tempat Percetakan</h4>
                    <p class="text-center">Cari lokasi tempat percetakan sesuai kebutuhan</p>
                </div>

                <div class="col">
                    <a href="{{ url('/member/'.$member->id_member.'/profil') }}">
                        <img src="ambildokumen.png" class="img-responsive center mb-4" alt="" width="80px" height="80px">
                    </a>
                    <h4 class="font-weight-bold text-center">Ambil Dokumen</h4>
                    <p class="text-center">Lakukan pembayaran dan ambil dokumen langsung di tempat percetakan</p>
                </div>
            </div>
        </div>

        <div class="container bg-light-purple pl-4 pr-4 pt-5 pb-5 mb-5 ml-0" style="border-radius:5px;">
            <h1 class="font-weight-bold text-center mb-4">Tentang Wakprint</h1>
            <p class="text-center">
                Wakprint adalah platform yang menghubungkan semua printer di seluruh Indonesia secara online untuk menjawab
                kebutuhan pencetakan dokumen Anda. Ribuan printer yang telah menjadi rekanan Wakprint, dapat diakses oleh
                Anda dengan mudah. Kirimkan dokumen dan ambil serta bayar dokumen anda langsung ke rekanan kami. Sekarang,
                mencetak dokumen dapat dilakukan di mana pun dengan
                mudah pada jaringan printer di Wakprint.com
            </p>
        </div>

        <div class="container mb-5 ml-0 mr-0">
            <div class="row">
                <div class="input-group mb-3" role="search">
                    <input type="text" class="form-control shadow-sm p-4" placeholder="Cari percetakan atau produk disini"
                        aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                        style="border-radius:30px;">
                    <button type="button"
                        class="btn btn-primary-yellow btn-rounded shadow-sm ml-1 pt-1 pb-1 pl-3 pr-3 font-weight-bold text-center"
                        onclick="window.location='{{ url('/member/pencarian') }}'" style="border-radius:30px; 
                        position: absolute;
                        top: 50%; left: 95%; 
                        transform: translate(-50%, -50%); 
                        -ms-transform: translate(-50%, -50%);">
                        Cari
                    </button>
                </div>
            </div>

        </div>

        <div class="container ml-0 mr-0">
            <div class="row justify-content-between mb-5">
                <h1 class="font-weight-bold">Produk Pilihan</h1>
                <p class="align-middle"><a class="text-primary-purple"
                        href="{{ url('/member/pencarian') }}">Lihat Semua</a></p>
            </div>

            <div class="container mb-5">

                <div class="row">

                    <span class="justify-content-center align-self-center col-1">
                        <a class="btn btn-circle-navigation-left btn-xl shadow-sm" href="#multi-item-produk-pilihan"
                            role="button" data-slide="prev"><img src="arrow-left.png"></a>
                    </span>


                    <!--Carousel Wrapper-->
                    <div id="multi-item-produk-pilihan" class="carousel slide carousel-multi-item col-10"
                        data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            <!--First slide-->
                            {{-- @foreach ($collection as $item) --}}
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-4">
                                        @include('card_produk')
                                    </div>
                                </div>
                            </div>
                            {{-- @endforeach --}}

                        </div>
                        <!--/.Slides-->

                    </div>
                    <!--/.Carousel Wrapper-->

                    <span class="justify-content-center align-self-center text-center col-1">
                        <a class="btn btn-circle-navigation-right btn-xl shadow-sm" href="#multi-item-produk-pilihan"
                            role="button" data-slide="next"><img src="arrow-right.png"></a>
                    </span>

                </div>
            </div>

        </div>

        <div class="container mb-5">
            <div class="row justify-content-between mb-5">
                <h1 class="font-weight-bold">Percetakan Pilihan</h1>
                <p class="align-middle"><a class="text-primary-purple"
                        href="{{ url('/member/pencarian') }}">Lihat Semua</a></p>
            </div>

            <div class="container">

                <div class="row">
                    <span class="align-self-center col-1">
                        <a class="btn btn-circle-navigation-left btn-xl shadow-sm" href="#multi-item-percetakan-pilihan"
                            role="button" data-slide="prev"><img src="arrow-left.png"></a>
                    </span>

                    <!--Carousel Wrapper-->
                    <div id="multi-item-percetakan-pilihan" class="carousel slide carousel-multi-item col-md-10"
                        data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            <!--First slide-->
                            {{-- @foreach ($collection as $item) --}}
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-4">
                                        @include('card_percetakan')
                                    </div>
                                </div>
                            </div>
                            {{-- @endforeach --}}

                        </div>
                        <!--/.Slides-->

                    </div>
                    <!--/.Carousel Wrapper-->

                    <span class="align-self-center text-center col-1">
                        <a class="btn btn-circle-navigation-right btn-xl shadow-sm" href="#multi-item-percetakan-pilihan"
                            role="button" data-slide="next"><img src="arrow-right.png"></a>
                    </span>
                </div>
            </div>
        </div>

        <div id="areaDaftarPercetakan" class="container p-5 mb-2 mr-0"
            style="background-image: url(bg-daftarpercetakan.png);">
            <h1 class="font-weight-bold">Daftarkan Percetakan Kamu</h1>
            <p class="text-dark font-weight-bold mb-4">Jadilah percetakan terbaik di Indonesia melalui kami</p>
            <button class="btn btn-primary-wakprint btn-rounded shadow pt-2 pb-2 pl-4 pr-4 font-weight-bold"
                onclick="window.location='{{ url('/pengelola/register') }}'"><i
                    class="material-icons md-24 align-middle my-auto mr-1">exit_to_app</i> Daftar</button>
        </div>

    </div>
@endsection

@section('footer')
    @include('member.footer_member')
@endsection
