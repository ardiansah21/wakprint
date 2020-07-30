<h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Riwayat Transaksi Saya') }}</h1>
<div class="mb-4">
    <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="filterriwayat" style="font-size: 18px;">
        <option class="dropdown-item" value="">Terbaru</option>
        <option value="Harga Tertinggi">{{__('Harga Tertinggi')}}</option>
        <option value="Harga Terendah">{{__('Harga Terendah')}}</option>
        <option value="Saldo Masuk">{{__('Saldo Masuk')}}</option>
        <option value="Saldo Keluar">{{__('Saldo Keluar')}}</option>
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
<div class="custom-scrollbar-ulasan mb-5 ml-1">
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
            @foreach ($transaksi_saldo as $ts)
                <tr>
                    <td class="align-middle" scope="row">{{ $ts->id_transaksi }}</td>
                    <td class="align-middle">{{ $ts->jenis_transaksi }}</td>
                    <td class="align-middle">{{ $ts->waktu }}</td>
                    <td class="align-middle">Rp. {{ $ts->jumlah_saldo }}</td>
                    <td class="align-middle">{{ $ts->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>