<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container pt-5 pb-5">
    <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Ulasan') }}</h1>
    <div class="row justify-content-left ml-1">
        <label class="font-weight-bold mr-5 mb-4" style="font-size: 24px;">
            {{$produk->nama}}
        </label>
        <input id="idProduk" type="text" value="{{$produk->id_produk}}" hidden>
        <i class="material-icons md-32 mr-2" style="color:#FCFF82;">star</i>
        <label class="SemiBold mt-0" style="font-size: 20px;">
            @if($ratingProduk == 0.0)
                {{$produk->rating}} / 5
            @else
                {{$ratingProduk}} / 5
            @endif()
        </label>
        <a class="social-button ml-4" href="https://www.facebook.com/sharer/sharer.php?u=https://wakprint.com/ulasan/partner/{{ $produk->id_produk }}"
            style="color:black; text-decoration: none;">
                <i id="shareProduk" class="align-self-center material-icons md-32 cursor-pointer">
                    share
                </i>
        </a>
        {{-- <i class="material-icons md-32 cursor-pointer ml-4">share</i> --}}
    </div>
    @php
        $urutkanRating = array('Semua', 'Rating Tertinggi ke Terendah', 'Rating Terendah ke Tertinggi');
    @endphp
    <div class="dropdown" aria-required="true">
        <input name="keyword_urutkan_rating" type="text" id="keyword_urutkan_rating" Class="form-control" hidden>
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
                <input id="isiFilter" type="text" value="{{$ur}}" hidden>
            @endforeach
        </div>
    </div>
    <div class="ulasanProduk mb-5">
        @if (!empty($ulasan))
            @foreach ($ulasan as $u => $value)
                @include('member.card_ulasan_produk')
            @endforeach
        @endif
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

        var fotoUlasan = $('#fotoUlasan').val();
        var fotoMember = $('#fotoMember').val();
        var namaMember = $('#namaMember').val();

        function filter() {
                var data = {
                    idProduk: $('#idProduk').val(),
                    filterUrutkan: $('#isiFilter').val()
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('urutkan.ulasan-produk.partner',"data.idProduk") }}",
                    method: 'GET',
                    data: data,
                    dataType: 'json',

                    beforeSend: function() {
                        // $('.ulasanProduk').css('color', '#dfecf6');
                        $('.ulasanProduk').html(
                            '<div class="mx-auto" style="position:relative; left:40%;"><img id="imgLoading" style="" src="/img/loading.gif" /></div>'
                        );
                    },
                    uploadProgress: function() {
                        $('#imgLoading').show();
                    },
                    success: function(ulasan) {
                        if(ulasan['ulasan'] != null){
                            for (let i = 0; i < ulasan['ulasan'].length; i++) {
                                var ulasanItem = '<div class="card shadow-sm mb-3 pl-4 pr-4 pt-3 pb-3">';
                                    ulasanItem += '<div class="row justify-content-left ml-0 mr-0 mb-4">';
                                        ulasanItem += '<div class="col-md-auto my-auto ml-0 mr-0">';
                                            if (fotoMember != null) {
                                                ulasanItem += '<img src='+ fotoMember +' width="56" height="56" alt="no logo" style="object-fit: cover; border-radius: 30px; border:solid 2px #BC41BE;">';
                                            }
                                            else{
                                                ulasanItem += '<img src="https://ptetutorials.com/images/user-profile.png" width="56" height="56" alt="no logo" style="object-fit: cover; border-radius: 30px; border:solid 2px #BC41BE;">';
                                            }
                                        ulasanItem += '</div>';
                                        ulasanItem += '<div class="col-md-6">';
                                            ulasanItem += '<label class="text-truncate font-weight-bold mb-0" style="font-size: 18px;">';
                                                ulasanItem += namaMember;
                                            ulasanItem +='</label>';
                                            ulasanItem += '<br>';
                                            ulasanItem += '<label style="font-size: 12px;">';
                                                ulasanItem += moment(ulasan['ulasan'][i].waktu).format('DD MMM YYYY');
                                                ulasanItem +='</label>';
                                        ulasanItem +='</div>';
                                        ulasanItem += '<div class="col-md-5 row justify-content-end">';
                                            ulasanItem += '<label class="SemiBold" style="font-size: 18px;">';
                                                for (let j = 0; j <= ulasan['ulasan'][i].rating.length; j++) {
                                                    ulasanItem += '<i class="material-icons md-32 align-middle" style="color:#FCFF82;">star</i>';
                                                }
                                                if(ulasan['ulasan'][i].rating == 1.0){
                                                    ulasanItem += 'Sangat Buruk';
                                                }
                                                else if(ulasan['ulasan'][i].rating == 2.0){
                                                    ulasanItem += 'Buruk';
                                                }
                                                else if(ulasan['ulasan'][i].rating == 3.0){
                                                    ulasanItem += 'Lumayan';
                                                }
                                                else if(ulasan['ulasan'][i].rating == 4.0){
                                                    ulasanItem += 'Baik';
                                                }
                                                else{
                                                    ulasanItem += 'Sangat Baik';
                                                }
                                            ulasanItem += '</label>';
                                        ulasanItem +='</div>';
                                    ulasanItem += '</div>';
                                    ulasanItem += '<p class="mb-4" style="font-size: 18px;">';
                                        ulasanItem += ulasan['ulasan'][i].pesan;
                                    ulasanItem += '</p>';
                                    if(fotoUlasan != ""){
                                        ulasanItem += '<a data-fancybox="gallery"';
                                        ulasanItem += 'href="'+ fotoUlasan +'">';
                                            ulasanItem += '<img class="img-responsive mr-0"';
                                                ulasanItem += 'src="'+ fotoUlasan +'"';
                                                ulasanItem += 'alt="no picture" style="width:100px; height:100px; object-fit:contain; border-radius:8px; border:solid 1px #C4C4C4;">';
                                        ulasanItem +='</a>';
                                    }
                                ulasanItem +='</div>';
                            }
                        }
                        $('#imgLoading').hide();
                        $('.ulasanProduk').html(ulasanItem);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                        alert(thrownError);
                    }
                });
        }

        $('#urutkanRatingList span').on('click', function () {
            $('#urutkanRatingButton').text($(this).text());
            $('#keyword_urutkan_rating').val($(this).text());
            filter();
        });
    </script>
@endsection
