@extends('layouts.member')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="mb-5">
            <label class="font-weight-bold mb-5"
            style="font-size: 48px;">Pesanan Kamu</label>

            {{-- @foreach ($collection as $item) --}}
            <div class="row justify-content-between mb-5 mr-0" style="width: 100%;">
                <div class="col-md-4">
                    @include('member.card_produk')
                </div>
                <div class="col-md-4">
                    <div class="mb-1">
                        <label class="SemiBold"
                            style="font-size:24px;">
                            {{__('File Kamu') }}
                        </label>
                    </div>
                    <div class="row justify-content-left ml-0 mb-4">
                        <a class="text-truncate mb-2 mr-3"
                            href="#"
                            style="font-size:18px;">
                            {{__('Skripsilagee.pdf') }}
                        </a>
                        <label class="my-auto mb-2"
                            style="font-size:14px;">
                            {{__('16 Halaman') }}
                        </label>
                    </div>
                    <div class="mb-4">
                        <label class="SemiBold mb-1"
                        style="font-size:24px;">
                            {{__('Halaman yang dipilih') }}
                        </label>
                        <br>
                        <label class="mb-2"
                            style="font-size:18px;">
                            {{__('16 Halaman') }}
                        </label>
                    </div>
                    <div class="mb-4">
                        <label class="SemiBold mb-1"
                        style="font-size:24px;">
                            {{__('Jumlah Salinan') }}
                        </label>
                        <br>
                        <label class="mb-2"
                            style="font-size:18px;">
                            {{__('2') }}
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="SemiBold mb-1"
                        style="font-size:24px;">
                            {{__('Cetak') }}
                        </label>
                        <br>
                        <label class="mb-2"
                            style="font-size:18px;">
                            {{__('Timbal Balik') }}
                        </label>
                        <br>
                        <label class="mb-2"
                            style="font-size:18px;">
                            {{__('Hitam Putih Seluruh Halaman') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="SemiBold mb-3"
                        style="font-size:24px;">
                            {{__('Catatan Tambahan') }}
                        </label>
                    <div class="card pt-2 pb-2 pl-4 pr-4 mb-5"
                        style="width:370px; min-height:120px;
                            font-size:18px;">
                        <p class="mb-2">{{__('Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur quam
                            veritatis recusandae provident voluptatem quos optio accusamus molestiae saepe iusto vitae
                            obcaecati, assumenda magni minima aperiam nobis omnis, officiis laboriosam.') }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}

            <div class="bg-light-purple p-4 mb-5" style="border-radius:10px;font-size:18px; width:100%;">
                <label class="font-weight-bold mb-4"
                    style="font-size:36px;">
                    {{__('Rincian Harga') }}
                </label>
                <div class="row justify-content-between">
                    <div class="col-md-auto text-left">
                        <label class="mb-2">
                            {{__('Jumlah File') }}
                        </label>
                        <br>
                        <label class="mb-2">
                            {{__('Total Produk Pesanan') }}
                        </label>
                    </div>
                    <div class="col-md-auto text-right">
                        <label class="SemiBold mb-2">
                            {{__('2') }}
                        </label>
                        <br>
                        <label class="SemiBold mb-2">
                            {{__('2') }}
                        </label>
                    </div>
                </div>
                <div class="row row-bordered mt-2 mb-4">
                </div>

                {{-- @foreach ($collection as $item) --}}
                <label class="font-weight-bold mt-2 mb-3">
                    {{__('Cetak Skripsi Mahasiswa') }}
                </label>
                <br>
                <label class="font-weight-bold mb-2">
                    {{__('Skripsi.pdf') }}
                </label>
                <div class="row justify-content-between">
                    <div class="col-md-6 text-left">
                        <label>
                            {{__('25 Halaman Hitam-Putih') }}
                        </label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            {{__('Rp. 10.000') }}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-md-6 text-left">
                        <label>{{__('25 Halaman Berwarna') }}</label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            {{__('Rp. 15.000') }}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between mb-2">
                    <div class="col-md-6 text-left">
                        <label>
                            {{__('Jumlah Salinan') }}
                        </label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            {{__('1') }}
                        </label>
                    </div>
                </div>
                <label class="font-weight-bold mt-2 mb-2">
                    {{__('Fitur') }}
                </label>

                {{-- @foreach ($collection as $item) --}}
                <div class="row justify-content-between mb-2">
                    <div class="col-md-6 text-left">
                        <label>
                            {{__('Paket Jilid Lakban Hitam') }}
                        </label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            {{__('Rp. 10.000') }}
                        </label>
                    </div>
                </div>
                {{-- @endforeach --}}

                <div class="row row-bordered mt-2 mb-4">
                </div>

                {{-- @endforeach --}}

                <label class="SemiBold mb-2">
                    {{__('ATK') }}
                </label>

                {{-- @foreach ($collection as $item) --}}
                <div class="row justify-content-between">
                    <div class="col-md-6 text-left">
                        <label>
                            {{__('Pensil (x4)') }}
                        </label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            {{__('Rp. 2.000') }}
                        </label>
                    </div>
                </div>
                {{-- @endforeach --}}

                <label class="font-weight-bold mt-3 mb-2">
                    {{__('Biaya Pengiriman') }}
                </label>
                <div class="row justify-content-between mb-2">
                    <div class="col-md-6 text-left">
                        <label>
                            {{__('Diantar ke Tempat') }}
                        </label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            {{__('Rp. 10.000') }}
                        </label>
                    </div>
                </div>
                <div class="row row-bordered">
                </div>
                <div class="row justify-content-between SemiBold mt-2 mb-4">
                    <div class="col-md-6 text-left">
                        <label>
                            {{__('Total Harga Pesanan') }}
                        </label>
                    </div>
                    <div class="col-md-6 text-right">
                        <label>
                            {{__('Rp. 20.000') }}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between mb-5">
                    <div class="col-md-10 text-left ml-0"
                        style="font-size: 36px;">
                        <label class="SemiBold">
                            {{__('Status Pesanan') }}
                        </label>
                    </div>
                    <div class="col-md-auto mr-0">
                        <div class="text-center"
                            style="font-size: 24px;">
                            <label class="badge bg-primary-yellow pl-4 pr-4 pt-2 pb-2 font-weight-bold mt-3">
                                {{__('Pending') }}
                            </label>
                        </div>
                    </div>
                </div>
                <label class="font-weight-bold"
                    style="font-size: 36px;">
                    {{__('Info Pesanan') }}
                </label>
                {{-- @foreach ($collection as $item) --}}
                <div class="row justify-content-between text-right mt-4">
                    <div class="col-md-6 text-left ml-0">
                        <label>
                            {{__('ID Pesanan') }}
                        </label>
                    </div>
                    <div class="col-md-6 mr-0">
                        <label class="font-weight-bold">
                            {{__('Pending') }}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between text-right mt-1">
                    <div class="col-md-6 text-left ml-0">
                        <label>
                            {{__('Nama Pemesan') }}
                        </label>
                    </div>
                    <div class="col-md-6 mr-0">
                        <label class="text-truncate-multiline font-weight-bold">
                            {{__('Joko Anwarasd sadsadadsadsad dsadsadssadsadsad ssadsadsada ssadsad asdadasdas') }}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between text-right mt-1">
                    <div class="col-md-6 text-left ml-0">
                        <label>
                            {{__('Metode Pengambilan') }}
                        </label>
                    </div>
                    <div class="col-md-6 mr-0">
                        <label class="font-weight-bold">
                            {{__('Ambil di Tempat') }}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-between text-right mt-1">
                    <div class="col-md-6 text-left ml-0">
                        <label>
                            {{__('Alamat Tempat Percetakan') }}
                        </label>
                    </div>
                    <div class="col-md-6 mr-0">
                        <label class="font-weight-bold">
                            {{__('Jalan Pengilar Medan Denai, Medan, Sumatera Utara, 20228 ') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- kode pembayaran --}}
        <div class="mb-5">
            <label class="font-weight-bold"
                style="font-size: 48px;">
                {{__('Menunggu Pembayaran') }}
            </label>
            <br>
            <label class="mb-5" style="font-size: 18px;">
                {{__('Nomor Pemesanan Kamu : 00000001') }}
            </label>
            <div class="row justify-content-between">
                <div class="col-md-7 mb-5">
                    <label class="SemiBold mt-2 mb-0"
                        style="font-size: 18px;">
                        {{__('Kode Pembayaran Kamu') }}
                    </label>
                    <br>
                    <label class="font-weight-bold text-primary-success mb-4"
                    style="font-size: 48px;">
                        {{__('4324325232321321412') }}
                    </label>
                    <br>
                    <label class="SemiBold mt-2 mb-0"
                        style="font-size: 18px;">
                        {{__('Kode Bayar akan Berakhir pada') }}
                    </label>
                    <br>
                    <label class="text-primary-danger font-weight-bold"
                        style="font-size: 48px;">
                        {{__('00 : 15 : 00') }}
                    </label>
                    <br>
                    <label class="mt-2"
                        style="font-size: 18px;">
                        {{__('Mohon menyelesaikan pembayaran sebelum 27 Jan 2020, 18:00 WIB') }}
                    </label>
                </div>
                <div class="col-md-5 mb-0">
                    <div class="card pt-4 pb-4 pl-4 pr-4 mb-5">
                        <label class="font-weight-bold mb-4 ml-0"
                            style="font-size: 24px;">
                            {{__('Panduan Pembayaran') }}
                        </label>
                        <div class="mb-2" style="font-size: 14px; list-style:none">
                            <li class="mb-2">{{__('1. Pilih menu “lainnya” > Transfer > Rekening Tabungan > Rekening BNI 762834629') }}</li>
                            <li class="mb-2">{{__('2. Masukkan jumlah pembayaran sesuai dengan jumlah transaksi') }}</li>
                            <li class="mb-2">{{__('3. Masukkan pilihan transaksi (optional)') }}</li>
                            <li class="mb-2">{{__('4. Konfirmasi pembayaran') }}</li>
                            <li>{{__('5. Bank Lain. Transfer ke Bank Lain > Kode BNI 009 > Isi nomor VA BNI > Nominal Pembayaran > Konfirmasi') }}</li>
                        </div>
                        {{-- <ul class="mb-2" style="font-size: 14px;"> --}}

                        {{-- </ul> --}}
                        {{-- <p class="mb-2"
                            style="font-size: 14px;">
                            {{__('1. Pilih menu “lainnya” > Transfer > Rekening Tabungan > Rekening BNI
                            762834629
                            2. Masukkan jumlah pembayaran sesuai dengan jumlah transaksi
                            3. Masukkan pilihan transaksi (optional)
                            4. Konfirmasi pembayaran
                            5. Bank Lain. Transfer ke Bank Lain > Kode BNI 009 > Isi nomor VA BNI > Nominal
                            Pembayaran > Konfirmasi') }}
                        </p> --}}
                    </div>
                </div>
                <div class="container ml-0 mr-0">
                    <button class="btn btn-outline-danger-primary btn-lg btn-block font-weight-bold mb-5"
                        style="font-size: 24px;">
                        {{__('Batalkan Pemesanan') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- kode qr pesanan --}}
        <div class="mb-5">
            <div class="row justify-content-left no-gutters">
                <div class="align-self-center col-md-auto mr-4">
                    <img src="{{url('img/Qr-Code.png')}}"
                        width="200"
                        height="200"
                        alt="no logo">
                </div>
                <div class="col-md-8 align-self-center">
                    <label class="SemiBold mb-1"
                        style="font-size: 36px;">
                            {{__('Kode QR Pesanan kamu') }}
                    </label>
                    <label class="mb-2"
                        style="font-size: 18px;">
                        {{__('Kode ini dapat langsung di scan oleh pemilik toko melalui smartphone-nya untuk
                        memastikan barang yang kamu pesan sudah sampai ditanganmu') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-auto mb-4">
                <button class="btn btn-outline-danger-primary btn-lg btn-block font-weight-bold"
                    style="font-size: 24px;">
                    {{__('Batalkan Pemesanan') }}
                </button>
            </div>
            <div class="col-md-auto mb-4">
                <button class="btn btn-outline-purple btn-lg btn-block font-weight-bold pl-4 pr-4"
                    style="font-size: 24px;">
                    {{__('Chat Pengelola') }}
                </button>
            </div>
            <div class="col-md-auto mb-4">
                <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold pl-4 pr-4"
                    style="font-size: 24px;">{{__('Pesanan Sudah Ditangan') }}
                </button>
            </div>
        </div>
    </div>
@endsection
