<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row justify-content-between">
            <div class="col-md-10">
                <label class="text-break font-weight-bold" style="font-size: 48px; max-width:90%;">
                    {{ $partner->nama_toko }}
                </label>
            </div>
            <div class="col-md-auto">
                <img src="{{ url('img/buka.png') }}" class="img-responsive mr-0" alt="" width="130px" height="60px">
            </div>
        </div>
        <div class="row justify-content-start mb-4">
            <i class="col-md-auto material-icons md-32">
                location_on
            </i>
            <label class="col-md-10 text-break" style="font-size:24px;">
                {{ $partner->alamat_toko }}
            </label>
        </div>

        <div class="row justify-content-left ml-0 mb-0">
            <label class="SemiBold mr-4" style="font-size: 24px;">
                <i class="material-icons md-32 align-middle mr-2" style="color:#FCFF82;">
                    star
                </i>
                @foreach ($produk as $p)
                    @if (!empty($p) && $p->id_pengelola === $p->partner->id_pengelola)
                        {{ round($ratingPartner, 1) }} / 5
                    @else
                        {{ $p->partner->rating_toko }} / 5
                    @endif
                    @break
                @endforeach
            </label>
            @if ($partner->ambil_di_tempat === 0 && $partner->antar_ke_tempat === 0)
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @elseif($partner->ambil_di_tempat === 1 && $partner->antar_ke_tempat === 1)
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @elseif($partner->ambil_di_tempat === 0 && $partner->antar_ke_tempat === 1)
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @elseif($partner->ambil_di_tempat === 1 && $partner->antar_ke_tempat === 0)
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @else
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{ __('Ambil di Tempat') }}
                </label>
                <label class="mr-4" style="font-size: 18px;" hidden>
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{ __('Antar ke Rumah') }}
                </label>
            @endif
            @foreach ($atk as $a)
                @if ($a->id_pengelola === $partner->id_pengelola && $a->status === 'Tersedia')
                    <label class="mr-4" style="font-size: 18px;">
                        <i class="align-middle material-icons md-32 mr-2">
                            architecture
                        </i>
                        {{ __('Alat Tulis Kantor') }}
                    </label>
                    @break
                @else
                    <label class="mr-4" style="font-size: 18px;" hidden>
                        <i class="align-middle material-icons md-32 mr-2">
                            architecture
                        </i>
                        {{ __('Alat Tulis Kantor') }}
                    </label>
                @endif
            @endforeach
        </div>
        <div class="row justify-content-between ml-0 mr-0">
            <div class="col-md-4 mt-5">
                <div class="row justify-content-between bg-light-purple p-3" style="border-radius:10px;">
                    <div class="mb-4" style="border-bottom: 1px solid #BC41BE">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Nilai Persentase Minimum Toleransi Halaman Berwarna') }}
                        </label>
                        <label class="mb-4" style="font-size: 18px;">
                            {{ $partner->ntkwh ?? 0 }} %
                        </label>
                    </div>
                    <div class="mx-auto mb-4" style="position:relative;">
                        @if (count($partner->getMedia('foto_percetakan')) > 0)
                            <a data-fancybox="gallery" id="linkFotoPercetakan"
                                href="{{ $partner->getFirstMediaUrl('foto_percetakan') }}">
                                <img id="fotoPercetakanUtama" class="img-responsive"
                                    src="{{ $partner->getFirstMediaUrl('foto_percetakan') }}" alt="no picture"
                                    style="width:300px; height:200px; object-fit:cover;">
                            </a>
                        @else
                            <a data-fancybox="gallery" id="linkFotoPercetakan"
                                href="{{$partner->foto_percetakan[0]}}">
                                <img id="fotoPercetakanUtama" class="img-responsive"
                                    src="{{$partner->foto_percetakan[0]}}" alt=""
                                    style="width:300px; height:200px; object-fit:cover;">
                            </a>
                        @endif
                    </div>
                    @if (count($partner->getMedia('foto_percetakan')) > 0)
                        <div class="row justify-content-left mb-5 mr-0">
                            <div class="col-md-1 owl-nav align-self-center">
                                <a class="foto-percetakan-prev text-primary-purple cursor-pointer disabled"
                                    role="presentation">
                                    <i class="material-icons md-28 text-primary-purple">
                                        chevron_left
                                    </i>
                                </a>
                            </div>
                            <div id="foto-percetakan-carousel"
                                class="col-md-9 owl-carousel owl-theme owl-loaded owl-drag owl-loading">
                                @if (count($partner->getMedia('foto_percetakan')) > 0)
                                    @foreach ($partner->getMedia('foto_percetakan') as $p => $value)
                                        <img id="klikFotoPercetakan{{ $p }}" class="img-responsive imgPercetakan"
                                            src="{{ $value->getUrl() }}" alt="no picture"
                                            onclick="changeFotoPercetakan(this.src)"
                                            style="width:50px; height:50px; object-fit:cover;" />
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-1 owl-nav align-self-center">
                                <a class="foto-percetakan-next cursor-pointer" role="presentation">
                                    <i class="material-icons md-28 text-primary-purple">
                                        chevron_right
                                    </i>
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="container">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Pemilik Percetakan') }}
                        </label>
                        <label class="text-truncate mb-4" style="width: 100%; font-size: 18px;">
                            <img class="img-responsive align-self-center mr-2" src="{{$partner->avatar}}" width="40" height="40" alt="no logo" style="border-radius: 30px; border:solid 2px #BC41BE; object-fit:cover;">
                            {{ $partner->nama_lengkap }}
                        </label>
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Deskripsi Percetakan') }}
                        </label>
                        <br>
                        <label class="mb-4" style="font-size: 14px;">
                            {{ $partner->deskripsi_toko ?? '-' }}
                        </label>
                        <br>
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Jam Operasional Percetakan') }}
                        </label>
                        <br>
                        @if (!empty($partner->jam_op_buka) && !empty($partner->jam_op_tutup))
                            <label class="mb-4" style="font-size: 14px;">
                                <i class="material-icons md-12 align-middle mr-3">
                                    fiber_manual_record
                                </i>
                                Pukul {{ date_create($partner->jam_op_buka)->format('H:i') }} -
                                {{ date_create($partner->jam_op_tutup)->format('H:i') }} WIB
                            </label>
                            <br>
                        @else
                            <label class="mb-2" style="font-size: 14px;">
                                {{ __('-') }}
                            </label>
                            <br>
                        @endif
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Syarat & Ketentuan Percetakan') }}
                        </label>
                        <br>
                        @if (!empty($partner->syaratkententuan))
                            <div class="row justify-content-left mb-2" style="font-size: 14px;">
                                <i class="col-md-1 material-icons md-12 mr-1 mt-1">
                                    fiber_manual_record
                                </i>
                                <label class="col-md-10 mb-2" style="font-size: 14px;">
                                    {{ $partner->syaratkententuan }}
                                </label>
                            </div>
                            <br>
                        @else
                            <label class="mb-2" style="font-size: 14px;">
                                {{ __('-') }}
                            </label>
                            <br>
                        @endif
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('ATK') }}
                        </label>
                        <br>
                        @if (!empty($atk))
                            @foreach ($atk as $a)
                                @if ($a->id_pengelola === $partner->id_pengelola)
                                    <div class="row justify-content-left" style="font-size: 14px;">
                                        <div class="col-md-5 text-left">
                                            <label class="mb-2">
                                                {{ $a->nama }}
                                            </label>
                                        </div>
                                        {{-- <div class="col-md-2">
                                            <i class="material-icons md-18 align-middle ml-2 mr-4" style="color:#C4C4C4">
                                                help
                                            </i>
                                        </div> --}}
                                        <div class="col-md-3 text-left">
                                            <label class="mb-2">
                                                x {{ $a->jumlah }}
                                            </label>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <label class="mb-2">
                                                {{ rupiah($a->harga) }}
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <label>-</label>
                        @endif
                    </div>
                </div>
            </div>
            <div id="pencarianDetailPartnerVue" class="col-md-8 mt-5">
                <pencarian-produk-parner-component :produks="{{ $produk }}">
                </pencarian-produk-parner-component>
                {{-- <div class="search-input mr-0 ml-3 mb-4">
                    <div class="main-search-input-item mr-0">
                        <input id="keyword" type="text" role="search" class="form-control" placeholder="Cari produk disini"
                            aria-label="Cari produk disini" aria-describedby="basic-addon2"
                            style="border:0px solid white; border-radius:30px; font-size:18px;">
                        <i id="cari" class="material-icons cursor-pointer ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute; top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            search
                        </i>
                    </div>
                </div> --}}
                {{-- <div class="row justify-content-between mb-4 ml-0">
                    <div class="col-md-3">
                        <div class="btn-group btn-group-toggle mb-4" data-toggle="buttons">
                            <label id="semua" class="btn btn-yellow-wakprint btn-outline-black mr-1 pt-1 pb-1 pl-4 pr-4"
                                style="border-radius:30px; font-size:18px;">
                                <input id="checkboxSemua" type="checkbox" checked autocomplete="off">
                                {{ __('Semua') }}
                            </label>
                        </div>
                        <div class="dropdown">
                            <input name="filter_produk" type="text" id="filterProduk" Class="form-control" hidden>
                            <button id="filterProdukButton"
                                class="is-flex btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                                id="dropdownFilterProduk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="font-size: 16px; text-align:left;">
                                {{ __('Urutkan') }}
                            </button>
                            @php
                            $filterProduk= array('Terbaru', 'Harga Tertinggi', 'Harga Terendah');
                            @endphp
                            <div id="filterProdukList" class="dropdown-menu" aria-labelledby="dropdownKertas"
                                style="font-size: 16px; width:100%;">
                                @foreach ($filterProduk as $fp)
                                    <span class="dropdown-item cursor-pointer ">
                                        {{ $fp }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @php
                    $ukuranKertas= array('A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr',
                    'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LetterHVS80gr');
                    @endphp
                    <div class="col-md-9">
                        <div class="scrolling-wrapper mb-2 ml-0 mr-0">
                            <div class="btn-group btn-group-toggle pb-2" data-toggle="buttons">
                                @foreach ($ukuranKertas as $key => $kertas)
                                    <label class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4"
                                        style="border-radius:30px; font-size:18px;">
                                        <input id="jenisKertas{{ $key }}" type="checkbox" checked autocomplete="off"
                                            value="{{ $kertas }}">
                                        {{ $kertas }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @php
                        $jenisPrinter= array('Ink Jet', 'Laser Jet');
                        @endphp
                        <div class="scrolling-wrapper">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach ($jenisPrinter as $key => $printer)
                                    <label class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4"
                                        style="border-radius:30px; font-size:18px;">
                                        <input id="jenisPrinter{{ $key }}" type="checkbox" checked autocomplete="off"
                                            value="{{ $printer }}">
                                        {{ $printer }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4 ml-3" style="border-radius:5px;">
                    <label class="SemiBold mb-3 ml-0" style="font-size: 18px;">
                        {{ __('Fitur') }}
                    </label>
                    <br>
                    @php
                    $paket = array('Lem','Baut','Kawat','Spiral');
                    @endphp
                    <div class="container" style="font-size: 14px;">
                        <label class="SemiBold mb-2 ml-0">
                            {{ __('Jilid') }}
                        </label>
                        <div class="row justify-content-left ml-0">
                            @foreach ($paket as $p)
                                <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                    <input type="checkbox" name="checkbox_paket{{ $p }}" class="custom-control-input"
                                        id="checkboxPaket{{ $p }}" value="{{ $p }}">
                                    <label class="custom-control-label" for="checkboxPaket{{ $p }}">
                                        {{ $p }}
                                        <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">help</i>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php
                    $nonPaket = array('Hekter','Kliping','Penjepit Kertas','Plastik Transparan','Kertas Jeruk');
                    @endphp
                    <label class="SemiBold mt-3 mb-2 ml-0">
                        {{ __('Lainnya') }}
                    </label>
                    <div class="row justify-content-left ml-0" style="font-size: 14px;">
                        @foreach ($nonPaket as $np)
                            <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                <input type="checkbox" class="custom-control-input" id="checkboxNonPaket{{ $np }}"
                                    value="{{ $np }}">
                                <label class="custom-control-label" for="checkboxNonPaket{{ $np }}">
                                    {{ $np }}
                                    <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">help</i>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mr-0 ml-2">
                    <div class="produk row justify-content-between mb-4 ml-0 mr-0">
                        <input id="idPartner" type="number" value="{{ $partner->id_pengelola }}" hidden>
                        @foreach ($produk as $p)
                            <div class="col-md-6 mb-4">
                                @include('member.card_produk')
                            </div>
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        var fotoPercetakan = $('#fotoPercetakan').val();
        var fotoPercetakanCarousel = $("#foto-percetakan-carousel");

        // Percetakan Navigation Events
        $(".foto-percetakan-next").on('click', function() {
            fotoPercetakanCarousel.trigger('next.owl.carousel');
        });
        $(".foto-percetakan-prev").on('click', function() {
            fotoPercetakanCarousel.trigger('prev.owl.carousel');
        });

        fotoPercetakanCarousel.owlCarousel({
            loop: false,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });

        $('img').each(function(index, value) {
            $('#klikFotoPercetakan' + 0).css('border', "solid 2px #BC41BE");
            $('#klikFotoPercetakan' + index).on('click', function(e) {
                $('.imgPercetakan').css('border', "solid 0px #BC41BE");
                $(this).css('border', "solid 2px #BC41BE");
            });
        });

        function changeFotoPercetakan(src) {
            document.getElementById('fotoPercetakanUtama').src = src;
            document.getElementById('linkFotoPercetakan').href = src;
        }

    </script>
@endsection
