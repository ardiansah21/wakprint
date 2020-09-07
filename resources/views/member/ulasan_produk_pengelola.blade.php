<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container pt-5 pb-5">
    <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Ulasan') }}</h1>
    <div class="row justify-content-left ml-1">
        {{-- @foreach($produk as $p) --}}
            {{-- @if ($p->id_pengelola === $partner->id_pengelola) --}}
                <label class="font-weight-bold mr-5" style="font-size: 24px;">{{$partner->nama_toko}}</label>
                <i class="material-icons md-32 mr-2" style="color:#FCFF82;">star</i>
                <label class="SemiBold mt-0"
                style="font-size: 20px;">
                    {{$partner->rating_toko}} / 5
                </label>
                <i class="material-icons md-32 ml-4">forward</i>
            {{-- @endif --}}
        {{-- @endforeach --}}
    </div>
    @php
    $urutkanRating = array(
        'Rating Tertinggi ke Terendah',
        'Rating Terendah ke Tertinggi'
        );
    @endphp
    <div class="dropdown" aria-required="true">
        <input name="keyword_urutkan_rating" type="text" id="keyword_urutkan_rating" Class="form-control"
        {{-- @php
                if (session()->has('keyword_jenis_transaksi')) {
                    echo "value = '".session('keyword_jenis_transaksi')."' autofocus onfocus='this.value = this.value;'";
                }
            @endphp --}}
        hidden>
        <button id="urutkanRatingButton" class="is-flex btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray mb-4 ml-0"
            id="dropdownUrutkanRating" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
            {{__('Urutkan')}}
        </button>
        <div id="urutkanRatingList" class="dropdown-menu" aria-labelledby="dropdownUrutkanRating"
            style="font-size: 16px;">
            @foreach ($urutkanRating as $ur)
                <span class="dropdown-item cursor-pointer">
                    {{$ur}}
                </span>
            @endforeach
        </div>
    </div>
    <div class="my-custom-scrollbar pr-4">
        {{-- @foreach ($collection as $item) --}}
            @include('member.card_ulasan_produk')
        {{-- @endforeach --}}
    </div>
</div>
@endsection
@section('script')
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
        $('#urutkanRatingList span').on('click', function () {
            $('#urutkanRatingButton').text($(this).text());
            $('#keyword_urutkan_rating').val($(this).text());
            // event.preventDefault();
            // document.getElementById('filter-form').submit();
        });
        // $('#jenisDanaList span').on('select', function () {
        //     $('#jenisdata').window.location.href = {{ route('partner.filter.riwayat') }}
        // });
    </script>
@endsection
