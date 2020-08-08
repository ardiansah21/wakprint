<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <div class="mt-5 mb-5">
        <label class="font-weight-bold" style="font-size:48px;">{{__('Konfigurasi File') }}
        </label>
        <div class="row justify-content-between mb-5">
            <div class="col-md-auto mt-5 mr-0">
                <div class="border-primary-purple" style="width:515px;
                        height:515px;
                        position:relative;
                        float: none;
                        display: table-cell;
                        vertical-align: bottom;">
                    {{-- <embed src="{{ action('MemberController@showPDF', ['path'=> $pdf ?? ''->path]) }}"
                    type="application/pdf" height="515px"
                    width="515px" frameborder="0"/>
                    --}}
                    <embed
                        src="{{url('tmp/upload/',$pdf->namaFile ?? '')."#pagemode=thumbs&statusbar=0&messages=0&navpanes=0&toolbar=0"}}"
                        type="application/pdf" height="515px" width="515px" frameborder="0" />
                    {{-- <div class="row bg-dark justify-content-between align-middle ml-0 mr-0 pl-2 pr-2 pt-4 pb-4" style="font-size:24px;
                        opacity:80%;
                        width:100%;
                        border-radius: 0px 0px 5px 5px;">
                        <label class="col-md-auto text-white">
                            {{__('Hitam-Putih') }}
                    </label>
                    <label class="col-md-auto text-right text-white">
                        <i class="fa fa-chevron-left text-white mr-2"></i>
                        {{__('12 / 16') }}
                        <i class="fa fa-chevron-right ml-2"></i>
                    </label>
                </div> --}}
            </div>
        </div>
        <div class="col-md-6 mt-5">
            <div class="row align-self-center p-2 bg-light-purple mb-4 col-md-12" style="border-radius:5px;">
                <div class="col-md-1 d-flex justify-content-center">
                    <div class="align-self-center"><img src="https://img.icons8.com/nolan/96/pdf-2.png" width="48px" />
                    </div>
                </div>
                <div class="col-md-8 text-truncate align-self-center">
                    <a class="" href="{{url('tmp/upload',$pdf->namaFile?? '')}}" target="_blank"
                        style="font-size: 18px;">
                        {{$pdf->namaFile ?? ''}}
                    </a>
                    <br>
                    <label class="text-muted" style="font-size: 12px;">
                        {{$pdf ->jumlahHalaman ?? '' }} {{ __('Halaman') }}
                    </label>
                </div>
                <div class="col-md-3 align-self-center text-right p-0">
                    <button class="btn btn-primary-yellow btn-rounded font-weight-bold py-1 px-4"
                        style="border-radius:35px;font-size: 16px;" onclick="openDialog()">
                        {{__('Ubah') }}
                    </button>
                    <script>
                        function openDialog() {
                                document.getElementById('fileid').click();
                            }
                        function submitForm() {
                                document.getElementById('upload-form').submit();
                            }
                    </script>
                    <form id="upload-form" action="{{ route('upload.file.home') }}" method="POST"
                        enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type='file' name="file" id="fileid" onchange="submitForm()" accept="application/pdf"
                            hidden />


                </div>

            </div>

            </form>
            {{--
            <div class="bg-light-purple mb-4 p-2" style="border-radius:5px;">
                <div class="row justify-content-between">
                    <div class="text-center align-self-center col-md-1">
                        <img src="https://img.icons8.com/nolan/96/pdf-2.png" width="48" />
                    </div>

                    <div class="col-md-11">
                        <div class="row justify-content-between" width="100%">
                            <div class="col-md-5 ml-2">
                                <a class="mb-0" href="{{url('filenya/',$pdf ?? ''->namaFile)}}" target="_blank"
            style="font-size: 18px;">

            {{__('ajdosalkjdsaoldjaoidjsoaidjsoaidjsaoidjsajdoisdasoijdoisajdsoaioissjaoiadjsoaijd')}}
            </a>
            <br>
            <label class="text-muted" style="font-size: 12px;">
                {{$pdf ?? ''->jumlahHalaman }} {{ __('Halaman') }}
            </label>
        </div>
        <div class="col-md-4 align-self-center mr-2">
            <button class="btn btn-primary-yellow btn-rounded font-weight-bold ml-5 pt-1 pb-1 pl-4 pr-4"
                style="border-radius:30px;font-size: 16px;" onclick="openDialog()">
                {{__('Ubah') }}
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
</div>
</div>
--}}

<div class="row justify-content-between">
    <div class="col-md-7">
        <label class="mb-0" style="font-size: 18px;">
            {{$pdf->jumlahHalHitamPutih ?? '' }}{{ __(' Halaman Hitam Putih') }}
        </label>
        <br>
        <label class="mb-2" style="font-size: 18px;">
            {{$pdf->jumlahHalBerwarna ?? ''}} {{ __(' Halaman Berwarna') }}
        </label><br>
        <label class="text-muted mb-0" style="font-size: 12px;">
            {{__('*Hitam Putih Rp. 2K / lembar') }}
        </label>
        <br>
        <label class="text-muted mb-4" style="font-size: 12px;">
            {{__('*Berwarna Rp. 2K / lembar') }}
        </label>
        <label class="SemiBold mb-3" style="font-size: 24px;">
            {{__('Pilih Halaman') }}
        </label>
        <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
            <input id="rbSemuaHal" name="radio" class="custom-control-input" type="radio"
                onchange="document.getElementById('halamanAwal').disabled; document.getElementById('halamanAkhir').disabled; document.getElementById('halamanKustom').disabled;"
                checked>
            <label class="custom-control-label" for="rbSemuaHal">
                {{__('Semua') }}
            </label>
        </div>
        {{-- if(document.getElementById('halamanAwal').disabled){document.getElementById('rbSemuaHal').click();document.getElementById('rbSemuaHal').focus() }; --}}
        <div class="form-group custom-control custom-radio mb-4"
            onchange="document.getElementById('halamanAwal').!disabled; document.getElementById('halamanAkhir').!disabled; document.getElementById('halamanKustom').disabled;"
            style="font-size: 18px;">
            <input id="rbSampaiHal" name="radio" class="custom-control-input" type="radio">
            <label class="custom-control-label" for="rbSampaiHal">
                <input id="halamanAwal" type="text" class="form-input mr-2" for="rbSampaiHal"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    style="width:48px;">
                {{__('Sampai') }}
                <input id="halamanAkhir" type="text" class="form-input ml-2" for="rbSampaiHal"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    style="width:48px;">
            </label>
        </div>
        <div class="form-group custom-control custom-radio mb-4" style="font-size: 18px;">
            <input id="rbKustomHal" name="radio" class="custom-control-input" type="radio">
            <label class="custom-control-label" for="rbKustomHal">
                {{__('Kustom') }}
            </label>
            <br>
            <input id="halamanKustom" type="text mr-4" class="form-input"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
        </div>
    </div>
    <div class="col-md-5">
        <label class="card-title font-weight-bold mb-4" style="font-size: 24px;">
            {{__('Jumlah Salinan') }}
        </label>
        <div class="form-group mb-4" style="font-size: 18px;">
            <label>
                <i class="fa fa-minus ml-2 mr-2"></i>
            </label>
            <input id="jumlahSalin" type="number" class="form-input"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                style="width:48px;">
            <label class="label">
                <i class="fa fa-plus ml-2 mr-2"></i>
            </label>
        </div>
        <label class="SemiBold mb-2" style="font-size: 24px;">
            {{__('Cetak') }}
        </label>
        <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
            <input type="checkbox" class="custom-control-input" id="checkboxTimbalBalik">
            <label class="custom-control-label" for="checkboxTimbalBalik">
                {{__('Timbal Balik') }}
            </label>
        </div>
        <div class="form-group custom-control custom-checkbox mt-2 ml-0" style="font-size: 18px;">
            <input type="checkbox" class="custom-control-input" id="checkboxPaksaHitamPutih">
            <label class="custom-control-label" for="checkboxPaksaHitamPutih">
                {{__('Paksa Hitam Putih') }}
            </label>
        </div>
    </div>
</div>
</div>
</div>
<div class="row justify-content-between mb-4">
    <div class="col-md-6">
        <div class="search-input">
            <div class="main-search-input-item">
                <input type="text" role="search" class="form-control" placeholder="Cari percetakan atau produk disini"
                    aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2" style="border:0px solid white;
                                border-radius:30px;
                                font-size:18px;">
                <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                    style="position: absolute;
                                    top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                    search
                </i>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="dropdown">
            <input name="filter_produk" type="text" id="filterProduk" Class="form-control" hidden>
            <button id="filterProdukButton"
                class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                id="dropdownFilterProduk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                    text-align:left;">
                {{__('Urutkan') }}
            </button>
            @php
            $filterProduk= array('Terbaru', 'Harga Tertinggi', 'Harga Terendah');
            @endphp
            <div id="filterProdukList" class="dropdown-menu" aria-labelledby="dropdownKertas"
                style="font-size: 16px; width:100%;">
                @foreach ( $filterProduk as $fp)
                <span class="dropdown-item cursor-pointer ">
                    {{$fp}}
                </span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="dropdown">
            <input name="jenis_printer" type="text" id="jenisPrinter" Class="form-control" hidden>
            <button id="jenisPrinterButton"
                class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                id="dropdownJenisPrinter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                    text-align:left;">
                {{__('Jenis Printer') }}
            </button>
            @php
            $jenisPrinter= array('Ink Jet', 'Laser Jet');
            @endphp
            <div id="jenisPrinterList" class="dropdown-menu" aria-labelledby="dropdownJenisPrinter"
                style="font-size: 16px; width:100%;">
                @foreach ( $jenisPrinter as $printer)
                <span class="dropdown-item cursor-pointer ">
                    {{$printer}}
                </span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="dropdown" aria-required="true">
            <input name="jenis_kertas" type="text" id="ukuranKertas" Class="form-control" hidden>
            <button id="ukuranKertasButton"
                class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                id="dropdownKertas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                    text-align:left;">
                {{__('Ukuran Kertas') }}
            </button>
            @php
            $ukuranKertas= array('A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr',
            'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr');
            @endphp
            <div id="ukuranKertasList" class="dropdown-menu" aria-labelledby="dropdownKertas"
                style="font-size: 16px; width:100%;">
                @foreach ( $ukuranKertas as $kertas)
                <span class="dropdown-item cursor-pointer ">
                    {{$kertas}}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4 ml-0" style="border-radius:5px;">
    <label class="SemiBold mb-3 ml-0" style="font-size: 18px;">
        {{__('Paket')}}
    </label>
    <br>
    @php
    $paket = array('Lem','Baut','Kawat','Spiral');
    @endphp
    <div class="container" style="font-size: 14px;">
        <label class="SemiBold mb-2 ml-0">
            {{__('Jilid')}}
        </label>
        <div class="row justify-content-left ml-0">
            @foreach ($paket as $p)
            <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                <input type="checkbox" name="checkbox_paket{{ $p }}" class="custom-control-input"
                    id="checkboxPaket{{ $p }}">
                <label class="custom-control-label" for="checkboxPaket{{ $p }}">
                    {{$p}}
                    <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                        help
                    </i>
                </label>
            </div>
            @endforeach
        </div>
    </div>
    @php
    $nonPaket = array('Hekter','Tulang Kliping','Penjepit Kertas','Plastik Transparan','Kertas Jeruk');
    @endphp
    <label class="SemiBold mt-3 mb-2 ml-0" style="font-size: 18px;">
        {{__('Non-Paket')}}
    </label>
    <div class="row justify-content-left ml-0" style="font-size: 14px;">
        @foreach ($nonPaket as $np)
        <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
            <input type="checkbox" class="custom-control-input" id="checkboxNonPaket{{$np}}">
            <label class="custom-control-label" for="checkboxNonPaket{{$np}}">
                {{$np}}
                <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                    help
                </i>
            </label>
        </div>
        @endforeach
    </div>
</div>

<div id="pilihProduk" class="border-primary-purple my-custom-scrollbar-2 p-5" style="border-radius:5px;">
    <div class="row row-cols-3">
        @foreach ($produk as $p)
            <div class="col-md-4 mb-4">
                <div class="card shadow mb-2" onclick="document.getElementById('detailProduk').hidden = false; document.getElementById('pilihProduk').hidden = true;" style="border-radius: 10px;">
                    <a class="text-decoration-none"
                        {{-- onclick="document.getElementById('detailProduk').hidden = false" --}}
                        {{-- href="{{ route('detail.produk',$p->id_produk) }}" --}}
                        style="color: black;">
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
                                <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{$p->partner->nama_toko ?? '-'}}</label>
                                <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                            </div>
                            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{$p->nama ?? ''}}</label>
                            <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{$p->partner->alamat_toko}}</label>
                            <div class="row justify-content-between ml-0 mr-0">
                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i>
                                    @if ($p->berwarna === 0 && $p->hitam_putih === 1)
                                        {{__('Hitam-Putih')}}
                                    @elseif ($p->berwarna === 1 && $p->hitam_putih === 0)
                                        {{__('Berwarna')}}
                                    @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                        {{__('Berwarna')}}
                                    @else
                                        {{__('-')}}
                                    @endif
                                </label>
                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label>
                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label>
                            </div>
                        </div>
                        <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                            <div class="row justify-content-between">
                                <div class="ml-3">
                                    <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                        Rp. {{$p->harga_hitam_putih ?? '-'}}
                                    </label>
                                    <label class="card-text SemiBold badge-sm badge-light px-1" style="font-size: 12px; border-radius:5px;">
                                        {{__('Hitam-Putih')}}
                                    </label>
                                    <br>
                                    @if (!empty($p->harga_berwarna))
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                            Rp. {{$p->harga_berwarna}}
                                        </label>
                                        <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1" style="font-size: 12px; border-radius:5px;">
                                            {{__('Berwarna')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="mr-0 my-auto">
                                    <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                        <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                        {{$p->rating ?? '-'}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div id="detailProduk" hidden>
    <div class="border-primary-purple my-custom-scrollbar-2 p-5 mb-5" style="border-radius:5px;">
        <div class="card shadow mt-0 ml-0 mb-4 p-4">
            <div class="row justify-content-between">
                <div class="col-md-8">
                    <label class="text-break font-weight-bold" style="font-size: 24px;">
                        {{__('Percetakan IMAHA Productions') }}
                    </label>
                    <label class="text-truncate-multiline mb-4" style="font-size: 18px;">
                        {{__('Jalan Seksama No 95A Medan Denai, Medan, Sumatera Utara') }}
                    </label>
                    <div class="row justify-content-left mb-4 ml-0" style="font-size: 14px;">

                        <label class="mr-4">
                            <i class="align-middle material-icons mr-1">
                                directions_run
                            </i>
                            {{__('Ambil di Tempat') }}
                        </label>
                        <label class="mr-4">
                            <i class="align-middle material-icons mr-1">
                                local_shipping
                            </i>
                            {{__('Antar ke Rumah') }}
                        </label>
                        <label class="">
                            <i class="align-middle material-icons mr-1">
                                architecture
                            </i>
                            {{__('Alat Tulis Kantor') }}
                        </label>

                    </div>
                </div>
                <div class="col-md-auto mt-2">
                    <div class="row justify-content-right">
                        <i class="text-right material-icons md-32 mr-4">location_on</i>
                        <i class="text-right material-icons md-32 mr-5">favorite</i>
                        <i class="text-right material-icons md-32 mr-4" onclick="document.getElementById('detailProduk').hidden = true; document.getElementById('pilihProduk').hidden = false;">close</i>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-6">
                    <div class="mb-4" style="position:relative;">
                        <img class="img-responsive"
                            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt=""
                            style="width:100%; height:200px;">
                        <label class="text-break font-weight-bold" style="position: absolute;
                                        top: 10%;
                                        left: 0%;
                                        width: 100%;
                                        height: 100%;
                                        max-width: 440px;
                                        font-size:24px;
                                        color: black;
                                        display:flex;
                                        justify-content: top;
                                        flex-direction: column;
                                        text-align: center;">
                            {{__('Cetak Dokumen Hitam Putih') }}
                        </label>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <span class="align-self-center col-md-1 ml-0 mr-0">
                            <a class="text-primary-purple" href="#multi-item-foto-produk" role="button" data-slide="prev">
                                <i class="material-icons md-32">
                                    chevron_left
                                </i>
                            </a>
                        </span>

                        <!--Carousel Wrapper-->
                        <div id="multi-item-foto-produk" class="col-md-9 carousel slide carousel-multi-item"
                            data-ride="carousel">

                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">

                                {{-- @foreach ($collection as $item) --}}
                                <div class="carousel-item active">

                                    <div class="row">

                                        {{-- @foreach ($collection as $item) --}}
                                        <div class="col-md-auto mr-0">
                                            <img class="img-responsive"
                                                src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                alt="" style="width:60px; height:60px;">
                                        </div>
                                        {{-- @endforeach --}}

                                    </div>
                                </div>
                                {{-- @endforeach --}}

                            </div>
                            <!--/.Slides-->

                        </div>
                        <!--/.Carousel Wrapper-->

                        <span class="align-self-center col-md-2">
                            <a class="text-primary-purple" href="#multi-item-foto-produk" role="button" data-slide="next">
                                <i class="material-icons md-32">
                                    chevron_right
                                </i>
                            </a>
                        </span>
                    </div>
                    <label class="font-weight-bold mb-4" style="font-size: 24px;">
                        {{__('Fitur') }}
                    </label>
                    <div class="bg-light-purple p-4 mb-4" style="border-radius:5px;
                                    font-size: 18px;">
                        <label class="mb-2">
                            {{__('Harga Produk') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-4">
                            {{__('Rp. 2.000 / hal') }}
                        </label>
                        <div class="row justify-content-left ml-0 mb-4">

                            {{-- @foreach ($collection as $item) --}}
                            <label class="mr-4">
                                <i class="material-icons align-middle mr-2">
                                    color_lens
                                </i>
                                {{__('Hitam-Putih') }}
                            </label>
                            <label class="mr-4">
                                <i class="material-icons align-middle mr-2">
                                    description
                                </i>
                                {{__('A4 HVS') }}
                            </label>
                            <label class="mr-4">
                                <i class="material-icons align-middle mr-2">
                                    print
                                </i>
                                {{__('Ink Jet') }}
                            </label>
                            <label class="mr-4">
                                <i class="material-icons align-middle mr-2">
                                    menu_book
                                </i>
                                {{__('Jilid') }}
                            </label>
                            {{-- @endforeach --}}

                        </div>

                        <div class="row justify-content-between mb-2">
                            <div class="col-md-auto text-left">
                                <label class="mb-0 ml-0">{{__('Timbal Balik') }}</label>
                            </div>
                            <div class="col text-right">
                                <label class="font-weight-bold mb-0">+ Rp. 2k / Hal</label>
                            </div>
                        </div>
                    </div>

                    <label class="card-text SemiBold mb-2" style="font-size: 18px;">
                        {{__('Paket')}}
                    </label>

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mb-4">
                        <label class="col-md-5 text-break mb-2" style="font-size: 18px;">
                            {{__('Jilid')}}
                        </label>
                        <i class="col-md-auto material-icons md-18 mt-1" style="color:#C4C4C4">
                            help
                        </i>
                        <label class="col-md-auto text-break font-weight-bold mb-2" style="font-size: 14px;">
                            {{__('+ Rp. 2k / Hal')}}
                        </label>
                    </div>
                    {{-- @endforeach --}}


                    <label class="card-text SemiBold mb-2" style="font-size: 18px;">
                        {{__('Non-Paket')}}
                    </label>

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mb-4">
                        <label class="col-md-5 text-break mb-2" style="font-size: 18px;">
                            {{__('Kertas Jeruk')}}
                        </label>
                        <i class="col-md-auto material-icons md-18 mt-1" style="color:#C4C4C4">
                            help
                        </i>
                        <label class="col-md-auto text-break font-weight-bold mb-2" style="font-size: 14px;">
                            {{__('+ Rp. 2k / Hal')}}
                        </label>
                    </div>
                    {{-- @endforeach --}}

                    <div class="bg-light-purple pl-4 pr-4 pb-4 pt-4 mb-5" style="border-radius:5px;
                                    ">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{__('Deskripsi Produk')}}
                        </label>
                        <p class="mb-4" style="font-size: 14px;">
                            {{__('Produk ini sudah dibuat 1 paket dengan keterangan yang ada diatas, apabila kamu ingin
                                    membuat permintaan khusus silahkan tulis di kolom catatan tambahan yang sudah disediakan
                                    pada konfigurasi file kamu sebelum melakukan pemesanan atau apabila produk ini kurang
                                    sesuai dengan keinginan tambahan kamu maka silahkan kamu memilih produk lain yang sesuai
                                    dengan tambahan yang anda inginkan. Terimakasih:):)')}}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4" style="position:relative;">
                        <img class="img-responsive"
                            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt=""
                            style="width:100%; height:200px;">
                        <label class="text-break font-weight-bold" style="position: absolute;
                                        top: 10%;
                                        left: 0%;
                                        width: 100%;
                                        height: 100%;
                                        max-width: 440px;
                                        font-size:24px;
                                        color: black;
                                        display:flex;
                                        justify-content: top;
                                        flex-direction: column;
                                        text-align: center;">
                            {{__('IMAHA Productions') }}
                        </label>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <span class="align-self-center col-md-1 ml-0 mr-0">
                            <a class="text-primary-purple" href="#multi-item-foto-produk" role="button" data-slide="prev">
                                <i class="material-icons md-32">
                                    chevron_left
                                </i>
                            </a>
                        </span>

                        <!--Carousel Wrapper-->
                        <div id="multi-item-foto-produk" class="col-md-9 carousel slide carousel-multi-item"
                            data-ride="carousel">

                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">

                                {{-- @foreach ($collection as $item) --}}
                                <div class="carousel-item active">

                                    <div class="row">

                                        {{-- @foreach ($collection as $item) --}}
                                        <div class="col-md-auto mr-0">
                                            <img class="img-responsive"
                                                src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                alt="" style="width:60px; height:60px;">
                                        </div>
                                        {{-- @endforeach --}}

                                    </div>
                                </div>
                                {{-- @endforeach --}}

                            </div>
                            <!--/.Slides-->

                        </div>
                        <!--/.Carousel Wrapper-->

                        <span class="align-self-center col-md-2">
                            <a class="text-primary-purple" href="#multi-item-foto-produk" role="button" data-slide="next">
                                <i class="material-icons md-32">
                                    chevron_right
                                </i>
                            </a>
                        </span>
                    </div>
                    <div class="row justify-content-left mb-4">
                        <div class="col-md-auto">
                            <img src="{{ url('img/buka.png') }}" class="align-self-center img-responsive mt-2" alt=""
                                width="100px" height="50px">
                        </div>
                        <div class="col-md-3 ml-0" style="font-size: 18px;">
                            <label class="mt-0">
                                {{__('Sampai Jam 22:00 WIB')}}
                            </label>
                        </div>
                        <div class="col-md-auto mb-2">
                            <div class="row justify-content-between">
                                <label class="col-md-auto SemiBold mr-4" style="font-size: 18px;">
                                    <i class="material-icons md-24 align-middle" style="color:#FCFF82;">
                                        star
                                    </i>
                                    {{__('2 / 5')}}
                                </label>
                                <label class="col-md-auto text-right align-self-center" style="font-size: 14px;">
                                    <a class="text-primary-purple" href="{{ url('member/ulasan-produk') }}">
                                        {{__('Ulasan')}}
                                    </a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-left ml-0 mb-4">
                        <img src="https://ptetutorials.com/images/user-profile.png" width="50" height="50" alt="no logo">
                        <label class="align-self-center font-weight-bold mb-0 ml-4" style="font-size: 18px;">
                            {{__('Ali Susi') }}
                        </label>
                    </div>
                    <div class="card shadow-sm pl-4 pr-4 pt-2 pb-2 mb-4" style="font-size: 18px;">
                        <p class="card-text">
                            {{__('“ Kami menawarkan produk-produk berkualitas tinggi yang sudah
                                    dipercayai oleh artis-artis top seperti; Chris Evans, Lucinta Luna (yang baru saja kena
                                    tangkap), Toby Maguire (mantan pemeran Spiderman), dan masih banyak lagi. Pokoknya
                                    mantappu jiwa produk yang kami tawarkan. “') }}
                        </p>
                    </div>
                    <div class="text-right mb-0">
                        <button class="btn btn-primary-yellow font-weight-bold pl-4 pr-4" style="border-radius:30px;
                                        font-size:14px;">{{__('Laporkan') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mr-0 mb-5">
        <div class="col-md-6 pl-2 pr-4 pb-4 pt-4 mb-4" style="border-radius:5px;">
            <label class="font-weight-bold mb-2 ml-0" style="font-size: 24px;">
                {{__('Catatan Tambahan') }}
            </label>
            <div class="input-group mb-3" style="height:120px;">
                <textarea class="form-control" style="font-size: 18px;" aria-label="Deskripsi Ulasan">
                        </textarea>
            </div>
        </div>
        <div class="col-md-6 bg-light-purple pl-4 pr-4 pt-2 pb-2 mt-4 mr-0" style="border-radius:10px;
                        font-size:18px;">
            <label class="SemiBold mb-4" style="font-size:24px;">
                {{__('Rincian Harga') }}
            </label>
            <div class="row justify-content-between mb-2">
                <div class="col-md-auto text-left">
                    <label class="mb-2">
                        {{__('Total Halaman') }}
                    </label>
                    <br>
                    <label class="mb-2">
                        {{__('Harga Cetak per Halaman') }}
                    </label>
                </div>
                <div class="col-md-auto text-right">
                    <label class="SemiBold mb-2">
                        {{__('2') }}
                    </label>
                    <br>
                    <label class="SemiBold mb-2">
                        {{__('Rp. 2.000') }}
                    </label>
                </div>
            </div>
            <label class="SemiBold mb-2">
                {{__('Fitur Tambahan') }}
            </label>
            {{-- @foreach ($collection as $item) --}}
            <div class="row justify-content-between">
                <div class="col-md-auto text-left">
                    <label class="mb-2">
                        {{__('Jilid Lem') }}
                    </label>
                </div>
                <div class="col-md-auto text-right">
                    <label class="SemiBold mb-2">
                        {{__('Rp. 2.000') }}
                    </label>
                </div>
            </div>
            {{-- @endforeach --}}
            <div class="row row-bordered"></div>
            <div class="row justify-content-between SemiBold mt-2">
                <div class="col-md-auto text-left">
                    <label>Total Harga Pesanan Kamu</label>
                </div>
                <div class="col-md-auto text-right">
                    <label>Rp. 20.000</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end ml-0 mr-0 mb-5">
        <div class="form-group mb-3 mr-4">
            <button class="btn btn-outline-purple font-weight-bold pl-4 pr-4" style="border-radius:30px;
                    font-size:24px;">
                {{__('Simpan Konfigurasi')}}
            </button>
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary-wakprint font-weight-bold pl-4 pr-4" style="border-radius:30px;
                        font-size:24px;">
                {{__('Simpan dan Lanjutkan')}}
            </button>
        </div>
    </div>
</div>
</div>
</div>
@endsection


@section('script')
<script>
    $('#filterProdukList span').on('click', function () {
        $('#filterProdukButton').text($(this).text());
        $('#filterProduk').val($(this).text());
    });
    $('#jenisPrinterList span').on('click', function () {
        $('#jenisPrinterButton').text($(this).text());
        $('#jenisPrinter').val($(this).text());
    });
    $('#ukuranKertasList span').on('click', function () {
        $('#ukuranKertasButton').text($(this).text());
        $('#ukuranKertas').val($(this).text());
    });
</script>
@endsection
