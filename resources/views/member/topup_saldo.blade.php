<h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Top Up Saldo') }}</h1>
<div class="bg-primary-yellow p-4 mb-5" style="border-radius:5px;">
    <label class="mb-2" style="font-size: 24px;">{{__('Masukkan Nominal') }}</label>
    <div class="input-group mb-4">
        <input type="text" class="form-control form-control-lg form-control-yellow pt-2 pb-2"
        style="font-size: 18px;"
        placeholder="Contoh : 1.000.000" aria-label="Contoh : 1.000.000"
        aria-describedby="inputGroup-sizing-sm"
        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
    </div>
    <div class="container pl-0 pr-0 mb-4">
        <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
            style="border-radius:30px; font-size:24px;">
            <i class="material-icons md-48 align-middle mr-2">upgrade</i>
            {{__('Top Up') }}
        </button>
    </div>
</div>
<h1 class="font-weight-bold mb-5 ml-1" style="font-size:48px;">{{__('Transaksi Terakhir Kamu') }}</h1>
<div class="table-scrollbar pr-3 mb-5 ml-1">
    <table class="table table-hover">
        <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
            <tr style="font-size:18px;">
                <th class="align-middle" scope="col-md-auto">{{__('ID') }}</th>
                <th class="align-middle" scope="col-md-auto">{{__('Jenis Transaksi') }}</th>
                <th class="align-middle" scope="col-md-auto">{{__('Biaya') }}</th>
                <th class="align-middle" scope="col-md-auto">{{__('Keterangan') }}</th>
            </tr>
        </thead>
        <tbody style="font-size:14px;">

            {{-- @foreach ($collection as $item) --}}
            <tr>

                {{-- @foreach ($collection as $item) --}}
                <td class="align-middle" scope="row">{{__('00000001') }}</td>
                <td class="align-middle">{{__('Saldo Keluar') }}</td>
                <td class="align-middle">{{__('Rp. 12.000') }}</td>
                <td class="align-middle">{{__('Cetak Hitam Putih Toko Uwak') }}</td>
                {{-- @endforeach --}}

            </tr>
            {{-- @endforeach --}}

        </tbody>
    </table>
</div>