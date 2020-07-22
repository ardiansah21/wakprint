@extends('layouts.member')

@section('content')
<div class="container">
    <div class="mt-5 mb-5">
        <label class="font-weight-bold" style="font-size:48px;">{{__('Konfigurasi File') }}
        </label>
        <div class="row justify-content-between mr-0 mb-5">
            <div class="col-md-auto mt-5 mr-0">
                <div class="border-primary-purple" style="width:515px;
                        height:515px;
                        position:relative;
                        float: none;
                        display: table-cell;
                        vertical-align: bottom;">
                    <div class="row bg-dark justify-content-between align-middle ml-0 mr-0 pl-2 pr-2 pt-4 pb-4" style="font-size:24px;
                        opacity:80%;
                        width:100%;
                        border-radius: 0px 0px 5px 5px;">
                        <label class="col-md-auto text-white">
                            {{__('Hitam-Putih') }}
                        </label>
                        <label class="col-md-auto text-right text-white">
                            <i class="fa fa-chevron-left text-white mr-2"></i>
                            {{__('12 / 16') }}
                            <i class="fa fa-chevron-right ml-2"></i>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-5 ml-0 mr-0">
                <div class="row justify-content-between bg-light-purple pl-4 pr-4 pt-4 pb-4 mb-4" style="border-radius:5px;
                        height:310px;">
                    <div class="col-md-6 border-primary-purple d-flex h-100" style="width:265px; 
                            height:265px;">
                        <label class="SemiBold text-center text-primary-purple align-self-center"
                            style="font-size: 24px;">
                            {{__('Letak Dokumen Disini') }}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="text-justify mb-4 ml-2" style="font-size: 14px">
                            {{__('Letak dokumen yang ingin kamu cetak disamping kiri atau klik tombol dibawah') }}
                        </label>
                        <div class="text-center ml-2">
                            <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold" style="border-radius:30px
                                    font-size: 18px">
                                <i class="material-icons align-middle mr-2">cloud_upload</i>
                                {{__('Unggah') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-between mb-4">
            <div class="col-md-7">
                <div class="search-input">
                    <div class="main-search-input-item">
                        <input type="text" role="search" class="form-control"
                            placeholder="Cari percetakan atau produk disini"
                            aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2" style="border:0px solid white;
                                border-radius:30px;
                                font-size:18px;">
                        <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute;
                                    top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            search
                        </i>
                    </div>
                </div>
            </div>
            <div class="col-md-auto">
                <div class="dropdown">
                    <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="font-size: 18px;">
                        {{__('Urutkan') }}
                    </button>
                    <div class="dropdown-menu" style="font-size: 18px;" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">
                            {{__('Terbaru') }}
                        </a>
                        <a class="dropdown-item" href="#">
                            {{__('Tinggi ke Rendah') }}
                        </a>
                        <a class="dropdown-item" href="#">
                            {{__('Rendah ke Tinggi') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-auto">
                <div class="dropdown">
                    <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="font-size: 18px;">
                        {{__('Printer') }}
                    </button>
                    <div class="dropdown-menu" style="font-size: 18px;" aria-labelledby="dropdownMenuButton">

                        {{-- @foreach ($collection as $item) --}}
                        <a class="dropdown-item" href="#">
                            {{__('Ink Jet') }}
                        </a>
                        {{-- @endforeach --}}

                    </div>
                </div>
            </div>
            <div class="col-md-auto">
                <div class="dropdown">
                    <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                        style="font-size: 18px;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{__('Kertas') }}
                    </button>
                    <div class="dropdown-menu" style="font-size: 18px;" aria-labelledby="dropdownMenuButton">

                        {{-- @foreach ($collection as $item) --}}
                        <a class="dropdown-item" href="#">A4</a>
                        {{-- @endforeach --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4 ml-0" style="border-radius:5px;">

            <label class="SemiBold mb-3 ml-0" style="font-size: 18px;">
                {{__('Paket')}}
            </label>
            <br>
            <div class="container" style="font-size: 14px;">

                {{-- @foreach ($collection as $item) --}}
                <label class="SemiBold mb-2 ml-0">
                    {{__('Jilid')}}
                </label>
                <div class="row justify-content-left ml-0">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                        <input type="checkbox" class="custom-control-input" id="checkboxJilid">
                        <label class="custom-control-label" for="checkboxJilid">
                            {{__('Jilid')}}
                            <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                                help
                            </i>
                        </label>
                    </div>
                    {{-- @endforeach --}}

                </div>
                {{-- @endforeach --}}

            </div>
            <label class="SemiBold mt-3 mb-2 ml-0" style="font-size: 18px;">
                {{__('Non-Paket')}}
            </label>
            <div class="row justify-content-left ml-0" style="font-size: 14px;">

                {{-- @foreach ($collection as $item) --}}
                <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                    <input type="checkbox" class="custom-control-input" id="checkboxLakban">
                    <label class="custom-control-label" for="checkboxLakban">
                        {{__('Jilid Lakban')}}
                        <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                            help
                        </i>
                    </label>
                </div>
                {{-- @endforeach --}}

            </div>
        </div>
        <div class="border-primary-purple my-custom-scrollbar-2 p-5" style="border-radius:5px;">
            <div class="row row-cols-3">

                {{-- @foreach ($collection as $item) --}}
                <div class="col mb-4">
                    @include('member.card_produk')
                </div>
                {{-- @endforeach --}}

            </div>
        </div>
    </div>
</div>
@endsection