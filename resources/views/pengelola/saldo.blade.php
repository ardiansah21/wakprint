<div class="bg-primary-purple text-white mb-5 ml-0"
    style="border-radius:10px;">
    <div class="row justify-content-left card-body ml-0">
        <div class="col-md-auto text-center align-self-center mr-0">
            <i class="material-icons md-48 align-middle">
                account_balance_wallet
            </i>
        </div>
        <div class="col-md-10">
            <div class="row justify-content-between">
                <div class="col-md-8">
                    <label class="font-weight-bold mb-0"
                        style="font-size: 36px;">
                        {{__('Rp. 57.000')}}
                    </label>
                </div>
                <div class="col-md-4 align-self-center text-right mr-0">
                    <button class="btn btn-primary-yellow pl-5 pr-5 font-weight-bold"
                        onclick="window.location.href='{{ route('partner.tarik.saldo') }}'"
                        {{-- data-toggle="modal"
                        data-target="#tarikSaldoModal" --}}
                        style="border-radius:30px
                            font-size: 16px;">
                        {{__('Tarik')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<label class="font-weight-bold mb-4 ml-0"
    style="font-size: 36px;">
    {{__('Riwayat Transaksi Saya')}}
</label>
<div class="row justify-content-between mb-4 ml-0 mr-0">     
    <div class="col-md-auto dropdown">
        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
            id="filter-saldo"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            style="font-size: 16px;">
            {{__('Jenis Dana')}}
        </button>
        <div class="dropdown-menu"
            aria-labelledby="filter-saldo"
            style="font-size: 16px;">
            <a class="dropdown-item"
                href="#">
                {{__('Dana Masuk')}}
            </a>
            <a class="dropdown-item"
                href="#">
                {{__('Dana Keluar')}}
            </a>
        </div>
    </div>
    <label class="col-md-1 mb-0"
        style="font-size: 12px;">
        {{__('Rentang Tanggal')}}
    </label>
    <div class="col-md-4">
        <input id="tanggal-awal"
            class="btn btn-lg shadow-sm border border-gray"
            id="tanggal-awal">
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
        <input id="tanggal-akhir"
            class="btn btn-lg shadow-sm border border-gray"
            id="tanggal-akhir">
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
<div class="table-scrollbar mb-4 ml-0 pr-2">
    <table class="table table-hover">
        <thead class="bg-primary-purple text-white"
            style="border-radius:25px 25px 15px 15px;
                font-size:16px;">
            <tr>
                <th scope="col-md-auto">{{__('No')}}</th>
                <th scope="col-md-auto">{{__('Waktu')}}</th>
                <th scope="col-md-auto">{{__('Tanggal')}}</th>
                <th scope="col-md-auto">{{__('Jenis Dana')}}</th>
                <th scope="col-md-auto">{{__('Jumlah')}}</th>
                <th scope="col-md-auto">{{__('Detail Transaksi')}}</th>
            </tr>
        </thead>
        <tbody style="font-size:12px;">

            {{-- @foreach ($collection as $item) --}}
                <tr class="clickable-row"
                    {{-- data-toggle="modal"
                    data-target="#detailTransaksiModal" --}}
                    >

                    {{-- @foreach ($collection as $item) --}}
                        <td scope="row">{{__('1')}}</td>
                        <td>{{__('09:34')}}</td>
                        <td>{{__('5/7/2020')}}</td>
                        <td>{{__('Masuk')}}</td>
                        <td>{{__('Rp. 20.000')}}</td>
                        <td><a class="text-primary-purple" href="{{ route('partner.detail.riwayat') }}">{{__('Lihat')}}</a></td>
                    {{-- @endforeach --}}
                    
                </tr>
            {{-- @endforeach --}}
            
        </tbody>
    </table>
</div>
<div class="text-right mb-5">
    <button class="btn btn-outline-purple font-weight-bold pl-5 pr-5"
        style="border-radius:30px;
            font-size:16px;">
        {{__('Export Excel')}}
    </button>
</div>

@include('pengelola.popup_detail_transaksi')
@include('pengelola.popup_tarik_saldo')
