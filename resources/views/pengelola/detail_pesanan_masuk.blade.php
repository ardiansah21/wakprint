@extends('layouts.pengelola')

@section('content')
    <div class="container mt-5 mb-5">
        <h1 class="font-weight-bold mb-5">Pesanan Masuk</h1>
        {{-- <div class="row justify-content-between mb-5 ml-0 mr-0">
            <div class="col-md-6 border-primary-purple mr-5"
                style="max-width:500px; height:500px;
                    border-radius:10px;">
                <div class="my-custom-scrollbar-pesanan-masuk-1 p-4">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-4">
                                <div class="card shadow-sm" style="border-radius: 10px; min-height:90px;">
                                    <label class="text-primary-danger font-weight-bold text-center my-auto" style="font-size: 24px;">{{__('PDF')}}</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="container mb-3">
                                    <button class="btn btn-block btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                        style="border-radius:30px;
                                            font-size:14px;">
                                        {{__('Unduh') }}
                                    </button>
                                </div>
                                <div class="container mb-3">
                                    <button class="btn btn-block btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                        style="border-radius:30px;
                                            font-size:14px;">
                                        {{__('Cetak') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
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
        </div> --}}


        <div class="border-primary-purple mb-5" style="border-radius: 10px;">
            <div class="row justify-content-between bg-light-purple ml-0 mr-0 p-2" style="width: 100%; border-bottom: 1px solid #BC41BE; border-radius: 10px 10px 0px 0px;">
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{__('Waktu Pemesanan')}}
                    </label>
                    <br>
                    <label>
                        {{__('09:34 5 Juli 2020 ')}}
                    </label>
                </div>
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{__('Nama Pemesan')}}
                    </label>
                    <br>
                    <label>
                        {{__('Tobey Maguire')}}
                    </label>
                </div>
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{__('No HP Pemesan')}}
                    </label>
                    <br>
                    <label>
                        {{__('+6282176358392 ')}}
                    </label>
                </div>
                <div class="col-md-3 my-auto">
                    <label class="font-weight-bold mb-0" style="font-size: 16px;">
                        {{__('Metode Penerimaan')}}
                    </label>
                    <br>
                    <label>
                        {{__('Antar ke Tempat')}}
                    </label>
                </div>
            </div>
            <div class="pl-4 pr-4 pt-3 pb-3">
                <div class="pb-2 mb-4" style="border-bottom: 1px solid #EBD1EC">
                    <label class="font-weight-bold mb-4" style="font-size: 16px;">
                        {{__('Cetak Dokumen Hitam Putih')}}
                    </label>
                    <div class="row justify-content-between ml-0 mr-0 mb-2" style="width: 100%;">
                        <div class="col-md-auto">
                            <label class="font-weight-bold mb-0" style="font-size: 14px;">
                                {{__('1')}}
                            </label>
                        </div>
                        <div class="col-md-2">
                            <div class="card shadow-sm" style="border-radius: 10px; min-height:90px;">
                                <label class="text-primary-danger font-weight-bold text-center my-auto" style="font-size: 24px;">{{__('PDF')}}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="" style="font-size: 14px;">
                                {{__('Skripsi.pdf')}}
                            </a>
                            <label class="mb-2" style="font-size: 14px;">
                                {{__('5 Halaman')}}
                            </label>
                            <br>
                            <label class="mb-1" style="font-size: 14px;">
                                {{__('2 Halaman Hitam Putih')}}
                            </label>
                            <br>
                            <label class="mb-1" style="font-size: 14px;">
                                {{__('3 Halaman Berwarna')}}
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                {{__('Halaman')}}
                            </label>
                            <br>
                            <label class="mb-2" style="font-size: 14px;">
                                {{__('Semua Halaman')}}
                            </label>
                            <br>
                            <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                {{__('Cetak')}}
                            </label>
                            <br>
                            <label class="mb-2" style="font-size: 14px;">
                                {{__('Timbal Balik')}}
                            </label>
                            <br>
                            <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                {{__('Jumlah Salinan')}}
                            </label>
                            <br>
                            <label class="mb-2" style="font-size: 14px;">
                                {{__('2')}}
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                {{__('Fitur')}}
                            </label>
                            <br>
                            <div class="row justify-content-left">
                                <div class="col-md-1">
                                    <i class="material-icons md-12">circle</i>
                                </div>
                                <div class="col-md-9">
                                    <label class="mb-2" style="font-size: 14px;">
                                        {{__('Jilid Lakban Hitam')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="font-weight-bold mb-1" style="font-size: 14px;">
                                {{__('Catatan Tambahan')}}
                            </label>
                            <br>
                            <label class="mb-1" style="font-size: 14px;">
                                {{__('Yang rapi yah bang awas ajaaaa')}}
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="text-right">
                            <div class="container mb-3">
                                <button class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                style="border-radius:30px;
                                    font-size:16px;">
                                    {{__('Unduh') }}
                                </button>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="container mb-3">
                                <button type="button" class="btn btn-primary-yellow font-weight-bold pl-5 pr-5 mb-0"
                                style="border-radius:30px;
                                    font-size:16px;">
                                    {{__('Cetak') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-2 mb-4" style="border-bottom: 1px solid #EBD1EC">
                    <label class="font-weight-bold mb-3" style="font-size: 16px;">
                        {{__('ATK')}}
                    </label>
                    <div class="row justify-content-left ml-0 mr-0">
                        <label class="font-weight-bold mb-0 mr-4" style="font-size: 14px;">
                            {{__('1')}}
                        </label>
                        <br>
                        <label style="font-size: 14px;">
                            {{__('Pensil (x4)')}}
                        </label>
                    </div>
                </div>
                <div class="row justify-content-left">
                    <div class="col-md-4">
                        <label class="font-weight-bold mb-1" style="font-size: 16px;">
                            {{__('Jumlah Dokumen')}}
                        </label>
                        <br>
                        <label class="mb-2" style="font-size: 14px;">
                            {{__('2')}}
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="font-weight-bold mb-1" style="font-size: 16px;">
                            {{__('Jumlah Produk')}}
                        </label>
                        <br>
                        <label class="mb-2" style="font-size: 14px;">
                            {{__('2')}}
                        </label>
                    </div>
                    <div class="col-md-4 ml-auto">
                        <div class="row justify-content-between ml-0 mr-0">
                            <div>
                                <label class="font-weight-bold mb-1" style="font-size: 16px;">
                                    {{__('Jumlah Biaya')}}
                                </label>
                                <br>
                                <label class="mb-2" style="font-size: 14px;">
                                    {{__('Rp. 10.000')}}
                                </label>
                            </div>
                            <div class="text-right align-self-center">
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
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="text-right mr-0">
                <div class="container mb-3">
                    <button class="btn btn-outline-danger-primary text-primary-danger font-weight-bold pl-5 pr-5 mb-0"
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
