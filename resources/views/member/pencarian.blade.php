<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <form id="search-form" action="{{ route('search') }}" method="POST">
        @csrf
        <div class="row justify-content-between mb-5 mt-5">
            <div class="col-md-4">
                <div class="btn-group btn-group-toggle mt-2 mb-4" data-toggle="buttons">
                    <label id="antarKeTempatLabel" class="btn btn-default-wakprint shadow-sm SemiBold mr-4" for="antarKeTempat"
                        style="border-radius:30px; font-size:14px;">
                        <input id="antarKeTempat" name="antar_ke_tempat" type="checkbox" value="0">
                        {{__('Antar ke Tempat')}}
                    </label>
                    <label id="ambilDiTempatLabel" class="btn btn-default-wakprint shadow-sm SemiBold" for="ambilDiTempat"
                        style="border-radius:30px; font-size:14px;">
                        <input id="ambilDiTempat" name="ambil_di_tempat" type="checkbox" value="0">
                            {{__('Ambil di Tempat')}}
                    </label>
                </div>
                <div class="mt-3">
                    <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Jenis Ukuran Kertas')}}</label>
                    <div class="dropdown" aria-required="true">
                        <input name="jenis_kertas" type="text" id="ukuranKertas" Class="form-control" hidden>
                        <button id="ukuranKertasButton"
                            class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownKertas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                                text-align:left;">
                            {{__('Ukuran Kertas') }}
                        </button>
                        @php
                            $ukuranKertas= array('A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr','F4HVS80gr','LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr');
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
                <div class="mt-3">
                    <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Jenis Printer')}}</label>
                    <div class="dropdown">
                        <input name="jenis_printer" type="text" id="jenisPrinter" Class="form-control" hidden>
                        <button id="jenisPrinterButton"
                            class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownJenisPrinter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="font-size: 16px;
                                text-align:left;">
                            {{__('Jenis Printer') }}
                        </button>
                        @php
                            $jenisPrinter= array('Ink Jet', 'Laser Jet');
                        @endphp
                        <div id="jenisPrinterList" class="dropdown-menu" aria-labelledby="dropdownJenisPrinter"
                            style="font-size: 16px; width:100%;">
                            @foreach ($jenisPrinter as $printer)
                                <span class="dropdown-item cursor-pointer ">
                                    {{$printer}}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Fitur')}}</label>
                    @php
                        $paket = array('Lem','Baut','Kawat','Spiral');
                    @endphp
                    <div class="" style="font-size: 18px;">
                        <label class="SemiBold mb-2 ml-0">
                            {{__('Jilid')}}
                        </label>
                        @foreach ($paket as $p)
                            <div id="fiturPaketLabel" class="custom-control custom-checkbox mt-2 ml-4 mr-4">
                                <input type="checkbox" name="checkbox_paket{{ $p }}" class="custom-control-input"
                                    id="checkboxPaket{{$p}}" value="{{$p}}">
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
                <div class="mt-3">
                    @php
                        $nonPaket = array('Hekter','Kliping','Penjepit Kertas','Plastik Transparan','Kertas Jeruk');
                    @endphp
                    @foreach ($nonPaket as $np)
                    <div id="fiturNonPaketLabel" class="custom-control custom-checkbox mt-2 ml-1 mr-4" style="font-size: 18px;">
                        <input type="checkbox" class="custom-control-input" id="checkboxNonPaket{{$np}}"
                            value="{{$np}}">
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
            <div class="col-md-8 ml-0">
                <label class="font-weight-bold mb-5" style="font-size: 48px;">
                    {{__('Cari Produk / Tempat Percetakan')}}
                </label>
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="search-input mb-3">
                            <div class="main-search-input-item">
                                <input id="keyword" name="keyword" type="text" role="search" class="form-control"
                                    placeholder="Cari percetakan atau produk disini"
                                    aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                                    style="border:0px solid white;
                                    border-radius:30px;
                                    font-size:18px;">
                                <i id='cari' class="material-icons pointer ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                                    top: 50%;
                                    left: 95%;
                                    transform:translate(-50%, -50%);
                                    -ms-transform: translate(-50%, -50%);">
                                    search
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown">
                            <input id="filter_pencarian" name="filter_pencarian" type="text" Class="form-control" hidden>
                            <button id="filterPencarianButton"
                                class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                                id="dropdownFilterPencarian" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" style="font-size: 16px; text-align:left;">
                                {{__('Urutkan') }}
                            </button>
                            @php
                                $filterPencarian= array('Terbaru', 'Harga Tertinggi', 'Harga Terendah');
                            @endphp
                            <div id="filterPencarianList" class="dropdown-menu"
                                aria-labelledby="dropdownFilterPencarian" style="font-size: 16px; width:100%;">
                                @foreach ( $filterPencarian as $fp)
                                    <span class="dropdown-item cursor-pointer ">
                                        {{$fp}}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="nav nav-pills SemiBold mb-5" id="pills-tab" role="tablist" style="font-size:18px;">
                        <li class="nav-item mr-3">
                            <a class="nav-link active" id="pills-produk-tab" data-toggle="tab" href="#pills-produk"
                                role="tab" aria-controls="pills-produk" aria-selected="true"
                                style="border-radius:10px 10px 0px 0px;">
                                <i class="material-icons align-middle mr-2">
                                    shopping_cart
                                </i>
                                {{__('Produk')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-tempat-percetakan-tab" data-toggle="tab"
                                href="#pills-tempat-percetakan" role="tab" aria-controls="pills-tempat-percetakan"
                                aria-selected="false" style="border-radius:10px 10px 0px 0px;">
                                <i class="material-icons align-middle mr-2">
                                    home
                                </i>
                                {{__('Tempat Percetakan')}}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-produk" role="tabpanel"
                            aria-labelledby="pills-produk-tab">
                            <div class="infinite-scroll">
                                <div id="pencarianItemsProduk" class="produk">
                                    <div class="row justify-content-between ml-0 mr-0">
                                        @foreach($produk as $p)
                                            <div class="col-md-6 mb-4">
                                                <div class="">
                                                    @include('member.card_produk')
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-tempat-percetakan" role="tabpanel" aria-labelledby="pills-tempat-percetakan-tab">
                            <div class="infinite-scroll">
                                <div id="pencarianItemsPercetakan" class="percetakan">
                                    <div class="row justify-content-between ml-0 mr-0">
                                        @foreach($partner as $p)
                                            <div class="col-md-6 mb-4">
                                                <div class="">
                                                    @include('member.card_percetakan')
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


{{-- <div class="card shadow mb-2" style="border-radius: 10px;">
    <a class="text-decoration-none" href="produk/detail/{{ $p->id_produk }}" style="color: black;">
        <div class="text-center" style="position: relative;">
            <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                width:75px;
                                height:50px;
                                border-radius:0px 0px 8px 8px;">
                <label class="font-weight-bold mb-1 mt-3"
                    style="font-size: 12px;">{{__('Promo') }}</label>
            </div>
        </div>
        <i class="fa fa-heart fa-2x fa-responsive"
            style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
        </i>
        <img class="card-img-top"
            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
            style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap" />
        <div class="card-body">
            <div class="row">
                <label class="col-md-7 text-truncate ml-0"
                    style="font-size: 14px;">{{$p->partner->nama_toko ?? '-'}}</label>
                <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i
                        class="material-icons md-18 align-middle mr-0">location_on</i>
                    {{__('100 m') }}</label>
            </div>
            <label class="card-title text-truncate-multiline font-weight-bold"
                style="font-size: 24px;">{{$p->nama ?? '-'}}</label>
            <label class="card-text text-truncate-multiline"
                style="font-size: 18px;">{{$p->partner->alamat_toko}}</label>
            <div class="row justify-content-between ml-0 mr-0">
                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                        class="material-icons md-18 align-middle mr-1">color_lens</i>
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
                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                        class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? '-'}}</label>
                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                        class="material-icons md-18 align-middle mr-1">menu_book</i>
                    {{__('Jilid') }}</label>
                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                        class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? '-'}}</label>
            </div>
        </div>
        <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
            <div class="row justify-content-between">
                <div class="ml-3">
                    <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                        Rp. {{$p->harga_hitam_putih ?? '-'}}
                    </label>
                    <label class="card-text SemiBold badge-sm badge-light px-1"
                        style="font-size: 12px; border-radius:5px;">
                        {{__('Hitam-Putih')}}
                    </label>
                    <br>
                    @if (!empty($p->harga_berwarna))
                    <label class="card-text SemiBold text-primary-yellow my-auto mr-2"
                        style="font-size: 16px;">
                        Rp. {{$p->harga_berwarna}}
                    </label>
                    <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1"
                        style="font-size: 12px; border-radius:5px;">
                        {{__('Berwarna')}}
                    </label>
                    @endif
                </div>
                <div class="mr-0 my-auto">
                    <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                        <i class="material-icons md-24 mr-1 align-middle"
                            style="color: #FCFF82">star</i>
                        {{$p->rating ?? '-'}}
                    </label>
                </div>
            </div>
        </div>
    </a>
</div> --}}

@endsection

@section('script')
<script>

    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            // $('.produk').css('color', '#dfecf6');
            // $('.produk').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/img/loading.gif" />');

            var url = $(this).attr('href');
            getArticles(url);
            // window.history.pushState("", "", url);
        });

        function getArticles(url) {
            $.ajax({
                url : url
            }).done(function (data) {
                $('.produk').html(data);
            }).fail(function () {
                alert('Produk tidak ditemukan.');
            });
        }
    });

    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="/img/loading.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });

    $(document).ready(function(){
        $('#keyword').on('keyup',function(){
            var keyword = $('#keyword').val();
            $.ajax({
                url:"{{route('pencarian')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    'keyword':keyword,
                },
                success:function(data){
                    $('#pencarianItems').html(data);
                }
            })
        });
    });


    $(function(){

        $('#ambilDiTempatLabel').on('click', function(){
            if ($('#ambilDiTempat').is(':checked')) {
                $('#ambilDiTempat').val(0);
            }
            else{
                $('#ambilDiTempat').val(1);
            }
            searching();
        });

        $('#antarKeTempatLabel').on('click', function(){
            if ($('#antarKeTempat').is(':checked')) {
                $('#antarKeTempat').val(0);
            }
            else{
                $('#antarKeTempat').val(1);
            }
            searching();
        });

        var hasilFitur = [];

        $('input[type=checkbox]').each(function(index, value){
            $(this).bind('change', function(){
                if(this.checked){
                    hasilFitur.push($(this).val());
                    searching();
                }
                else {
                    var pos = hasilFitur.indexOf($(this).val());
                    if(pos > -1){
                        hasilFitur.splice(pos, 1);
                    }
                    searching();
                }
            });
        });

        $('#ukuranKertasList span').on('click', function () {
            $('#ukuranKertasButton').text($(this).text());
            $('#ukuranKertas').val($(this).text());
            searching();
        });

        $('#jenisPrinterList span').on('click', function () {
            $('#jenisPrinterButton').text($(this).text());
            $('#jenisPrinter').val($(this).text());
            searching();
        });

        $('#filterPencarianList span').on('click', function () {
            $('#filterPencarianButton').text($(this).text());
            $('#filter_pencarian').val($(this).text());
            searching();
        });

        $('#cari').on('click', function(){
            searching();
        });

        function searching() {

            var data = {
                keyword: $('#keyword').val(),
                jenisKertas: $('#ukuranKertas').val(),
                jenisPrinter: $('#jenisPrinter').val(),
                ambilDiTempat: $('#ambilDiTempat').val(),
                antarKeTempat: $('#antarKeTempat').val(),
                fiturTambahan: hasilFitur,
                filterPencarian: $('#filter_pencarian').val(),
            };

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'{{ route('cari') }}',
                method:'GET',
                data:data,
                dataType:'json',

                beforeSend:function(){
                    $('.produk').css('color', '#dfecf6');
                    $('.produk').html('<div class="text-center"><img id="imgLoading" style="" src="/img/loading.gif" /></div>');

                    $('.percetakan').css('color', '#dfecf6');
                    $('.percetakan').html('<div class="text-center"><img id="imgLoading" style="" src="/img/loading.gif" /></div>');
                },
                uploadProgress: function () {
                    $('#imgLoading').show();
                },
                success:function(produks)
                {
                    var produkItem = '<div class="row justify-content-between ml-0 mr-0">';
                        if (produks['produks'].length != 0) {
                                for (i = 0; i < produks['produks'].length; i++) {
                                    var idProduk = produks['produks'][i].id_produk;
                                    var urlDetailProduk = "{{ route("detail.produk","") }}" + "/" + idProduk;

                                    var jumlahDiskonGray = produks['produks'][i].harga_hitam_putih * produks['produks'][i].jumlah_diskon;
                                    var jumlahDiskonWarna = produks['produks'][i].harga_berwarna * produks['produks'][i].jumlah_diskon;

                                    if (jumlahDiskonGray > produks['produks'][i].maksimal_diskon) {
                                        var hargaHitamPutih = produks['produks'][i].harga_hitam_putih - produks['produks'][i].maksimal_diskon;
                                        var hargaBerwarna = produks['produks'][i].harga_berwarna - produks['produks'][i].maksimal_diskon;
                                    }
                                    else {
                                        var hargaHitamPutih = produks['produks'][i].harga_hitam_putih - jumlahDiskonGray;
                                        var hargaBerwarna = produks['produks'][i].harga_berwarna - jumlahDiskonWarna;
                                    }
                                    produkItem += '<div class="col-md-6 mb-4">';
                                        produkItem += '<div class="card shadow mb-2" style="border-radius: 10px;">';
                                            produkItem +='<a class="text-decoration-none" href="'+urlDetailProduk+'" style="color: black;">'
                                                if (produks['produks'][i].jumlah_diskon != null) {
                                                    produkItem +='<div class="text-center" style="position: relative;">';
                                                        produkItem +='<div class="bg-promo" style="position: absolute; top: 55%; left: 10%; width:75px; height:50px; border-radius:0px 0px 8px 8px;">';
                                                            produkItem +='<label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">Promo</label>';
                                                        produkItem +='</div>';
                                                    produkItem +='</div>';
                                                }
                                                produkItem +='<button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>';

                                                // if(produks['members'].cekProdukFavorit(produks['members'].id_member,produks['produks'][i].id_produk)){
                                                //     produkItem +='<button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer text-danger" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>';
                                                // }
                                                // else{
                                                //     produkItem +='<button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>';
                                                // }
                                                produkItem +='<img class="card-img-top cursor-pointer" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" onclick="window.location.href=" style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap"/>';
                                                produkItem +='<div class="card-body cursor-pointer" onclick="window.location.href=">';
                                                    produkItem +='<div class="row justify-content-between">';
                                                        produkItem +='<label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">'+produks['nama_partner_dari_produk'][i]+'</label>';
                                                        produkItem +='<label class="col-md-auto card-text text-right mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i>100 m</label>';
                                                    produkItem +='</div>';
                                                produkItem +='<label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">'+produks['produks'][i].nama+'</label>';
                                                produkItem +='<label class="card-text text-truncate-multiline" style="font-size: 18px; min-height:65px;">'+produks['alamat_partner_dari_produk'][i]+'</label>';
                                                    produkItem +='<div class="row justify-content-left ml-0 mr-0">';
                                                        produkItem +='<label class="card-text text-truncate SemiBold mr-2" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>'+produks['produks'][i].jenis_kertas+'</label>';
                                                        produkItem +='<label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>'+produks['produks'][i].jenis_printer+'</label>';
                                                    produkItem +='</div>';
                                                produkItem +='</div>';
                                                produkItem +='<div class="card-footer card-footer-primary cursor-pointer" onclick="window.location.href=" style="border-radius: 0px 0px 10px 10px;">';
                                                    produkItem +='<div class="row justify-content-between ml-0 mr-0">';
                                                        produkItem +='<div>'
                                                            if (produks['produks'][i].harga_hitam_putih != null && produks['produks'][i].harga_berwarna != null && produks['produks'][i].jumlah_diskon != null) {
                                                                produkItem +='<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. <del>'+produks['produks'][i].harga_hitam_putih+'</del></label>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. '+hargaHitamPutih+'</label>';
                                                                produkItem +='</br>';
                                                                produkItem +='<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Rp. '+produks['produks'][i].harga_berwarna+'</label>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Rp. '+hargaBerwarna+'</label>';
                                                            }
                                                            else if(produks['produks'][i].harga_hitam_putih != null && produks['produks'][i].jumlah_diskon != null){
                                                                produkItem +='<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. <del>'+produks['produks'][i].harga_hitam_putih+'</del></label>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. '+hargaHitamPutih+'</label>';
                                                                produkItem +='</br>';
                                                                produkItem +='<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Tidak Tersedia</label>';
                                                            }
                                                            else if(produks['produks'][i].harga_berwarna != null){
                                                                produkItem +='<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. '+produks['produks'][i].harga_hitam_putih+'</label>';
                                                                produkItem +='</br>';
                                                                produkItem +='<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Rp. '+produks['produks'][i].harga_berwarna+'</label>';
                                                            }
                                                            else{
                                                                produkItem +='<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">Rp. '+produks['produks'][i].harga_hitam_putih+'</label>';
                                                                produkItem +='</br>';
                                                                produkItem +='<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Tidak Tersedia</label>';
                                                            }
                                                        produkItem +='</div>';
                                                        produkItem +='<div class="my-auto">';
                                                            produkItem +='<label class="card-text mt-0 mr-0 SemiBold" style="font-size: 18px;">';
                                                                produkItem +='<i class="material-icons md-24 align-middle mr-1" style="color: #FCFF82">star</i>';
                                                                    produkItem += produks['produks'][i].rating;
                                                            produkItem +='</label>';
                                                        produkItem +='</div>';
                                                    produkItem +='</div>';
                                                produkItem +='</div>';
                                            produkItem +='</a>';
                                        produkItem +='</div>';
                                    produkItem +='</div>';
                                }
                        }
                        else{
                            produkItem +='<label class="text-primary-purple text-center font-weight-bold" style="font-size: 18px; min-height:65px;">Data yang Anda Cari Tidak Ada</label>';
                        }
                    produkItem +='</div>';

                    var percetakanItem = '<div class="row justify-content-between ml-0 mr-0">';
                        if (produks['partners'].length != 0) {
                                for (i = 0; i < produks['partners'].length; i++) {
                                    var urlDetailPercetakan = '{{ route('detail.partner','produks["id_partner_dari_produk"][i]') }}';

                                    percetakanItem += '<div class="col-md-6 mb-4">';
                                        percetakanItem += '<div class="card shadow mb-2" style="border-radius: 10px;">';
                                            percetakanItem +='<a class="text-decoration-none" href='+urlDetailPercetakan+' style="color: black;">'
                                                if ((produks['partners'][i].id_pengelola) != produks['atk_id_partner'][i] && produks['atk_status_partner'][i] === 'TidakTersedia') {
                                                    percetakanItem +='<label class="badge badge-pill badge-info bg-promo font-weight-bold align-bottom p-2 mb-1 mt-3" style="position: absolute; top: 0%; left: 80%; font-size: 12px;" hidden>ATK</label>';
                                                }
                                                else{
                                                    percetakanItem +='<label class="badge badge-pill badge-info bg-promo font-weight-bold align-bottom p-2 mb-1 mt-3" style="position: absolute;top: 0%; left: 80%; font-size: 12px;">ATK</label>';
                                                }
                                                percetakanItem +='<img class="card-img-top cursor-pointer" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" onclick="window.location.href=" style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap"/>';
                                                percetakanItem +='<div class="card-body cursor-pointer" onclick="window.location.href=">';
                                                    percetakanItem +='<label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">'+produks['partners'][i].nama_toko+'</label>';
                                                    percetakanItem +='<label class="card-text text-truncate-multiline" style="font-size: 16px; min-height:55px;">'+produks['partners'][i].alamat_toko+'</label>';
                                                    percetakanItem +='<label class="card-text text-sm text-truncate" style="font-size: 14px; min-height:10px; width:100%">';
                                                        if (produks['partners'][i].deskripsi_toko === null) {
                                                            percetakanItem += '-';
                                                        }
                                                        else {
                                                            percetakanItem += produks['partners'][i].deskripsi_toko;
                                                        }
                                                    percetakanItem += '</label>';
                                                percetakanItem +='</div>';
                                                percetakanItem +='<div class="card-footer card-footer-primary cursor-pointer" onclick="window.location.href=" style="border-radius: 0px 0px 10px 10px;">';
                                                    percetakanItem +='<div class="row justify-content-between ml-0 mr-0">';
                                                        percetakanItem +='<label class="card-text font-weight-bold" style="font-size: 18px;">';
                                                            percetakanItem +='<i class="material-icons md-24 mr-2 align-middle" style="color: #6081D7">location_on</i>100 m';
                                                        percetakanItem +='</label>';
                                                        percetakanItem +='<label class="card-text mr-4 font-weight-bold" style="font-size: 18px;">';
                                                            percetakanItem +='<i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>';
                                                                percetakanItem += produks['partners'][i].rating_toko;
                                                        percetakanItem +='</label>';
                                                    percetakanItem +='</div>';
                                                percetakanItem +='</div>';
                                            percetakanItem +='</a>';
                                        percetakanItem +='</div>';
                                    percetakanItem +='</div>';
                                }
                            percetakanItem += '</div>';
                        }
                        else{
                            percetakanItem +='<label class="text-primary-purple text-center font-weight-bold" style="font-size: 18px; min-height:65px;">Data yang Anda Cari Tidak Ada</label>';
                        }
                    percetakanItem +='</div>';

                    $('#imgLoading').hide();

                    $('.produk').html(produkItem);
                    $('.percetakan').html(percetakanItem);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                    alert(thrownError);
                }
            })
        };

    });
</script>
@endsection
