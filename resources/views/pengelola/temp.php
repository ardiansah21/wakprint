@extends('layouts.pengelola')

@section('content')
    <div class="container mt-5 mb-5"
        style="font-size: 16px;">
        <form action="">
            <div class="row justify-content-between ml-0 mr-0">
                <label class="font-weight-bold mb-4"
                    style="font-size:36px;">
                    {{__('Tambah Produk') }}
                </label>
                <!-- Rounded switch -->
                <label class="switch mb-5">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            
            <label class="mb-2"
                style="font-size: 16px;">
                {{__('Foto Produk') }}
            </label>

            {{-- <div class="scrolling-wrapper mb-0"> --}}
                <div class="row justify-content-left"
                    style="height:200px;">
                    <div class="col-md-auto"
                        style="position: relative">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                            class="img-responsive bg-light"
                            style="width:250px;
                                border-radius:10px;">
                        <div class="mb-3">
                            <button type="button"
                                class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0"
                                style="position: relative;
                                    font-size:16px;
                                    bottom: 50px;
                                    left:110px;
                                    right: 0px;
                                    border-radius:30px;">
                                    {{__('Pilih Foto') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center mb-5">
                        <button class="btn btn-circle shadow-sm"
                            role="button">
                            <i class="material-icons md-36 align-middle" 
                            style="color: white; margin-left:-7px;">
                                add
                            </i>
                        </button>
                    </div>
                </div>
            {{-- </div> --}}
            
            <label class="mb-2">
                {{__('Nama Produk') }}
            </label>
            <div class="form-group mb-4">
                <input type="text"
                    class="form-control form-control-lg mr-0"
                    placeholder="Masukkan Nama Produk" 
                    aria-label="Masukkan Nama Produk"
                    aria-describedby="inputGroup-sizing-sm"
                    style="font-size:16px;">
            </div>
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <label class="mb-2">
                        {{__('Harga Produk') }}
                    </label>
                    <div class="row justify-content-left mb-2">
                        <label class="col-md-1 mt-2 mb-2">
                            {{__('Rp') }}
                        </label>
                        <div class="col-md-9 form-group mb-4">
                            <input type="text"
                                class="form-control form-control-lg"
                                placeholder="Masukkan Harga Produk" 
                                aria-label="Masukkan Harga Produk"
                                aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 16px;">
                        </div>
                        <label class="col-md-1 mt-0 mb-2">
                            {{__('/ Lembar') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="mb-2">
                        {{__('Harga Produk (Timbal Balik)') }}
                    </label>
                    <div class="row justify-content-left mb-2">
                        <label class="col-md-1 mt-2 mb-2">
                            {{__('Rp') }}
                        </label>
                        <div class="col-md-9 form-group mb-4">
                            <input type="text"
                                class="form-control form-control-lg pt-2 pb-2"
                                placeholder="Masukkan Harga Produk (Timbal Balik)" 
                                aria-label="Masukkan Harga Produk (Timbal Balik)"
                                aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 16px;">
                        </div>
                        <label class="col-md-1 mt-0 mb-2">
                            {{__('/ Halaman') }}
                        </label>
                    </div>
                </div>
            </div>
            <label class="mb-2">
                {{__('Deskripsi Produk') }}
            </label>
            <div class="form-group mb-4">
                <textarea class="form-control"
                    aria-label="Deskripsi Produk"
                    placeholder="Masukkan Deskripsi Produk Anda"></textarea>
            </div>
            <label class="mb-3">
                {{__('Fitur Utama') }}
            </label>
            <div class="row justify-content-between mb-4">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold mb-2"
                        style="font-size:14px;">
                        {{__('Kertas') }}
                    </label>
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownKertas"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            style="font-size: 16px;
                            text-align:left;">
                            {{__('Jenis Random') }}
                        </button>
                        <div class="dropdown-menu"
                            aria-labelledby="dropdownKertas"
                            style="font-size: 16px;
                                width:100%;">
                            <a class="dropdown-item"
                                href="#">
                                {{__('A4') }}
                            </a>
                            <a class="dropdown-item"
                                href="#">
                                {{__('A3') }}
                            </a>
                            <a class="dropdown-item"
                                href="#">
                                {{__('Quarto') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold mb-2"
                        style="font-size: 14px;">
                        {{__('Printer') }}
                    </label>
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownPrinter"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            style="font-size: 16px;
                                text-align:left;">
                            {{__('Ink Jet') }}
                        </button>
                        <div class="dropdown-menu"
                            aria-labelledby="dropdownPrinter"
                            style="font-size: 16px;
                                width:100%">
                            <a class="dropdown-item"
                                href="#">
                                {{__('Ink Jet') }}
                            </a>
                            <a class="dropdown-item"
                                href="#">
                                {{__('Laser Jet') }}
                            </a>
                            <a class="dropdown-item" 
                                href="#">
                                {{__('Turbo') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold mb-2"
                        style="font-size: 14px;">
                        {{__('Warna Cetak') }}
                    </label>
                    <div class="row justify-content-left mb-2">
                        <div class="custom-control custom-checkbox mt-2 ml-3">
                            <input type="checkbox"
                                class="custom-control-input"
                                id="checkboxHitamPutih">
                            <label class="custom-control-label"
                                for="checkboxHitamPutih">
                                {{__('Hitam-Putih') }}
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox mt-2 ml-4">
                            <input type="checkbox"
                                class="custom-control-input"
                                id="checkboxWarna">
                            <label class="custom-control-label"
                                for="checkboxWarna">
                                {{__('Berwarna') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <label class="mb-3">
                {{__('Paket Produk') }}
            </label>

            {{-- @foreach ($collection as $item) --}}
                <div class="row justify-content-left mb-2 ml-0">
                    <div class="form-group custom-control custom-checkbox">
                        <input type="checkbox"
                            class="custom-control-input"
                            id="checkboxJilid">
                        <label class="custom-control-label"
                            for="checkboxJilid">
                            {{__('Jilid') }} 
                            <i class="material-icons md-18 align-middle"
                                style="color:#C4C4C4">
                                help
                            </i>
                        </label>
                    </div>
                </div>

                {{-- @foreach ($collection as $item) --}}
                    <div class="form-group row justify-content-between mb-3 ml-2">
                        <div class="col-md-6 custom-control custom-checkbox ml-3">
                            <input type="checkbox"
                                class="custom-control-input"
                                id="checkboxLem">
                            <label class="custom-control-label"
                                for="checkboxLem">
                                {{__('Lem') }} 
                                <i class="material-icons md-18 align-middle"
                                    style="color:#C4C4C4">
                                    help
                                </i>
                            </label>
                        </div>
                        <label class="col-md-auto mt-1 mb-2">
                            {{__('Rp') }}
                        </label>
                        <div class="col-md-5">
                            <input type="text"
                                class="form-control pt-2 pb-2"
                                placeholder="3.000" 
                                aria-label="Masukkan Harga Produk"
                                aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 16px;">
                        </div>
                    </div>
                {{-- @endforeach --}}

            
            {{-- @endforeach --}}

            <label class="mb-3">
                {{__('Paket Non-Produk') }}
            </label>

            {{-- @foreach ($collection as $item) --}}
            <div class="form-group row justify-content-between mb-3 ml-0">
                <div class="col-md-6 custom-control custom-checkbox">
                    <input type="checkbox"
                        class="custom-control-input"
                        id="checkboxLaminating">
                    <label class="custom-control-label"
                        for="checkboxLaminating">
                        {{__('Laminating') }} 
                        <i class="material-icons md-18 align-middle"
                            style="color:#C4C4C4">
                            help
                        </i>
                    </label>
                </div>
                <label class="col-md-auto mt-1 mb-2">
                    {{__('Rp') }}
                </label>
                <div class="col-md-5">
                    <input type="text"
                        class="form-control pt-2 pb-2"
                        placeholder="3.000" 
                        aria-label="Masukkan Harga Produk"
                        aria-describedby="inputGroup-sizing-sm"
                        style="font-size: 16px;">
                </div>
            </div>
            {{-- @endforeach --}}

            <div class="ml-0 mr-0">
                <label class="mb-4 ml-0 mt-2">
                    {{__('Paket Tambahan Anda') }}
                </label>
                <div class="row justify-content-between mb-2">
                    <div class="col-md-2"
                        style="position: relative">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                            class="img-responsive bg-light"
                            style="width:163px;
                                height:163px;
                                border-radius:10px;">
                        <a href=""
                            style="color: black;
                                position: relative;
                                bottom: 40px;
                                left:130px;
                                right: 0px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2"
                                style="border-radius: 5px;">
                                edit
                            </i>
                        </a>
                    </div>
                    <div class="col-md-9">
                        <div class="row justify-content-between">
                            <div class="col-md-7 form-group mb-3">
                                <input type="text"
                                    class="form-control form-control-lg pt-2 pb-2"
                                    placeholder="Laminating"
                                    aria-label="Laminating"
                                    aria-describedby="inputGroup-sizing-sm"
                                    style="font-size: 16px;">
                            </div>
                            <div class="col-md-5 form-group input-group mb-3">
                                Rp &nbsp;
                                <input type="text"
                                    class="form-control form-control-lg pt-2 pb-2"
                                    placeholder="3.000" 
                                    aria-label="3.000" 
                                    aria-describedby="inputGroup-sizing-sm"
                                    style="font-size: 16px;">
                            </div>
                        </div>
                        <label class="mb-2">
                            {{__('Deskripsi Fitur') }}
                        </label>
                        <div class="form-group mb-4">
                            <textarea class="form-control"
                                aria-label="Deskripsi Fitur"
                                placeholder="Masukkan Deskripsi Paket Tambahan Anda"></textarea>
                        </div>
                    </div>
                    <div class="col-md-auto align-self-center mr-0 mb-3">
                        <button class="btn btn-circle shadow-sm"
                            role="button">
                            <i class="material-icons md-36 align-middle"
                                style="color: white; margin-left:-7px;">
                                add
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between mb-5 ml-0">
                <div class="col-md-11 bg-light-purple pl-4 pr-2 pt-2 pb-2"
                    style="border-radius:10px;">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between"
                        style="width:100%;">
                        <label class="col-md-9 text-break mb-0">
                            {{__('Tulang Kliping Warna') }}
                        </label>
                        <label class="col-md-3 text-right mb-0">
                            {{__('Rp. 500') }}
                        </label>
                    </div>
                    {{-- @endforeach --}}

                </div>
                <div class="col-md-auto pt-2 pb-2">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mr-0">
                        <i class="material-icons align-middle ml-2">
                            edit
                        </i>
                        <i class="material-icons align-middle text-primary-danger ml-2">
                            delete
                        </i>
                    </div>
                    {{-- @endforeach --}}

                </div>
            </div>
            <div class="row justify-content-end mr-0 mb-5">
                <div class="mr-3">
                    <button class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-5 pr-5 mb-0" 
                        style="border-radius:30px;
                            font-size:18px;">
                        {{__('Batalkan Perubahan') }}
                    </button>
                </div>
                <div class="mr-0">
                    <button class="btn btn-lg btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;
                            font-size:18px;">
                        {{__('Simpan Perubahan') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection