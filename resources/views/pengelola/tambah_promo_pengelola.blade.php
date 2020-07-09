<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:120px;">
            
            <h1 class="font-weight-bold mb-5 mt-5">Tambah Promo</h1>
            
            <label class="mb-2">Pilih Produk untuk Diberi Promo</label>
    
            <div class="container mb-5">
                <div class="input-group mb-3" role="search">
                    <input type="text" class="form-control form-control-lg pl-4 pr-4 pt-2 pb-2" placeholder="Cari Nama Produk" 
                    aria-label="Cari Nama Produk" aria-describedby="basic-addon2" style="border-radius:30px; margin-left:-20px;">
                    <i class="material-icons md-32 ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                    top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                        search
                    </i>
                </div>
            </div>
    
            <div class="container mb-0">
    
                    <div class="row justify-content-between">
                        
                        <span class="justify-content-center align-self-center col-auto">
                            <a class="btn btn-circle-navigation-left btn-xl shadow-sm" href="#multi-item-promo-produk" role="button" data-slide="prev"><img src="{{url('arrow-left.png')}}"></a>
                        </span>
                        
    
                        <!--Carousel Wrapper-->
                        <div id="multi-item-promo-produk" class="carousel slide carousel-multi-item col-md-10" data-ride="carousel">
    
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
    
                                {{-- @foreach ($collection as $item) --}}
                                    <div class="carousel-item active">
                                        <div class="row">

                                            {{-- @foreach ($collection as $item) --}}
                                                <div class="col-4">
                                                    @include('card_produk_pengelola')
                                                </div>
                                            {{-- @endforeach --}}
                                            
                                        </div>
                                    </div>
                                {{-- @endforeach --}}
    
                            </div>
                            <!--/.Slides-->
    
                        </div>
                        <!--/.Carousel Wrapper-->
                        
                        <span class="justify-content-center align-self-center col-auto">
                            <a class="btn btn-circle-navigation-left btn-xl shadow-sm" href="#multi-item-promo-produk" role="button" data-slide="next"><img class="ml-2" src="{{url('arrow-right.png')}}"></a>
                        </span>
                        
                    </div>
            </div>
            
            <div class="row mb-4" style="">
                <div class="container col">
                    <label class="mb-2">Maksimal Diskon</label>
                    <div class="row justify-content-between mb-2">
                        
                        <label class="col-auto text-center mb-0 mr-0 mt-2">Rp. </label>
                        <div class="col input-group mb-4">
                            <input type="text" class="form-control form-control-lg pt-2 pb-2" placeholder="300.000" 
                            aria-label="300.000" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        </div>
    
                        <p class="mb-2">Tanggal Promo Mulai</p>
                        <div class="row justify-content-left mb-3">
                            <div class="col-4">
                                <div class="dropdown">
                                    <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tanggal
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        
                                        {{-- @foreach ($collection as $item) --}}
                                            <a class="dropdown-item" href="#">1</a>
                                            <a class="dropdown-item" href="#">2</a>
                                            <a class="dropdown-item" href="#">3</a>
                                        {{-- @endforeach --}}
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-4">
                                <div class="dropdown" style="">
                                    <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Bulan
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        {{-- @foreach ($collection as $item) --}}
                                            <a class="dropdown-item" href="#">Januari</a>
                                            <a class="dropdown-item" href="#">Februari</a>
                                            <a class="dropdown-item" href="#">Maret</a>
                                        {{-- @endforeach --}}
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-4">
                                <div class="dropdown">
                                    <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tahun
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        
                                        {{-- @foreach ($collection as $item) --}}
                                            <a class="dropdown-item" href="#">2000</a>
                                            <a class="dropdown-item" href="#">2001</a>
                                            <a class="dropdown-item" href="#">2002</a>
                                        {{-- @endforeach --}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
    
                <div class="col">
                    <p class="mb-2">Jumlah Diskon</p>
                    <div class="row justify-content-left mb-2">
                        <div class="col-2 input-group mb-4">
                            <input type="text" class="form-control form-control-lg pt-2 pb-2" placeholder="10" 
                            aria-label="10" aria-describedby="inputGroup-sizing-sm" style="width:50px;">
                        </div>
                        <label class="col-auto text-left mb-0 mr-0 mt-2" style="margin-left:-20px;">%</label>
                    </div>
    
                    <p class="mb-2">Tanggal Promo Selesai</p>
                    <div class="row justify-content-left mb-3">
                        <div class="col-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tanggal
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item" href="#">1</a>
                                        <a class="dropdown-item" href="#">2</a>
                                        <a class="dropdown-item" href="#">3</a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="dropdown" style="">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Bulan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item" href="#">Januari</a>
                                        <a class="dropdown-item" href="#">Februari</a>
                                        <a class="dropdown-item" href="#">Maret</a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="dropdown">
                                <button class="btn btn-default btn-block btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tahun
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    
                                    {{-- @foreach ($collection as $item) --}}
                                        <a class="dropdown-item" href="#">2000</a>
                                        <a class="dropdown-item" href="#">2001</a>
                                        <a class="dropdown-item" href="#">2002</a>
                                    {{-- @endforeach --}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row justify-content-between">
                <div class="col text-right">
                    <div class="mb-3">
                        <button type="button" class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                        onclick="window.location='{{ url('/pengelola/kelola-promo') }}'"
                        style="border-radius:30px;">Batal</button>
                    </div>
                </div>
    
                <div class="col-auto text-right">
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                        onclick="window.location='{{ url('/pengelola/kelola-promo') }}'"
                        style="border-radius:30px;">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

