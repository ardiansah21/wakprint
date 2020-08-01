<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container">
        <div class="row justify-content-left pt-5 pb-5" style="background-image: url(img/bg-unggah.png);">
            <div id="areaUnggah" class="row border border-white text-white align-self-center ml-5 mr-5" style="width:250px;height:250px;">
                <label class="SemiBold my-auto" style="text-align:center; font-size: 24px">{{__('Letak Dokumen Disini') }}</label>
            </div>
            <div id="kamuMauPrintApa">
                <h1 class="display-4 font-weight-bold mb-0" style="font-size: 64px">{{__('Kamu mau print apa ?') }}</h1>
                <label class="SemiBold mb-4 ml-1" style="font-size: 24px">{{__('Letak dokumen kamu disamping atau pilih unggah ?') }}</label>
                <br>
                <button type="button"
                    class="btn btn-primary-yellow btn-rounded shadow ml-1 pt-1 pb-1 pl-5 pr-5 font-weight-bold text-center"
                    style="border-radius:30px; font-size: 24px;"><i class="material-icons md-32 align-middle mb-1 mr-1">cloud_upload</i>
                    {{__('Unggah') }}
                </button>
            </div>
        </div>
        <div class="pt-5 pb-5">
            <h1 class="font-weight-bold text-center mb-5" style="font-size: 48px">{{__('Cara Pemesanan') }}</h1>
            <div class="row">
                <div class="col-md-4">
                    <img src="img/uploaddata.png" class="img-responsive d-flex justify-content-center center mb-4" alt="" width="100px" height="100px">
                    <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">{{__('Unggah Data') }}</h4>
                    <p class="text-center" style="font-size: 18px">{{__('Unggah data dan masukan detail pesanan') }}</p>
                </div>
                <div class="col-md-4">
                    <img src="img/caripercetakan.png" class="img-responsive center mb-4" alt="" width="100px" height="100px">
                    <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">{{__('Cari Tempat Percetakan') }}</h4>
                    <p class="text-center" style="font-size: 18px">{{__('Cari lokasi tempat percetakan sesuai kebutuhan') }}</p>
                </div>
                <div class="col-md-4">
                    <img src="img/ambildokumen.png" class="img-responsive center mb-4" alt="" width="100px" height="100px">
                    <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">{{__('Ambil Dokumen') }}</h4>
                    <p class="text-center" style="font-size: 18px">{{__('Lakukan pembayaran dan ambil dokumen langsung di tempat percetakan') }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center bg-light-purple p-5 mb-5" style="border-radius:5px;">
            <h1 class="font-weight-bold text-center mb-4" style="font-size: 48px">{{__('Tentang Wakprint') }}</h1>
            <p class="text-center" style="font-size: 24px">
                {{__('Wakprint adalah platform yang menghubungkan semua printer di seluruh Indonesia secara online untuk menjawab
                kebutuhan pencetakan dokumen Anda. Ribuan printer yang telah menjadi rekanan Wakprint, dapat diakses oleh
                Anda dengan mudah. Kirimkan dokumen dan ambil serta bayar dokumen anda langsung ke rekanan kami. Sekarang,
                mencetak dokumen dapat dilakukan di mana pun dengan
                mudah pada jaringan printer di Wakprint.com') }}
            </p>
        </div>
        <div class="row">
            <div class="main-search-input mb-5 ml-0">
                <div class="main-search-input-item">
                    <input type="text" role="search" class="form-control p-4" placeholder="Cari percetakan atau produk disini"
                        aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                        style="border:0px solid white; border-radius:30px; font-size:24px;">
                    <button class="btn btn-primary-yellow btn-rounded shadow-sm ml-1 pt-1 pb-1 pl-5 pr-5 SemiBold text-center"
                        style="position: absolute; font-size:24px;
                        top: 50%; left: 92%;
                        transform: translate(-50%, -50%); 
                        -ms-transform: translate(-50%, -50%);">
                        {{__('Cari') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <div class="row justify-content-between mb-5">
                <label class="font-weight-bold" style="font-size: 48px">{{__('Produk Pilihan') }}</label>
                <a class="SemiBold text-primary-purple align-self-center" href="" style="font-size: 14px">{{__('Lihat Semua') }}</a>
            </div>
            <div class="row">

                <span class="justify-content-center align-self-center col-md-1">
                    <a class="btn btn-circle-navigation-left btn-xl shadow-sm" href="#multi-item-produk-pilihan"
                        role="button" data-slide="prev"><img src="img/arrow-left.png"></a>
                </span>

                <!--Carousel Wrapper-->
                <div id="multi-item-produk-pilihan" class="carousel slide carousel-multi-item col-md-10"
                    data-ride="carousel">

                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">

                        <!--First slide-->
                        {{-- @foreach ($collection as $item) --}}
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4">
                                    @include('member.card_produk')
                                </div>
                            </div>
                        </div>
                        {{-- @endforeach --}}

                    </div>
                    <!--/.Slides-->

                </div>
                <!--/.Carousel Wrapper-->

                <span class="justify-content-center align-self-center text-center col-md-1">
                    <a class="btn btn-circle-navigation-right btn-xl shadow-sm" href="#multi-item-produk-pilihan"
                        role="button" data-slide="next"><img src="img/arrow-right.png"></a>
                </span>

            </div>
        </div>
        <div class="mb-5">
            <div class="row justify-content-between mb-5">
                <label class="font-weight-bold" style="font-size: 48px">{{__('Percetakan Pilihan') }}</label>
                <a class="text-primary-purple SemiBold align-self-center" href="" style="font-size: 14px">{{__('Lihat Semua') }}</a>
            </div>
            <div class="row">
                <span class="align-self-center col-md-1">
                    <a class="btn btn-circle-navigation-left btn-xl shadow-sm" href="#multi-item-percetakan-pilihan"
                        role="button" data-slide="prev"><img src="img/arrow-left.png"></a>
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
                                <div class="col-md-4">
                                    @include('member.card_percetakan')
                                </div>
                            </div>
                        </div>
                        {{-- @endforeach --}}
                    </div>
                    <!--/.Slides-->
                </div>
                <!--/.Carousel Wrapper-->
                <span class="align-self-center text-center col-md-1">
                    <a class="btn btn-circle-navigation-right btn-xl shadow-sm" href="#multi-item-percetakan-pilihan"
                        role="button" data-slide="next"><img src="img/arrow-right.png"></a>
                </span>
            </div>
        </div>
        <div id="areaDaftarPercetakan" class="p-5 mb-2 mr-0"
            style="background-image: url(img/bg-daftarpercetakan.png);">
            <label class="font-weight-bold" style="font-size: 64px;">{{__('Daftarkan Percetakan Kamu') }}</label>
            <br>
            <label class="text-dark font-weight-bold mb-4" style="font-size: 24px;">{{__('Jadilah percetakan terbaik di Indonesia melalui kami') }}</label>
            <br>
            <button onclick="window.location.href='{{ route('partner.login') }}'" class="btn btn-primary-wakprint btn-rounded shadow pt-2 pb-2 pl-4 pr-4 font-weight-bold"
                style="font-size: 24px">
                <i class="material-icons md-32 align-middle mr-1">exit_to_app</i>
                {{__('Daftar') }}
            </button>
        </div>
    </div>
@endsection