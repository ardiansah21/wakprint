@extends('layouts.admin')

@section('content')
    <div class="card shadow-sm mb-0 p-4" style="border-radius:10px;">
        @switch(Route::currentRouteName())
            @case('admin.partner.tolak')
            <form action="{{ route('admin.partner.tolak.tanggapi', $partner->id_pengelola) }}" method="GET">
                @csrf
                <span>
                    <a class="close material-icons md-32" href="{{ route('admin.partner.detail', $partner->id_pengelola) }}">
                        close
                    </a>
                    <label class="font-weight-bold ml-0 mb-2" style="font-size:36px;">
                        {{ __('Alasan Penolakan') }}
                    </label>
                </span>
                <div class="scrolling-wrapper mb-4 pr-2 pt-4 pb-4">
                    <div class="btn-group btn-group-toggle mt-2" data-toggle="buttons">
                        <label id="minimalTopUpLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="minimalTopUp" style="border-radius:10px; font-size:14px;">
                            <input id="minimalTopUp" name="radioAlasan" type="radio" value="0">
                            {{ __('Minimal Top-Up') }}
                        </label>
                        <label id="kendalaVerifikasiLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="kendalaVerifikasi" style="border-radius:10px; font-size:14px;">
                            <input id="kendalaVerifikasi" name="radioAlasan" type="radio" value="1">
                            {{ __('Ada Kendala pada Verifikasi Pendaftaran') }}
                        </label>
                        <label id="saldoTidakCukupLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="saldoTidakCukup" style="border-radius:10px; font-size:14px;">
                            <input id="saldoTidakCukup" name="radioAlasan" type="radio" value="2">
                            {{ __('Saldo Tidak Mencukupi') }}
                        </label>
                        <label id="akunDibekukanLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="akunDibekukan" style="border-radius:10px; font-size:14px;">
                            <input id="akunDibekukan" name="radioAlasan" type="radio" value="3">
                            {{ __('Akun Dibekukan Sementara') }}
                        </label>
                        <label id="alasanLainnyaLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="alasanLainnya" style="border-radius:10px; font-size:14px;">
                            <input id="alasanLainnya" name="radioAlasan" type="radio" value="4">
                            {{ __('Lainnya') }}
                        </label>
                    </div>
                </div>
                <label class="mb-2">
                    {{ __('Isi Sendiri') }}
                </label>
                <div class="form-group mb-4">
                    <textarea id="alasanText" type="text" name="alasan" class="form-control pt-2 pb-2"
                        placeholder="Masukkan alasan selain diatas..." disabled style="font-size: 18px;"></textarea>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group mr-3">
                        <button
                            class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold pl-5 pr-5"
                            onclick="window.location.href='{{ route('admin.partner.detail', $partner->id_pengelola) }}'"
                            style="border-radius:30px; font-size:18px;">
                            {{ __('Batal') }}
                        </button>
                    </div>
                    <div class="form-group mr-3">
                        <button type="submit" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5"
                            style="border-radius:30px; font-size:18px;">
                            {{ __('Kirim') }}
                        </button>
                    </div>
                </div>
            </form>
            @break
            @default
            <form action="{{ route('admin.saldo.tolak.store', $transaksiSaldo->id_transaksi) }}" method="POST">
                @csrf
                <span>
                    <a class="close material-icons md-32" href="{{ route('admin.saldo') }}">
                        close
                    </a>
                    <label class="font-weight-bold ml-0 mb-2" style="font-size:36px;">
                        {{ __('Alasan Penolakan') }}
                    </label>
                </span>
                <div class="scrolling-wrapper mb-4 pr-2 pt-4 pb-4">
                    <div class="btn-group btn-group-toggle mt-2" data-toggle="buttons">
                        <label id="minimalTopUpLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="minimalTopUp" style="border-radius:10px; font-size:14px;">
                            <input id="minimalTopUp" name="radioAlasan" type="radio" value="0">
                            {{ __('Minimal Top-Up') }}
                        </label>
                        <label id="kendalaVerifikasiLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="kendalaVerifikasi" style="border-radius:10px; font-size:14px;">
                            <input id="kendalaVerifikasi" name="radioAlasan" type="radio" value="1">
                            {{ __('Ada Kendala pada Verifikasi Pendaftaran') }}
                        </label>
                        <label id="saldoTidakCukupLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="saldoTidakCukup" style="border-radius:10px; font-size:14px;">
                            <input id="saldoTidakCukup" name="radioAlasan" type="radio" value="2">
                            {{ __('Saldo Tidak Mencukupi') }}
                        </label>
                        <label id="akunDibekukanLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="akunDibekukan" style="border-radius:10px; font-size:14px;">
                            <input id="akunDibekukan" name="radioAlasan" type="radio" value="3">
                            {{ __('Akun Dibekukan Sementara') }}
                        </label>
                        <label id="alasanLainnyaLabel" class="btn btn-default-wakprint shadow-sm text-left SemiBold mr-4"
                            for="alasanLainnya" style="border-radius:10px; font-size:14px;">
                            <input id="alasanLainnya" name="radioAlasan" type="radio" value="4">
                            {{ __('Lainnya') }}
                        </label>
                    </div>
                </div>
                <label class="mb-2">
                    {{ __('Isi Sendiri') }}
                </label>
                <div class="form-group mb-4">
                    <textarea id="alasanText" type="text" name="alasan" class="form-control pt-2 pb-2"
                        placeholder="Masukkan alasan selain diatas..." disabled style="font-size: 18px;"></textarea>
                </div>
                <div class="row justify-content-end">
                    <div class="form-group mr-3">
                        <button
                            class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold pl-5 pr-5"
                            onclick="window.location.href='{{ route('admin.saldo') }}'"
                            style="border-radius:30px; font-size:18px;">
                            {{ __('Batal') }}
                        </button>
                    </div>
                    <div class="form-group mr-3">
                        <button type="submit" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5"
                            style="border-radius:30px; font-size:18px;">
                            {{ __('Kirim') }}
                        </button>
                    </div>
                </div>
            </form>
        @endswitch
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type=radio]').each(function(index, value) {
                $(this).bind('change', function() {
                    if (this.checked) {
                        if (index === 4) {
                            $('#alasanText').prop('disabled', false);
                        } else {
                            $('#alasanText').prop('disabled', true);
                        }
                    } else {
                        $('#alasanText').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
