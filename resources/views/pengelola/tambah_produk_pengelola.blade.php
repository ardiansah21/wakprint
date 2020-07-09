<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid" style="margin-top:100px;">
        <div class="container">
            <div class="row justify-content-between">
                <h1 class="font-weight-bold mb-5 mt-5" style="margin-left: 10px;">Tambah Produk</h1>
                <!-- Rounded switch -->
                <label class="switch mb-5 mt-5 mr-4">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            
            <p class="mb-2">Foto Tempat Percetakan</p>
    
            {{-- <div class="scrolling-wrapper"> --}}
                <div class="row justify-content-left mb-2">
                    <div class="col-auto">
                        <div class="row justify-content-left">
                            <div class="col-auto">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive bg-light" style="width:250px; height:200px; border-radius:10px;">
                                <div class="container mb-3">
                                    <button type="button" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4 mb-0" style="position: absolute;
                                    bottom: 30px;
                                    right: 35px;
                                    border-radius:30px;">Pilih Foto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto align-self-center mb-3">
                        <button class="btn btn-circle shadow-sm" role="button"><i class="material-icons md-36 align-middle" style="color: white; margin-left:-6px;">add</i></button>
                    </div>
                    
                </div>
            {{-- </div> --}}
            
                <label class="mb-2">Nama Produk</label>
                <div class="input-group mb-4">
                    <input type="text" class="form-control form-control-lg mr-0" placeholder="Masukkan Nama Produk" 
                    aria-label="Masukkan Nama Produk" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="row justify-content-between">
                    <div class="col-6">
                        <label class="mb-2">Harga Produk</label>
                        <div class="row justify-content-left mb-2">
                            <label class="col-1 mt-1 mb-2">Rp</label>
                            <div class="col-9 input-group mb-4" style="margin-left:-0px;">
                                <input type="text" class="form-control form-control-lg" placeholder="Masukkan Harga Produk" 
                                aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <label class="col-1 mt-0 mb-2">/ Lembar</label>
                        </div>
                    </div>
    
                    <div class="col-6">
                        <p class="mb-2">Harga Produk (Timbal Balik)</p>
                        <div class="row justify-content-left mb-2">
                            <p class="col-1 mt-1 mb-2">Rp</p>
                            <div class="col-9 input-group mb-4" style="margin-left:-15px;">
                                <input type="text" class="form-control form-control-lg pt-2 pb-2" placeholder="Masukkan Harga Produk (Timbal Balik)" 
                                aria-label="Masukkan Harga Produk (Timbal Balik)" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <p class="col-1 mt-0 mb-2">/ Halaman</p>
                        </div>
                        
                    </div>
                </div>
                <label class="mb-2">Deskripsi Produk</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" aria-label="Deskripsi Produk"></textarea>
                </div>
    
                <p class="mb-3">Fitur Utama</p>
                <div class="row justify-content-between mb-4">
    
                    <div class="col-4" style="margin-left:0px;">
                        <label class="font-weight-bold mb-2">Kertas</label>
                        <div class="dropdown" style="margin-left:0px;">
                            <button class="btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            >
                                Jenis Random
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">A4</a>
                                <a class="dropdown-item" href="#">A3</a>
                                <a class="dropdown-item" href="#">Quarto</a>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-4" style="margin-left:0px;">
                        <label class="font-weight-bold mb-2">Printer</label>
                        <div class="dropdown" style="margin-left:0px;">
                            <button class="btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            >
                                Ink Jet
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Ink Jet</a>
                                <a class="dropdown-item" href="#">Laser Jet</a>
                                <a class="dropdown-item" href="#">Turbo</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <label class="font-weight-bold mb-2">Warna Cetak</label>
                        <div class="row justify-content-left mb-2">
                            
                            <div class="custom-control custom-checkbox mt-2 ml-3">
                                <input type="checkbox" class="custom-control-input" id="checkboxHitamPutih">
                                <label class="custom-control-label" for="checkboxHitamPutih">Hitam-Putih</label>
                            </div>
    
                            <div class="custom-control custom-checkbox mt-2 ml-4">
                                <input type="checkbox" class="custom-control-input" id="checkboxWarna">
                                <label class="custom-control-label" for="checkboxWarna">Berwarna</label>
                            </div>
                        </div>
                    </div>
                </div>
    
                <p class="mb-3">Paket Produk</p>
    
                {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-left mb-4 ml-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkboxJilid">
                            <label class="custom-control-label" for="checkboxJilid">Jilid <i class="material-icons md-18 align-middle">help</i></label>
                        </div>
                    </div>

                    {{-- @foreach ($collection as $item) --}}
                        <div class="row justify-content-between mb-4 ml-2">
                            <div class="col-6 custom-control custom-checkbox ml-3">
                                <input type="checkbox" class="custom-control-input" id="checkboxLem">
                                <label class="custom-control-label" for="checkboxLem">Lem <i class="material-icons md-18 align-middle">help</i></label>
                            </div>
                            
                            <label class="col-auto mt-1 mb-2">Rp</label>
                            <div class="col-5" style="">
                                <input type="text" class="form-control pt-2 pb-2" placeholder="3.000" 
                                aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="row justify-content-between mb-4 ml-2">
                            <div class="col-6 custom-control custom-checkbox ml-3">
                                <input type="checkbox" class="custom-control-input" id="checkboxSpiralKawat">
                                <label class="custom-control-label" for="checkboxSpiralKawat">Spiral Kawat <i class="material-icons md-18 align-middle">help</i></label>
                            </div>
                            
                            <label class="col-auto mt-1 mb-2">Rp</label>
                            <div class="col-5" style="">
                                <input type="text" class="form-control pt-2 pb-2" placeholder="3.000" 
                                aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                    {{-- @endforeach --}}
        
                   
                {{-- @endforeach --}}
    
                <p class="mb-3">Paket Non-Produk</p>
    
                {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mb-4 ml-0">
                        <div class="col-6 custom-control custom-checkbox ml-0">
                            <input type="checkbox" class="custom-control-input" id="checkboxLaminating">
                            <label class="custom-control-label" for="checkboxLaminating">Laminating <i class="material-icons md-18 align-middle">help</i></label>
                        </div>
                        
                        <label class="col-auto mt-1 mb-2 mr-0">Rp</label>
                        <div class="col-5" style="">
                            <input type="text" class="form-control pt-2 pb-2" placeholder="3.000" 
                            aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                {{-- @endforeach --}}

            <div>
                <label class="mb-4 ml-0 mt-2">Paket Tambahan Anda</label>
                <div class="row justify-content-between mb-2">
                    <div class="col-2">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive bg-light" style="width:170px; height:170px; border-radius:10px;">
                        <a href="{{url('pengelola/produk/tambah')}}" style="color: black;
                        position: absolute;
                        bottom: 40px;
                        right: 5px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;">edit</i>
                        </a>
                    </div>
        
                    <div class="col-9">
                        <div class="row justify-content-between">
                            <div class="col input-group mb-3">
                                <input type="text" class="form-control form-control-lg pt-2 pb-2" placeholder="Laminating" 
                                aria-label="Laminating" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="col-5 input-group mb-3" style="margin-left:-5px;">
                                Rp &nbsp;<input type="text" class="form-control form-control-lg pt-2 pb-2" placeholder="3.000" 
                                aria-label="3.000" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
        
                        <p class="mb-2">Deskripsi Fitur</p>
                        <div class="input-group mb-4">
                            <textarea class="form-control" aria-label="Deskripsi Fitur"></textarea>
                        </div>
        
                    </div>
                    
                    <div class="col-1 align-self-center text-right">
                        <span class="mb-3">
                            <button class="btn btn-circle shadow-sm" role="button"><i class="material-icons md-36 align-middle" style="color: white; margin-left:-7px;">add</i></button>
                        </span>
                    </div>
                    
                </div>
            </div>
    
            <div class="row mb-5 ml-0">
                    <div class="col-11 bg-light-purple pl-4 pr-4 pt-2 pb-2" style="border-radius:10px;">

                        {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between">
                                <p class="mb-0 ml-2 mt-2">Tulang Kliping Warna</p>
                                <p class="mb-0 ml-2 mt-2">Rp. 500</p>
                            </div>
                        {{-- @endforeach --}}

                    </div>
    
                    <div class="col-auto pt-2 pb-2">

                        {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between mt-2">
                                <i class="material-icons align-middle ml-2">edit</i>
                                <i class="material-icons align-middle text-primary-danger ml-2">delete</i>
                            </div>
                        {{-- @endforeach --}}
                        
                    </div>
            </div>
    
            <div class="row justify-content-between mr-0 mb-5">
                            
                <div class="col text-right">
                    <div class="mb-3">
                        <button type="button" class="btn btn-default btn-lg text-primary-danger font-weight-bold pl-5 pr-5 mb-0" 
                        onclick="window.location='{{ url('/pengelola/kelola-produk') }}'"
                        style="border-radius:30px;">Batalkan Perubahan</button>
                    </div>
                </div>
    
                <div class="col-auto text-right">
                    <div class="mb-3">
                        <button type="button" class="btn btn-lg btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                        onclick="window.location='{{ url('/pengelola/kelola-produk') }}'"
                        style="border-radius:30px;">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
