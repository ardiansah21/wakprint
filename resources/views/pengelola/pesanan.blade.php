@extends('layouts.pengelola')

@section('content')
<div id="v-pills-beranda" role="tabpanel">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row justify-content-between mb-3">
        <div class="col-md-8">
            <div class="form-group search-input">
                <div class="main-search-input-item">
                    <input id="keywordFilterPesanan" name="keywordFilterPesanan" type="text" role="search" class="form-control" placeholder="Cari pesanan anda disini..."  value="" style="border:0px solid white; border-radius:30px; font-size:16px;">
                        <i id="searchPesanan" class="material-icons cursor-pointer ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute; top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            search
                        </i>
                </div>
            </div>
        </div>
        <div class="col-md-auto mr-0">
            @php
                $filterPesanan = array('Semua', 'Terbaru', 'Harga Tertinggi', 'Harga Terendah');
            @endphp
            <div class="dropdown" aria-required="true">
                <input name="keyword_filter_pesanan" type="text" id="keyword_filter_pesanan" Class="form-control" hidden>
                <button id="filterPesananBtn" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownJenisDana" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                    {{ __('Semua') }}
                </button>
                <div id="filterPesananList" class="dropdown-menu" aria-labelledby="dropdownFilterPesanan" style="font-size: 16px; width:100%;">
                    @foreach ($filterPesanan as $fp)
                        <span class="dropdown-item cursor-pointer">
                            {{ $fp }}
                            <input id="filterPesanan" name="filterPesanan" type="text" value="{{$fp}}" Class="form-control" hidden>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="table-scrollbar mb-5 mr-0 pr-2">
        <table class="table table-hover">
            <thead class="bg-primary-purple text-white"
                style="border-radius:25px 25px 15px 15px;">
                <tr style="font-size: 16px;">
                    <th scope="col-md-auto">{{__('ID')}}</th>
                    <th scope="col-md-auto">{{__('Waktu')}}</th>
                    <th scope="col-md-auto">{{__('Tanggal')}}</th>
                    <th scope="col-md-auto">{{__('Jumlah Dokumen')}}</th>
                    <th scope="col-md-auto">{{__('Pengambilan')}}</th>
                    <th scope="col-md-auto">{{__('Status')}}</th>
                </tr>
            </thead>
            <tbody id="tbodyPesanan" class="tbodyPesanan" style="font-size: 12px;">
                @foreach ($partner->pesanans as $p => $value)
                    @if (!empty($value))
                        @if (($value->status != "Pending" && !empty($value->status)) && $value->transaksiSaldo->status != "Pending")
                            <tr class="cursor-pointer" onclick="window.location.href='{{ route('partner.detail.pesanan',$value->id_pesanan) }}'">
                                <td scope="row">{{$value->id_pesanan}}</td>
                                <td>{{Carbon::parse($value->updated_at)->translatedFormat('H:i')}} WIB</td>
                                <td>{{Carbon::parse($value->updated_at)->translatedFormat('d F Y')}}</td>
                                <td>{{count($value->konfigurasiFile)}}</td>
                                <td>
                                    @if ($value->metode_penerimaan != "Ditempat")
                                        {{__('Antar ke Rumah')}}
                                    @else
                                        {{__('Ambil di Tempat')}}
                                    @endif
                                </td>
                                <td>{{$value->status}}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script>
        $('#filterPesananList span').on('click', function() {
            $('#filterPesananBtn').text($(this).text());
            $('#keyword_filter_pesanan').val($(this).text());
            $('#filterPesanan').val($(this).text());
            filter();
        });

        $('#searchPesanan').on('click', function() {
            filter();
        });

        function filter() {
            var data = {
                keywordFilterPesanan: $('#keywordFilterPesanan').val(),
                urutkanPesan: $('#filterPesanan').val(),
            };

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{ route('partner.pesanan.filter') }}",
                method:'GET',
                data:data,
                dataType:'json',

                beforeSend:function(){
                    $('.tbodyPesanan').html('<div class="text-center mx-auto"><img class="mx-auto" id="imgLoading" style="width:64px; height:64px;" src="/img/loading.gif" /></div>');
                },
                uploadProgress: function () {
                    $('#imgLoading').show();
                },
                success:function(pesanan)
                {
                    var rowListPesanan = '';
                    for(i = 0; i < pesanan['pesanan'].length; i++) {
                        var urlDetailProduk = "pesanan/detail/" + pesanan['pesanan'][i].id_pesanan;
                        rowListPesanan += '<tr class="cursor-pointer">';
                            rowListPesanan += '<td scope="row">' + pesanan['pesanan'][i].id_pesanan + '</td>';
                            rowListPesanan += '<td>' + moment(pesanan['pesanan'][i].updated_at).format('H:mm') + ' WIB</td>';
                            rowListPesanan += '<td>' + moment(pesanan['pesanan'][i].updated_at).format('D MMMM Y') + '</td>';
                            rowListPesanan += '<td>' + pesanan['konfigurasi'].length + '</td>';
                            rowListPesanan += '<td>';
                                if(pesanan['pesanan'][i].metode_penerimaan != 'Ditempat'){
                                    rowListPesanan += 'Antar ke Rumah';
                                }
                                else{
                                    rowListPesanan += 'Ambil di Tempat';
                                }
                            rowListPesanan += '</td>';
                            rowListPesanan += '<td>'+ pesanan['pesanan'][i].status +'</td>';
                        rowListPesanan += '<tr/>';
                    }

                    $('.tbodyPesanan').on( 'click', 'tr', function () {
                        document.location.href = urlDetailProduk;
                    });

                    $('#imgLoading').hide();
                    $('.tbodyPesanan').html(rowListPesanan);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                    alert(thrownError);
                }
            });
        }
    </script>
@endsection


