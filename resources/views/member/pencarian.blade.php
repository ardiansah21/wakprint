<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="row justify-content-between mb-5 mt-5">
        <div class="col-md-4">
            <div class="btn-group btn-group-toggle mt-2 mb-4" data-toggle="buttons">
                <label id="antarRumah"
                class="btn btn-default-wakprint shadow-sm SemiBold mr-4"
                style="border-radius:30px; font-size:14px;">
                    <input type="checkbox" checked autocomplete="off">
                    {{__('Antar ke Rumah')}}
                </label>
                <label id="ambilTempat"
                class="btn btn-default-wakprint shadow-sm SemiBold"
                style="border-radius:30px; font-size:14px;">
                    <input type="checkbox" checked autocomplete="off">
                    {{__('Ambil di Tempat')}}
                </label>
            </div>
            <div class="mt-3">
                <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Jenis Ukuran Kertas')}}</label>
                <div class="dropdown">
                    <button class="btn btn-default shadow-sm dropdown-toggle border border-gray"
                    style="font-size:18px;"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                        {{__('Semua')}}
                    </button>
                    <div class="dropdown-menu"
                    style="font-size:18px;"
                    aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">{{__('Terbaru')}}</a>
                        <a class="dropdown-item" href="#">{{__('Tinggi ke Rendah')}}</a>
                        <a class="dropdown-item" href="#">{{__('Rendah ke Tinggi')}}</a>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Jenis Printer')}}</label>
                <div class="dropdown">
                    <button class="btn btn-default shadow-sm dropdown-toggle border border-gray"
                    style="font-size:18px;"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                        {{__('Semua')}}
                    </button>
                    <div class="dropdown-menu"
                    style="font-size:18px;"
                    aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">{{__('Terbaru')}}</a>
                        <a class="dropdown-item" href="#">{{__('Tinggi ke Rendah')}}</a>
                        <a class="dropdown-item" href="#">{{__('Rendah ke Tinggi')}}</a>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label class="SemiBold mb-3 ml-0"
                style="font-size:24px;">{{__('Paket')}}</label>

                {{-- @foreach ($collection as $item) --}}
                    <div style="font-size:18px;">
                        <div class="custom-control custom-checkbox ml-1">
                            <input type="checkbox"
                            class="custom-control-input"
                            id="checkboxJilid">
                            <label class="custom-control-label" for="checkboxJilid">
                                {{__('Jilid')}}
                                <i class="material-icons md-18 align-middle ml-2">
                                    help
                                </i>
                            </label>
                        </div>

                        {{-- @foreach ($collection as $item) --}}
                            <div class="custom-control custom-checkbox mt-2 ml-4">
                                <input type="checkbox" class="custom-control-input" id="checkboxLakban">
                                <label class="custom-control-label" for="checkboxLakban">
                                    {{__('Lakban')}} 
                                    <i class="material-icons md-18 align-middle ml-2">
                                        help
                                    </i>
                                </label>
                            </div>
                        {{-- @endforeach --}}
                        
                    </div>
                {{-- @endforeach --}}
                
            </div>
            <div class="mt-3">
                <label class="font-weight-bold mb-3 ml-1"
                style="font-size:24px;">{{__('Non Paket')}}</label>

                {{-- @foreach ($collection as $item) --}}
                    <div class="custom-control custom-checkbox ml-1"
                    style="font-size:18px;">
                        <input type="checkbox" class="custom-control-input" id="checkboxLemNasi">
                        <label class="custom-control-label" for="checkboxLemNasi">{{__('Lem Nasi')}}  
                            <i class="material-icons md-18 align-middle ml-2">
                                help
                            </i>
                        </label>
                    </div>
                {{-- @endforeach --}}
            </div>
        </div>
        <div class="col-md-8 ml-0">
            <label class="font-weight-bold mb-5"
            style="font-size: 48px;">
                {{__('Cari Produk / Tempat Percetakan')}}
            </label>
            <div class="row mb-3">
                <div class="col-md-9">
                    <div class="search-input mb-3">
                        <div class="main-search-input-item">
                            <input type="text"
                            role="search"
                            class="form-control"
                            placeholder="Cari percetakan atau produk disini"
                            aria-label="Cari percetakan atau produk disini"
                            aria-describedby="basic-addon2"
                            style="border:0px solid white;
                            border-radius:30px;
                            font-size:18px;">
                            <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute;
                            top: 50%;
                            left: 95%;
                            transform:translate(-50%, -50%);
                            -ms-transform: translate(-50%, -50%);">
                                search
                            </i>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto">
                    <div class="dropdown">
                        <button class="btn btn-default shadow-sm btn-lg dropdown-toggle border border-gray"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            style="font-size:18px;"
                            aria-expanded="false">
                            {{__('Semua')}}
                        </button>
                        <div class="dropdown-menu"
                        style="font-size:18px;"
                        id="dropdown"
                        aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-value="item1">{{__('Terbaru')}}</a>
                            <a class="dropdown-item" href="#" data-value="item2">{{__('Tinggi ke Rendah')}}</a>
                            <a class="dropdown-item" href="#" data-value="item3">{{__('Rendah ke Tinggi')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <ul class="nav nav-pills SemiBold mb-5"
                id="pills-tab"
                role="tablist"
                style="font-size:18px;">
                    <li class="nav-item mr-3">
                        <a class="nav-link active" id="pills-produk-tab" data-toggle="tab" href="#pills-produk"
                            role="tab" aria-controls="pills-produk" aria-selected="true"
                            style="border-radius:10px 10px 0px 0px;">
                            <i class="material-icons align-middle mr-2">
                                shopping_cart
                            </i>
                            {{__('Produk')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-tempat-percetakan-tab" data-toggle="tab"
                            href="#pills-tempat-percetakan" role="tab" aria-controls="pills-tempat-percetakan"
                            aria-selected="false" style="border-radius:10px 10px 0px 0px;">
                            <i class="material-icons align-middle mr-2">
                                home
                            </i>
                            {{__('Tempat Percetakan')}}
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active"
                    id="pills-produk"
                    role="tabpanel"
                    aria-labelledby="pills-produk-tab">
                        <div class="my-custom-scrollbar">
                            <div class="row justify-content-between mb-4">
                                        
                                {{-- @foreach ($collection as $item) --}}
                                    <div class="col-md-6 mb-4">
                                        <div class="col-md-auto mb-4">
                                            @include('member.card_produk')
                                        </div>
                                    </div>
                                {{-- @endforeach --}}
                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-tempat-percetakan" role="tabpanel"
                        aria-labelledby="pills-tempat-percetakan-tab">
                        <div class="my-custom-scrollbar">
                            <div class="row justify-content-between mb-4">
                                        
                                {{-- @foreach ($collection as $item) --}}
                                    <div class="col-md-6 mb-4">
                                        <div class="col-md-auto mb-4">
                                            @include('member.card_percetakan')
                                        </div>
                                    </div>
                                {{-- @endforeach --}}
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection