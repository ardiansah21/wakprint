<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="pt-4 pb-5 ml-0">
        <h1 class="font-weight-bold mb-0" style="font-size: 48px;">{{__('Ulasan Saya') }}</h1>
        <label class="mb-2" style="font-size: 18px;">{{__('Detail produk yang telah Anda ulas') }}</label>

        {{-- @foreach ($collection as $item) --}}
        <div class="row mt-5">
            <div class="col-md-3">
                @include('member.card_produk')
            </div>
            <div class="col-md-9">
                <div class="row mb-5">
                    <div class="col-md-9 ml-0 my-auto">
                        <h5 style="font-size: 24px; color:#BABABA">{{__('Dipesan pada: 21 Februari 2020, 20:35 WIB') }}</h5>
                    </div>
                    <div class="col-md-3 align-self-right">
                        <button class="btn btn-primary-yellow btn-sm btn-block SemiBold"
                            style="border-radius:30px; font-size:24px;">{{__('Pesan Lagi') }}</button>
                    </div>
                </div>
                <div class="row justify-content-left ml-0 mb-4">
                    <div style="color:#FCFF82;">
                        <span class="material-icons md-60">star</span>
                        <span class="material-icons md-60">star</span>
                        <span class="material-icons md-60">star</span>
                        <span class="material-icons md-60">star</span>
                        <span class="material-icons md-60">star</span>
                    </div>
                    <label class="my-auto ml-4" style="font-size: 36px;">{{__('Senang') }}</label>
                </div>

                <div class="row ml-0 mb-3">
                    <div class="col-md-2">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                            class="img-responsive justify-content-center align-self-center center-block" alt=""
                            width="141px" height="141px" style="border-radius:8px 8px 8px 8px;">
                    </div>
                    <div class="col-md-10">
                        <div class="card ml-5" style="height:232px;">
                            <p class="card-text text-truncate mb-2 ml-4 mt-3" 
                            style="font-size: 18px;">
                            {{__('"Mantap sekali gannnn"') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}

    </div>
@endsection
