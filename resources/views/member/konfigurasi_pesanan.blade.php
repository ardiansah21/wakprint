@extends('layouts.member')

@section('content')
    <div id="konfigurasiPesanan">
        <konfigurasi-pesanan-component :member="{{ Auth::user() }}" :kon-files="{{ $pesanan->konfigurasiFile }}"
            :atks="{{ $pesanan->partner->atk }}" :ongkir_toko="{{$pesanan->partner->ongkir_toko}}" :jarak="{{$pesanan->partner->jarak}}" :antar_ke_tempat="{{$pesanan->partner->antar_ke_tempat}}"></konfigurasi-pesanan-component>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/konfigurasiPesananVue.js') }}"></script>
@endsection
