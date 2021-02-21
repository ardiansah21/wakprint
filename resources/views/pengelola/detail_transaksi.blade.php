@extends('layouts.pengelola')

@section('content')

<div class="tab-pane fade show active" role="tabpanel">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container card shadow-sm p-4">
        <span>
            <a class="close material-icons md-32" href="{{ route('partner.saldo') }}">
                close
            </a>
            <label class="font-weight-bold mb-5"
                style="font-size: 36px;">
                {{__('Detail Transaksi')}}
            </label>
        </span>
        <div class="row justify-content-between mb-5">
            <div class="col-md-auto">
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Nama Pemilik Rekening')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{$partner->nama_lengkap}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Nama Bank')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{$partner->nama_bank}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Nomor Rekening')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{$partner->nomor_rekening}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Status Transaksi')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{$transaksi_saldo->status}}
                </label>
            </div>
            <div class="container col-md-auto">
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Tanggal dan Waktu Transaksi')}}
                </label>
                <br>
                <label class="mb-2" style="font-size: 18px;">
                    {{Carbon::parse($transaksi_saldo->updated_at)->translatedFormat('d F Y H:i').' WIB' ?? '-'}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Jenis Dana')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    @if ($transaksi_saldo->jenis_transaksi === 'Tarik')
                        <td>{{__('Dana Keluar')}}</td>
                    @else
                        <td>{{__('Dana Masuk')}}</td>
                    @endif
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Jumlah Saldo')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{rupiah($transaksi_saldo->jumlah_saldo)}}
                </label>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection



