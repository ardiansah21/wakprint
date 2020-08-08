@extends('layouts.member')

@section('content')
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
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
    @if (!empty($transaksi_saldo))
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
                    @if (($ts->jenis_transaksi === 'TopUp' || $ts->jenis_transaksi === 'Pembayaran') && $ts->id_member === $member->id_member)
                        <tr
                            @if ($ts->jenis_transaksi === 'TopUp')
                                onclick="window.location.href='saldo/riwayat/{{ $ts->id_transaksi }}'"
                            @else
                                onclick="window.location.href='{{ route('detail.pesanan') }}'"
                            @endif>
                            <td class="align-middle" scope="row">{{ $ts->id_transaksi }}</td>
                            <td class="align-middle">{{ $ts->jenis_transaksi }}</td>
                            <td class="align-middle">{{ $ts->waktu }}</td>
                            <td class="align-middle">Rp. {{ $ts->jumlah_saldo }}</td>
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
