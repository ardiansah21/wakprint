<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
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
                                <input type="checkbox" name="checkbox_paket{{ $p }}" class="custom-control-input" id="checkboxPaket{{$p}}" value="{{$p}}">
                                <label class="custom-control-label" for="checkboxPaket{{ $p }}">
                                    {{$p}}
                                    <i id="helpJilid{{$p}}" class="material-icons help md-18 align-middle" data-toggle="popover" data-trigger="hover" title="Deskripsi" data-html="true"
                                        data-content="
                                            <div class='media'>
                                                <img
                                                    @if($p === 'Lem')
                                                        src='https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-lem-panas-perfect-binding.jpg'
                                                    @elseif($p === 'Baut')
                                                        src='https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-baut-screw-binding.jpg'
                                                    @elseif($p === 'Kawat')
                                                        src='https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-kawat-staples-tengah-saddle-stitching.jpg'
                                                    @else
                                                        src='https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-spiral-wire-binding.jpg'
                                                    @endif class='mr-3 mb-3' width='100%' height='156' alt='Sample Image'>
                                            </div>
                                            <div class='media-body'>
                                                <h5 class='media-heading'>{{'Jilid '.$p}}</h5>
                                                <p>{{'Jilid '.$p}} adalah
                                                    @if($p === 'Lem')
                                                        jilid yang dilakukan dengan cara merekatkan bagian pinggir kertas ke punggung sampul buku bagian dalam menggunakan lem atau perekat. Teknik ini cocok untuk buku yang cukup tebal, dengan soft cover maupun hard cover.
                                                    @elseif($p === 'Baut')
                                                        teknik yang mirip dengan jilid spiral, yaitu melubangi tepi halaman untuk menyatukan kertas. Bedanya adalah yang digunakan untuk menyatukan halaman adalah baut yang dikencangkan. Tentunya dipilih baut khusus yang juga bisa menunjang estetika buku. Penjilidan ini seringnya dipakai untuk buku hard cover yang dibuat khusus seperti katalog warna, katalog pameran, buku menu, dll.
                                                    @elseif($p === 'Kawat')
                                                        jilid yang cocok untuk dokumen dengan soft cover dan ketebalan yang tipis antara 4-80 halaman seperti booklet, majalah, atau buku modul tipis.
                                                    @else
                                                        jilid yang dilakukan dengan cara melubangi tepi halaman di satu sisi lalu menyatukannya dengan kawat atau plastik berbentuk roll. Teknik ini biasanya dipakai untuk buku dengan bahan kertas yang cukup tebal namun tidak memiliki terlalu banyak halaman.
                                                    @endif
                                                </p>
                                            </div>"
                                        onmouseover="showPopUpHelpJilid('{{$p}}')" onmouseout="hidePopUpHelpJilid('{{$p}}')" style="color:#C4C4C4">
                                        help
                                    </i>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-3">
                    @php
                        $nonPaket = array('Kliping','Hekter','Tulang Kliping','Penjepit Kertas','Plastik Transparan','Kertas Jeruk');
                    @endphp
                    @foreach ($nonPaket as $np)
                    <div id="fiturNonPaketLabel" class="custom-control custom-checkbox mt-2 ml-1 mr-4" style="font-size: 18px;">
                        <input type="checkbox" class="custom-control-input" id="checkboxNonPaket{{$np}}" value="{{$np}}">
                        <label class="custom-control-label" for="checkboxNonPaket{{$np}}">
                            {{$np}}
                            <i id="helpNonPaket{{str_replace(' ','',$np)}}" class="material-icons help md-18 align-middle cursor-pointer" data-toggle="popover" data-trigger="hover" title="Deskripsi" data-html="true"
                                data-content=
                                    "<div class='media'>
                                        <img
                                            @if($np === 'Kliping')
                                                src='https://ecs7.tokopedia.net/img/cache/700/product-1/2017/11/3/24128252/24128252_b0f7c29c-5096-4d76-9d7e-91fee75f553c_320_427.jpg'
                                            @elseif($np === 'Hekter')
                                                src='https://qph.fs.quoracdn.net/main-qimg-92ca56763f43afe14652d15eadc59264'
                                            @elseif(str_replace(' ','',$np) == 'TulangKliping')
                                                src='https://ecs7.tokopedia.net/img/cache/700/product-1/2017/11/3/24128252/24128252_b0f7c29c-5096-4d76-9d7e-91fee75f553c_320_427.jpg'
                                            @elseif(str_replace(' ','',$np) === 'PenjepitKertas')
                                                src='https://cdn0-production-images-kly.akamaized.net/eJOTPdEE8EJmfGT90UZpzbdbhHI=/640x640/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/2887278/original/001566000_1566293636-rainbow-made-colorful-paper-clips_23-2148092020freepika.jpg'
                                            @elseif(str_replace(' ','',$np) === 'PlastikTransparan')
                                                src='https://1.bp.blogspot.com/-ZNjTq20AXBE/Vp13uSac7YI/AAAAAAAAABQ/3-V4wH-wlsA/s1600/IMG-20160104-WA0002.jpg'
                                            @else
                                                src='https://cdn.siplah.pesonaedu.id/uploads/6f84a30ff9f80054908cb570c0a86c6743e9f6683f18602a0d89901bf781fc64/51826/image.png'
                                            @endif class='mr-3 mb-3' width='100%' height='156' alt='Sample Image'>
                                    </div>
                                    <div class='media-body'>
                                        <h5 class='media-heading'>{{$np}}</h5>
                                        <p>{{$np}} adalah
                                            @if($np === 'Kliping')
                                                hasil cetakan Anda akan sekaligus diberikan tulang kliping, plastik transparan, dan kertas jeruk secara lengkap diberikan dalam 1 paket pada dokumen Anda.
                                            @elseif($np === 'Hekter')
                                                hasil cetakan Anda akan sekaligus dihekter untuk membuat dokumen Anda terlihat rapi dan tidak berantakan.
                                            @elseif(str_replace(' ','',$np) === 'TulangKliping')
                                                hasil cetakan Anda akan sekaligus diberikan tulang kliping pada saat proses pencetakan dokumen telah selesai.
                                            @elseif(str_replace(' ','',$np) === 'PenjepitKertas')
                                                hasil cetakan Anda akan sekaligus dijepit dengan penjepit kertas untuk membuat dokumen Anda terlihat rapi dan tidak berantakan.
                                            @elseif(str_replace(' ','',$np) === 'PlastikTransparan')
                                                hasil cetakan Anda akan sekaligus diberikan plastik transparan untuk halaman depan pada dokumen Anda.
                                            @else
                                                hasil cetakan Anda akan sekaligus diberikan kertas jeruk untuk halaman belakang pada dokumen Anda.
                                            @endif
                                        </p>
                                    </div>"
                                onmouseover="showPopUpHelpNonPaket('{{str_replace(' ','',$np)}}')" onmouseout="hidePopUpHelpNonPaket('{{str_replace(' ','',$np)}}')" style="color:#C4C4C4">
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
                                <input id="keyword" name="keyword" value="{{request()->keyword}}" type="text" role="search" class="form-control" placeholder="Cari percetakan atau produk disini" aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2" style="border:0px solid white; border-radius:30px; font-size:18px;">
                                <i id='cari' class="material-icons badge badge-sm shadow-sm bg-light-yellow pointer ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute; top: 50%; left: 93%; transform:translate(-50%, -50%); -ms-transform: translate(-50%, -50%); border-radius:30px;">search</i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown">
                            <input id="filter_pencarian" name="filter_pencarian" type="text" Class="form-control" hidden>
                            <button id="filterPencarianButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownFilterPencarian" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                {{__('Urutkan') }}
                            </button>
                            @php
                                $filterPencarian= array('Terbaru', 'Harga Tertinggi', 'Harga Terendah');
                            @endphp
                            <div id="filterPencarianList" class="dropdown-menu" aria-labelledby="dropdownFilterPencarian" style="font-size: 16px; width:100%;">
                                @foreach ($filterPencarian as $fp)
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
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){

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

        function rupiah(val) {
            return ("Rp. " + val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1."));
        }

        function searching() {
            var fromKonfigurasi = ("{{request()->fromKonfigurasi}}" === "true");
            if (fromKonfigurasi == true) {
                var url = "{{ route('cari') }}" + "?id_konfigurasi=" + "{{request()->id_konfigurasi}}" + "&fromKonfigurasi=" + "{{request()->fromKonfigurasi}}";
            } else {
                var url = "{{ route('cari') }}";
            }
            console.log(url);
            var data = {
                keyword: $('#keyword').val(),
                jenisKertas: $('#ukuranKertas').val(),
                jenisPrinter: $('#jenisPrinter').val(),
                ambilDiTempat: $('#ambilDiTempat').val(),
                antarKeTempat: $('#antarKeTempat').val(),
                fiturTambahan: hasilFitur,
                filterPencarian: $('#filter_pencarian').val(),
                fromKonfigurasi:fromKonfigurasi,
            };

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:url,
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
                                    var idKonfigurasi = produks['idKonfigurasi'];
                                    var fromKonfigurasi = ("{{request()->fromKonfigurasi}}" === 'true');

                                    if (fromKonfigurasi != true){
                                        var urlDetailProduk = "{{ route("detail.produk","") }}" + "/" + idProduk;
                                    }
                                    else{
                                        var urlDetailProduk = "{{ route("detail.produk","") }}" + "/" + idProduk + "?id_konfigurasi=" + "{{request()->id_konfigurasi}}" + "&fromKonfigurasi=true";
                                    }

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
                                                if(produks['produks'][i].foto_produk[0] != null){
                                                    produkItem +='<img class="card-img-top cursor-pointer" src="'+ produks['produks'][i].foto_produk[0] +'" onclick="window.location.href=" style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap"/>';
                                                }
                                                else{
                                                    produkItem +='<img class="card-img-top cursor-pointer" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg" onclick="window.location.href=" style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap"/>';
                                                }
                                                produkItem +='<div class="card-body cursor-pointer">';
                                                    produkItem +='<div class="row justify-content-between">';
                                                        produkItem +='<label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">'+produks['nama_partner_dari_produk'][i]+'</label>';
                                                        produkItem +='<label class="col-md-auto card-text text-right mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i>'+produks['produks'][i].jarak/1000 +' km</label>';
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
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;"><del>'+rupiah(produks['produks'][i].harga_hitam_putih)+'</del></label>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">'+rupiah(hargaHitamPutih)+'</label>';
                                                                produkItem +='</br>';
                                                                produkItem +='<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 12px;"><del>'+rupiah(produks['produks'][i].harga_berwarna)+'</del></label>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">'+rupiah(hargaBerwarna)+'</label>';
                                                            }
                                                            else if(produks['produks'][i].harga_hitam_putih != null && produks['produks'][i].jumlah_diskon != null){
                                                                produkItem +='<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;"><del>'+rupiah(produks['produks'][i].harga_hitam_putih)+'</del></label>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">'+rupiah(hargaHitamPutih)+'</label>';
                                                                produkItem +='</br>';
                                                                produkItem +='<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">Tidak Tersedia</label>';
                                                            }
                                                            else if(produks['produks'][i].harga_berwarna != null){
                                                                produkItem +='<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">'+rupiah(produks['produks'][i].harga_hitam_putih)+'</label>';
                                                                produkItem +='</br>';
                                                                produkItem +='<i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">'+rupiah(produks['produks'][i].harga_berwarna)+'</label>';
                                                            }
                                                            else{
                                                                produkItem +='<i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>';
                                                                produkItem +='<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">'+rupiah(produks['produks'][i].harga_hitam_putih)+'</label>';
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
                                                percetakanItem +='<img class="card-img-top cursor-pointer" src="'+produks['partners'][i].foto_percetakan[0]+'" onclick="window.location.href=" style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap"/>';
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

    function showPopUpHelpJilid(value) {
        $('#helpJilid' + value).popover('show');
    }

    function hidePopUpHelpJilid(value) {
        $('#helpJilid' + value).popover('hide');
    }

    function showPopUpHelpNonPaket(value) {
        console.log($('#helpNonPaket' + value));
        $('#helpNonPaket' + value).popover('show');
    }

    function hidePopUpHelpNonPaket(value) {
        $('#helpNonPaket' + value).popover('hide');
    }
</script>
@endsection
