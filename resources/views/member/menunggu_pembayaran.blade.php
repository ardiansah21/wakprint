<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container">
            <div class="container mb-5" style="margin-top:120px; margin-left:-15px">
                <h1 class="font-weight-bold">Pesanan Kamu</h1>

                {{-- @foreach ($collection as $item) --}}
                <div class="row justify-content-between mb-4">
                    <div class="col-4">
                        @include('card_produk')
                    </div>
                    <div class="col">
                        <div class="container mb-1">
                            <h4 class="font-weight-bold">File Kamu</h4>
                        </div>

                        <div class="container row justify-content-left ml-0 mb-4">
                            <p class="text-truncate mb-2 mr-3"><a href="#">Skripsilagee.pdf</a></p>
                            <p class="mb-2">16 Halaman</p>
                        </div>

                        <div class="container mb-4">
                            <h4 class="font-weight-bold mb-1">Halaman yang dipilih</h4>
                            <p class="mb-2">16 Halaman</p>
                        </div>

                        <div class="container mb-4">
                            <h4 class="font-weight-bold mb-1">Jumlah Salinan</h4>
                            <p class="mb-2">2</p>
                        </div>

                        <div class="container mb-4">
                            <h4 class="font-weight-bold mb-1">Cetak</h4>
                            <p class="mb-2">Hitam Putih</p>
                            <p class="mb-2">Timbal Balik</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <h4 class="font-weight-bold mb-2 ml-0">Catatan Tambahan</h4>
                        <div class="card pt-2 pb-2 pl-4 pr-4 mb-5" style="width:250px; min-height:100px;">
                            <p class="mb-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur quam
                                veritatis recusandae provident voluptatem quos optio accusamus molestiae saepe iusto vitae
                                obcaecati, assumenda magni minima aperiam nobis omnis, officiis laboriosam.</p>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}

                <div class="container bg-light-purple p-4" style="border-radius:10px;">
                    <h1 class="font-weight-bold mb-4">Rincian Harga</h1>

                    <div class="row justify-content-between">
                        <div class="col text-left">
                            <label class="mb-2">Jumlah File Kamu</label><br>
                            <label class="mb-2">Total Produk Pesanan</label>
                        </div>
                        <div class="col text-right">
                            <p class="mb-2">2</p>
                            <p class="mb-2">2</p>
                        </div>
                    </div>

                    <div class="row row-bordered mt-2 mb-4">
                    </div>

                    {{-- @foreach ($collection as $item) --}}
                    <p class="font-weight-bold mt-2 mb-3">Cetak Skripsi Mahasiswa</p>
                    <p class="font-weight-bold mb-2">Skripsi.pdf</p>
                    <div class="row justify-content-between">
                        <div class="col-6 text-left">
                            <p>25 Halaman Hitam-Putih</p>
                        </div>
                        <div class="col-6 text-right">
                            <p>Rp. 10.000</p>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-6 text-left">
                            <p>25 Halaman Berwarna</p>
                        </div>
                        <div class="col-6 text-right">
                            <p>Rp. 15.000</p>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-6 text-left">
                            <p>Timbal Balik</p>
                        </div>
                        <div class="col-6 text-right">
                            <p>Rp. 5.000</p>
                        </div>
                    </div>

                    <div class="row justify-content-between mb-2">
                        <div class="col-6 text-left">
                            <p>Jumlah Salinan</p>
                        </div>
                        <div class="col-6 text-right">
                            <p>1</p>
                        </div>
                    </div>

                    <p class="font-weight-bold mt-2 mb-2">Fitur Tambahan</p>

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mb-2">
                        <div class="col-6 text-left">
                            <p>Paket Jilid Lakban Hitam</p>
                        </div>
                        <div class="col-6 text-right">
                            <p>Rp. 10.000</p>
                        </div>
                    </div>
                    {{-- @endforeach --}}

                    <div class="row row-bordered mt-2 mb-4">
                    </div>

                    {{-- @endforeach --}}

                    <p class="font-weight-bold mb-2">ATK</p>

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between">
                        <div class="col-6 text-left">
                            <p>Pensil (x4)</p>
                        </div>
                        <div class="col-6 text-right">
                            <p>Rp. 2.000</p>
                        </div>
                    </div>
                    {{-- @endforeach --}}

                    <p class="font-weight-bold mt-3 mb-2">Biaya Pengiriman</p>
                    <div class="row justify-content-between mb-2">
                        <div class="col-6 text-left">
                            <p>Diantar ke Tempat</p>
                        </div>
                        <div class="col-6 text-right">
                            <p>Rp. 10.000</p>
                        </div>
                    </div>

                    <div class="row row-bordered">
                    </div>

                    <div class="row justify-content-between font-weight-bold mt-2">
                        <div class="container col-6 text-left">
                            <p>Total Harga Pesanan</p>
                        </div>
                        <div class="container col-6 text-right">
                            <p>Rp. 20.000</p>
                        </div>
                    </div>

                    <div class="row mt-2 mb-5">
                        <div class="container col-10 text-left ml-0">
                            <h1 class="font-weight-bold">Status Pesanan</h1>
                        </div>
                        <div class="container col-auto mr-0">
                            <div class="text-center">
                                <p class="badge bg-primary-yellow pl-4 pr-4 pt-2 pb-2 font-weight-bold mt-3">Pending</p>
                            </div>

                        </div>
                    </div>

                    <h1 class="font-weight-bold">Info Pesanan</h1>

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row mt-4">
                        <div class="container col-2 text-left ml-0">
                            <p>ID Pesanan</p>
                        </div>
                        <div class="container col-auto mr-0">
                            <p class="font-weight-bold">Pending</p>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="container col-2 text-left ml-0">
                            <p>Nama Pemesan</p>
                        </div>
                        <div class="container col-auto mr-0">
                            <p class="font-weight-bold">Joko Susilo Rahmat</p>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="container col-4 text-left ml-0">
                            <p>Metode Pengambilan</p>
                        </div>
                        <div class="container col-auto mr-0">
                            <p class="font-weight-bold">Ambil di Tempat</p>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="container col-4 text-left ml-0">
                            <p>Alamat Tempat Percetakan</p>
                        </div>
                        <div class="container col-auto mr-0">
                            <p class="font-weight-bold">
                                Jalan Pengilar Medan
                                Denai, Medan, Sumatera Utara, 20228
                            </p>
                        </div>
                    </div>
                    {{-- @endforeach --}}

                </div>

            </div>

            {{-- kode pembayaran --}}
            <div class="container" style="margin-left:-15px;">
                <h1 class="font-weight-bold">Menunggu Pembayaran</h1>
                <p class="mt-2" style="margin-left:2px;">Nomor Pemesanan Kamu : 00000001</p>
                <div class="row justify-content-between" style="margin-left:2px;">
                    <div class="col-7 mb-4" style="margin-left:-15px;">
                        <label class="mt-2">Kode Pembayaran Kamu</label><br>
                        <h1 class="font-weight-bold text-primary-success mb-4">4324325232321321412</h1>

                        <label class="mt-2">Kode Bayar akan Berakhir pada</label><br>
                        <h1 class="text-primary-danger font-weight-bold">00 : 15 : 00</h1>

                        <label class="mt-2">Mohon menyelesaikan pembayaran sebelum 27 Jan 2020, 18:00 WIB</label>
                    </div>

                    <div class="container col-5 mb-0" style="margin-right:-20px;">
                        <div class="container">
                            <div class="card pt-4 pb-4 pl-4 pr-4 mb-5">
                                <h4 class="font-weight-bold mb-4 ml-0">Panduan Pembayaran</h4>
                                <small>
                                    <p class="mb-2">1. Pilih menu “lainnya” > Transfer > Rekening Tabungan > Rekening BNI
                                        762834629<br>
                                        2. Masukkan jumlah pembayaran sesuai dengan jumlah transaksi<br>
                                        3. Masukkan pilihan transaksi (optional)<br>
                                        4. Konfirmasi pembayaran<br>
                                        5. Bank Lain. Transfer ke Bank Lain > Kode BNI 009 > Isi nomor VA BNI > Nominal
                                        Pembayaran > Konfirmasi<br>
                                    </p>
                                </small>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-danger-primary btn-lg btn-block font-weight-bold mb-5"
                        onclick="window.location='{{ url('/index') }}'">
                        Batalkan Pemesanan
                    </button>
                </div>


            </div>

            {{-- kode qr pesanan --}}
            <div class="container mb-5" style="margin-left:-20px;">
                <div class="row no-gutters">
                    <div class="container align-self-center col-auto">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="150"
                            height="150" alt="no logo">
                    </div>

                    <div class="col-10 align-self-center">
                        <h5 class="card-title font-weight-bold mb-1">Kode QR Pesanan kamu</h5>
                        <p class="mb-2">Kode ini dapat langsung di scan oleh pemilik toko melalui smartphone-nya untuk
                            memastikan barang yang kamu pesan sudah sampai ditanganmu</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="row">
                    <div class="col-4 mb-4">
                        <button type="button" class="btn btn-outline-danger-primary btn-lg btn-block font-weight-bold"
                            onclick="window.location='{{ url('/index') }}'">Batalkan Pemesanan</button>
                    </div>
                    <div class="col-4 mb-4">
                        <button type="button" class="btn btn-outline-purple btn-lg btn-block font-weight-bold pl-4 pr-4"
                            onclick="window.location='{{ url('/member/chat') }}'">Chat
                            Pengelola</button>
                    </div>
                    <div class="col-4 mb-4">
                        <button type="button" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold pl-4 pr-4"
                            onclick="window.location='{{ url('/member/ulas') }}'">Pesanan Sudah
                            Ditangan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection
