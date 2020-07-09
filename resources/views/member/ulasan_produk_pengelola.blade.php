<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
<div class="container-fluid" style="margin-top: 72px;">
    <div class="container pt-5 pb-5">
        <h1 class="font-weight-bold ml-0 mb-5">Ulasan</h1>
        <div class="row justify-content-left ml-1">
            <p class="font-weight-bold mr-5">Toko Bang Ali</p>
            <p class="font-weight-bold"><i class="material-icons align-middle mr-2" style="color:#FCFF82;">star</i>3.5 / 5
                <i class="material-icons align-middle ml-4">forward</i></p>
        </div>

        <div class="container mb-4" style="margin-left: -10px;">
            <div class="dropdown">
                <button class="btn btn-default shadow-sm dropdown-toggle border border-gray" type="button"
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Urutkan
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Rating Tertinggi ke Terendah</a>
                    <a class="dropdown-item" href="#">Rating Terendah ke Tertinggi</a>
                </div>
            </div>
        </div>

        <div class="container my-custom-scrollbar" style="margin-left: -10px;">

            {{-- @foreach ($collection as $item) --}}
                @include('card_ulasan_produk')
            {{-- @endforeach --}}

        </div>

    </div>
</div>
@endsection

@section('footer')
    @include('member.footer_member')
@endsection
