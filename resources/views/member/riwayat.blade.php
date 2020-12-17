@extends('layouts.member')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Riwayat Transaksi Saya') }}</h1>
    <div class="mb-4">
        @php
            $filterRiwayat = array('Semua', 'Terbaru', 'Harga Tertinggi', 'Harga Terendah', 'Saldo Masuk', 'Saldo Keluar');
        @endphp
        <div class="dropdown" aria-required="true">
            <input id="filterRiwayat" name="filterRiwayat" type="text" Class="form-control" hidden>
            <button id="filterRiwayatButton" class="is-flex btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" id="dropdownFilterRiwayat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                {{$filterRiwayat[0]}}
            </button>
            <div id="filterRiwayatList" class="dropdown-menu" aria-labelledby="dropdownFilterRiwayat" style="font-size: 16px;">
                @foreach ($filterRiwayat as $fr)
                    <span class="dropdown-item cursor-pointer">{{$fr}}</span>
                @endforeach
            </div>
        </div>
    </div>
    @if (!empty($transaksi_saldo))
        <div class="custom-scrollbar-ulasan mb-5 ml-1">
            <table id="riwayatTable" class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white">
                    <tr style="font-size: 18px;">
                        <th class="align-middle" scope="col">{{__('ID') }}</th>
                        <th class="align-middle" scope="col">{{__('Jenis Transaksi') }}</th>
                        <th class="align-middle" scope="col">{{__('Kapan') }}</th>
                        <th class="align-middle" scope="col">{{__('Biaya') }}</th>
                        <th class="align-middle" scope="col">{{__('Keterangan') }}</th>
                    </tr>
                </thead>
                <tbody class="tbodySaldo" style="font-size: 14px;">
                    @foreach ($transaksi_saldo as $ts)
                        @if (($ts->jenis_transaksi === 'TopUp' || $ts->jenis_transaksi === 'Pembayaran') && ($ts->status === 'Berhasil' || $ts->status === 'Gagal') && $ts->id_member === $member->id_member)
                            <tr onclick="window.location.href='{{route('riwayat.saldo',$ts->id_transaksi) }}'">
                                <td class="align-middle" scope="row">{{ $ts->id_transaksi }}</td>
                                <td class="align-middle">{{ $ts->jenis_transaksi }}</td>
                                <td class="align-middle">{{ Carbon::parse($ts->updated_at)->diffForHumans() }}</td>
                                <td class="align-middle">{{ rupiah($ts->jumlah_saldo) }}</td>
                                <td class="align-middle">{{ $ts->keterangan }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <label>{{__('Belum ada riwayat transaksi')}}</label>
    @endif
    </div>
@endsection
@section('script')
<script>
    $('#filterRiwayatList span').on('click', function() {
        $('#filterRiwayatButton').text($(this).text());
        $('#filterRiwayat').val($(this).text());
        filterRiwayat();
    });

    function rupiah(val) {
        return ("Rp. " + val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1."));
    }

    function filterRiwayat() {
        var data = {
            filterRiwayat: $('#filterRiwayat').val(),
        };

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"{{ route('riwayat.filter') }}",
            method:'GET',
            data:data,
            dataType:'json',

            beforeSend:function(){
                $('.tbodySaldo').html('<div><img class="mx-auto" id="imgLoading" style="position:relative; left:400%; width:64px; height:64px;" src="/img/loading.gif" /></div>');
            },
            uploadProgress: function () {
                $('#imgLoading').show();
            },
            success:function(transaksi_saldo)
            {
                var rowListSaldo = '';
                for(i = 0; i < transaksi_saldo['transaksi_saldo'].length;i++){
                    var urlRiwayat = "saldo/riwayat/" + transaksi_saldo['transaksi_saldo'][i].id_transaksi;
                    rowListSaldo += '<tr>';
                        rowListSaldo += '<td scope="row">' + transaksi_saldo['transaksi_saldo'][i].id_transaksi + '</td>';
                        rowListSaldo += '<td scope="row">' + transaksi_saldo['transaksi_saldo'][i].jenis_transaksi + '</td>';
                        rowListSaldo += '<td>' + moment(transaksi_saldo['transaksi_saldo'][i].updated_at).format('D MMMM Y') + '</td>';
                        rowListSaldo += '<td>' + rupiah(transaksi_saldo['transaksi_saldo'][i].jumlah_saldo) + '</td>';
                        rowListSaldo += '<td>'+ transaksi_saldo['transaksi_saldo'][i].keterangan +'</td>';
                    rowListSaldo += '<tr/>';

                    $('#riwayatTable tbody').on('click', 'tr', function () {
                        document.location.href=urlRiwayat;
                    });
                }

                $('#imgLoading').hide();
                $('.tbodySaldo').html(rowListSaldo);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
                alert(thrownError);
            }
        })
    };
</script>
@endsection
