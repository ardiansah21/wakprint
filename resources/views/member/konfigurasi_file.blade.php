<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container mb-5" style="margin-top:120px;">
            <h1 class="font-weight-bold" style="margin-top:120px;">Konfigurasi File</h1>
            <div class="row justify-content-between mr-0 mb-5">
                <div class="col mt-5 mr-4">
                    <div class="border-primary-purple pl-2 pr-4 pt-4 pb-1 mb-4" style="height:500px;">
                        <div class="row bg-dark justify-content-between align-bottom p-4" style="margin-top:401px;
                            margin-left:-8px;
                            margin-right:-25px;
                            opacity:80%;
                            border-radius: 0px 0px 5px  5px;
                            ">
                            <h4 class="col font-weight-bold text-white" style="margin-left:-10px; margin-bottom:-5px;">Hitam
                                Putih</h4>
                            <h4 class="col text-right font-weight-bold text-white"
                                style="margin-left:-10px; margin-bottom:-5px;">
                                <i class="fa fa-chevron-left text-white mr-2"></i>
                                12 / 16
                                <i class="fa fa-chevron-right ml-2"></i>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col mt-5" style="margin-left:-20px;">
                    <div class="container bg-light-purple pl-2 pr-4 pt-4 pb-4 mb-4" style="border-radius:5px;">
                        <div class="row justify-content-between">
                            <div class="col border-primary-purple bg-light-purple ml-4" style="height:200px;">
                                <p class="text-center text-primary-purple text-wrap font-weight-bold mb-2"
                                    style="margin-top:75px; font-size:20px;">Letak Dokumen Disini</p>
                            </div>
                            <div class="container col">
                                <p class="text-justify mb-4 ml-2">Letak dokumen yang ingin kamu cetak disamping kiri atau
                                    klik tombol dibawah</p>
                                <div class="container text-center">
                                    <button type="button" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
                                        style="border-radius:30px"><i
                                            class="material-icons align-middle mr-2">cloud_upload</i>
                                        Unggah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-left mr-0 mb-3">
                <div class="container col">
                    <div class="input-group mb-3" role="search">
                        <input type="text" class="form-control form-control-lg pl-4 pr-4"
                            placeholder="Cari percetakan atau produk disini" style="border-radius:30px;">
                        <i class="material-icons md-32 ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute;
                                top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            search
                        </i>
                    </div>
                </div>
                <div class="container col-auto">
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Urutkan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Terbaru</a>
                            <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                            <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                        </div>
                    </div>
                </div>
                <div class="container col-auto">
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Printer
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            {{-- @foreach ($collection as $item) --}}
                                <a class="dropdown-item" href="#">Ink Jet</a>
                            {{-- @endforeach --}}

                        </div>
                    </div>
                </div>
                <div class="container col-auto">
                    <div class="dropdown">
                        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kertas
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            {{-- @foreach ($collection as $item) --}}
                                <a class="dropdown-item" href="#">A4</a>
                            {{-- @endforeach --}}

                        </div>
                    </div>
                </div>
            </div>

            <div class="container bg-light-purple pt-3 pb-3 pl-4 pr-4 mr-0 mb-4" style="border-radius:5px;">
                <label class="font-weight-bold mb-3 ml-0">Paket</label><br>
                <div class="container">

                    {{-- @foreach ($collection as $item) --}}
                    <label class="font-weight-bold mb-3 ml-0">Jilid</label>
                    <div class="row justify-content-left" style="margin-left:-5px; margin-top:-15px;">

                        {{-- @foreach ($collection as $item) --}}
                        <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                            <input type="checkbox" class="custom-control-input" id="checkboxJilid">
                            <label class="custom-control-label" for="checkboxJilid">Jilid <i
                                    class="material-icons md-18 align-middle ml-2">help</i></label>
                        </div>
                        {{-- @endforeach --}}

                    </div>
                    {{-- @endforeach --}}

                </div>

                <label class="font-weight-bold mt-3 mb-3 ml-0">Non-Paket</label>
                <div class="row justify-content-left" style="margin-left:-5px; margin-top:-15px;">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                        <input type="checkbox" class="custom-control-input" id="checkboxLakban">
                        <label class="custom-control-label" for="checkboxLakban">Jilid Lakban <i
                                class="material-icons md-18 align-middle ml-2">help</i></label>
                    </div>
                    {{-- @endforeach --}}

                </div>

            </div>

            <div class="container border-primary-purple my-custom-scrollbar-2 p-5" style="border-radius:5px;">
                <div class="row row-cols-3">

                    {{-- @foreach ($collection as $item) --}}
                        <div class="col mb-4">
                            @include('card_produk')
                        </div>
                    {{-- @endforeach --}}
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection
