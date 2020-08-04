<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row justify-content-between">
            <div class="col-md-10">
                <label class="text-break font-weight-bold"
                    style="font-size: 48px; max-width:90%;">
                    {{__('Percetakan IMAHA Productions') }}
                </label>
            </div>
            <div class="col-md-auto">
                <img src="{{url('img/buka.png')}}"
                    class="img-responsive mr-0"
                    alt=""
                    width="130px"
                    height="60px">
            </div>
        </div>
        <label class="text-break mb-4" style="font-size:24px;">
            <i class="material-icons md-32 align-middle mr-2">
                location_on
            </i>
            {{__('Jalan Seksama No 95A Medan Denai, Medan, Sumatera Utara') }}
        </label>
        <div class="row justify-content-left ml-0 mb-0">
            <label class="SemiBold mr-4" style="font-size: 24px;">
                <i class="material-icons md-32 align-middle mr-2"
                    style="color:#FCFF82;">
                    star
                </i>
                {{__('3.5 / 5')}}
            </label>

            {{-- @foreach ($collection as $item) --}}
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-1">
                        directions_run
                    </i>
                    {{__('Ambil di Tempat')}}
                </label>
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-2">
                        local_shipping
                    </i>
                    {{__('Antar ke Rumah')}}
                </label>
                <label class="mr-4" style="font-size: 18px;">
                    <i class="align-middle material-icons md-32 mr-2">
                        architecture
                    </i>
                    {{__('Alat Tulis Kantor')}}
                </label>
            {{-- @endforeach --}}
            
        </div>
        <div class="row justify-content-between ml-0 mr-0">
            <div class="bg-light-purple col-md-4 p-3 mt-5"
                style="border-radius:10px;">
                <div class="text-center mb-4"
                style="position:relative;">
                <img class="img-responsive"
                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                    alt=""
                    style="width:300px;
                        height:200px;">
                </div>
                <div class="row justify-content-left mb-5">
                    <span class="align-self-center col-md-1 mr-0">
                        <a class="text-primary-purple"
                            href="#multi-item-foto-percetakan"
                            role="button"
                            data-slide="prev">
                            <i class="material-icons md-32">
                                chevron_left
                            </i>
                        </a>
                    </span>

                        <!--Carousel Wrapper-->
                    <div id="multi-item-foto-percetakan" class="carousel slide carousel-multi-item col-md-9" data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            {{-- @foreach ($collection as $item) --}}
                                <div class="carousel-item active">

                                    <div class="row">

                                        {{-- @foreach ($collection as $item) --}}
                                            <div class="col-md-auto mr-0">
                                                <img class="img-responsive" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                alt="" style="width:60px; height:60px;">
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
                        <a class="text-primary-purple"
                            href="#multi-item-foto-percetakan"
                            role="button"
                            data-slide="next">
                            <i class="material-icons md-32">
                                chevron_right
                            </i>
                        </a>
                    </span>
                </div>
                <div class="container">
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Pemilik Percetakan')}}
                    </label>
                    <label class="text-truncate mb-4"
                        style="width: 100%;
                            font-size: 18px;">
                        <img class="img-responsive align-self-center mr-2"
                            src="https://ptetutorials.com/images/user-profile.png"
                            width="40"
                            height="40"
                            alt="no logo">
                            {{__('Mohammed Salahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh')}}
                        </label>
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Deskripsi Percetakan')}}
                    </label>
                    <label class="mb-4"
                        style="font-size: 14px;">
                        {{__('Percetakan IMAHA Productions adalah akun resmi dari Percetakan IMAHA Productions di Wakprint. 
                        Kami juga menyediakan beberapa layanan percetakan seperti mencetak dokumen lengkap dengan paket penjIlidan dan paket tambahan lainnya.')}}
                    </label>
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Jam Operasional Percetakan')}}
                    </label>
                    <label class="mb-4"
                        style="font-size: 14px;">
                        <i class="material-icons md-12 align-middle mr-3">
                            fiber_manual_record
                        </i>
                        {{__('Pukul 08:00 - 19:00 WIB')}}
                    </label>
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('Syarat & Ketentuan Percetakan')}}
                    </label>
                    <div class="row justify-content-left mb-2"
                        style="font-size: 14px;">
                        <i class="col-md-1 material-icons md-12 mr-1 mt-1">
                            fiber_manual_record
                        </i>
                        <label class="col-md-10 mb-2"
                            style="font-size: 14px;">
                            {{__('Membayar pembayar melalui saldo tunai kamu secara penuh')}}
                        </label>
                    </div>
                    
                    <label class="SemiBold mb-2"
                        style="font-size: 18px;">
                        {{__('ATK')}}
                    </label>

                    {{-- @foreach ($collection as $item) --}}
                        <div class="row justify-content-between" style="font-size: 14px;">
                            <div class="col-md-auto text-left">
                                <label class="mb-2">
                                    {{__('Pensil')}} 
                                    <i class="material-icons md-18 align-middle ml-2 mr-4"
                                    style="color:#C4C4C4">
                                        help
                                    </i>
                                    {{__('x 34')}}
                                </label>
                            </div>
                            <div class="col-md-auto text-right">
                                <label class="mb-2">
                                    {{__('Rp. 2.000')}}
                                </label>
                            </div>
                        </div>
                    {{-- @endforeach --}}

                </div>
            </div>
            <div class="col-md-8 mt-5">
                <div class="search-input mr-0 ml-3 mb-4">
                    <div class="main-search-input-item mr-0">
                        <input type="text"
                            role="search"
                            class="form-control"
                            placeholder="Cari produk disini"
                            aria-label="Cari produk disini"
                            aria-describedby="basic-addon2"
                            style="border:0px solid white;
                                border-radius:30px;
                                font-size:18px;">
                            <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                            style="position: absolute;
                                top: 50%; left: 95%;
                                transform: translate(-50%, -50%);
                                -ms-transform:
                                translate(-50%, -50%);">
                                search
                            </i>
                    </div>
                </div>

                <div class="row justify-content-between mb-4 ml-0">
                    <div class="col-md-3">
                        <div class="btn-group btn-group-toggle mb-4"
                            data-toggle="buttons">
                            <label id="semua"
                                class="btn btn-yellow-wakprint btn-outline-black mr-1 pt-1 pb-1 pl-4 pr-4" 
                                style="border-radius:30px;
                                    font-size:18px;">
                                <input type="checkbox"
                                    checked
                                    autocomplete="off">
                                    {{__('Semua')}}
                            </label>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                                id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                style="font-size:18px;">
                                {{__('Urutkan')}}
                            </button>
                            <div class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton"
                                style="font-size:18px;">
                                <a class="dropdown-item"
                                    href="#">
                                    {{__('Terbaru')}}
                                </a>
                                <a class="dropdown-item"
                                    href="#">
                                    {{__('Tinggi ke Rendah')}}
                                </a>
                                <a class="dropdown-item"
                                    href="#">
                                    {{__('Rendah ke Tinggi')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="scrolling-wrapper mb-2">
                            <div class="btn-group btn-group-toggle pt-0"
                                data-toggle="buttons">

                                {{-- @foreach ($collection as $item) --}}
                                    <label id="a4"
                                        class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4"
                                        style="border-radius:30px;
                                            font-size:18px;">
                                        <input type="checkbox"
                                            checked
                                            autocomplete="off">
                                            {{__('A4')}}
                                    </label>
                                {{-- @endforeach --}}

                            </div>
                        </div>
                        <div class="scrolling-wrapper">
                            <div class="btn-group btn-group-toggle"
                                data-toggle="buttons">

                                {{-- @foreach ($collection as $item) --}}
                                    <label id="a4"
                                        class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4"
                                        style="border-radius:30px;
                                            font-size:18px;">
                                        <input type="checkbox"
                                            checked
                                            autocomplete="off">
                                            {{__('Ink Jet')}}
                                    </label>
                                {{-- @endforeach --}}
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4 ml-3"
                    style="border-radius:5px;">
                    <label class="SemiBold mb-3 ml-0"
                        style="font-size: 18px;">
                        {{__('Paket')}}
                    </label>
                    <br>
                    <div class="container"
                        style="font-size: 14px;">

                        {{-- @foreach ($collection as $item) --}}
                            <label class="SemiBold mb-2 ml-0">
                                {{__('Jilid')}}
                            </label>
                            <div class="row justify-content-left ml-0">
                                
                                {{-- @foreach ($collection as $item) --}}
                                    <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="checkboxJilid">
                                        <label class="custom-control-label"
                                            for="checkboxJilid">
                                            {{__('Jilid')}} 
                                            <i class="material-icons md-18 align-middle ml-2"
                                                style="color:#C4C4C4">
                                                help
                                            </i>
                                        </label>
                                    </div>
                                {{-- @endforeach --}}

                            </div>
                        {{-- @endforeach --}}
                        
                    </div>
                    <label class="SemiBold mt-3 mb-2 ml-0"
                        style="font-size: 18px;">
                        {{__('Non-Paket')}}
                    </label>
                    <div class="row justify-content-left ml-0"
                        style="font-size: 14px;">

                        {{-- @foreach ($collection as $item) --}}
                            <div class="custom-control custom-checkbox mt-2 ml-1 mr-4">
                                <input type="checkbox"
                                    class="custom-control-input"
                                    id="checkboxLakban">
                                <label class="custom-control-label"
                                    for="checkboxLakban">
                                    {{__('Jilid Lakban')}} 
                                    <i class="material-icons md-18 align-middle ml-2"
                                    style="color:#C4C4C4">
                                        help
                                    </i>
                                </label>
                            </div>
                        {{-- @endforeach --}}

                    </div>
                    
                </div>

                <div class="my-custom-scrollbar">
                    <div class="row justify-content-between mb-4">
                                        
                        {{-- @foreach ($collection as $item) --}}
                            <div class="col-md-6 mb-4">
                                <div class="col-md-auto mb-4">
                                    @include('member.card_produk')
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="col-md-auto mb-4">
                                    @include('member.card_produk')
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="col-md-auto mb-4">
                                    @include('member.card_produk')
                                </div>
                            </div>
                        {{-- @endforeach --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

