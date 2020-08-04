@extends('layouts.pengelola')

@section('content')
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
                            {{__('Rp. 57.000')}}
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
        <div class="col-md-auto dropdown">
            <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                id="filter-saldo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="font-size: 16px;">
                {{__('Jenis Dana')}}
            </button>
            <div class="dropdown-menu" aria-labelledby="filter-saldo" style="font-size: 16px;">
                <a class="dropdown-item" href="#">
                    {{__('Dana Masuk')}}
                </a>
                <a class="dropdown-item" href="#">
                    {{__('Dana Keluar')}}
                </a>
            </div>
        </div>
        <label class="col-md-1 mb-0" style="font-size: 12px;">
            {{__('Rentang Tanggal')}}
        </label>
        <div class="col-md-4">
            <input id="tanggal-awal" class="btn btn-lg shadow-sm border border-gray" id="tanggal-awal">
            {{-- <script>
                    var $datepicker = $('#tanggal-awal');
                    $datepicker.datepicker();
                    $datepicker.datepicker('setDate', new Date());
                </script> --}}
            <script>
                $('#tanggal-awal').datepicker({
                    uiLibrary: 'bootstrap4'
                });
            </script>
        </div>
        <div class="col-md-4">
            <input id="tanggal-akhir" class="btn btn-lg shadow-sm border border-gray" id="tanggal-akhir">
            {{-- <script>
                    var $datepicker = $('#tanggal-awal');
                    $datepicker.datepicker();
                    $datepicker.datepicker('setDate', new Date());
                </script> --}}
            <script>
                $('#tanggal-akhir').datepicker({
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
                @foreach ($transaksi_saldo as $ts)
                {{-- @if ($ts->jenis_transaksi === 'Tarik') --}}
                <tr class="clickable-row"
                    {{-- onclick="window.location.href='partner/riwayat/{{ $ts->id_transaksi }}'" --}} {{-- data-toggle="modal"
                data-target="#detailTransaksiModal" --}}>

                    {{-- @foreach ($collection as $item) --}}
                    <td scope="row">{{$ts->id_transaksi}}</td>
                    <td>{{date('H:i', strtotime($ts->waktu))}}</td>
                    <td>{{date('d/m/y', strtotime($ts->waktu))}}</td>
                    <td>{{$ts->jenis_transaksi}}</td>
                    <td>Rp. {{$ts->jumlah_saldo}}</td>
                    <td>
                        <a class="text-primary-purple"
                            href=""
                            {{-- href="riwayat/{{ $ts->id_transaksi }}" --}}
                            >
                            {{__('Lihat') }}
                        </a>
                    </td>
                    {{-- @endforeach --}}

                </tr>
                {{-- @endif --}}
                @endforeach
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


<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="row justify-content-left ml-0 mb-3" style="font-size: 18px;">
                <label class="font-weight-bold mr-3">
                    {{__('Percetakan')}}
                </label>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"
                style="font-size: 18px;">
                <a class="nav-link mb-2" id="v-pills-beranda-tab" href="{{ route('partner.home') }}" role="tab"
                    aria-controls="v-pills-beranda" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        home
                    </i>
                    {{__('Beranda')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-pesanan-tab" href="{{ route('partner.pesanan') }}" role="tab"
                    aria-controls="v-pills-pesanan" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        shopping_cart
                    </i>
                    {{__('Pesanan')}}
                </a>
                <a class="nav-link active mb-2" id="v-pills-saldo-tab" href="{{ route('partner.saldo') }}" role="tab"
                    aria-controls="v-pills-saldo" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        account_balance_wallet
                    </i>
                    {{__('Saldo')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-produk-tab" href="{{ route('partner.produk') }}" role="tab"
                    aria-controls="v-pills-produk" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        print
                    </i>
                    {{__('Produk')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-promo-tab" href="{{ route('partner.promo') }}" role="tab"
                    aria-controls="v-pills-promo" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        local_offer
                    </i>
                    {{__('Promo')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-atk-tab" href="{{ route('partner.atk') }}" role="tab"
                    aria-controls="v-pills-atk" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        architecture
                    </i>
                    {{__('Alat Tulis Kantor')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-info-tab" href="{{ route('partner.info') }}" role="tab"
                    aria-controls="v-pills-info" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        contact_support
                    </i>
                    {{__('Info dan Bantuan')}}
                </a>
                <a class="nav-link mb-2 mt-4" id="v-pills-keluar-tab" data-toggle="pill" href="#v-pills-keluar"
                    role="tab" aria-controls="v-pills-keluar" aria-selected="true"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons text-primary-danger md-36 align-middle mr-2">
                        exit_to_app
                    </i>
                    {{__('Keluar')}}
                </a>
                <form id="logout-form" action="{{ route('partner.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="tab-content col-md-8">

        </div>
    </div>
    <label class="font-weight-bold mb-4 ml-0" style="font-size: 36px;">
        {{__('Riwayat Transaksi Saya')}}
    </label>
    <div class="row justify-content-between mb-4 ml-0 mr-0">
        <div class="col-md-auto dropdown">
            <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                id="filter-saldo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="font-size: 16px;">
                {{__('Jenis Dana')}}
            </button>
            <div class="dropdown-menu" aria-labelledby="filter-saldo" style="font-size: 16px;">
                <a class="dropdown-item" href="#">
                    {{__('Dana Masuk')}}
                </a>
                <a class="dropdown-item" href="#">
                    {{__('Dana Keluar')}}
                </a>
            </div>
        </div>
        <label class="col-md-1 mb-0" style="font-size: 12px;">
            {{__('Rentang Tanggal')}}
        </label>
        <div class="col-md-4">
            <input id="tanggal-awal" class="btn btn-lg shadow-sm border border-gray" id="tanggal-awal">
            {{-- <script>
                    var $datepicker = $('#tanggal-awal');
                    $datepicker.datepicker();
                    $datepicker.datepicker('setDate', new Date());
                </script> --}}
            <script>
                $('#tanggal-awal').datepicker({
                    uiLibrary: 'bootstrap4'
                });
            </script>
        </div>
        <div class="col-md-4">
            <input id="tanggal-akhir" class="btn btn-lg shadow-sm border border-gray" id="tanggal-akhir">
            {{-- <script>
                    var $datepicker = $('#tanggal-awal');
                    $datepicker.datepicker();
                    $datepicker.datepicker('setDate', new Date());
                </script> --}}
            <script>
                $('#tanggal-akhir').datepicker({
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
                @foreach ($transaksi_saldo as $ts)
                {{-- @if ($ts->jenis_transaksi === 'Tarik') --}}
                <tr class="clickable-row"
                    {{-- onclick="window.location.href='partner/riwayat/{{ $ts->id_transaksi }}'" --}} {{-- data-toggle="modal"
                data-target="#detailTransaksiModal" --}}>

                    {{-- @foreach ($collection as $item) --}}
                    <td scope="row">{{$ts->id_transaksi}}</td>
                    <td>{{date('H:i', strtotime($ts->waktu))}}</td>
                    <td>{{date('d/m/y', strtotime($ts->waktu))}}</td>
                    <td>{{$ts->jenis_transaksi}}</td>
                    <td>Rp. {{$ts->jumlah_saldo}}</td>
                    <td>
                        <a class="text-primary-purple"
                            href=""
                            {{-- href="riwayat/{{ $ts->id_transaksi }}" --}}
                            >
                            {{__('Lihat') }}
                        </a>
                    </td>
                    {{-- @endforeach --}}

                </tr>
                {{-- @endif --}}
                @endforeach
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
@endsection
