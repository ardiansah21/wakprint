@extends('layouts.member')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Ulasan') }}</h1>
        <div class="dropdown mb-4">
            @php
                $urutkanUlasan = array('Untuk Diulas' .' (' .count($arrayBelumDiulas). ')' , 'Sudah Diulas');
            @endphp
            <input name="keyword_urutkan_ulasan" type="text" id="keyword_urutkan_ulasan" Class="form-control" hidden>
            <button id="urutkanUlasanBtn" class="is-flex btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray mb-4 ml-0"
                id="dropdownUrutkanUlasan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                {{$urutkanUlasan[0]}}
            </button>
            <div id="urutkanUlasanList" class="dropdown-menu" aria-labelledby="dropdownUrutkanUlasan" style="font-size: 16px;">
                @foreach ($urutkanUlasan as $u)
                    <span class="dropdown-item cursor-pointer">
                        {{$u}}
                    </span>
                    <input id="isiFilter" type="text" value="{{$u}}" hidden>
                @endforeach
            </div>
        </div>
        <div class="ulasan pr-4">
                @foreach ($arrayBelumDiulas as $abd => $value)
                    <div class="card shadow-sm mb-3 pl-4 pr-2" style="border-radius: 10px;">
                        <div class="row">
                            <div class="container text-center align-self-center col-md-2">
                                <img src="{{$value->product->foto_produk[0]}}" width="100" height="100" alt="no logo" style="object-fit:cover; border-radius:8px;">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate SemiBold mb-1" style="font-size: 24px;">{{$value->product->nama}}</h5>
                                    <label class="card-text text-truncate mb-2" style="font-size: 18px;">{{$value->product->partner->nama_toko}}</label>
                                    <div class="row align-middle" style="font-size: 14px;">
                                        <div class="col-md-9 my-auto">
                                            <label class="card-text text-muted">{{__('Dipesan pada: '.Carbon::parse($value->pesanan->updated_at)->translatedFormat('d F Y H:i').' WIB') }}</label>
                                        </div>
                                        <div class="text-right col-md-3">
                                            <a href="{{ route('ulasan.ulas', ['idProduk' => $value->product->id_produk, 'idPesanan' => $value->pesanan->id_pesanan]) }}" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">
                                                {{__('Ulas') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" id="fotoProdukBelumDiulas" name="fotoProdukBelumDiulas" value="{{$value->product->foto_produk[0]}}" hidden>
                @endforeach
        </div>
    </div>

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>

        $('#urutkanUlasanList span').on('click', function () {
            $('#urutkanUlasanBtn').text($(this).text());
            $('#keyword_urutkan_ulasan').val($(this).text());
            filter();
        });

        function filter() {
                var data = {
                    keywordFilter: $('#keyword_urutkan_ulasan').val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('urutkan.ulasan') }}",
                    method: 'GET',
                    data: data,
                    dataType: 'json',

                    beforeSend: function() {
                        $('.ulasan').html(
                            '<div class="" style="position:relative; left:40%;"><img id="imgLoading" src="/img/loading.gif" /></div>'
                        );
                    },
                    uploadProgress: function() {
                        $('#imgLoading').show();
                    },
                    success: function(ulasan) {
                        var itemUlasan = '';
                        if(ulasan['filterKey'] === "Sudah Diulas"){
                            for (i = 0; i < ulasan['ulasan'].length; i++) {
                                var urlUlasanSaya = "/ulasan/ulasan-saya/" + ulasan['arrayProdukUlasan'][i].id_produk + "/" + ulasan['ulasan'][i].id_ulasan;
                                itemUlasan += '<div class="card shadow-sm mb-3 pl-4 pr-2" style="border-radius: 10px;">';
                                    itemUlasan += '<div class="row">';
                                        itemUlasan += '<div class="container text-center align-self-center col-md-2">';
                                            if (ulasan['arrayFotoProdukUlasan'] != null) {
                                                itemUlasan += '<img src="'+ ulasan['arrayFotoProdukUlasan'][0] +'" width="100" height="100" alt="no logo" style="object-fit:cover; border-radius:8px;">';
                                            } else {
                                                itemUlasan += '<img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="100" height="100" alt="no logo" style="object-fit:cover; border-radius:8px;">';
                                            }
                                        itemUlasan += '</div>';
                                        itemUlasan += '<div class="col-md-10">';
                                            itemUlasan += '<div class="card-body">';
                                                itemUlasan += '<h5 class="card-title text-truncate SemiBold mb-1" style="font-size: 24px;">'+ ulasan['arrayProdukUlasan'][i].nama +'</h5>';
                                                itemUlasan += '<label class="card-text text-truncate mb-2" style="font-size: 18px;">'+ulasan['arrayPartnerProduk'][i].nama_toko+'</label>';
                                                itemUlasan += '<div class="row align-middle" style="font-size: 14px;">';
                                                    itemUlasan += '<div class="col-md-9 my-auto">';
                                                        itemUlasan += '<label class="card-text text-muted">Diulas pada: ' + moment(ulasan['ulasan'][i].updated_at).format('D MMMM Y H:mm') + ' WIB </label>';
                                                    itemUlasan += '</div>';
                                                    itemUlasan += '<div class="text-right col-md-3">';
                                                        itemUlasan += '<a href="'+ urlUlasanSaya +'" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">';
                                                            itemUlasan += 'Lihat';
                                                        itemUlasan += '</a>';
                                                    itemUlasan += '</div>';
                                                itemUlasan += '</div>';
                                            itemUlasan += '</div>';
                                        itemUlasan += '</div>';
                                    itemUlasan += '</div>';
                                itemUlasan += '</div>';
                            }
                        }
                        else {
                            for (i = 0; i < ulasan['arrayBelumDiulas'].length; i++) {
                                var urlUlasProduk = "/ulasan/ulas/" + ulasan['arrayProdukUlasan'][i].id_produk + "/" + ulasan['arrayPesananUlasan'][i].id_pesanan;
                                itemUlasan += '<div class="card shadow-sm mb-3 pl-4 pr-2" style="border-radius: 10px;">';
                                    itemUlasan += '<div class="row">';
                                        itemUlasan += '<div class="container text-center align-self-center col-md-2">';
                                            if (ulasan['arrayFotoProdukUlasan'] != null) {
                                                itemUlasan += '<img src="'+ ulasan['arrayFotoProdukUlasan'][0] +'" width="100" height="100" alt="no logo" style="object-fit:cover; border-radius:8px;">';
                                            } else {
                                                itemUlasan += '<img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="100" height="100" alt="no logo" style="object-fit:cover; border-radius:8px;">';
                                            }
                                        itemUlasan += '</div>';
                                        itemUlasan += '<div class="col-md-10">';
                                            itemUlasan += '<div class="card-body">';
                                                itemUlasan += '<h5 class="card-title text-truncate SemiBold mb-1" style="font-size: 24px;">'+ ulasan['arrayProdukUlasan'][i].nama +'</h5>';
                                                itemUlasan += '<label class="card-text text-truncate mb-2" style="font-size: 18px;">'+ulasan['arrayPartnerProduk'][i].nama_toko+'</label>';
                                                itemUlasan += '<div class="row align-middle" style="font-size: 14px;">';
                                                    itemUlasan += '<div class="col-md-9 my-auto">';
                                                        itemUlasan += '<label class="card-text text-muted">Dipesan pada: ' + moment(ulasan['arrayPesananUlasan'][i].updated_at, ).format('DD MMMM Y H:mm') + ' WIB </label>';
                                                    itemUlasan += '</div>';
                                                    itemUlasan += '<div class="text-right col-md-3">';
                                                        itemUlasan += '<a href="'+urlUlasProduk+'" class="btn btn-primary-wakprint btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">';
                                                            itemUlasan += 'Ulas';
                                                        itemUlasan += '</a>';
                                                    itemUlasan += '</div>';
                                                itemUlasan += '</div>';
                                            itemUlasan += '</div>';
                                        itemUlasan += '</div>';
                                    itemUlasan += '</div>';
                                itemUlasan += '</div>';
                            }
                        }
                        $('#imgLoading').hide();
                        $('.ulasan').html(itemUlasan);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal({title: "Kesalahan Sistem",
                            text: "Maaf, terdapat kesalahan sistem mohon untuk refresh halaman Anda",
                            icon: "warning",
                            buttons:"OK",
                            dangerMode: true,
                        })
                    }
                });
        }
    </script>
@endsection
