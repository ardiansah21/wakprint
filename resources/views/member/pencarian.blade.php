<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:72px">
            <div class="row mb-5">
                <div class="container col-auto mt-5">
                    <div class="btn-group btn-group-toggle mt-2 mb-4" data-toggle="buttons">
                        <label id="antarRumah" class="btn btn-default-wakprint shadow-sm mr-4" style="border-radius:30px;">
                            <input type="checkbox" checked autocomplete="off">Antar ke Rumah
                        </label>
                        <label id="ambilTempat" class="btn btn-default-wakprint shadow-sm" style="border-radius:30px;">
                            <input type="checkbox" checked autocomplete="off">Ambil di Tempat
                        </label>
                    </div>

                    <div class="container mt-3" style="margin-left:-10px;">
                        <h4 class="font-weight-bold mb-3 ml-1">Jenis Ukuran Kertas</h4>
                        <div class="container" style="margin-left:-10px;">
                            <div class="dropdown">
                                <button class="btn btn-default shadow-sm dropdown-toggle border border-gray" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Semua
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Terbaru</a>
                                    <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                    <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-3" style="margin-left:-10px;">
                        <h4 class="font-weight-bold mb-3 ml-1">Jenis Printer</h4>
                        <div class="container" style="margin-left:-10px;">
                            <div class="dropdown">
                                <button class="btn btn-default shadow-sm dropdown-toggle border border-gray" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Semua
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Terbaru</a>
                                    <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                    <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-3" style="margin-left:-10px;">
                        <h4 class="font-weight-bold mb-3 ml-1">Paket</h4>

                        {{-- @foreach ($collection as $item) --}}
                            <div>
                                <div class="custom-control custom-checkbox ml-1">
                                    <input type="checkbox" class="custom-control-input" id="checkboxJilid">
                                    <label class="custom-control-label" for="checkboxJilid">Jilid <i class="material-icons md-18 align-middle ml-2">help</i></label>
                                </div>

                                {{-- @foreach ($collection as $item) --}}
                                    <div class="custom-control custom-checkbox mt-2 ml-4">
                                        <input type="checkbox" class="custom-control-input" id="checkboxLakban">
                                        <label class="custom-control-label" for="checkboxJilid">Jilid <i class="material-icons md-18 align-middle ml-2">help</i></label>
                                    </div>
                                {{-- @endforeach --}}
                                
                            </div>
                        {{-- @endforeach --}}
                        
                    </div>

                    <div class="container mt-3" style="margin-left:-10px;">
                        <h4 class="font-weight-bold mb-3 ml-1">Non Paket</h4>

                        {{-- @foreach ($collection as $item) --}}
                            <div class="custom-control custom-checkbox ml-1">
                                <input type="checkbox" class="custom-control-input" id="checkboxLemNasi">
                                <label class="custom-control-label" for="checkboxJilid">Jilid <i class="material-icons md-18 align-middle ml-2">help</i></label>
                            </div>
                        {{-- @endforeach --}}
                    </div>
                </div>

                <div class="container col-8 mt-5">
                    <div class="container mb-5">
                        <h1 class="font-weight-bold">Cari Produk / Tempat Percetakan</h1>
                    </div>


                    <div class="container mb-3">
                        <div class="row ">
                            <div class="container col-9">
                                <div class="input-group mb-3" role="search">
                                    <input type="text" class="form-control p-4"
                                        placeholder="Cari percetakan atau produk disini"
                                        aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                                        style="border-radius:30px;">
                                    <i class="material-icons md-36 ml-1 pt-1 pb-1 pl-3 pr-3"
                                        style="position: absolute;
                                        top: 50%; left: 93%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">search
                                    </i>

                                </div>
                            </div>
                            <div class="container col-auto">
                                <div class="dropdown">
                                    <button class="btn btn-default shadow-sm btn-lg dropdown-toggle border border-gray"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Semua
                                    </button>
                                    <div class="dropdown-menu" id="dropdown" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-value="item1">Terbaru</a>
                                        <a class="dropdown-item" href="#" data-value="item2">Tinggi ke Rendah</a>
                                        <a class="dropdown-item" href="#" data-value="item3">Rendah ke Tinggi</a>
                                    </div>
                                </div>

                                <script>
                                    $(".dropdown-menu li a").click(function () {
                                        var selText = $(this).text();
                                        console.log(selText);
                                        $(this).parents('.dropdown').find('.dropdown-toggle').val(selText);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item mr-3">
                                <a class="nav-link active" id="pills-produk-tab" data-toggle="tab" href="#pills-produk"
                                    role="tab" aria-controls="pills-produk" aria-selected="true"
                                    style="border-radius:10px 10px 0px 0px;">
                                    <i class="fa fa-star mr-2"></i>Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tempat-percetakan-tab" data-toggle="tab"
                                    href="#pills-tempat-percetakan" role="tab" aria-controls="pills-tempat-percetakan"
                                    aria-selected="false" style="border-radius:10px 10px 0px 0px;">
                                    <i class="fa fa-home mr-2"></i>Tempat Percetakan</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-produk" role="tabpanel"
                                aria-labelledby="pills-produk-tab">
                                <div class="my-custom-scrollbar">

                                    <div class="row justify-content-between mb-4">
                                                
                                        {{-- @foreach ($collection as $item) --}}
                                            <div class="col-6 mb-4">
                                                <div class="col mb-4">
                                                    @include('card_produk')
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
                                            <div class="col-6 mb-4">
                                                <div class="col mb-4">
                                                    @include('card_percetakan')
                                                </div>
                                            </div>
                                        {{-- @endforeach --}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <script type="text/javascript">
                        $(function () {
                            $('#pills-produk li:first-child a').tab('show') // Select first tab
                            $('#pills-tempat-percetakan li:last-child a').tab('show') // Select last tab
                        })
                    </script> --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection