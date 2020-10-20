@extends('layouts.member')

@section('content')
    <div class="container mb-5 mt-5">
        <div>
            <label class="font-weight-bold mb-5"
                style="font-size:48px;">
                {{__('Pesanan Kamu') }}
            </label>

            {{-- @foreach ($collection as $item) --}}
            <div class="row justify-content-between mb-5 mr-0">
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

            <div class="bg-light-purple p-4 mb-5"
                style="border-radius:10px;
                    font-size:18px;">
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
                <div class="row justify-content-between SemiBold mt-2">
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
            </div>
        </div>
        <div class="row justify-content-end mb-5 mr-0">
            <button class="btn btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold mr-4"
                style="border-radius:30px;
                    font-size:24px;">
                {{__('Batalkan Pemesanan') }}
            </button>
            <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
                style="border-radius:30px;
                    font-size:24px;">
                {{__('Konfirmasi dan Lanjutkan') }}
            </button>
        </div>
    </div>
@endsection
