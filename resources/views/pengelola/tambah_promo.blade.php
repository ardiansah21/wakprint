@extends('layouts.pengelola')

@section('content')
    <div class="container mt-5 mb-5"
        style="font-size: 16px;">
        <label class="font-weight-bold mb-4"
            style="font-size: 36px;">
            {{__('Tambah Promo') }}
        </label>
        <br>
        <label class="mb-2">
            {{__('Pilih Produk untuk Diberi Promo') }}
        </label>
        <div class="form-group search-input mb-4">
            <div class="main-search-input-item">
                <input type="text"
                    role="search"
                    class="form-control"
                    placeholder="Cari produk anda disini..."
                    aria-label="Cari produk disini"
                    aria-describedby="basic-addon2"
                    style="border:0px solid white;
                        border-radius:30px;
                        font-size:16px;">
                    <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                        style="position: absolute;
                            top: 50%; left: 98%;
                            transform: translate(-50%, -50%);
                            -ms-transform: translate(-50%, -50%);">
                        search
                    </i>
            </div>
        </div>
        <div class="row justify-content-between mb-0">
            <span class="justify-content-center align-self-center col-md-auto">
                <a class="btn btn-circle-navigation-left btn-xl shadow-sm"
                    href="#multi-item-promo-produk"
                    role="button"
                    data-slide="prev">
                    <img src="{{url('img/arrow-left.png')}}">
                </a>
            </span>

            <!--Carousel Wrapper-->
            <div id="multi-item-promo-produk"
                class="carousel slide carousel-multi-item col-md-10"
                data-ride="carousel">

                <!--Slides-->
                <div class="carousel-inner"
                    role="listbox">

                    {{-- @foreach ($collection as $item) --}}
                        <div class="carousel-item active">
                            <div class="row">

                                {{-- @foreach ($collection as $item) --}}
                                    <div class="col-md-4">
                                        @include('pengelola.card_produk_pengelola')
                                    </div>
                                {{-- @endforeach --}}
                                
                            </div>
                        </div>
                    {{-- @endforeach --}}

                </div>
                <!--/.Slides-->

            </div>
            <!--/.Carousel Wrapper-->
            
            <span class="justify-content-center align-self-center col-md-auto">
                <a class="btn btn-circle-navigation-left btn-xl shadow-sm"
                    href="#multi-item-promo-produk"
                    role="button"
                    data-slide="next">
                    <img class="ml-2" 
                        src="{{url('img/arrow-right.png')}}">
                    </a>
            </span>
        </div>
        <form action="">
            <div class="row mb-4" style="">
                <div class="col-md-6">
                    <label class="mb-2">
                        {{__('Maksimal Diskon') }}
                    </label>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-1 text-center mb-0 mr-0 mt-2">
                            {{__('Rp.') }}
                        </label>
                        <div class="col-md-11 form-group mb-4">
                            <input type="text"
                                class="form-control form-control-lg pt-2 pb-2"
                                placeholder="300.000" 
                                aria-label="300.000"
                                aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 16px;">
                        </div>
                    </div>
                    <label class="mb-2">
                        {{__('Tanggal Promo Mulai') }}
                    </label>
                    <div class="row justify-content-left mb-3">
                        <div class="form-group col-md-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" 
                                    id="dropdownTanggalMulai"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    style="font-size: 16px;">
                                    {{__('Tanggal') }}
                                </button>
                                <div class="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton"
                                    style="font-size: 16px;
                                        width:100%;">
                                    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('1') }}
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            {{__('2') }}
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            {{__('3') }}
                                        </a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray"
                                    id="dropdownBulanMulai"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    style="font-size: 16px;">
                                    {{__('Bulan') }}
                                </button>
                                <div class="dropdown-menu"
                                    aria-labelledby="dropdownBulanMulai"
                                    style="font-size: 16px;">
    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item" href="#">
                                            {{__('Januari') }}
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            {{__('Februari') }}
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            {{__('Maret') }}
                                        </a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" 
                                    id="dropdownTahunMulai"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    style="font-size: 16px;">
                                    {{__('Tahun') }}
                                </button>
                                <div class="dropdown-menu"
                                    aria-labelledby="dropdownTahunMulai"
                                    style="font-size: 16px;">
                                    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('2000') }}
                                        </a>
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('2001') }}
                                        </a>
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('2002') }}
                                        </a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="mb-2">
                        {{__('Jumlah Diskon') }}
                    </label>
                    <div class="form-group row justify-content-left mb-2">
                        <div class="col-md-2 input-group mb-4">
                            <input type="text"
                                class="form-control form-control-lg pt-2 pb-2"
                                placeholder="10" 
                                aria-label="10"
                                aria-describedby="inputGroup-sizing-sm"
                                style="width:100%;
                                    font-size:16px;">
                        </div>
                        <label class="col-md-auto text-left mb-0 mr-0 ml-0 mt-2">
                            {{__('%') }}
                        </label>
                    </div>
                    <label class="mb-2">
                        {{__('Tanggal Promo Selesai') }}
                    </label>
                    <div class="row justify-content-left mb-3">
                        <div class="form-group col-md-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" 
                                    id="dropdownTanggalSelesai"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    style="font-size: 16px;">
                                    {{__('Tanggal') }}
                                </button>
                                <div class="dropdown-menu"
                                    aria-labelledby="dropdownTanggalSelesai"
                                    style="font-size: 16px;
                                        width:100%;">
                                    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('1') }}
                                        </a>
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('2') }}
                                        </a>
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('3') }}
                                        </a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray"
                                    id="dropdownBulanSelesai"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    style="font-size: 16px;">
                                    {{__('Bulan') }}
                                </button>
                                <div class="dropdown-menu"
                                    aria-labelledby="dropdownBulanSelesai"
                                    style="font-size: 16px;">
    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item" href="#">
                                            {{__('Januari') }}
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            {{__('Februari') }}
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            {{__('Maret') }}
                                        </a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" 
                                    id="dropdownTahunSelesai"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    style="font-size: 16px;">
                                    {{__('Tahun') }}
                                </button>
                                <div class="dropdown-menu"
                                    aria-labelledby="dropdownTahunSelesai"
                                    style="font-size: 16px;">
                                    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('2000') }}
                                        </a>
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('2001') }}
                                        </a>
                                        <a class="dropdown-item"
                                            href="#">
                                            {{__('2002') }}
                                        </a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end mr-0">
                <div class="form-group mr-3">
                    <button class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;
                            font-size:18px;">
                        {{__('Batal') }}
                    </button>
                </div>
                <div class="form-group mr-0">
                    <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;">
                        {{__('Tambah') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

