<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <form id="search-form" action="{{ route('search') }}" method="POST">
        @csrf
        <div class="row justify-content-between mb-5 mt-5">
            <div class="col-md-4">
                <div class="btn-group btn-group-toggle mt-2 mb-4" data-toggle="buttons">
                    <label id="antarRumah" class="btn btn-default-wakprint shadow-sm SemiBold mr-4"
                        style="border-radius:30px; font-size:14px;">
                        <input type="checkbox" checked autocomplete="off">
                        {{__('Antar ke Rumah')}}
                    </label>
                    <label id="ambilTempat" class="btn btn-default-wakprint shadow-sm SemiBold"
                        style="border-radius:30px; font-size:14px;">
                        <input type="checkbox" checked autocomplete="off">
                        {{__('Ambil di Tempat')}}
                    </label>
                </div>
                <div class="mt-3">
                    <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Jenis Ukuran Kertas')}}</label>
                    <div class="dropdown" aria-required="true">
                        <input name="jenis_kertas" type="text" id="ukuranKertas" Class="form-control" hidden>
                        <button id="ukuranKertasButton"
                            class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownKertas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;
                                text-align:left;">
                            {{__('Ukuran Kertas') }}
                        </button>
                        @php
                        $ukuranKertas= array('A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr',
                        'F4HVS80gr',
                        'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr');
                        @endphp
                        <div id="ukuranKertasList" class="dropdown-menu" aria-labelledby="dropdownKertas"
                            style="font-size: 16px; width:100%;">
                            @foreach ( $ukuranKertas as $kertas)
                            <span class="dropdown-item cursor-pointer ">
                                {{$kertas}}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Jenis Printer')}}</label>
                    <div class="dropdown">
                        <input name="jenis_printer" type="text" id="jenisPrinter" Class="form-control" hidden>
                        <button id="jenisPrinterButton"
                            class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                            id="dropdownJenisPrinter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="font-size: 16px;
                                text-align:left;">
                            {{__('Jenis Printer') }}
                        </button>
                        @php
                        $jenisPrinter= array('Ink Jet', 'Laser Jet');
                        @endphp
                        <div id="jenisPrinterList" class="dropdown-menu" aria-labelledby="dropdownJenisPrinter"
                            style="font-size: 16px; width:100%;">
                            @foreach ( $jenisPrinter as $printer)
                            <span class="dropdown-item cursor-pointer ">
                                {{$printer}}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="SemiBold mb-3 ml-0" style="font-size:24px;">{{__('Paket')}}</label>
                    @php
                    $paket = array('Lem','Baut','Kawat','Spiral');
                    @endphp
                    <div class="" style="font-size: 18px;">
                        <label class="SemiBold mb-2 ml-0">
                            {{__('Jilid')}}
                        </label>
                        @foreach ($paket as $p)
                        <div class="custom-control custom-checkbox mt-2 ml-4 mr-4">
                            <input type="checkbox" name="checkbox_paket{{ $p }}" class="custom-control-input"
                                id="checkboxPaket{{ $p }}" value="{{$p}}">
                            <label class="custom-control-label" for="checkboxPaket{{ $p }}">
                                {{$p}}
                                <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                                    help
                                </i>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-3">
                    @php
                    $nonPaket = array('Hekter','Tulang Kliping','Penjepit Kertas','Plastik Transparan','Kertas Jeruk');
                    @endphp
                    <label class="SemiBold mt-3 mb-2 ml-0" style="font-size: 24px;">
                        {{__('Non-Paket')}}
                    </label>
                    @foreach ($nonPaket as $np)
                    <div class="custom-control custom-checkbox mt-2 ml-1 mr-4" style="font-size: 18px;">
                        <input type="checkbox" class="custom-control-input" id="checkboxNonPaket{{$np}}"
                            value="{{$np}}">
                        <label class="custom-control-label" for="checkboxNonPaket{{$np}}">
                            {{$np}}
                            <i class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">
                                help
                            </i>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8 ml-0">
                <label class="font-weight-bold mb-5" style="font-size: 48px;">
                    {{__('Cari Produk / Tempat Percetakan')}}
                </label>
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="search-input mb-3">
                            <div class="main-search-input-item">
                                <input id="keyword" name="keyword" type="text" role="search" class="form-control"
                                    placeholder="Cari percetakan atau produk disini"
                                    aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                                    style="border:0px solid white;
                                    border-radius:30px;
                                    font-size:18px;">
                                <i id='cari' class="material-icons pointer ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                                    top: 50%;
                                    left: 95%;
                                    transform:translate(-50%, -50%);
                                    -ms-transform: translate(-50%, -50%);">
                                    search
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown">
                            <input name="filter_pencarian" type="text" id="filter_pencarian" Class="form-control"
                                hidden>
                            <button id="filterPencarianButton"
                                class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                                id="dropdownFilterPencarian" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" style="font-size: 16px;
                                    text-align:left;">
                                {{__('Urutkan') }}
                            </button>
                            @php
                            $filterPencarian= array('Terbaru', 'Harga Tertinggi', 'Harga Terendah');
                            @endphp
                            <div id="filterPencarianList" class="dropdown-menu"
                                aria-labelledby="dropdownFilterPencarian" style="font-size: 16px; width:100%;">
                                @foreach ( $filterPencarian as $fp)
                                <span class="dropdown-item cursor-pointer ">
                                    {{$fp}}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="nav nav-pills SemiBold mb-5" id="pills-tab" role="tablist" style="font-size:18px;">
                        <li class="nav-item mr-3">
                            <a class="nav-link active" id="pills-produk-tab" data-toggle="tab" href="#pills-produk"
                                role="tab" aria-controls="pills-produk" aria-selected="true"
                                style="border-radius:10px 10px 0px 0px;">
                                <i class="material-icons align-middle mr-2">
                                    shopping_cart
                                </i>
                                {{__('Produk')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-tempat-percetakan-tab" data-toggle="tab"
                                href="#pills-tempat-percetakan" role="tab" aria-controls="pills-tempat-percetakan"
                                aria-selected="false" style="border-radius:10px 10px 0px 0px;">
                                <i class="material-icons align-middle mr-2">
                                    home
                                </i>
                                {{__('Tempat Percetakan')}}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-produk" role="tabpanel"
                            aria-labelledby="pills-produk-tab">
                            <div class="infinite-scroll">
                                <div id="pencarianItems" class="row justify-content-between mb-4">
                                    {{-- <div id="load" style=""> --}}
                                    <div class="produk">
                                        @foreach ($produk as $p)
                                        <div class="col-md-6 mb-4">
                                            <div class="col-md-auto mb-4">
                                                <div class="card shadow mb-2" style="border-radius: 10px;">
                                                    <a class="text-decoration-none"
                                                        href="produk/detail/{{ $p->id_produk }}" style="color: black;">
                                                        <div class="text-center" style="position: relative;">
                                                            <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                                                            width:75px;
                                                                            height:50px;
                                                                            border-radius:0px 0px 8px 8px;">
                                                                <label class="font-weight-bold mb-1 mt-3"
                                                                    style="font-size: 12px;">{{__('Promo') }}</label>
                                                            </div>
                                                        </div>
                                                        <i class="fa fa-heart fa-2x fa-responsive"
                                                            style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                                        </i>
                                                        <img class="card-img-top"
                                                            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                                            style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                                            alt="Card image cap" />
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <label class="col-md-7 text-truncate ml-0"
                                                                    style="font-size: 14px;">{{$p->partner->nama_toko ?? '-'}}</label>
                                                                <label class="col-md-auto card-text mr-0"
                                                                    style="font-size: 14px;"><i
                                                                        class="material-icons md-18 align-middle mr-0">location_on</i>
                                                                    {{__('100 m') }}</label>
                                                            </div>
                                                            <label
                                                                class="card-title text-truncate-multiline font-weight-bold"
                                                                style="font-size: 24px;">{{$p->nama ?? '-'}}</label>
                                                            <label class="card-text text-truncate-multiline"
                                                                style="font-size: 18px;">{{$p->partner->alamat_toko}}</label>
                                                            <div class="row justify-content-between ml-0 mr-0">
                                                                <label class="card-text text-truncate SemiBold"
                                                                    style="font-size: 14px;"><i
                                                                        class="material-icons md-18 align-middle mr-1">color_lens</i>
                                                                    @if ($p->berwarna === 0 && $p->hitam_putih === 1)
                                                                    {{__('Hitam-Putih')}}
                                                                    @elseif ($p->berwarna === 1 && $p->hitam_putih ===
                                                                    0)
                                                                    {{__('Berwarna')}}
                                                                    @elseif ($p->hitam_putih === 1 && $p->berwarna ===
                                                                    1)
                                                                    {{__('Berwarna')}}
                                                                    @else
                                                                    {{__('-')}}
                                                                    @endif
                                                                </label>
                                                                <label class="card-text text-truncate SemiBold"
                                                                    style="font-size: 14px;"><i
                                                                        class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? '-'}}</label>
                                                                <label class="card-text text-truncate SemiBold"
                                                                    style="font-size: 14px;"><i
                                                                        class="material-icons md-18 align-middle mr-1">menu_book</i>
                                                                    {{__('Jilid') }}</label>
                                                                <label class="card-text text-truncate SemiBold"
                                                                    style="font-size: 14px;"><i
                                                                        class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? '-'}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer card-footer-primary"
                                                            style="border-radius: 0px 0px 10px 10px;">
                                                            <div class="row justify-content-between">
                                                                <div class="ml-3">
                                                                    <label
                                                                        class="card-text SemiBold text-white my-auto mr-2"
                                                                        style="font-size: 16px;">
                                                                        Rp. {{$p->harga_hitam_putih ?? '-'}}
                                                                    </label>
                                                                    <label
                                                                        class="card-text SemiBold badge-sm badge-light px-1"
                                                                        style="font-size: 12px; border-radius:5px;">
                                                                        {{__('Hitam-Putih')}}
                                                                    </label>
                                                                    <br>
                                                                    @if (!empty($p->harga_berwarna))
                                                                    <label
                                                                        class="card-text SemiBold text-primary-yellow my-auto mr-2"
                                                                        style="font-size: 16px;">
                                                                        Rp. {{$p->harga_berwarna}}
                                                                    </label>
                                                                    <label
                                                                        class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1"
                                                                        style="font-size: 12px; border-radius:5px;">
                                                                        {{__('Berwarna')}}
                                                                    </label>
                                                                    @endif
                                                                </div>
                                                                <div class="mr-0 my-auto">
                                                                    <label class="card-text mt-0 mr-4 SemiBold"
                                                                        style="font-size: 18px;">
                                                                        <i class="material-icons md-24 mr-1 align-middle"
                                                                            style="color: #FCFF82">star</i>
                                                                        {{$p->rating ?? '-'}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    {{ $produk->links() }}
                                </div>
                            </div>
                            {{-- <div class="my-custom-scrollbar">
                                <div id="pencarianItems" class="row justify-content-between mb-4">
                                    @foreach ($produk as $p)
                                    <div class="col-md-6 mb-4">
                                        <div class="col-md-auto mb-4">
                                            <div class="card shadow mb-2" style="border-radius: 10px;">
                                                <a class="text-decoration-none" href="produk/detail/{{ $p->id_produk }}"
                            style="color: black;">
                            <div class="text-center" style="position: relative;">
                                <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                                                            width:75px;
                                                                            height:50px;
                                                                            border-radius:0px 0px 8px 8px;">
                                    <label class="font-weight-bold mb-1 mt-3"
                                        style="font-size: 12px;">{{__('Promo') }}</label>
                                </div>
                            </div>
                            <i class="fa fa-heart fa-2x fa-responsive"
                                style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            </i>
                            <img class="card-img-top"
                                src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap" />
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-7 text-truncate ml-0"
                                        style="font-size: 14px;">{{$p->partner->nama_toko ?? '-'}}</label>
                                    <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i
                                            class="material-icons md-18 align-middle mr-0">location_on</i>
                                        {{__('100 m') }}</label>
                                </div>
                                <label class="card-title text-truncate-multiline font-weight-bold"
                                    style="font-size: 24px;">{{$p->nama ?? '-'}}</label>
                                <label class="card-text text-truncate-multiline"
                                    style="font-size: 18px;">{{$p->partner->alamat_toko}}</label>
                                <div class="row justify-content-between ml-0 mr-0">
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                                            class="material-icons md-18 align-middle mr-1">color_lens</i>
                                        @if ($p->berwarna === 0 && $p->hitam_putih === 1)
                                        {{__('Hitam-Putih')}}
                                        @elseif ($p->berwarna === 1 && $p->hitam_putih === 0)
                                        {{__('Berwarna')}}
                                        @elseif ($p->hitam_putih === 1 && $p->berwarna === 1)
                                        {{__('Berwarna')}}
                                        @else
                                        {{__('-')}}
                                        @endif
                                    </label>
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                                            class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? '-'}}</label>
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                                            class="material-icons md-18 align-middle mr-1">menu_book</i>
                                        {{__('Jilid') }}</label>
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i
                                            class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? '-'}}</label>
                                </div>
                            </div>
                            <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                <div class="row justify-content-between">
                                    <div class="ml-3">
                                        <label class="card-text SemiBold text-white my-auto mr-2"
                                            style="font-size: 16px;">
                                            Rp. {{$p->harga_hitam_putih ?? '-'}}
                                        </label>
                                        <label class="card-text SemiBold badge-sm badge-light px-1"
                                            style="font-size: 12px; border-radius:5px;">
                                            {{__('Hitam-Putih')}}
                                        </label>
                                        <br>
                                        @if (!empty($p->harga_berwarna))
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2"
                                            style="font-size: 16px;">
                                            Rp. {{$p->harga_berwarna}}
                                        </label>
                                        <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1"
                                            style="font-size: 12px; border-radius:5px;">
                                            {{__('Berwarna')}}
                                        </label>
                                        @endif
                                    </div>
                                    <div class="mr-0 my-auto">
                                        <label class="card-text mt-0 mr-4 SemiBold" style="font-size: 18px;">
                                            <i class="material-icons md-24 mr-1 align-middle"
                                                style="color: #FCFF82">star</i>
                                            {{$p->rating ?? '-'}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div> --}}
</div>
<div class="tab-pane fade" id="pills-tempat-percetakan" role="tabpanel" aria-labelledby="pills-tempat-percetakan-tab">
    <div class="my-custom-scrollbar">
        <div id="pencarianItems" class="row justify-content-between mb-4">
            @foreach($partner as $p)
            <div class="col-md-6 mb-4">
                <div class="col-md-auto mb-4">
                    <div class="card shadow mb-2" style="border-radius: 10px;">
                        <a class="text-decoration-none" href="partner/detail/{{ $p->id_pengelola }}"
                            style="color: black;">
                            <label
                                class="badge badge-pill badge-info bg-promo font-weight-bold align-bottom p-2 mb-1 mt-3"
                                style="position: absolute;top: 0%; left: 80%; font-size: 12px;">{{__('ATK') }}</label>
                            <img class="card-img-top"
                                src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Card image cap" />
                            <div class="card-body">
                                <label class="card-title text-truncate-multiline font-weight-bold"
                                    style="font-size: 24px;">{{$p->nama_toko}}</label>
                                <label class="card-text text-truncate-multiline"
                                    style="font-size: 16px;">{{$p->alamat_toko}}</label>
                                <label class="card-text text-sm text-truncate-multiline"
                                    style="font-size: 14px;">{{$p->deskripsi_toko}}</label>
                            </div>
                            <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                <div class="row justify-content-between ml-0">
                                    <label class="card-text font-weight-bold" style="font-size: 18px;">
                                        <i class="material-icons md-24 mr-2 align-middle"
                                            style="color: #6081D7">location_on</i>
                                        {{__('100 m') }}
                                    </label>
                                    <label class="card-text mr-4 font-weight-bold" style="font-size: 18px;">
                                        <i class="material-icons md-24 mr-1 align-middle"
                                            style="color: #FCFF82">star</i>
                                        {{$p->rating_toko}}
                                    </label>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</form>
</div>
@endsection
@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> --}}
<script>
    $('#ukuranKertasList span').on('click', function () {
            $('#ukuranKertasButton').text($(this).text());
            $('#ukuranKertas').val($(this).text());
        });

        $('#filterPencarianList span').on('click', function () {
            $('#filterPencarianButton').text($(this).text());
            $('#filter_pencarian').val($(this).text());
        });

        $('#jenisPrinterList span').on('click', function () {
            $('#jenisPrinterButton').text($(this).text());
            $('#jenisPrinter').val($(this).text());
        });

        // $('input:checkbox').on('click',function(){
        //     alert($(this).val())
        // });



    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#pencarianItems a').css('color', '#dfecf6');
            $('#pencarianItems').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

            var url = $(this).attr('href');
            getArticles(url);
            window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('.produk').html(data);
        }).fail(function () {
            alert('Produk tidak ditemukan.');
        });
    }
});



    $(document).ready(function(){
        $('#keyword').on('keyup',function(){
            var keyword = $('#keyword').val();
            $.ajax({
                url:"{{route('search')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    'keyword':keyword,
                },
                success:function(data){
                    $('#pencarianItems').html(data);
                }
            })
        });
    });



</script>
@endsection
