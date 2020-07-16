<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid mt-4">
        <div class="container" style="margin-top: 120px;">
            <h1 class="font-weight-bold mb-5">Detail Transaksi</h1>
        
            <div class="row justify-content-between mb-5">
                <div class="container col">
                    <p class="font-weight-bold mb-0">Nama Pemilik Rekening</p>
                    <p class="mb-2">Agus</p>

                    <p class="font-weight-bold mb-0">Nama Bank</p>
                    <p class="mb-2">BRI</p>

                    <p class="font-weight-bold mb-0">Nomor Rekening</p>
                    <p class="mb-2">016748359004048</p>

                    <p class="font-weight-bold mb-0">Status Transaksi</p>
                    <p class="mb-2">Berhasil</p>
                </div>

                <div class="container col">
                    <p class="font-weight-bold mb-0">Tanggal dan Waktu Transaksi</p>
                    <p class="mb-2">20 januari 2020 &nbsp; 23:00 WIB</p>

                    <p class="font-weight-bold mb-0">Jenis Dana</p>
                    <p class="mb-2">Masuk</p>

                    <p class="font-weight-bold mb-0">Jumlah Saldo</p>
                    <p class="mb-2">Rp. 300.000</p>
                </div>

                <div class="container col">
                </div>
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold pl-5 pr-5 mb-0"
                onclick="window.location='{{ url('/pengelola/saldo') }}'"
                style="border-radius:30px;">Kembali ke Halaman Saldo</button>
            </div>
        </div>
    </div>
@endsection

