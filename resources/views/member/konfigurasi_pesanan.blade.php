@extends('layouts.member')

@section('content')
    <div id="konfigurasiPesanan">
        <konfigurasi-pesanan :member="{{ Auth::user() }}" :kon-files="{{ $pesanan->konfigurasiFile }}"
            :atks="{{ $pesanan->partner->atk }}"></konfigurasi-pesanan>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/konfigurasiPesanan.js') }}"></script>
@endsection
