<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container">
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
                                    @foreach ($produk as $p)
                                        <div class="col-md-6 mb-4">
                                            <div class="col-md-auto mb-4">
                                                <div class="card shadow mb-2" style="border-radius: 10px;">
                                                    <a class="text-decoration-none" href="" style="color: black;">
                                                        <div class="text-center" style="position: relative;">
                                                            <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                                                width:75px;
                                                                height:50px;
                                                                border-radius:0px 0px 8px 8px;">
                                                                    <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                                            </div>
                                                        </div>
                                                        <i class="fa fa-heart fa-2x fa-responsive"
                                                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                                        </i>
                                                        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                        style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                                        alt="Card image cap"/>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{__('Percetakan UD Sinar Jaya') }}</label>
                                                                <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                                            </div>
                                                            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{$p->nama ?? ''}}</label>
                                                            <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{__('Jalan Seksama Ujung No 95A Medan Denai, Medan, Sumatera Utara') }}</label>
                                                            <div class="row justify-content-between ml-0 mr-0">
                                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i>
                                                                    @if ($p->berwarna === 0 || $p->hitam_putih === 1)
                                                                        {{__('Hitam-Putih')}}
                                                                    @elseif ($p->berwarna === 1 || $p->hitam_putih === 0)
                                                                        {{__('Berwarna')}}
                                                                    @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                                                        {{__('Berwarna')}}
                                                                    @else
                                                                        {{__('-')}}
                                                                    @endif
                                                                </label>
                                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label>
                                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                                            <div class="row justify-content-between">
                                                                <div class="ml-3">
                                                                    <label class="card-text ml-0 SemiBold" style="font-size: 18px;">
                                                                        <i class="material-icons md-24 align-middle mr-2" style="color: #7BD6AF">local_offer</i>
                                                                        Rp. {{$p->harga ?? ''}}
                                                                    </label>
                                                                </div>

                                                                <div class="mr-0">
                                                                    <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                                                        <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                                        {{$p->rating ?? ''}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-tempat-percetakan" role="tabpanel"
                            aria-labelledby="pills-tempat-percetakan-tab">
                            <div class="my-custom-scrollbar">
                                <div class="row justify-content-between mb-4">

                                    @foreach ($partner as $p)
                                        <div class="col-md-6 mb-4">
                                            <div class="col-md-auto mb-4">
                                                <div class="card shadow mb-2" style="border-radius: 10px;">
                                                    <a class="text-decoration-none" href="" style="color: black;">
                                                        <label class="badge badge-pill badge-info bg-promo font-weight-bold align-bottom p-2 mb-1 mt-3" style="position: absolute;top: 0%; left: 80%; font-size: 12px;">{{__('ATK') }}</label>
                                                        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                        style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                                        alt="Card image cap"/>
                                                        <div class="card-body">
                                                            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{$p->nama_toko}}</label>
                                                            <label class="card-text text-truncate-multiline" style="font-size: 16px;">{{$p->alamat_toko}}</label>
                                                            <label class="card-text text-sm text-truncate-multiline" style="font-size: 14px;">{{$p->deskripsi_toko}}</label>
                                                        </div>
                                                        <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                                            <div class="row justify-content-between ml-0">
                                                                <label class="card-text font-weight-bold" style="font-size: 18px;">
                                                                    <i class="material-icons md-24 mr-2 align-middle" style="color: #6081D7">location_on</i>
                                                                    {{__('100 m') }}
                                                                </label>
                                                                <label class="card-text mr-4 font-weight-bold" style="font-size: 18px;">
                                                                    <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                                                                    {{$p->rating_toko}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
