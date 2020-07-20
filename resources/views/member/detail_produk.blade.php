<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="mt-5 mb-5">
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
        <div class="row justify-content-between">
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
            <div class="my-custom-scrollbar-2 col-8 mt-5 ml-0 pl-4 pr-4">
                @include('member.card_detail_produk')
            </div>
        </div>
    </div>
@endsection
