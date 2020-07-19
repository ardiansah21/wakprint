<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="pt-5 pb-5 ml-0">
    <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Ulasan') }}</h1>
    <div class="row justify-content-left ml-1">
        <label class="font-weight-bold mr-5" style="font-size: 24px;">{{__('Toko Bang Ali') }}</label>
        <i class="material-icons md-32 mr-2" style="color:#FCFF82;">star</i>
        <label class="SemiBold mt-0"
        style="font-size: 20px;">
            {{__('3.5 / 5') }}
        </label>
        <i class="material-icons md-32 ml-4">forward</i>
    </div>
    <div class="dropdown mb-4 ml-1">
        <button class="btn btn-default shadow-sm dropdown-toggle border border-gray"
            id="dropdownMenuButton"
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false"
            style="font-size: 18px;">
            {{__('Urutkan') }}
        </button>
        <div class="dropdown-menu"
        style="font-size: 18px;"
        aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">{{__('Rating Tertinggi ke Terendah') }}</a>
            <a class="dropdown-item" href="#">{{__('Rating Terendah ke Tertinggi') }}</a>
        </div>
    </div>

    <div class="my-custom-scrollbar pr-4">

        {{-- @foreach ($collection as $item) --}}
            @include('member.card_ulasan_produk')
        {{-- @endforeach --}}

    </div>
</div>
@endsection
