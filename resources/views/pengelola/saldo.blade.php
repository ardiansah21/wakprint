@extends('layouts.pengelola')

@section('content')
<form id="filter-form" action="{{ route('partner.filter.riwayat') }}" method="POST">
    @csrf
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
                                Rp. {{$partner->jumlah_saldo ?? 0}}
                            </label>
                        </div>
                        <div class="col-md-4 align-self-center text-right mr-0">
                            <button class="btn btn-primary-yellow pl-5 pr-5 font-weight-bold"
                                onclick="window.location.href='{{ route('partner.saldo.tarik') }}'"
                                style="border-radius:30px
                                    font-size: 16px;">
                                {{__('Tarik')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <label class="font-weight-bold mb-4 ml-0" style="font-size: 36px;">
            {{__('Riwayat Transaksi Saya')}}
        </label>
        <div class="row justify-content-between mb-4 ml-0 mr-0">
            <div class="col-md-auto form-group">
                @php
                    $jenisDana = array(
                        'Dana Masuk',
                        'Dana Keluar'
                    );
                @endphp
                <div class="dropdown" aria-required="true">
                    <input name="keyword_jenis_transaksi" type="text" id="keyword_jenis_transaksi" Class="form-control"
                        @php
                            if (session()->has('keyword_jenis_transaksi')) {
                                echo "value = '".session('keyword_jenis_transaksi')."' autofocus onfocus='this.value = this.value;'";
                            }
                        @endphp
                        hidden>
                    <button id="jenisDanaButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                        id="dropdownJenisDana" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                        {{__('Jenis Dana')}}
                    </button>
                    <div id="jenisDanaList" class="dropdown-menu" aria-labelledby="dropdownJenisDana"
                        style="font-size: 16px; width:100%;">
                        @foreach ($jenisDana as $jd)

                            <span class="dropdown-item cursor-pointer">
                                {{$jd}}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <label class="col-md-1 mb-0" style="font-size: 12px;">
                {{__('Rentang Tanggal')}}
            </label>
            <div class="col-md-4">
                <input class="btn btn-lg shadow-sm border border-gray" id="tanggalAwal" name="keyword_tanggal_awal" autofocus onselect="this.value = this.value;"
                    @php
                        if (session()->has('keyword_tanggal_awal')) {
                            echo "value = '".session('keyword_tanggal_awal')."' autofocus onselect='this.value = this.value;'";
                        }
                    @endphp>
                {{-- <script>
                        var $datepicker = $('#tanggal-awal');
                        $datepicker.datepicker();
                        $datepicker.datepicker('setDate', new Date());
                    </script> --}}
                <script>
                    $('#tanggalAwal').datepicker({
                        uiLibrary: 'bootstrap4'
                    });
                </script>
            </div>
            <div class="col-md-4">
                <input class="btn btn-lg shadow-sm border border-gray" id="tanggalAkhir" autofocus onselect="this.value = this.value;">
                {{-- <script>
                        var $datepicker = $('#tanggal-awal');
                        $datepicker.datepicker();
                        $datepicker.datepicker('setDate', new Date());
                    </script> --}}
                <script>
                    $('#tanggalAkhir').datepicker({
                        uiLibrary: 'bootstrap4'
                    });
                </script>
            </div>
        </div>
        @if (!empty($transaksi_saldo))
        <div class="table-scrollbar mb-4 ml-0 pr-2">
            <table class="table table-hover">
                <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;
                    font-size:16px;">
                    <tr>
                        <th scope="col-md-auto">{{__('ID')}}</th>
                        <th scope="col-md-auto">{{__('Waktu')}}</th>
                        <th scope="col-md-auto">{{__('Tanggal')}}</th>
                        <th scope="col-md-auto">{{__('Jenis Dana')}}</th>
                        <th scope="col-md-auto">{{__('Jumlah')}}</th>
                        <th scope="col-md-auto">{{__('Detail Transaksi')}}</th>
                    </tr>
                </thead>
                <tbody style="font-size:12px;">
                    @if(session()->has('transaksi_saldo'))
                        @foreach(session('transaksi_saldo') as $ts)
                            @if (($ts->jenis_transaksi === 'Tarik' || $ts->jenis_transaksi === 'Pembayaran') && $ts->id_pengelola === $partner->id_pengelola)
                            <tr>
                                <td scope="row">{{$ts->id_transaksi ?? ''}}</td>
                                <td>{{date('H:i', strtotime($ts->waktu ?? ''))}}</td>
                                <td>{{date('d/m/y', strtotime($ts->waktu ?? ''))}}</td>
                                @if ($ts->jenis_transaksi === 'Tarik')
                                    <td>{{__('Dana Keluar')}}</td>
                                @else
                                    <td>{{__('Dana Masuk')}}</td>
                                @endif
                                <td>Rp. {{$ts->jumlah_saldo ?? ''}}</td>
                                <td>
                                    <a class="text-primary-purple"
                                        href="riwayat/{{ $ts->id_transaksi }}"
                                        {{-- href="riwayat/{{ $ts->id_transaksi }}" --}}
                                        >
                                        {{__('Lihat') }}
                                    </a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="text-right mb-5">
            <button class="btn btn-outline-purple font-weight-bold pl-5 pr-5" style="border-radius:30px;
                font-size:16px;">
                {{__('Export Excel')}}
            </button>
        </div>
        @else
            <label>Riwayat Transaksi Kosong</label>
        @endif
    </div>
</form>

@endsection

@section('script')
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
        $('#jenisDanaList span').on('click', function () {
            $('#jenisDanaButton').text($(this).text());
            $('#keyword_jenis_transaksi').val($(this).text());
            event.preventDefault();
            document.getElementById('filter-form').submit();
        });
        // $('#jenisDanaList span').on('select', function () {
        //     $('#jenisdata').window.location.href = {{ route('partner.filter.riwayat') }}
        // });
    </script>
@endsection
