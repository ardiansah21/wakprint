@extends('layouts.member')

@section('content')
<div class="container">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card shadow-sm p-4 mt-5 mb-5">
        <span>
            <button class="close material-icons md-32"
                onclick="window.location.href='{{ route('riwayat') }}'">
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
                {{__('Jumlah Top Up Saldo Anda') }}
            </label>
            <br>
            <label class="text-primary-danger font-weight-bold" id="waktuTransaksi" name="waktu" style="font-size: 48px;">
                {{rupiah($transaksi_saldo->jumlah_saldo)}}
            </label>
            <br>
            <label class="mt-2" id="waktuTransaksi" name="waktu" style="font-size: 18px;">
                {{__('Telah dibayar pada : ') }} {{Carbon::parse($transaksi_saldo->updated_at)->translatedFormat('d F Y')}}
            </label>
        </div>
        <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold" disabled style="font-size: 24px;">
            {{__('Selesai') }}
        </button>
    </div>
</div>

@endsection
