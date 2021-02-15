@extends('layouts.pengelola')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
        <div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
            <div class="bg-primary-purple text-white mb-5 ml-0" style="border-radius:10px;">
                <div class="row justify-content-left card-body ml-0">
                    <div class="col-md-auto text-center align-self-center mr-0">
                        <i class="material-icons md-48 align-middle">
                            account_balance_wallet
                        </i>
                    </div>
                    <div class="col-md-10">
                        <div class="row justify-content-between">
                            <div class="col-md-8">
                                <label class="font-weight-bold mb-0" style="font-size: 36px;">
                                    {{ rupiah($partner->jumlah_saldo) ?? 0 }}
                                </label>
                            </div>
                            <div class="col-md-4 align-self-center text-right mr-0">
                                <button class="btn btn-primary-yellow pl-5 pr-5 font-weight-bold" onclick="window.location.href='{{ route('partner.saldo.tarik') }}'" style="border-radius:30px font-size: 16px;">
                                    {{ __('Tarik') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <label class="font-weight-bold mb-4 ml-0" style="font-size: 36px;">
                {{ __('Riwayat Transaksi Saya') }}
            </label>
            <div class="row justify-content-between mb-4 ml-0 mr-0">
                <div class="col-md-auto form-group">
                    @php
                        $jenisDana = array('Semua', 'Dana Masuk', 'Dana Keluar');
                    @endphp
                    <div class="dropdown" aria-required="true">
                        <input name="keyword_jenis_transaksi" type="text" id="keyword_jenis_transaksi" Class="form-control" hidden>
                        <button id="jenisDanaButton"
                            class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownJenisDana" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="font-size: 16px; text-align:left;">
                            {{ __('Jenis Dana') }}
                        </button>
                        <div id="jenisDanaList" class="dropdown-menu" aria-labelledby="dropdownJenisDana"
                            style="font-size: 16px; width:100%;">
                            @foreach ($jenisDana as $jd)
                                <span class="dropdown-item cursor-pointer">
                                    {{ $jd }}
                                <input id="jenisDana" name="jenisDana" type="text" value="{{$jd}}" Class="form-control" hidden>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <label class="col-md-1 mb-0" style="font-size: 12px;">
                    {{ __('Rentang Tanggal') }}
                </label>
                <div class="col-md-auto">
                    <input type="text" id="tanggalAwal" name="keyword_tanggal_awal" class="form-control form-control-lg col-md-6 datepicker-here pt-2 pb-2" placeholder="Masukkan Waktu Estimasi Anda" style="font-size: 16px;" data-timepicker="true" data-language="en" data-position="top left" oninput="this.value = this.text">

                    {{-- <input data-provide="datepicker" data-date-format="yyyy-mm-dd H:i:s" class="btn btn-lg shadow-sm border border-gray" id="tanggalAwal" name="keyword_tanggal_awal" autofocus> --}}
                </div>
                <div class="col-md-auto">
                    <input type="text" id="tanggalAkhir" name="keyword_tanggal_akhir" class="form-control form-control-lg col-md-6 datepicker-here pt-2 pb-2" placeholder="Masukkan Waktu Estimasi Anda" style="font-size: 16px;" data-timepicker="true" data-language="en" data-position="top left" oninput="this.value = this.text">

                    {{-- <input data-provide="datepicker" data-date-format="yyyy-mm-dd H:i:s" class="btn btn-lg shadow-sm border border-gray" id="tanggalAkhir" autofocus> --}}
                </div>
            </div>
            @if (!empty($transaksi_saldo))
                <div class="table-scrollbar mb-4 ml-0 pr-2">
                    <table class="table table-hover">
                        <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px; font-size:16px;">
                            <tr>
                                <th scope="col-md-auto">{{ __('ID') }}</th>
                                <th scope="col-md-auto">{{ __('Waktu') }}</th>
                                <th scope="col-md-auto">{{ __('Tanggal') }}</th>
                                <th scope="col-md-auto">{{ __('Jenis Dana') }}</th>
                                <th scope="col-md-auto">{{ __('Jumlah') }}</th>
                                <th scope="col-md-auto">{{ __('Detail Transaksi') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tbodySaldo" class="tbodySaldo" style="font-size:12px;">
                            @foreach ($transaksi_saldo as $ts)
                                @if ($ts->status === 'Berhasil' || $ts->status === 'Gagal')
                                    <tr>
                                        <input id="idPartner" type="number" value="{{$ts->id_pengelola}}" hidden>
                                        <input id="waktuTransaksi" type="text" value="{{ date('H:i', strtotime($ts->waktu ?? '')) }}" hidden>
                                        <input id="tanggalTransaksi" type="text" value="{{ date('d/m/y', strtotime($ts->waktu ?? '')) }}" hidden>
                                        <td scope="row">{{ $ts->id_transaksi ?? '' }}</td>
                                        <td>{{Carbon::parse($ts->updated_at)->translatedFormat('H:i'). ' WIB' ?? '-'}}</td>
                                        <td>{{Carbon::parse($ts->updated_at)->translatedFormat('d F Y') ?? '-'}}</td>
                                        @if ($ts->jenis_transaksi === 'Tarik')
                                            <td>{{ __('Dana Keluar') }}</td>
                                        @else
                                            <td>{{ __('Dana Masuk') }}</td>
                                        @endif
                                        <td>{{ rupiah($ts->jumlah_saldo) ?? '' }}</td>
                                        <td>
                                            <a class="text-primary-purple" href="riwayat/{{ $ts->id_transaksi }}">
                                                {{ __('Lihat') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right mb-5">
                    <button class="btn btn-outline-purple font-weight-bold pl-5 pr-5"
                        onclick="window.location.href='{{ route('partner.saldo.export') }}'" style="border-radius:30px; font-size:16px;">
                        {{ __('Export Excel') }}
                    </button>
                </div>
            @else
                <label>Riwayat Transaksi Kosong</label>
            @endif
        </div>
        {{--
    </form> --}}

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var tanggalAwal = null;
            var tanggalAkhir = null;

            $('#jenisDanaList span').on('click', function() {
                $('#jenisDanaButton').text($(this).text());
                $('#keyword_jenis_transaksi').val($(this).text());
                $('#jenisDana').val($(this).text());
                filter();
            });

            // $('#tanggalAwal').datepicker({
            //     uiLibrary: 'bootstrap4',
            //     format: 'yyyy-mm-dd',
            //     clearBtn: true
            // });

            $('#tanggalAwal').change(function() {
                tanggalAwal = $(this).val();
                filter();
            });

            // $('#tanggalAkhir').datepicker({
            //     uiLibrary: 'bootstrap4',
            //     format: 'yyyy-mm-dd',
            //     clearBtn: true
            // });

            $('#tanggalAkhir').change(function() {
                tanggalAkhir = $(this).val();
                filter();
            });

            function rupiah(val) {
                return ("Rp. " + val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1."));
            }

            function filter() {
                var data = {
                    jenisDana: $('#jenisDana').val(),
                    idPartner: $('#idPartner').val(),
                    waktuTransaksi: $('#waktuTransaksi').val(),
                    tanggalTransaksi: $('#tanggalTransaksi').val(),
                    tanggalAwal: tanggalAwal,
                    tanggalAkhir: tanggalAkhir
                };

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:"{{ route('partner.saldo.filter') }}",
                    method:'GET',
                    data:data,
                    dataType:'json',

                    beforeSend:function(){
                        $('.tbodySaldo').html('<div><img class="mx-auto" id="imgLoading" style="position:relative; left:400%; width:64px; height:64px;" src="/img/loading.gif" /></div>');
                    },
                    uploadProgress: function () {
                        $('#imgLoading').show();
                    },
                    success:function(transaksiSaldo)
                    {
                        var rowListSaldo = '';
                        for(i = 0; i < transaksiSaldo['transaksiSaldo'].length;i++){
                            rowListSaldo += '<tr>';
                                rowListSaldo += '<td scope="row">' + transaksiSaldo['transaksiSaldo'][i].id_transaksi + '</td>';
                                rowListSaldo += '<td>' + moment(transaksiSaldo['transaksiSaldo'][i].updated_at).format('H:mm') + ' WIB</td>';
                                rowListSaldo += '<td>' + moment(transaksiSaldo['transaksiSaldo'][i].updated_at).format('D MMMM Y') + '</td>';
                                if(transaksiSaldo['transaksiSaldo'][i].jenis_transaksi === 'Tarik'){
                                    rowListSaldo += '<td> Dana Keluar </td>';
                                }
                                else{
                                    rowListSaldo += '<td> Dana Masuk </td>';
                                }
                                rowListSaldo += '<td>' + rupiah(transaksiSaldo['transaksiSaldo'][i].jumlah_saldo) + '</td>';
                                rowListSaldo += '<td><a class="text-primary-purple" href="riwayat/'+ transaksiSaldo['transaksiSaldo'][i].id_transaksi +'">Lihat</a></td>';
                            rowListSaldo += '<tr/>';
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
        });
    </script>
@endsection
