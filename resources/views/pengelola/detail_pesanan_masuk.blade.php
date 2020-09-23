@extends('layouts.pengelola')

@section('content')
    <div class="container mt-5 mb-5">
        <h1 class="font-weight-bold mb-5">Pesanan Masuk</h1>
        <div class="row justify-content-between mb-5 ml-0 mr-0">
            <div class="col-md-6 border-primary-purple mr-5"
                style="max-width:500px; height:500px;
                    border-radius:10px;">
                <div class="my-custom-scrollbar-pesanan-masuk-1 p-4">

                    {{-- @foreach ($collection as $item) --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                @include('pengelola.card_produk')
                            </div>
                            <div class="col-md-6">
                                <div class="container mb-3">
                                    <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                        style="border-radius:30px;
                                            font-size:14px;">
                                        {{__('Lihat') }}
                                    </button>
                                </div>
                                <div class="container mb-3">
                                    <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                        style="border-radius:30px;
                                            font-size:14px;">
                                        {{__('Cetak') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                @include('pengelola.card_produk')
                            </div>
                            <div class="col-md-6">
                                <div class="container mb-3">
                                    <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                        style="border-radius:30px;
                                            font-size:14px;">
                                        {{__('Lihat') }}
                                    </button>
                                </div>
                                <div class="container mb-3">
                                    <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                        style="border-radius:30px;
                                            font-size:14px;">
                                        {{__('Cetak') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    {{-- @endforeach --}}

                </div>
            </div>
            <div class="col-md-6 border-primary-purple"
                style="max-width:500px;
                    height:500px;
                    border-radius:10px;">
                <div class="my-custom-scrollbar-pesanan-masuk-2">
                    <div class="p-3">
                        <label class="SemiBold mb-1"
                            style="font-size:14px;">
                            {{__('Waktu Pemesanan') }}
                        </label>
                        <br>
                        <label class="mr-3 mb-4"
                            style="font-size:16px;">
                            {{__('09:34 5 Juli 2020') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1"
                            style="font-size:14px;">
                            {{__('Nama Pemesan') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4"
                            style="font-size:16px;">
                            {{__('Tobey Maguire') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1"
                            style="font-size:14px;">
                            {{__('No Hp Pemesan') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4"
                            style="font-size:16px;">
                            {{__('+6282176358392') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1"
                            style="font-size:14px;">
                            {{__('Jumlah Dokumen') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4"
                            style="font-size:16px;">
                            {{__('2') }}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-1"
                            style="font-size:14px;">
                            {{__('Metode Penerimaan') }}
                        </label>
                        <br>
                        <label class=" mr-3 mb-4"
                            style="font-size:16px;">
                            {{__('Antar ke Tempat') }}
                        </label>
                        {{-- <div class="mb-4">
                            <label class="font-weight-bold mr-3 mb-2"
                                style="font-size:14px;">
                                {{__('Warna Halaman') }}
                            </label>
                            <br>
                            @foreach ($collection as $item)
                                <label class="mr-3 mb-0"
                                    style="font-size:14px;">
                                    {{__('(Skripsilagee.pdf)') }}
                                </label>
                                <div class="row justify-content-between ml-0 mb-0 mr-0">
                                    <label class="mb-0"
                                        style="font-size: 16px;">
                                        {{__('25 Halaman Hitam-Putih') }}
                                    </label>
                                    <label class="font-weight-bold mb-0"
                                        style="font-size: 16px;">
                                        {{__('x Rp. 2k / hal') }}
                                    </label>
                                </div>
                                <div class="row justify-content-between ml-0 mb-0 mr-0">
                                    <label class="mb-0"
                                        style="font-size: 16px;">
                                        {{__('25 Halaman Berwarna') }}
                                    </label>
                                    <label class="font-weight-bold mb-0"
                                        style="font-size: 16px;">
                                        {{__('x Rp. 3k / hal') }}
                                    </label>
                                </div>
                                <label class="mr-3 mt-2 mb-0"
                                    style="font-size:14px;">
                                    {{__('(Skripsilagee.pdf)') }}
                                </label>
                                <div class="row justify-content-between ml-0 mb-0 mr-0">
                                    <label class="mb-0"
                                        style="font-size: 16px;">
                                        {{__('25 Halaman Hitam-Putih') }}
                                    </label>
                                    <label class="font-weight-bold mb-0"
                                        style="font-size: 16px;">
                                        {{__('x Rp. 2k / hal') }}
                                    </label>
                                </div>
                                <div class="row justify-content-between ml-0 mb-0 mr-0">
                                    <label class="mb-0"
                                        style="font-size: 16px;">
                                        {{__('25 Halaman Berwarna') }}
                                    </label>
                                    <label class="font-weight-bold mb-0"
                                        style="font-size: 16px;">
                                        {{__('x Rp. 3k / hal') }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-4">
                            <label class="font-weight-bold mb-1"
                                style="font-size:14px;">
                                {{__('Halaman yang Dicetak') }}
                            </label>

                            @foreach ($collection as $item)
                                <div class="row justify-content-between ml-0 mb-0"
                                    style="font-size: 16px;">
                                    <label class="mr-3 mb-0">
                                        {{__('(Skripsilagee.pdf)') }}
                                    </label>
                                    <label class="font-weight-bold mr-3 mb-0">
                                        {{__('Semua Halaman') }}
                                    </label>
                                </div>
                                <div class="row justify-content-between ml-0 mb-0"
                                    style="font-size: 16px;">
                                    <label class="mr-3 mb-0">
                                        {{__('(Skripsilagee.pdf)') }}
                                    </label>
                                    <label class="font-weight-bold mr-3 mb-0">
                                        {{__('Semua Halaman') }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <div class="mb-4">
                            <label class="font-weight-bold mr-3 mb-1"
                                style="font-size:14px;">
                                {{__('Jumlah Salinan') }}
                            </label>

                            @foreach ($collection as $item)
                                <div class="row justify-content-between ml-0 mb-0"
                                    style="font-size:16px;">
                                    <label class="mr-3 mb-0">
                                        {{__('(Skripsilagee.pdf)') }}
                                    </label>
                                    <label class="font-weight-bold mr-3 mb-0">
                                        {{__('2') }}
                                    </label>
                                </div>
                                <div class="row justify-content-between ml-0 mb-0"
                                    style="font-size:16px;">
                                    <label class="mr-3 mb-0">
                                        {{__('(Skripsilagee.pdf)') }}
                                    </label>
                                    <label class="font-weight-bold mr-3 mb-0">
                                        {{__('1') }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <div class="mb-4">
                            <label class="font-weight-bold mb-1"
                                style="font-size:14px;">
                                {{__('Cetak') }}
                            </label>

                            @foreach ($collection as $item)
                                <div class="row justify-content-between ml-0 mb-0"
                                    style="font-size:16px;">
                                    <label class="mr-3 mb-0">
                                        {{__('(Skripsilagee.pdf)') }}
                                    </label>
                                    <label class="font-weight-bold mr-3 mb-0">
                                        {{__('Satu Sisi') }}
                                    </label>
                                </div>
                                <div class="row justify-content-between ml-0 mb-0"
                                    style="font-size:16px;">
                                    <label class="mr-3 mb-0">
                                        {{__('(Skripsilagee.pdf)') }}
                                    </label>
                                    <label class="font-weight-bold mr-3 mb-0">
                                        {{__('Satu Sisi') }}
                                    </label>
                                </div>
                            @endforeach

                        </div> --}}
                    </div>
                </div>
                <div class="row justify-content-between bg-light-purple pl-3 pr-3 pt-2 pb-2 mb-5"
                    style="border-radius:0px 0px 10px 10px;">
                        <div class="col-md-auto"
                            style="border-radius:5px;">
                            <label class="font-weight-bold mr-3 mb-1"
                                style="font-size:14px;">
                                {{__('Jumlah Biaya') }}
                            </label>
                            <br>
                            <label class="mr-3"
                                style="16px;">
                                {{__('Rp. 20.000') }}
                            </label>
                        </div>
                        <div class="col-md-auto text-right align-self-center">
                            <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                data-toggle="modal"
                                data-target="#detailBiayaModal"
                                style="border-radius:30px;
                                    font-size:16px;">
                                {{__('Detail Biaya') }}
                            </button>
                        </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="text-right">
                <div class="container mb-3">
                    <button class="btn btn-default text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                    data-toggle="modal"
                    data-target="#tolakPesananModal"
                    style="border-radius:30px;
                        font-size:18px;">
                        {{__('Tolak') }}
                    </button>
                </div>
            </div>
            <div class="text-right">
                <div class="container mb-3">
                    <button type="button" class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                    style="border-radius:30px;
                        font-size:18px;">
                        {{__('Terima') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- pop up detail biaya --}}
        @include('pengelola.popup_detail_biaya')

        {{-- pop up tolak --}}
        @include('pengelola.popup_tolak_pesanan')
    </div>
@endsection
