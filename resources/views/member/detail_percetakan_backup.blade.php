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
                        <img class="img-responsive"
                            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" alt="" style="width:300px;
                                    height:200px;">
                    </div>
                    <div class="row justify-content-left mb-5">
                        <span class="align-self-center col-md-1 mr-0">
                            <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button"
                                data-slide="prev">
                                <i class="material-icons md-32">
                                    chevron_left
                                </i>
                            </a>
                        </span>

                        <!--Carousel Wrapper-->
                        <div id="multi-item-foto-percetakan" class="carousel slide carousel-multi-item col-md-8"
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
                                                {{--
                                            @endforeach --}}

                                        </div>
                                    </div>
                                    {{--
                                @endforeach --}}

                            </div>
                            <!--/.Slides-->

                        </div>
                        <!--/.Carousel Wrapper-->

                        <span class="align-self-center col-md-1">
                            <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button"
                                data-slide="next">
                                <i class="material-icons md-32">
                                    chevron_right
                                </i>
                            </a>
                        </span>
                    </div>
                    <div class="container">
                        <label class="SemiBold mb-2" style="font-size: 18px;">
                            {{ __('Pemilik Percetakan') }}
                        </label>
                        <label class="text-truncate mb-4" style="width: 100%;
                                    font-size: 18px;">
                            @if (!empty($partner->getFirstMediaUrl()))
                                <img class="img-responsive border border-gray align-self-center mr-2"
                                    src="{{ $partner->getFirstMediaUrl() }}" width="40" height="40" alt="no logo"
                                    style="border-radius: 30px;">
                            @else
                                <img class="img-responsive border border-gray align-self-center mr-2"
                                    src="https://ptetutorials.com/images/user-profile.png" width="40" height="40"
                                    alt="no logo" style="border-radius: 30px;">
                            @endif
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
                                        <div class="col-md-3 text-left">
                                            <label class="mb-2">
                                                {{ $a->nama }}

                                                {{-- x {{ $a->jumlah }}
                                                --}}
                                            </label>
                                        </div>
                                        <div class="col-md-2">
                                            <i class="material-icons md-18 align-middle ml-2 mr-4" style="color:#C4C4C4">
                                                help
                                            </i>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <label class="mb-2">
                                                x {{ $a->jumlah }}
                                            </label>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <label class="mb-2">
                                                Rp. {{ $a->harga }}
                                            </label>
                                        </div>
                                    </div>
                                    {{-- @else
                                    <label>-</label>
                                    @break --}}
                                @endif
                            @endforeach
                        @else
                            <label>-</label>
                        @endif
                    </div>
                </div>
            </div>
            <div id="pencarianProduk" class="col-md-8 mt-5">
                <div class="search-input mr-0 ml-3 mb-4">
                    <div class="main-search-input-item mr-0">
                        <input id="keyword" type="text" role="search" class="form-control" placeholder="Cari produk disini"
                            aria-label="Cari produk disini" aria-describedby="basic-addon2"
                            style="border:0px solid white; border-radius:30px; font-size:18px;">
                        <i id="cari" class="material-icons cursor-pointer ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute; top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            search
                        </i>
                    </div>
                </div>
                <div class="row justify-content-between mb-4 ml-0">
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
                            @if ($p->id_pengelola === $partner->id_pengelola)
                                <div class="col-md-6 mb-4">
                                    @include('member.card_produk')
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
        $(document).ready(function() {
            var idPartner = $('#idPartner').val();

            var jk = ['A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr', 'LegalHVS70gr',
                'LegalHVS80gr', 'LetterHVS70gr', 'LetterHVS80gr'
            ];
            var jp = ['Ink Jet', 'Laser Jet'];

            var jenisKertas = [];
            var jenisPrinter = [];
            var hasilFitur = [];

            // $('input[type=checkbox]').on('click change', function(){
            //     for (let i = 0; i < jk.length; i++) {
            //         if($('#jenisKertas' + i).is(':checked')){
            //             jenisKertas.push($('#jenisKertas' + i).val());
            //             console.log(jenisKertas);
            //         }
            //         else {
            //             var pos = jenisKertas.indexOf($('#jenisKertas' + i).val());
            //             if(pos > -1){
            //                 jenisKertas.splice(pos, 1);
            //             }
            //             console.log(jenisKertas);
            //         }
            //         // $('#jenisKertas' + i).on('click change', function(){
            //         //     if($('#jenisKertas' + i).checked){
            //         //         jenisKertas.push($('#jenisKertas' + i).val());
            //         //         console.log(jenisKertas);
            //         //     }
            //         //     else {
            //         //         var pos = jenisKertas.indexOf($('#jenisKertas' + i).val());
            //         //         if(pos > -1){
            //         //             jenisKertas.splice(pos, 1);
            //         //         }
            //         //         console.log(jenisKertas);
            //         //     }
            //         // });
            //     }
            // })

            // console.log(true);
            for (i = 0; i < jk.length; i++) {
                $('#semua').on('click', function() {

                    if ($('#jenisKertas' + i).is(':checked')) {
                        // jenisKertas = [];
                        $('#jenisKertas' + i).not('#jenisKertas' + i).prop('checked', $('#jenisKertas' + i)
                            .checked);
                        // console.log(jenisKertas);
                    } else {
                        $('#jenisKertas' + i).prop('checked', $('#jenisKertas' + i).checked);
                        // jenisKertas.push($('#jenisKertas' + i).val());
                        // console.log(jenisKertas);
                    }

                });
            }

            $('input[type=checkbox]').each(function(index, value) {
                // $('#jenisPrinter' + index).bind('change', function(){
                //     if($('#jenisPrinter' + index).checked){
                //         jenisPrinter.push($(this).val());
                //         console.log(jenisPrinter);
                //     }
                //     else {
                //         var pos = jenisPrinter.indexOf($(this).val());
                //         if(pos > -1){
                //             jenisPrinter.splice(pos, 1);
                //         }
                //         console.log(jenisPrinter);
                //     }
                // });
                $(this).bind('change', function() {
                    if (this.checked) {
                        hasilFitur.push($(this).val());
                        searching();
                    } else {
                        var pos = hasilFitur.indexOf($(this).val());
                        if (pos > -1) {
                            hasilFitur.splice(pos, 1);
                        }
                        searching();
                    }
                });
            });

            $('#filterProdukList span').on('click', function() {
                $('#filterProdukButton').text($(this).text());
                $('#filterProduk').val($(this).text());
                searching();
            });
            $('#cari').on('click', function() {
                searching();
            });

            function searching() {
                var data = {
                    keyword: $('#keyword').val(),
                    jenisKertas: jenisKertas,
                    jenisPrinter: jenisPrinter,
                    ambilDiTempat: $('#ambilDiTempat').val(),
                    antarKeTempat: $('#antarKeTempat').val(),
                    fiturTambahan: hasilFitur,
                    filterPencarian: $('#filterProduk').val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('
                    cari ') }}',
                    method: 'GET',
                    data: data,
                    dataType: 'json',

                    beforeSend: function() {
                        $('.produk').css('color', '#dfecf6');
                        $('.produk').html(
                            '<div class="mx-auto"><img id="imgLoading" style="" src="/img/loading.gif" /></div>'
                            );
                    },
                    uploadProgress: function() {
                        $('#imgLoading').show();
                    },
                    success: function(produks) {
                        var produkItem = '<div class="row justify-content-between ml-0 mr-0">';
                        if (produks['produks'].length != 0) {
                            for (i = 0; i < produks['produks'].length; i++) {
                                if (produks['produks'][i].id_pengelola != idPartner) {

                                } else {
                                    var idProduk = produks['produks'][i].id_produk;
                                    var urlDetailProduk = "{{ route('detail.produk', '') }}" + "/" +
                                        idProduk;

                                    var jumlahDiskonGray = produks['produks'][i].harga_hitam_putih *
                                        produks['produks'][i].jumlah_diskon;
                                    var jumlahDiskonWarna = produks['produks'][i].harga_berwarna *
                                        produks['produks'][i].jumlah_diskon;

                                    if (jumlahDiskonGray > produks['produks'][i].maksimal_diskon) {
                                        var hargaHitamPutih = produks['produks'][i].harga_hitam_putih -
                                            produks['produks'][i].maksimal_diskon;
                                        var hargaBerwarna = produks['produks'][i].harga_berwarna -
                                            produks['produks'][i].maksimal_diskon;
                                    } else {
                                        var hargaHitamPutih = produks['produks'][i].harga_hitam_putih -
                                            jumlahDiskonGray;
                                        var hargaBerwarna = produks['produks'][i].harga_berwarna -
                                            jumlahDiskonWarna;
                                    }
                                    produkItem += '<div class="col-md-6 mb-4">';
                                    produkItem +=
                                        '<div class="card shadow mb-2" style="border-radius: 10px;">';
                                    produkItem += '<a class="text-decoration-none" href="' +
                                        urlDetailProduk + '" style="color: black;">'
                                    if (produks['produks'][i].jumlah_diskon != null) {
                                        produkItem +=
                                            '<div class="text-center" style="position: relative;">';
                                        produkItem +=
                                            '<div class="bg-promo" style="position: absolute; top: 55%; left: 10%; width:75px; height:50px; border-radius:0px 0px 8px 8px;">';
                                        produkItem +=
                                            '<label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">Promo</label>';
                                        produkItem += '</div>';
                                        produkItem += '</div>';
                                    }
                                    produkItem +=
                                        '<button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>';

                                    // if(produks['members'].cekProdukFavorit(produks['members'].id_member,produks['produks'][i].id_produk)){
                                    //     produkItem +='<button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer text-danger" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>';
                                    // }
                                    // else{
                                    //     produkItem +='<button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>';
                                    // }
                                    produkItem +=
                                        '<img class="card-img-top cursor-pointer" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" onclick="window.location.href=" style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap"/>';
                                    produkItem +=
                                        '<div class="card-body cursor-pointer" onclick="window.location.href=">';
                                    produkItem += '<div class="row justify-content-between">';
                                    produkItem +=
                                        '<label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">' +
                                        produks['nama_partner_dari_produk'][i] + '</label>';
                                    produkItem +=
                                        '<label class="col-md-auto card-text text-right mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i>100 m</label>';
                                    produkItem += '</div>';
                                    produkItem +=
                                        '<label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">' +
                                        produks['produks'][i].nama + '</label>';
                                    produkItem +=
                                        '<label class="card-text text-truncate-multiline" style="font-size: 18px; min-height:65px;">' +
                                        produks['alamat_partner_dari_produk'][i] + '</label>';
                                    produkItem += '<div class="row justify-content-left ml-0 mr-0">';
                                    produkItem +=
                                        '<label class="card-text text-truncate SemiBold mr-2" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>' +
                                        produks['produks'][i].jenis_kertas + '</label>';
                                    produkItem +=
                                        '<label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>' +
                                        produks['produks'][i].jenis_printer + '</label>';
                                    produkItem += '</div>';
                                    produkItem += '</div>';
                                    produkItem +=
                                        '<div class="card-footer card-footer-primary cursor-pointer" onclick="window.location.href=" style="border-radius: 0px 0px 10px 10px;">';
                                    produkItem += '<div class="row justify-content-between ml-0 mr-0">';
                                    produkItem += '<div>'
                                    if (produks['produks'][i].harga_hitam_putih != null && produks[
                                            'produks'][i].harga_berwarna != null && produks['produks'][
                                            i].jumlah_diskon != null) {
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. <del>' +
                                            produks['produks'][i].harga_hitam_putih + '</del></label>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. ' +
                                            hargaHitamPutih + '</label>';
                                        produkItem += '</br>';
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Rp. ' +
                                            produks['produks'][i].harga_berwarna + '</label>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Rp. ' +
                                            hargaBerwarna + '</label>';
                                    } else if (produks['produks'][i].harga_hitam_putih != null &&
                                        produks['produks'][i].jumlah_diskon != null) {
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. <del>' +
                                            produks['produks'][i].harga_hitam_putih + '</del></label>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. ' +
                                            hargaHitamPutih + '</label>';
                                        produkItem += '</br>';
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Tidak Tersedia</label>';
                                    } else if (produks['produks'][i].harga_berwarna != null) {
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. ' +
                                            produks['produks'][i].harga_hitam_putih + '</label>';
                                        produkItem += '</br>';
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Rp. ' +
                                            produks['produks'][i].harga_berwarna + '</label>';
                                    } else {
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. ' +
                                            produks['produks'][i].harga_hitam_putih + '</label>';
                                        produkItem += '</br>';
                                        produkItem +=
                                            '<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                        produkItem +=
                                            '<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Tidak Tersedia</label>';
                                    }
                                    produkItem += '</div>';
                                    produkItem += '<div class="my-auto">';
                                    produkItem +=
                                        '<label class="card-text mt-0 mr-0 SemiBold" style="font-size: 18px;">';
                                    produkItem +=
                                        '<i class="material-icons md-24 align-middle mr-1" style="color: #FCFF82">star</i>';
                                    produkItem += produks['produks'][i].rating;
                                    produkItem += '</label>';
                                    produkItem += '</div>';
                                    produkItem += '</div>';
                                    produkItem += '</div>';
                                    produkItem += '</a>';
                                    produkItem += '</div>';
                                    produkItem += '</div>';
                                }
                            }
                        } else {
                            produkItem +=
                                '<label class="text-primary-purple font-weight-bold ml-3" style="font-size: 18px; min-height:65px;">Data yang Anda Cari Tidak Ada</label>';
                        }
                        produkItem += '</div>';

                        $('#imgLoading').hide();

                        $('.produk').html(produkItem);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                        alert(thrownError);
                    }
                })
            }
        });

    </script>
@endsection