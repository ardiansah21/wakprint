<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container-fluid mb-5" style="margin-top:120px;">

            <div class="container">
                <h1 class="font-weight-bold" style="margin-top:120px; margin-left:-0px">Konfigurasi Pesanan</h1>
            </div>

            <div class="container">
                <div class="row justify-content-between mb-5">
                    <div class="container col-4 mt-5" style="margin-left:-0px; border-radius:10px;">
                        <div class="container bg-light-purple pl-2 pr-4 pt-4 pb-4 mb-4" style="border-radius:10px;">
                            <h4 class="font-weight-bold mb-3 ml-4">Penerimaan</h4>

                            <div class="container custom-control custom-radio mb-4 ml-4">
                                <input id="rbAmbilTempat" name="radio" class="custom-control-input" type="radio">
                                <label class="custom-control-label" for="rbAmbilTempat">Ambil di tempat percetakan</label>
                                <p class="text-truncate-multiline mb-2" style="margin-left:0px;">Jl. Seksama Medan Denai,
                                    Medan, Sumatera Utara (20228)</p>
                            </div>

                            <div class="container custom-control custom-radio mb-4 ml-4">
                                <div class="row justify-content-between ml-0 mr-0">
                                    <input id="rbAntar" name="radio" class="custom-control-input" type="radio">
                                    <label class="custom-control-label" for="rbAntar">Pengantaran</label>
                                    <p class="col text-right mb-2" style="margin-left:0px;"><a
                                            href="{{ url('member/alamat') }}">Ubah</a></p>
                                </div>
                                <p class="text-truncate font-weight-bold mb-2 ml-0">Ardiansah</p>
                                <p class="text-truncate-multiline mb-2 ml-0 mb-5">Jl. Air Bersih Ujung, Medan Denai, Medan,
                                    Sumatera Utara (20228)</p>
                            </div>

                            <div class="row justify-content-between">
                                <p class="col font-weight-bold mb-2 ml-4" style="margin-left:0px;">Biaya</p>
                                <p class="col font-weight-bold text-right mb-2" style="margin-left:0px;">Rp. 5.000</p>
                            </div>
                        </div>

                        <div class="container bg-light-purple pl-2 pr-4 pt-4 pb-4" style="border-radius:10px;">
                            <h4 class="font-weight-bold mb-3 ml-4">Ringkasan Pemesanan</h4>
                            <div class="row justify-content-between">
                                <p class="col mb-2 ml-4" style="margin-left:0px;">Subtotal (3 file)</p>
                                <p class="col text-right mb-2" style="margin-left:0px;">Rp. 70.500</p>
                            </div>
                            <div class="row justify-content-between mb-2">
                                <p class="col mb-2 ml-4" style="margin-left:0px;">Biaya Pengiriman</p>
                                <p class="col text-right mb-2" style="margin-left:0px;">Rp. 5.000</p>
                            </div>

                            <div class="row justify-content-between">
                                <p class="col mb-2 ml-4" style="margin-left:0px;">Total</p>
                                <p class="col text-right mb-2" style="margin-left:0px;">Rp. 75.500</p>
                            </div>
                            <div class="row justify-content-between">
                                <p class="col mb-2 ml-4" style="margin-left:0px;">Saldo Kamu</p>
                                <p class="col text-right mb-2" style="margin-left:0px;">Rp. 0</p>
                            </div>

                            <div class="row justify-content-between">
                                <p class="col mb-2 ml-4" style="margin-left:0px;">Sisa Saldo Kamu</p>
                                <p class="col text-right mb-3" style="margin-left:0px;">Rp. -75.500</p>
                            </div>

                            <small>
                                <p class="text-muted text-justify mb-2 ml-4" style="margin-left:0px;">
                                    Saldo kamu tidak mencukupi, silahkan melakukan pengisian saldo setelah pesanan kamu
                                    dibuat
                                </p>
                            </small>
                        </div>

                    </div>

                    <div class="container col-8 ml-0 mt-5">
                        <div class="row justify-content-between mb-4 ml-0 mr-2">
                            <div class="custom-control custom-checkbox mt-2 ml-1">
                                <input type="checkbox" class="custom-control-input" id="checkboxPilihSemua">
                                <label class="custom-control-label" for="checkboxPilihSemua">Pilih Semua</label>
                            </div>
                            <button type="button"
                                class="btn btn-primary-yellow btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center"
                                onclick="window.location='{{ url('/member/konfigurasi-file') }}'"
                                style="border-radius:30px">Tambah File</button>
                        </div>

                        <div class="table-scrollbar pl-0 pr-2 mb-5">
                            <table class="table table-hover">
                                <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama File</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Biaya</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($collection as $item) --}}
                                    <tr>

                                        {{-- @foreach ($collection as $item) --}}
                                        <td scope="row">
                                            <div class="custom-control custom-checkbox mt-2 ml-1">
                                                <input type="checkbox" class="custom-control-input" id="checkboxTable1">
                                                <label class="custom-control-label" for="checkboxTable1"></label>
                                            </div>
                                        </td>
                                        <td>00000001</td>
                                        <td>Skripsilagee.pdf</td>
                                        <td>Cetak Warna Skripsi</td>
                                        <td>Rp. 12.000</td>
                                        <td><span><i class="material-icons mr-2">edit</i><i class="material-icons"
                                                    style="color: red;">delete</i></span></td>
                                        {{-- @endforeach --}}

                                    </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>

                        <label class="font-weight-bold mb-2 ml-0 mr-2">ATK</label>

                        {{-- @foreach ($collection as $item) --}}
                        <div class="row justify-content-between ml-0 mr-2">
                            <div class="col-4 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkboxPensil">
                                <label class="custom-control-label align-middle" for="checkboxPensil">Pensil <i
                                        class="material-icons align-middle ml-2">help</i></label>
                            </div>
                            <div class="col-4 form-group">
                                <label class="label">Jumlah <i class="fa fa-plus ml-2 mr-2"></i></label>

                                <input type="text" class="form-input" style="width:48px;">

                                <label class="label"><i class="fa fa-minus ml-2 mr-2"></i></label>

                            </div>
                            <div class="col-4">
                                <p class="text-right font-weight-bold mb-2 ml-0">Rp. 500</p>
                            </div>
                        </div>
                        {{-- @endforeach --}}

                    </div>
                </div>

                <div class="mb-5">
                    <button type="button" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
                        onclick="window.location='{{ url('/member/konfirmasi-pembayaran') }}'"
                        style="border-radius:30px">
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer_member')
@endsection
