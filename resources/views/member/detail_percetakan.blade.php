<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row justify-content-between">
            <div class="col-md-10">
                <label class="text-break font-weight-bold"
                    style="font-size: 48px; max-width:90%;">
                    {{$partner->nama_toko}}
                </label>
            </div>
            <div class="col-md-auto">
                <img src="{{url('img/buka.png')}}"
                    class="img-responsive mr-0"
                    alt=""
                    width="130px"
                    height="60px">
            </div>
        </div>
        <label class="text-break mb-4" style="font-size:24px;">
            <i class="material-icons md-32 align-middle mr-2">
                location_on
            </i>
            {{$partner->alamat_toko}}
        </label>
        <div class="row justify-content-left ml-0 mb-0">
            <label class="SemiBold mr-4" style="font-size: 24px;">
                <i class="material-icons md-32 align-middle mr-2"
                    style="color:#FCFF82;">
                    star
                </i>
                {{$partner->rating_toko}} / 5
            </label>
                @if ($partner->ambil_di_tempat === 0 && $partner->antar_ke_tempat === 0)
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-1">
                            directions_run
                        </i>
                        {{__('Ambil di Tempat')}}
                    </label>
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-2">
                            local_shipping
                        </i>
                        {{__('Antar ke Rumah')}}
                    </label>
                @elseif($partner->ambil_di_tempat === 1 && $partner->antar_ke_tempat === 1)
                    <label class="mr-4" style="font-size: 18px;">
                        <i class="align-middle material-icons md-32 mr-1">
                            directions_run
                        </i>
                        {{__('Ambil di Tempat')}}
                    </label>
                    <label class="mr-4" style="font-size: 18px;">
                        <i class="align-middle material-icons md-32 mr-2">
                            local_shipping
                        </i>
                        {{__('Antar ke Rumah')}}
                    </label>
                @elseif($partner->ambil_di_tempat === 0 && $partner->antar_ke_tempat === 1)
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-1">
                            directions_run
                        </i>
                        {{__('Ambil di Tempat')}}
                    </label>
                    <label class="mr-4" style="font-size: 18px;">
                        <i class="align-middle material-icons md-32 mr-2">
                            local_shipping
                        </i>
                        {{__('Antar ke Rumah')}}
                    </label>
                @elseif($partner->ambil_di_tempat === 1 && $partner->antar_ke_tempat === 0)
                    <label class="mr-4" style="font-size: 18px;">
                        <i class="align-middle material-icons md-32 mr-1">
                            directions_run
                        </i>
                        {{__('Ambil di Tempat')}}
                    </label>
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-2">
                            local_shipping
                        </i>
                        {{__('Antar ke Rumah')}}
                    </label>
                @else
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-1">
                            directions_run
                        </i>
                        {{__('Ambil di Tempat')}}
                    </label>
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-2">
                            local_shipping
                        </i>
                        {{__('Antar ke Rumah')}}
                    </label>
                @endif
                @foreach ($atk as $a)
                    @if($a->id_pengelola === $partner->id_pengelola && $a->status === 'Tersedia')
                        <label class="mr-4" style="font-size: 18px;">
                            <i class="align-middle material-icons md-32 mr-2">
                                architecture
                            </i>
                            {{__('Alat Tulis Kantor')}}
                        </label>
                    @break
                    @else
                        <label class="mr-4" style="font-size: 18px;" hidden>
                            <i class="align-middle material-icons md-32 mr-2">
                                architecture
                            </i>
                            {{__('Alat Tulis Kantor')}}
                        </label>
                    @endif
                @endforeach
        </div>
        <div class="row justify-content-between ml-0 mr-0">
            <div class="bg-light-purple col-md-4 p-3 mt-5"
                style="border-radius:10px;">
                <div class="text-center mb-4"
                style="position:relative;">
                <img class="img-responsive"
                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                    alt=""
                    style="width:300px;
                        height:200px;">
                </div>
                <div class="row justify-content-left mb-5">
                    <span class="align-self-center col-md-1 mr-0">
                        <a class="text-primary-purple"
                            href="#multi-item-foto-percetakan"
                            role="button"
                            data-slide="prev">
                            <i class="material-icons md-32">
                                chevron_left
                            </i>
                        </a>
                    </span>

                        <!--Carousel Wrapper-->
                    <div id="multi-item-foto-percetakan" class="carousel slide carousel-multi-item col-md-9" data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            {{-- @foreach ($collection as $item) --}}
                                <div class="carousel-item active">

                                    <div class="row">

                                        {{-- @foreach ($collection as $item) --}}
                                            <div class="col-md-auto mr-0">
                                                <img class="img-responsive" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
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

                    <span class="align-self-center">
                        <a class="text-primary-purple"
                            href="#multi-item-foto-percetakan"
                            role="button"
                            data-slide="next">
                            <i class="material-icons md-32">
                                chevron_right
                            </i>
                        </a>
                    </span>
                </div>
                <div class="container">
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Pemilik Percetakan')}}
                    </label>
                    <label class="text-truncate mb-4"
                        style="width: 100%;
                            font-size: 18px;">
                        <img class="img-responsive align-self-center mr-2"
                            src="https://ptetutorials.com/images/user-profile.png"
                            width="40"
                            height="40"
                            alt="no logo">
                            {{$partner->nama_lengkap}}
                        </label>
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Deskripsi Percetakan')}}
                    </label>
                    <br>
                    <label class="mb-4"
                        style="font-size: 14px;">
                        {{$partner->deskripsi_toko}}
                    </label>
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Jam Operasional Percetakan')}}
                    </label>
                    <br>
                    @if (!empty($partner->jam_op_buka) && !empty($partner->jam_op_tutup))
                        <label class="mb-4"
                            style="font-size: 14px;">
                            <i class="material-icons md-12 align-middle mr-3">
                                fiber_manual_record
                            </i>
                            Pukul {{ date_create($partner->jam_op_buka)->format('H:i')}} - {{ date_create($partner->jam_op_tutup)->format('H:i')}} WIB
                        </label>
                        <br>
                    @else
                        <label class="mb-2"
                            style="font-size: 14px;">
                            {{__('-')}}
                        </label>
                        <br>
                    @endif
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Syarat & Ketentuan Percetakan')}}
                    </label>
                    <br>
                    @if (!empty($partner->syaratkententuan))
                        <div class="row justify-content-left mb-2"
                            style="font-size: 14px;">
                            <i class="col-md-1 material-icons md-12 mr-1 mt-1">
                                fiber_manual_record
                            </i>
                            <label class="col-md-10 mb-2"
                                style="font-size: 14px;">
                                {{$partner->syaratkententuan}}
                            </label>
                        </div>
                        <br>
                    @else
                        <label class="mb-2"
                            style="font-size: 14px;">
                            {{__('-')}}
                        </label>
                        <br>
                    @endif
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('ATK')}}
                    </label>
                    <br>
                    @foreach ($atk as $a)
                        @if ($a->id_pengelola === $partner->id_pengelola)
                            <div class="row justify-content-between" style="font-size: 14px;">
                                <div class="col-md-auto text-left">
                                    <label class="mb-2">
                                        {{$a->nama}}
                                        <i class="material-icons md-18 align-middle ml-2 mr-4"
                                        style="color:#C4C4C4">
                                            help
                                        </i>
                                        x {{$a->jumlah}}
                                    </label>
                                </div>
                                <div class="col-md-auto text-right">
                                    <label class="mb-2">
                                        Rp. {{$a->harga}}
                                    </label>
                                </div>
                            </div>
                        @else
                            <label>-</label>
                        @break
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-8 mt-5">
                <div class="search-input mr-0 ml-3 mb-4">
                    <div class="main-search-input-item mr-0">
                        <input type="text"
                            role="search"
                            class="form-control"
                            placeholder="Cari produk disini"
                            aria-label="Cari produk disini"
                            aria-describedby="basic-addon2"
                            style="border:0px solid white;
                                border-radius:30px;
                                font-size:18px;">
                            <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute;
                                top: 50%; left: 95%;
                                transform: translate(-50%, -50%);
                                -ms-transform:
                                translate(-50%, -50%);">
                                search
                            </i>
                    </div>
                </div>

                <div class="row justify-content-between mb-4 ml-0">
                    <div class="col-md-3">
                        <div class="btn-group btn-group-toggle mb-4"
                            data-toggle="buttons">
                            <label id="semua"
                                class="btn btn-yellow-wakprint btn-outline-black mr-1 pt-1 pb-1 pl-4 pr-4"
                                style="border-radius:30px;
                                    font-size:18px;">
                                <input type="checkbox"
                                    checked
                                    autocomplete="off">
                                    {{__('Semua')}}
                            </label>
                        </div>
                        <div class="dropdown">
                            <input name="filter_produk" type="text" id="filterProduk" Class="form-control" hidden>
                            <button id="filterProdukButton"
                                class="is-flex btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
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
                    @php
                        $ukuranKertas= array('A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr',
                        'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr');
                    @endphp
                    <div class="col-md-9">
                        <div class="scrolling-wrapper mb-2 ml-0 mr-0">
                            <div class="btn-group btn-group-toggle pb-2"
                                data-toggle="buttons">
                                @foreach ($ukuranKertas as $kertas)
                                    <label id="a4"
                                        class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4"
                                        style="border-radius:30px;
                                            font-size:18px;">
                                        <input type="checkbox"
                                            checked
                                            autocomplete="off">
                                            {{$kertas}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @php
                            $jenisPrinter= array('Ink Jet', 'Laser Jet');
                        @endphp
                        <div class="scrolling-wrapper">
                            <div class="btn-group btn-group-toggle"
                                data-toggle="buttons">
                                @foreach ($jenisPrinter as $printer)
                                    <label id="a4"
                                        class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4"
                                        style="border-radius:30px;
                                            font-size:18px;">
                                        <input type="checkbox"
                                            checked
                                            autocomplete="off">
                                            {{$printer}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4 ml-3"
                    style="border-radius:5px;">
                    <label class="SemiBold mb-3 ml-0"
                        style="font-size: 18px;">
                        {{__('Paket')}}
                    </label>
                    <br>
                    @php
                        $paket = array('Lem','Baut','Kawat','Spiral');
                    @endphp
                    <div class="container"
                        style="font-size: 14px;">
                            <label class="SemiBold mb-2 ml-0">
                                {{__('Jilid')}}
                            </label>
                            <div class="row justify-content-left ml-0">
                                @foreach ($paket as $p)
                                    <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                        <input type="checkbox"
                                            name="checkbox_paket{{ $p }}"
                                            class="custom-control-input"
                                            id="checkboxPaket{{ $p }}">
                                        <label class="custom-control-label"
                                            for="checkboxPaket{{ $p }}">
                                            {{$p}}
                                            <i class="material-icons md-18 align-middle ml-2"
                                                style="color:#C4C4C4">
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
                    <label class="SemiBold mt-3 mb-2 ml-0"
                        style="font-size: 18px;">
                        {{__('Non-Paket')}}
                    </label>
                    <div class="row justify-content-left ml-0"
                        style="font-size: 14px;">
                        @foreach ($nonPaket as $np)
                            <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                <input type="checkbox"
                                    class="custom-control-input"
                                    id="checkboxNonPaket{{$np}}">
                                <label class="custom-control-label"
                                    for="checkboxNonPaket{{$np}}">
                                    {{$np}}
                                    <i class="material-icons md-18 align-middle ml-2"
                                    style="color:#C4C4C4">
                                        help
                                    </i>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="my-custom-scrollbar">
                    <div class="row justify-content-between mb-4">
                        @foreach ($produk as $p)
                            @if ($p->id_pengelola === $partner->id_pengelola)
                                <div class="col-md-6 mb-4">
                                    <div class="col-md-auto mb-4">
                                        <div class="card shadow mb-2" style="border-radius: 10px;">
                                            <a class="text-decoration-none" href="{{ route('detail.produk',$p->id_produk) }}" style="color: black;">
                                                @if (!empty($p->jumlah_diskon))
                                                    <div class="text-center" style="position: relative;">
                                                        <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                                            width:75px;
                                                            height:50px;
                                                            border-radius:0px 0px 8px 8px;">
                                                                <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-center" style="position: relative;" hidden>
                                                        <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                                            width:75px;
                                                            height:50px;
                                                            border-radius:0px 0px 8px 8px;">
                                                                <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                                        </div>
                                                    </div>
                                                @endif
                                                <i class="fa fa-heart fa-2x fa-responsive"
                                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                                </i>
                                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                                alt="Card image cap"/>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{$partner->nama_toko ?? '-'}}</label>
                                                        <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                                    </div>
                                                    <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">{{$p->nama ?? '-'}}</label>
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
                                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? '-'}}</label>
                                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                                        <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? '-'}}</label>
                                                    </div>
                                                </div>
                                                <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                                    <div class="row justify-content-between ml-0">
                                                        <div class="">
                                                            @if (!empty($p->jumlah_diskon))
                                                                @php
                                                                    $jumlahDiskonGray = $p->harga_hitam_putih * $p->jumlah_diskon;
                                                                    $jumlahDiskonWarna = $p->harga_berwarna * $p->jumlah_diskon;

                                                                    if($jumlahDiskonGray > $p->maksimal_diskon){
                                                                        $hargaHitamPutih = $p->harga_hitam_putih - $p->maksimal_diskon;
                                                                        $hargaBerwarna = $p->harga_berwarna - $p->maksimal_diskon;
                                                                    }
                                                                    else{
                                                                        $hargaHitamPutih = $p->harga_hitam_putih - $jumlahDiskonGray;
                                                                        $hargaBerwarna = $p->harga_berwarna - $jumlahDiskonWarna;
                                                                    }
                                                                @endphp
                                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                                    Rp. <del>{{$p->harga_hitam_putih ?? '-'}}</del>
                                                                </label>
                                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                                    {{$hargaHitamPutih ?? '-'}}
                                                                </label>
                                                            @else
                                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                                    Rp. {{$p->harga_hitam_putih ?? '-'}}
                                                                </label>
                                                            @endif
                                                            <label class="card-text SemiBold badge-sm badge-light px-1" style="font-size: 12px; border-radius:5px;">
                                                                {{__('Hitam-Putih')}}
                                                            </label>
                                                            <br>
                                                            @if (!empty($p->harga_berwarna) && !empty($p->jumlah_diskon))
                                                                <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                                    Rp. <del>{{$p->harga_berwarna ?? '-'}}</del>
                                                                </label>
                                                                <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                                    {{$hargaBerwarna ?? '-'}}
                                                                </label>
                                                                <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1" style="font-size: 12px; border-radius:5px;">
                                                                    {{__('Berwarna')}}
                                                                </label>
                                                            @else
                                                                <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;" hidden>
                                                                    Rp. {{$p->harga_berwarna ?? '-'}}
                                                                </label>
                                                                <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1" style="font-size: 12px; border-radius:5px;" hidden>
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
                                </div>
                            @endif
                        @endforeach
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
</script>
@endsection

