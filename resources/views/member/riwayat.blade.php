<h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Riwayat Transaksi Saya') }}</h1>
<div class="mb-4">
    <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="year" style="font-size: 18px;">
        <option class="dropdown-item" value="">Terbaru</option>
        <option value="">Harga Tertinggi</option>
        <option value="">Harga Terendah</option>
        <option value="">Saldo Masuk</option>
        <option value="">Saldo Keluar</option>
    </select>
    
    {{-- <div class="dropdown" style="font-size: 18px;">
        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        {{__('Semua') }}
        </button>
        <div class="dropdown-menu" 
        style="font-size: 18px;"
        aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">{{__('Terbaru') }}</a>
            <a class="dropdown-item" href="#">{{__('Tinggi ke Rendah') }}</a>
            <a class="dropdown-item" href="#">{{__('Rendah ke Tinggi') }}</a>
        </div>
    </div> --}}
</div>
<div class="table-scrollbar mb-5 ml-1">
    <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
        <thead class="bg-primary-purple text-white">
            <tr style="font-size: 18px;">
                <th class="align-middle" scope="col">{{__('ID') }}</th>
                <th class="align-middle" scope="col">{{__('Jenis Transaksi') }}</th>
                <th class="align-middle" scope="col">{{__('Kapan') }}</th>
                <th class="align-middle" scope="col">{{__('Biaya') }}</th>
                <th class="align-middle" scope="col">{{__('Keterangan') }}</th>
            </tr>
        </thead>
        <tbody style="font-size: 14px;">

            {{-- @foreach ($collection as $item) --}}
            <tr>

                {{-- @foreach ($collection as $item) --}}
                <td class="align-middle" scope="row">{{__('00000001') }}</td>
                <td class="align-middle">{{__('Saldo Keluar') }}</td>
                <td class="align-middle">{{__('5 hour ago') }}</td>
                <td class="align-middle">{{__('Rp. 12.000') }}</td>
                <td class="align-middle">{{__('Cetak Hitam Putih Toko Uwak') }}</td>
                {{-- @endforeach --}}

            </tr>
            {{-- @endforeach --}}

        </tbody>
    </table>
</div>