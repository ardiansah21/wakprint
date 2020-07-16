<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container">
            <div class="container mb-5" style="margin-top:120px; margin-left:-15px">
                <h1 class="font-weight-bold mb-5">Pesanan Kamu</h1>

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
                </div>
            </div>

            <div class="row mb-5 mr-0">
                <div class="container text-right col-md-8 mb-4">
                    <button type="button" class="btn btn-default btn-lg text-danger font-weight-bold"
                        onclick="window.location='{{ url('/index') }}'"
                        style="border-radius:30px; margin-right:-25px;">Batalkan Pemesanan</button>
                </div>
                <div class="container text-right col-md-auto mb-4">
                    <button type="button" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
                        onclick="window.location='{{ url('member/menunggu-pembayaran') }}'"
                        style="border-radius:30px;">Konfirmasi dan Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection
