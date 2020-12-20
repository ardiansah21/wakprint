@extends('layouts.member')

@section('content')
    <div class="container">
        @php
            use Carbon\Carbon;
        @endphp
        <div class="card shadow-sm p-4 mt-5 mb-5">
            <span>
                <button class="close material-icons md-32" onclick="window.location.href='{{ route('riwayat') }}'">
                    close
                </button>
                <label class="font-weight-bold" style="font-size: 48px;">
                    Pembayaran {{$transaksi_saldo->status}}
                </label>
            </span>
            <br>
            <label class="mb-5" id="idTransaksi" name="id_transaksi" style="font-size: 18px;">
                {{'ID Transaksi Kamu : '. $transaksi_saldo->id_transaksi}}
            </label>
            <div class="mb-5">
                <label class="SemiBold mt-2 mb-0" style="font-size: 18px;">
                    {{__('Kode Pembayaran Kamu') }}
                </label>
                <br>
                <label class="font-weight-bold text-primary-success mb-4" id="kodePembayaran" name="kode_pembayaran" style="font-size: 48px;">
                    {{$transaksi_saldo->kode_pembayaran}}
                </label>
                <br>
                <label class="SemiBold mt-2 mb-0" style="font-size: 18px;">
                    @if ($transaksi_saldo->jenis_transaksi === 'Pembayaran')
                        {{__('Total Pembayaran Anda') }}
                    @else
                        {{__('Jumlah Top Up Saldo Anda') }}
                    @endif
                </label>
                <br>
                <label class="text-primary-danger font-weight-bold" id="waktuTransaksi" name="waktu" style="font-size: 48px;">
                    {{rupiah($transaksi_saldo->jumlah_saldo)}}
                </label>
                <br>
                <label class="mt-2" id="waktuTransaksi" name="waktu" style="font-size: 18px;">
                    @if ($transaksi_saldo->status != 'Gagal')
                        {{__('Telah dibayar pada : ') }} {{Carbon::parse($transaksi_saldo->updated_at)->translatedFormat('d F Y')}}
                    @else
                        {{__('Telah dibatalkan pada : ') }} {{Carbon::parse($transaksi_saldo->updated_at)->translatedFormat('d F Y')}}
                    @endif
                </label>
            </div>
            @if ($transaksi_saldo->status != 'Gagal')
                <label class="badge badge-pill bg-primary-purple py-3 text-white font-weight-bold mb-5" style="border:#BC41BE 1px solid; font-size: 24px;">
                    {{__('Selesai') }}
                </label>
            @else
                <label class="badge badge-pill py-3 text-primary-danger font-weight-bold mb-5" style="border:#FF4949 1px solid; font-size: 24px;">
                    {{__('Dibatalkan') }}
                </label>
            @endif

        </div>
    </div>
@endsection
