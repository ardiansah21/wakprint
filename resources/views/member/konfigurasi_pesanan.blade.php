@extends('layouts.member')

@section('content')
    <div class="container mt-5 mb-5">
        <label class="font-weight-bold"
            style="font-size:48px;">
            {{__('Konfigurasi Pesanan') }}
        </label>
        <div class="row justify-content-between mb-5">
            <div class="col-md-4 mt-5" 
                style="border-radius:10px;">
                <div class="bg-light-purple pl-4 pr-4 pt-4 pb-4 mb-4"
                    style="border-radius:10px;">
                    <label class="font-weight-bold mb-3"
                        style="font-size: 24px;">
                        {{__('Penerimaan') }}
                    </label>
                    <div class="form-group custom-control custom-radio mb-4"
                        style="font-size: 14px;">
                        <input id="rbAmbilTempat"
                            name="radio"
                            class="custom-control-input"
                            type="radio">
                        <label class="custom-control-label"
                            for="rbAmbilTempat">
                            {{__('Ambil di tempat percetakan') }}
                        </label>
                        <label class="text-truncate-multiline mb-2">
                            {{__('Jl. Seksama Medan Denai, Medan, Sumatera Utara (20228)') }}
                        </label>
                    </div>
                    <div class="form-group custom-control custom-radio mr-0 mb-4">
                        <div class="row justify-content-between ml-0">
                            <input id="rbAntar"
                                name="radio"
                                class="custom-control-input"
                                type="radio">
                            <label class="custom-control-label"
                                for="rbAntar">
                                {{__('Pengantaran') }}
                            </label>
                            <a class="col-md-auto text-right mb-2"
                                href=""
                                style="font-size: 12px;">
                                {{__('Ubah') }}
                            </a>
                        </div>
                        <label class="text-truncate SemiBold mb-2 ml-0">
                            {{__('Ardiansah') }}
                        </label>
                        <label class="text-truncate-multiline mb-2 ml-0 mb-5">
                            {{__('Jl. Air Bersih Ujung, Medan Denai, Medan, Sumatera Utara (20228)') }}
                        </label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto font-weight-bold mb-2">
                            {{__('Biaya') }}
                        </label>
                        <label class="col-md-auto font-weight-bold text-right mb-2">
                            {{__('Rp. 5.000') }}
                        </label>
                    </div>
                </div>
                <div class="bg-light-purple pl-4 pr-4 pt-4 pb-4"
                    style="border-radius:10px;
                        font-size: 14px;">
                    <label class="font-weight-bold mb-3"
                        style="font-size: 24px;">
                        {{__('Ringkasan Pemesanan') }}
                    </label>
                    <div class="row justify-content-between">
                        <label class="col-md-auto mb-2">{{__('Subtotal (3 file)') }}</label>
                        <label class="col-md-auto text-right mb-2">{{__('Rp. 70.500') }}</label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-auto mb-2">{{__('Biaya Pengiriman') }}</label>
                        <label class="col-md-auto text-right mb-2">{{__('Rp. 5.000') }}</label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2">{{__('Total') }}</label>
                        <label class="col-md-auto SemiBold text-right mb-2">{{__('Rp. 75.500') }}</label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2">{{__('Saldo Kamu') }}</label>
                        <label class="col-md-auto SemiBold text-right mb-2">{{__('Rp. 0') }}</label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2">{{__('Sisa Saldo Kamu') }}</label>
                        <label class="col-md-auto SemiBold text-right mb-3">{{__('Rp. -75.500') }}</label>
                    </div>
                    <label class="text-muted text-justify mb-2">
                        {{__('Saldo kamu tidak mencukupi, silahkan melakukan pengisian saldo setelah pesanan kamu dibuat') }}
                    </label>
                </div>
            </div>

            <div class="col-md-8 ml-0 mt-5" 
                style="font-size: 18px;">
                <div class="row justify-content-between mb-4 ml-0 mr-2">
                    <div class="custom-control custom-checkbox mt-2 ml-1">
                        <input type="checkbox" class="custom-control-input"
                            id="checkboxPilihSemua">
                        <label class="custom-control-label"
                            for="checkboxPilihSemua">{{__('Pilih Semua') }}</label>
                    </div>
                    <button class="btn btn-primary-yellow btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center"
                        style="border-radius:30px">{{__('Tambah File') }}</button>
                </div>
                <div class="table-scrollbar pl-0 pr-2 mb-5">
                    <table class="table table-hover">
                        <thead class="bg-primary-purple text-white"
                            style="border-radius:25px 25px 15px 15px;">
                            <tr>
                                <th scope="col-md-auto"></th>
                                <th scope="col-md-auto">{{__('ID') }}</th>
                                <th scope="col-md-auto">{{__('Nama File') }}</th>
                                <th scope="col-md-auto">{{__('Produk') }}</th>
                                <th scope="col-md-auto">{{__('Biaya') }}</th>
                                <th scope="col-md-auto"></th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px;">

                            {{-- @foreach ($collection as $item) --}}
                            <tr>

                                {{-- @foreach ($collection as $item) --}}
                                <td scope="row">
                                    <div class="custom-control custom-checkbox mt-0 ml-1">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="checkboxTable1">
                                        <label class="custom-control-label"
                                            for="checkboxTable1"></label>
                                    </div>
                                </td>
                                <td>{{__('00000001') }}</td>
                                <td>{{__('Skripsilagee.pdf') }}</td>
                                <td>{{__('Cetak Warna Skripsi') }}</td>
                                <td>{{__('Rp. 12.000') }}</td>
                                <td>
                                    <span>
                                        <i class="material-icons mr-2">
                                            edit
                                        </i>
                                        <i class="material-icons"
                                            style="color: red;">
                                            delete
                                        </i>
                                    </span>
                                </td>
                                {{-- @endforeach --}}

                            </tr>
                            {{-- @endforeach --}}

                        </tbody>
                    </table>
                </div>
                <label class="SemiBold mb-2 ml-0 mr-2">{{__('ATK') }}</label>

                {{-- @foreach ($collection as $item) --}}
                <div class="row justify-content-between ml-0 mr-2">
                    <div class="col-md-4 form-group custom-control custom-checkbox">
                        <input type="checkbox"
                            class="custom-control-input"
                            id="checkboxPensil"
                            style="width: 100%;">
                        <label class="custom-control-label text-break align-middle"
                            for="checkboxPensil"
                            style="width: 100%;">
                            {{__('Pensilasdasdsadadadadadadsadadsadad') }}
                            <i class="material-icons align-middle ml-2"
                            style="color: #C4C4C4">
                                help
                            </i>
                        </label>
                    </div>
                    <div class="col-md-auto form-group">
                        <label>{{__('Jumlah') }}
                            <i class="fa fa-plus ml-2 mr-2"></i>
                        </label>
                        <input type="text"
                            class="form-input"
                            style="width:48px;">
                        <i class="fa fa-minus ml-2 mr-2"></i>
                    </div>
                    <div class="col-md-4 text-right">
                        <label class="SemiBold mb-2 ml-0"
                        style="width: 100%;">
                            {{__('Rp. 500') }}
                        </label>
                    </div>
                </div>
                {{-- @endforeach --}}

            </div>
        </div>
        <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold mb-5"
            style="border-radius:30px;
                font-size:24px;">
            {{__('Buat Pesanan') }}
        </button>
    </div>
@endsection