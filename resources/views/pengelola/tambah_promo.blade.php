@extends('layouts.pengelola')

@php
    $month=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
@endphp

@section('content')
    <div class="container mt-5 mb-5" style="font-size: 16px;">
        <label class="font-weight-bold mb-4" style="font-size: 36px;">
            {{__('Tambah Promo') }}
        </label>
        <br>
        <label class="mb-2">
            {{__('Pilih Produk untuk Diberi Promo') }}
        </label>
        <div class="form-group search-input mb-4">
            <div class="main-search-input-item">
                <input id="keyword" name="keyword" type="text" role="search" class="form-control" placeholder="Cari produk anda disini..." aria-label="Cari produk disini" aria-describedby="basic-addon2" style="border:0px solid white; border-radius:30px; font-size:16px;">
                    <i id="searchBtn" class="material-icons pointer ml-1 pt-1 pb-1 pl-3 pr-3" onclick="event.preventDefault(); document.getElementById('search-form').submit();" style="position: absolute; top: 50%; left: 98%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                        search
                    </i>
            </div>
        </div>
        <form id="submit-form" action="{{ route('partner.promo.store.create') }}" method="POST">
            @csrf
                <div class="row justify-content-between mb-4">
                    <div class="col-md-1 owl-nav align-self-center">
                        <a class="produk-promo-prev disabled" role="presentation">
                            <span class="carousel-control-prev-icon btn-floating btn-circle-navigation-right rounded-circle cursor-pointer" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div id="produk" class="col-md-10">
                        <div id="produk-promo-carousel" class="owl-carousel owl-theme owl-loaded owl-drag owl-loading">
                            @foreach ($partner->products as $p => $value)
                                @if ($value->status_diskon != 'Tersedia')
                                    <div class="card shadow-sm mb-4 mx-4" style="min-height: 200px;">
                                        <div class="card-body">
                                            <div class="row justify-content-between" style="min-height:50px;">
                                                <label class="card-title col-md-10 text-truncate-multiline font-weight-bold mb-2" style="font-size: 14px;">
                                                    {{$value->nama ?? '-'}}
                                                </label>
                                                <div class="col-md-2 text-right" style="font-size: 12px;">
                                                    <input type="checkbox" id="checkbox_promo{{$p}}" name="checkbox_promo" value="{{ $value->id_produk }}">
                                                </div>
                                            </div>
                                            <label class="card-title font-weight-bold mb-0" style="font-size: 14px;">
                                                {{__('Deskripsi Produk')}}
                                            </label>
                                            <label class="card-text text-truncate-multiline" style="font-size: 12px;">
                                                {{$value->deskripsi ?? '-'}}
                                            </label>
                                        </div>
                                        <div class="card-footer bg-primary-purple">
                                            <div class="row justify-content-left mb-0 mr-0 ml-0">
                                                <i class="material-icons md-24 text-white align-middle mr-2">
                                                    color_lens
                                                </i>
                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 14px;">
                                                    {{rupiah($value->harga_hitam_putih) ?? '-'}}
                                                </label>
                                                <br>
                                            </div>
                                            @if (!empty($value->harga_berwarna))
                                                <div class="row justify-content-left mb-0 mr-0 ml-0">
                                                    <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                                        color_lens
                                                    </i>
                                                    <label class="SemiBold text-primary-yellow my-auto mr-2" style="font-size: 14px;">
                                                        {{rupiah($value->harga_berwarna)}}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-1 owl-nav align-self-center">
                        <a class="produk-promo-next" role="presentation">
                            <span class="carousel-control-next-icon btn-floating btn-circle-navigation-left rounded-circle cursor-pointer" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="row mb-4" style="">
                    <div class="col-md-6">
                        <label class="mb-2">
                            {{__('Maksimal Diskon') }}
                        </label>
                        <div class="row justify-content-between mb-2">
                            <label class="col-md-1 text-center mb-0 mr-0 mt-2">
                                {{__('Rp.') }}
                            </label>
                            <div class="col-md-11 form-group mb-4">
                                <input type="text" name="maksimal_diskon" class="form-control form-control-lg pt-2 pb-2" placeholder="300.000" aria-label="300.000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" aria-describedby="inputGroup-sizing-sm" style="font-size: 16px;">
                            </div>
                        </div>
                        <label class="mb-2">
                            {{__('Tanggal Promo Mulai') }}
                        </label>
                        <div class="row justify-content-left mb-3">
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tanggal_mulai_promo" type="text" id="tanggal_mulai_promo" Class="form-control" value="" hidden>
                                    <button id="tanggalMulaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTanggalMulaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{__('Tanggal')}}
                                    </button>
                                    <div id="tanggalMulaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTanggalMulaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=1;$i<32;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="bulan_mulai_promo" type="text" id="bulan_mulai_promo" Class="form-control" value="" hidden>
                                    <button id="bulanMulaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownBulanMulaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{__('Bulan')}}
                                    </button>
                                    <div id="bulanMulaiPromoList" class="dropdown-menu" aria-labelledby="dropdownBulanMulaiPromo" style="font-size: 16px; width:100%;">
                                        @foreach ($month as $m)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$m}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tahun_mulai_promo" type="text" id="tahun_mulai_promo" Class="form-control" value="" hidden>
                                    <button id="tahunMulaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTahunMulaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{__('Tahun')}}
                                    </button>
                                    <div id="tahunMulaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTahunMulaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=2020;$i<2030;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">
                            {{__('Jumlah Diskon') }}
                        </label>
                        <div class="form-group row justify-content-left mb-2">
                            <div class="col-md-3 input-group mb-4">
                                <input type="number" name="jumlah_diskon" class="form-control form-control-lg pt-2 pb-2" placeholder="10" aria-label="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" aria-describedby="inputGroup-sizing-sm" style="width:100%; font-size:16px;">
                            </div>
                            <label class="col-md-auto text-left mb-0 mr-0 ml-0 mt-2">
                                {{__('%') }}
                            </label>
                        </div>
                        <label class="mb-2">
                            {{__('Tanggal Promo Selesai') }}
                        </label>
                        <div class="row justify-content-left mb-3">
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tanggal_selesai_promo" type="text" id="tanggal_selesai_promo" Class="form-control" value="" hidden>
                                    <button id="tanggalSelesaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTanggalSelesaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{__('Tanggal')}}
                                    </button>
                                    <div id="tanggalSelesaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTanggalSelesaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=1;$i<32;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="bulan_selesai_promo" type="text" id="bulan_selesai_promo" Class="form-control" value="" hidden>
                                    <button id="bulanSelesaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownBulanSelesaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{__('Bulan')}}
                                    </button>
                                    <div id="bulanSelesaiPromoList" class="dropdown-menu" aria-labelledby="dropdownBulanSelesaiPromo" style="font-size: 16px; width:100%;">
                                        @foreach ($month as $m)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$m}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="dropdown" aria-required="true">
                                    <input name="tahun_selesai_promo" type="text" id="tahun_selesai_promo" Class="form-control" value="" hidden>
                                    <button id="tahunSelesaiPromoButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownTahunSelesaiPromo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                        {{__('Tahun')}}
                                    </button>
                                    <div id="tahunSelesaiPromoList" class="dropdown-menu" aria-labelledby="dropdownTahunSelesaiPromo" style="font-size: 16px; width:100%;">
                                        @for($i=2020;$i<2030;$i++)
                                            <span class="dropdown-item cursor-pointer ">
                                                {{$i}}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-0">
                    <div class="mr-3">
                        <button class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0" onclick="window.location.href='{{ route('partner.promo.index') }}'" style="border-radius:30px; font-size:18px;">
                            {{__('Batal') }}
                        </button>
                    </div>
                    <div class="mr-0">
                        <button type="submit" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;">
                            {{__('Tambah') }}
                        </button>
                    </div>
                </div>
                <input type="text" name="idProduk" id="idProduk" value="" hidden>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var produkCarousel = $("#produk-promo-carousel");

            $(".produk-promo-next").on('click',function(){
                produkCarousel.trigger('next.owl.carousel');
            });
            $(".produk-promo-prev").on('click',function(){
                produkCarousel.trigger('prev.owl.carousel');
            });

            produkCarousel.owlCarousel({
                loop:false,
                autoplay:false,
                autoplayTimeout:5000,
                autoplayHoverPause:false
            });
        });

        var arrIdProduk = [];

        $('input[type=checkbox]').each(function(index,value){
            $('#checkbox_promo' + index).bind('change',function(){
                if(this.checked){
                    arrIdProduk.push($(this).val());
                }
                else {
                    var pos = arrIdProduk.indexOf($(this).val());
                    if(pos > -1){
                        arrIdProduk.splice(pos, 1);
                    }
                }
                $('#idProduk').val(JSON.stringify(arrIdProduk));
            });
        });

        $('#tanggalMulaiPromoList span').on('click', function () {
            $('#tanggalMulaiPromoButton').text($(this).text());
            $('#tanggal_mulai_promo').val($(this).text());
        });
        $('#bulanMulaiPromoList span').on('click', function () {
            $('#bulanMulaiPromoButton').text($(this).text());
            $('#bulan_mulai_promo').val($(this).text());
        });
        $('#tahunMulaiPromoList span').on('click', function () {
            $('#tahunMulaiPromoButton').text($(this).text());
            $('#tahun_mulai_promo').val($(this).text());
        });

        $('#tanggalSelesaiPromoList span').on('click', function () {
            $('#tanggalSelesaiPromoButton').text($(this).text());
            $('#tanggal_selesai_promo').val($(this).text());
        });
        $('#bulanSelesaiPromoList span').on('click', function () {
            $('#bulanSelesaiPromoButton').text($(this).text());
            $('#bulan_selesai_promo').val($(this).text());
        });
        $('#tahunSelesaiPromoList span').on('click', function () {
            $('#tahunSelesaiPromoButton').text($(this).text());
            $('#tahun_selesai_promo').val($(this).text());
        });

        $('#searchBtn').click(function(){
            cariProduk();
        });

        function cariProduk() {
            var data = {
                keyword: $('#keyword').val(),
            };

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{ route('partner.promo.search') }}",
                method:'GET',
                data:data,
                dataType:'json',

                beforeSend:function(){
                    $('#produk-promo-carousel').html('<div class="text-center"><img class="mx-auto" id="imgLoading" style="position:absolute; left:40%; width:64px; height:64px;" src="/img/loading.gif" /></div>');
                },
                uploadProgress: function () {
                    $('#imgLoading').show();
                },
                success:function(produk)
                {
                    $('#imgLoading').hide();
                    $('#produk').html('<div id="produk-promo-carousel" class="owl-carousel owl-theme owl-loaded owl-drag owl-loading"></div>');
                    var itemProduk = '';
                    for(i = 0; i < produk['produk'].length;i++){
                        if (produk['produk'][i].status_diskon != 'Tersedia'){
                            itemProduk += '<div class="card shadow-sm mb-4 mx-4" style="min-height: 200px;">';
                                itemProduk += '<div class="card-body">';
                                    itemProduk += '<div class="row justify-content-between" style="min-height:50px;">';
                                        itemProduk += '<label class="card-title col-md-10 text-truncate-multiline font-weight-bold mb-2" style="font-size: 14px;">';
                                            itemProduk += produk['produk'][i].nama;
                                        itemProduk += '</label>';
                                        itemProduk += '<div class="col-md-2 text-right" style="font-size: 12px;">';
                                            itemProduk += '<input type="checkbox" id="checkbox_promo'+i+'" name="checkbox_promo" value="'+ produk['produk'][i].id_produk +'">';
                                        itemProduk += '</div>';
                                    itemProduk += '</div>';
                                    itemProduk += '<label class="card-title font-weight-bold mb-0" style="font-size: 14px;">';
                                        itemProduk += 'Deskripsi Produk';
                                    itemProduk += '</label>';
                                    itemProduk += '<label class="card-text text-truncate-multiline" style="font-size: 12px;">';
                                        itemProduk += produk['produk'][i].deskripsi;
                                    itemProduk += '</label>';
                                itemProduk += '</div>';
                                itemProduk += '<div class="card-footer bg-primary-purple">';
                                    itemProduk += '<div class="row justify-content-left mb-0 mr-0 ml-0">';
                                        itemProduk +='<i class="material-icons md-24 text-white align-middle mr-2"> color_lens </i>';
                                        itemProduk += '<label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 14px;">';
                                            itemProduk += produk['produk'][i].harga_hitam_putih;
                                        itemProduk += '</label>';
                                        itemProduk += '<br>';
                                    itemProduk += '</div>';
                                    if (produk['produk'][i].harga_berwarna != null){
                                        itemProduk +='<div class="row justify-content-left mb-0 mr-0 ml-0">';
                                            itemProduk += '<i class="material-icons md-24 text-primary-yellow align-middle mr-2">color_lens</i>';
                                            itemProduk += '<label class="SemiBold text-primary-yellow my-auto mr-2" style="font-size: 14px;">';
                                                itemProduk += produk['produk'][i].harga_berwarna;
                                            itemProduk += '</label>';
                                        itemProduk += '</div>';
                                    }
                                itemProduk += '</div>';
                            itemProduk += '</div>';
                        }
                    }
                    $('#produk-promo-carousel').append(itemProduk);

                    var produkCarousel = $("#produk-promo-carousel");

                    $(".produk-promo-next").on('click',function(){
                        produkCarousel.trigger('next.owl.carousel');
                    });
                    $(".produk-promo-prev").on('click',function(){
                        produkCarousel.trigger('prev.owl.carousel');
                    });

                    produkCarousel.owlCarousel({
                        loop:false,
                        autoplay:false,
                        autoplayTimeout:5000,
                        autoplayHoverPause:false
                    });

                    var arrIdProduk = [];

                    $('input[type=checkbox]').each(function(index,value){
                        $('#checkbox_promo' + index).bind('change',function(){
                            if(this.checked){
                                arrIdProduk.push($(this).val());
                            }
                            else {
                                var pos = arrIdProduk.indexOf($(this).val());
                                if(pos > -1){
                                    arrIdProduk.splice(pos, 1);
                                }
                            }
                            $('#idProduk').val(JSON.stringify(arrIdProduk));
                        });
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                    alert(thrownError);
                }
            })
        };
    </script>

@endsection

