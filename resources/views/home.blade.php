<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')

<div class="pt-5 pb-5 img-responsive d-flex justify-content-center pl-0 pr-0"
    style="background-image: url(img/bg-unggah.png);background-size: cover;">
    <div ondragover="" id="areaUnggah" class="row border border-white text-white align-self-center ml-5 mr-5"
        style="width:250px;height:250px;">
        <!-- Dropzone -->
        <form action="{{route('upload.file.home')}}" class='dropzone' method="POST" enctype="multipart/form-data">
            @csrf
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
            {{-- <label class="SemiBold my-auto"
                    style="text-align:center; font-size: 24px">{{__('Letak Dokumen Disini') }}</label> --}}
        </form>
    </div>
    <div id="kamuMauPrintApa">
        <h1 class="display-4 font-weight-bold mb-0" style="font-size: 64px">{{__('Kamu mau print apa ?') }}</h1>
        <label class="SemiBold mb-4 ml-1"
            style="font-size: 24px">{{__('Letak dokumen kamu disamping atau pilih unggah ?') }}</label>
        <br>
        <button type="button"
            class="btn btn-primary-yellow btn-rounded shadow ml-1 pt-1 pb-1 pl-5 pr-5 font-weight-bold text-center"
            style="border-radius:30px; font-size: 24px;" onclick="openDialog()">
            <i class="material-icons md-32 align-middle mb-1 mr-1">cloud_upload</i>
            {{__('Unggah') }}
        </button>

        <script>
            function openDialog() {
                    document.getElementById('fileid').click();
                }
            function submitForm() {
                    document.getElementById('upload-form').submit();
                }
        </script>

        <form id="upload-form" action="{{ route('upload.file.home') }}" method="POST" enctype="multipart/form-data" 
            style="display: none;">
            @csrf
            <input type='file' name="file" id="fileid" onchange="submitForm()" accept="application/pdf" hidden />
        </form>
        </div>
    </div>
    
</div>
<div class="container">
    <div class="pt-5 pb-5">
        <h1 class="font-weight-bold text-center mb-5" style="font-size: 48px">{{__('Cara Pemesanan') }}</h1>
        <div class="row">
            <div class="col-md-4">
                <img src="img/uploaddata.png" class="img-responsive d-flex justify-content-center center mb-4" alt=""
                    width="100px" height="100px">
                <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">{{__('Unggah Data') }}</h4>
                <p class="text-center" style="font-size: 18px">{{__('Unggah data dan masukan detail pesanan') }}</p>
            </div>
            <div class="col-md-4">
                <img src="img/caripercetakan.png" class="img-responsive center mb-4" alt="" width="100px"
                    height="100px">
                <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">
                    {{__('Cari Tempat Percetakan') }}</h4>
                <p class="text-center" style="font-size: 18px">{{__('Cari lokasi tempat percetakan sesuai kebutuhan') }}
                </p>
            </div>
            <div class="col-md-4">
                <img src="img/ambildokumen.png" class="img-responsive center mb-4" alt="" width="100px" height="100px">
                <h4 class="SemiBold text-primary-purple text-center" style="font-size: 24px">{{__('Ambil Dokumen') }}
                </h4>
                <p class="text-center" style="font-size: 18px">
                    {{__('Lakukan pembayaran dan ambil dokumen langsung di tempat percetakan') }}</p>
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
                <input type="text" role="search" class="form-control p-4"
                    placeholder="Cari percetakan atau produk disini" aria-label="Cari percetakan atau produk disini"
                    aria-describedby="basic-addon2" style="border:0px solid white; border-radius:30px; font-size:24px;">
                <button
                    class="btn btn-primary-yellow btn-rounded shadow-sm ml-1 pt-1 pb-1 pl-5 pr-5 SemiBold text-center"
                    onclick="window.location.href='{{route('pencarian')}}'"
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
            <a class="SemiBold text-primary-purple align-self-center" href="{{ route('pencarian') }}"
                style="font-size: 14px">{{__('Lihat Semua') }}</a>
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
                <div class="carousel-inner row" role="listbox">

                    <!--First slide-->
                    @foreach ($produk as $p)
                        <div class="carousel-item active col-md-4">
                            @foreach ($produk as $p)
                            {{-- @for($i=0;$i<3;$i++) --}}
                                <div class="card shadow mb-2" style="border-radius: 10px;">
                                    <a class="text-decoration-none" href="{{ route('produk') }}" style="color: black;">
                                        <div class="text-center" style="position: relative;">
                                            <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                                width:75px;
                                                height:50px;
                                                border-radius:0px 0px 8px 8px;">
                                                    <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                            </div>
                                        </div>
                                        <i class="fa fa-heart fa-2x fa-responsive" 
                                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                        </i>
                                        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                        style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                        alt="Card image cap"/>
                                        <div class="card-body">
                                            <div class="row">
                                                <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                                <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                            </div>
                                            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{$p->nama ?? ''}}</label>
                                            <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                            <div class="row justify-content-between ml-0 mr-0">
                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i> 
                                                    {{-- @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                        {{__('Hitam-Putih')}}
                                                    @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                        {{__('Berwarna')}}
                                                    @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                        {{__('Berwarna')}}
                                                    @else
                                                        {{__('-')}}
                                                    @endif --}}
                                                </label>
                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label> 
                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label> 
                                            </div>
                                        </div>
                                        <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                            <div class="row justify-content-between">
                                                <div class="ml-3">
                                                    <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                        <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                        Rp. {{$p->harga ?? ''}}
                                                    </label>
                                                </div>
                                                
                                                <div class="mr-0">
                                                    <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                        <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                        {{$p->rating ?? ''}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            {{-- @endfor --}}
                        </div>
                    @endforeach

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
            <a class="text-primary-purple SemiBold align-self-center" href="{{ route('pencarian') }}"
                style="font-size: 14px">{{__('Lihat Semua') }}</a>
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
                                <div class="card shadow mb-2" style="border-radius: 10px;">
                                    <a class="text-decoration-none" href="{{ route('detail.partner') }}" style="color: black;">
                                        <label class="badge badge-pill badge-info bg-promo font-weight-bold align-bottom p-2 mb-1 mt-3" style="position: absolute;top: 0%; left: 80%; font-size: 12px;">{{__('ATK') }}</label>
                                        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                        style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                        alt="Card image cap"/>
                                        <div class="card-body">
                                            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{__('Percetakan IMAHA Productions Sinar Jaya') }}</label>
                                            <label class="card-text text-truncate-multiline" style="font-size: 16px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                            <label class="card-text text-sm text-truncate-multiline" style="font-size: 14px;">{{__('Kami sangat membantu para pelanggan dengan harga yang sangat bersahabat dan ramah di kantong') }}</label>
                                        </div>
                                        <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                            <div class="row justify-content-between ml-0">
                                                <label class="card-text font-weight-bold" style="font-size: 18px;">
                                                    <i class="material-icons md-24 mr-2 align-middle" style="color: #6081D7">location_on</i>
                                                    {{__('100 m') }}
                                                </label>
                                                
                                                <label class="card-text mr-4 font-weight-bold" style="font-size: 18px;">
                                                    <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                    {{__('5') }}
                                                </label>
                                            </div>
                                        </div>
                                    </a>
                                </div>
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
</div>
<div id="areaDaftarPercetakan" class="img-responsive pt-5 pb-5 pr-0 pl-0 mb-0 mr-0"
    style="background-image: url(img/bg-daftarpercetakan.png); background-size: cover;">
    <div class="container">
        <label class="font-weight-bold" style="font-size: 64px;">{{__('Daftarkan Percetakan Kamu') }}</label>
        <br>
        <label class="text-dark font-weight-bold mb-4"
            style="font-size: 24px;">{{__('Jadilah percetakan terbaik di Indonesia melalui kami') }}</label>
        <br>
        <button onclick="window.location.href='{{ route('partner.register') }}'" 
            class="btn btn-primary-wakprint btn-rounded shadow pt-2 pb-2 pl-4 pr-4 font-weight-bold"
            style="font-size: 24px">
            <i class="material-icons md-32 align-middle mr-1">exit_to_app</i>
                {{__('Daftar') }}
        </button>
    </div>
</div>

<div class="container my-3">
    <div class="row mx-auto my-auto">
        <div id="produkCarousel" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="col-md-4">
                        <div class="card shadow mb-2" style="border-radius: 10px;">
                            <a class="text-decoration-none" href="{{ route('produk') }}" style="color: black;">
                                <div class="text-center" style="position: relative;">
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                                <i class="fa fa-heart fa-2x fa-responsive" 
                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                alt="Card image cap"/>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                        <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                    </div>
                                    <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{__('Nama Produk')}}</label>
                                    <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i> 
                                            {{-- @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                {{__('Hitam-Putih')}}
                                            @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                {{__('Berwarna')}}
                                            @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                {{__('Berwarna')}}
                                            @else
                                                {{__('-')}}
                                            @endif --}}
                                        </label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label> 
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label> 
                                    </div>
                                </div>
                                <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                    <div class="row justify-content-between">
                                        <div class="ml-3">
                                            <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                Rp. {{$p->harga ?? ''}}
                                            </label>
                                        </div>
                                        
                                        <div class="mr-0">
                                            <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                {{$p->rating ?? ''}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card shadow mb-2" style="border-radius: 10px;">
                            <a class="text-decoration-none" href="{{ route('produk') }}" style="color: black;">
                                <div class="text-center" style="position: relative;">
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                                <i class="fa fa-heart fa-2x fa-responsive" 
                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                alt="Card image cap"/>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                        <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                    </div>
                                    <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{__('Nama Produk')}}</label>
                                    <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i> 
                                            {{-- @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                {{__('Hitam-Putih')}}
                                            @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                {{__('Berwarna')}}
                                            @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                {{__('Berwarna')}}
                                            @else
                                                {{__('-')}}
                                            @endif --}}
                                        </label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label> 
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label> 
                                    </div>
                                </div>
                                <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                    <div class="row justify-content-between">
                                        <div class="ml-3">
                                            <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                Rp. {{$p->harga ?? ''}}
                                            </label>
                                        </div>
                                        
                                        <div class="mr-0">
                                            <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                {{$p->rating ?? ''}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card shadow mb-2" style="border-radius: 10px;">
                            <a class="text-decoration-none" href="{{ route('produk') }}" style="color: black;">
                                <div class="text-center" style="position: relative;">
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                                <i class="fa fa-heart fa-2x fa-responsive" 
                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                alt="Card image cap"/>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                        <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                    </div>
                                    <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{__('Nama Produk')}}</label>
                                    <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i> 
                                            {{-- @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                {{__('Hitam-Putih')}}
                                            @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                {{__('Berwarna')}}
                                            @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                {{__('Berwarna')}}
                                            @else
                                                {{__('-')}}
                                            @endif --}}
                                        </label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label> 
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label> 
                                    </div>
                                </div>
                                <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                    <div class="row justify-content-between">
                                        <div class="ml-3">
                                            <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                Rp. {{$p->harga ?? ''}}
                                            </label>
                                        </div>
                                        
                                        <div class="mr-0">
                                            <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                {{$p->rating ?? ''}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card shadow mb-2" style="border-radius: 10px;">
                            <a class="text-decoration-none" href="{{ route('produk') }}" style="color: black;">
                                <div class="text-center" style="position: relative;">
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                                <i class="fa fa-heart fa-2x fa-responsive" 
                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                alt="Card image cap"/>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                        <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                    </div>
                                    <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{__('Nama Produk')}}</label>
                                    <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i> 
                                            {{-- @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                {{__('Hitam-Putih')}}
                                            @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                {{__('Berwarna')}}
                                            @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                {{__('Berwarna')}}
                                            @else
                                                {{__('-')}}
                                            @endif --}}
                                        </label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label> 
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label> 
                                    </div>
                                </div>
                                <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                    <div class="row justify-content-between">
                                        <div class="ml-3">
                                            <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                Rp. {{$p->harga ?? ''}}
                                            </label>
                                        </div>
                                        
                                        <div class="mr-0">
                                            <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                {{$p->rating ?? ''}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card shadow mb-2" style="border-radius: 10px;">
                            <a class="text-decoration-none" href="{{ route('produk') }}" style="color: black;">
                                <div class="text-center" style="position: relative;">
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                                <i class="fa fa-heart fa-2x fa-responsive" 
                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                alt="Card image cap"/>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                        <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                    </div>
                                    <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{__('Nama Produk')}}</label>
                                    <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i> 
                                            {{-- @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                {{__('Hitam-Putih')}}
                                            @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                {{__('Berwarna')}}
                                            @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                {{__('Berwarna')}}
                                            @else
                                                {{__('-')}}
                                            @endif --}}
                                        </label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label> 
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label> 
                                    </div>
                                </div>
                                <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                    <div class="row justify-content-between">
                                        <div class="ml-3">
                                            <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                Rp. {{$p->harga ?? ''}}
                                            </label>
                                        </div>
                                        
                                        <div class="mr-0">
                                            <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                {{$p->rating ?? ''}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-4">
                        <div class="card shadow mb-2" style="border-radius: 10px;">
                            <a class="text-decoration-none" href="{{ route('produk') }}" style="color: black;">
                                <div class="text-center" style="position: relative;">
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                                <i class="fa fa-heart fa-2x fa-responsive" 
                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                alt="Card image cap"/>
                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                        <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                    </div>
                                    <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{__('Nama Produk')}}</label>
                                    <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                    <div class="row justify-content-between ml-0 mr-0">
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i> 
                                            {{-- @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                {{__('Hitam-Putih')}}
                                            @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                {{__('Berwarna')}}
                                            @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                {{__('Berwarna')}}
                                            @else
                                                {{__('-')}}
                                            @endif --}}
                                        </label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label> 
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label> 
                                    </div>
                                </div>
                                <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                    <div class="row justify-content-between">
                                        <div class="ml-3">
                                            <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                Rp. {{$p->harga ?? ''}}
                                            </label>
                                        </div>
                                        
                                        <div class="mr-0">
                                            <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                {{$p->rating ?? ''}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#produkCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#produkCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

@endsection

<script>
    $('#produkCarousel').carousel({
      interval: 10000
    })
    
    $('.carousel .carousel-item').each(function(){
        var next = $(this).next();
        if (!next.length) {
        next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
        
        if (next.next().length>0) {
        next.next().children(':first-child').clone().appendTo($(this));
        }
        else {
          $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });
</script>