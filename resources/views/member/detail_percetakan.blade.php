<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container">
            <div class="container mb-5" style="margin-top:120px;">
                <div class="row justify-content-between mb-2">
                    <h1 class="font-weight-bold">Percetakan IMAHA Productions</h1>
                    <img src="{{url('buka.png')}}" class="align-middle img-responsive mr-0" alt="" width="100px" height="50px">
                </div>
    
                <h4 class="mb-4" style="margin-left:-20px;"><i class="material-icons md-32 align-middle mr-2">location_on</i>Jalan Seksama No 95A Medan Denai, Medan, Sumatera Utara</h4>
                
                <div class="row justify-content-left mb-0" style="margin-left:-15px;">
                    <p class="mr-4"><i class="material-icons align-middle mr-2" style="color:#FCFF82;">star</i>3.5 / 5</p>

                    {{-- @foreach ($collection as $item) --}}
                        <label class="mr-4"><i class="align-middle material-icons mr-1">directions_run</i>Ambil di Tempat</label>
                        <label class="mr-4"><i class="align-middle material-icons mr-1">local_shipping</i>Antar ke Rumah</label>
                        <label class=""><i class="align-middle material-icons mr-1">architecture</i>Alat Tulis Kantor</label>
                    {{-- @endforeach --}}
                    
                </div>
    
                <div class="row justify-content-between">
    
                    <div class="container bg-light-purple col-4 p-3 mt-5 mr-0 ml-0" style="border-radius:10px;">
                            
                            <div class="container text-center mb-4" style="position:relative;">
                                <img class="img-responsive" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                alt="" style="width:300px;">
                            </div>

                            <div class="row justify-content-left mb-5" style="margin-left:0px;">
                                <span class="align-self-center col-1 mr-0">
                                    <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button" data-slide="prev"><i class="material-icons md-32">chevron_left</i></a>
                                </span>

                                    <!--Carousel Wrapper-->
                                <div id="multi-item-foto-percetakan" class="carousel slide carousel-multi-item col-9" data-ride="carousel">

                                    <!--Slides-->
                                    <div class="carousel-inner" role="listbox">

                                        {{-- @foreach ($collection as $item) --}}
                                            <div class="carousel-item active">

                                                <div class="row">

                                                    {{-- @foreach ($collection as $item) --}}
                                                        <div class="container col mr-0">
                                                            <img class="img-responsive" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                            alt="" style="width:56px; height:56px;">
                                                        </div>
                                                    {{-- @endforeach --}}

                                                </div>
                                            </div>
                                        {{-- @endforeach --}}

                                    </div>
                                    <!--/.Slides-->

                                </div>
                                <!--/.Carousel Wrapper-->

                                <span class="align-self-center">
                                    <a class="text-primary-purple" href="#multi-item-foto-percetakan" role="button" data-slide="next"><i class="material-icons md-32">chevron_right</i></a>
                                </span>
                            </div>
                            
                            <div class="container">
                                <p class="font-weight-bold mb-2">Pemilik Percetakan</p>
                                <label class="text-truncate mb-4" style="width: 300px;"><img class="img-responsive align-self-center mr-2" src="https://ptetutorials.com/images/user-profile.png" width="32" height="32" alt="no logo">Mohammed Salahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</label>
                                <p class="font-weight-bold mb-2">Deskripsi Percetakan</p>
                                <p class="mb-4">
                                Percetakan IMAHA Productions adalah akun resmi dari Percetakan IMAHA Productions di Wakprint. 
                                Kami juga menyediakan beberapa layanan percetakan seperti mencetak dokumen lengkap dengan paket penjIlidan dan paket tambahan lainnya.
                                </p>
            
                                <p class="font-weight-bold mb-2">Jam Operasional Percetakan</p>
                                <p class="mb-4"><i class="material-icons md-18 align-middle mr-3">fiber_manual_record</i>Pukul 08:00 - 19:00 WIB</p>
            
                                <p class="font-weight-bold mb-2">Syarat & Ketentuan Percetakan</p>
                                <div class="row justify-content-left mb-2">
                                    <i class="col-1 material-icons md-18 mr-1 mt-1">fiber_manual_record</i>
                                    <p class="col-10 mb-2">Membayar pembayar melalui saldo tunai kamu secara penuh</p>
                                </div>
                                
                                <p class="font-weight-bold mb-2">ATK</p>

                                {{-- @foreach ($collection as $item) --}}
                                    <div class="row justify-content-between">
                                        <div class="container col text-left">
                                            <p class="mb-2">Pensil <i class="material-icons md-18 align-middle ml-2 mr-4">help</i>x 34</p>
                                        </div>
                                        <div class="container col text-right">
                                            <p class="mb-2">Rp. 2.000</p>
                                        </div>
                                    </div>
                                {{-- @endforeach --}}

                            </div>
                            
                    </div>
                        
                    <div class="container col mt-5">
                        <div class="input-group mb-3 ml-3 mr-3" role="search">
                            <input type="text" class="form-control form-control-lg shadow-sm" placeholder="Cari produk disini" 
                            aria-label="Cari produk disini" aria-describedby="basic-addon2" style="border-radius:30px;">
                            <i class="material-icons md-32 ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                            top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                search
                            </i>    
                        </div>
    
                        <div class="row mb-4 ml-0">
                            <div class="container col-auto">
                                <div class="container mb-4" style="margin-left:-20px;">
                                    <button type="button" class="btn btn-primary-yellow pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center" style="border-radius:30px">Semua</button>
                                </div>
                                <div class="dropdown" style="margin-left:-5px;">
                                    <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Urutkan
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Terbaru</a>
                                        <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                        <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                    </div>
                                </div>
                            </div>
    
                            <div class="container col-9 ml-2">
                            
                                <div class="scrolling-wrapper mb-4" style="margin-top:-10px;">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                        {{-- @foreach ($collection as $item) --}}
                                            <label id="a4" class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4" style="border-radius:30px;">
                                                <input type="checkbox" checked autocomplete="off">A4
                                            </label>
                                        {{-- @endforeach --}}

                                    </div>
                                </div>
    
                                <div class="scrolling-wrapper" style="margin-top:-10px;">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                        {{-- @foreach ($collection as $item) --}}
                                            <label id="a4" class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4" style="border-radius:30px;">
                                                <input type="checkbox" checked autocomplete="off">Ink Jet
                                            </label>
                                        {{-- @endforeach --}}
                                        
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
    
                        <div class="container bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4 ml-3" style="border-radius:5px;">
                            <label class="font-weight-bold mb-3 ml-0">Paket</label><br>
                            <div class="container">

                                {{-- @foreach ($collection as $item) --}}
                                    <label class="font-weight-bold mb-3 ml-0">Jilid</label>
                                    <div class="row justify-content-left" style="margin-left:-5px; margin-top:-15px;">
                                        
                                        {{-- @foreach ($collection as $item) --}}
                                            <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                                <input type="checkbox" class="custom-control-input" id="checkboxJilid">
                                                <label class="custom-control-label" for="checkboxJilid">Jilid <i class="material-icons md-18 align-middle ml-2">help</i></label>
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
                                        <label class="custom-control-label" for="checkboxLakban">Jilid Lakban <i class="material-icons md-18 align-middle ml-2">help</i></label>
                                    </div>
                                {{-- @endforeach --}}

                            </div>
                            
                        </div>
    
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection

