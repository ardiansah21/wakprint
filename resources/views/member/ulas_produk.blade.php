<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container mt-5 mb-5">
        <h1 class="font-weight-bold mb-0" style="font-size: 48px;">{{__('Ulas') }}</h1>
        <label class="text-sm mb-2 ml-1" style="font-size: 18px;">{{__('Beri nilai dan ulas produk yang telah dipesan') }}</label>
        {{-- @foreach ($collection as $item) --}}
        <form action="{{ route('ulasan.ulasansaya') }}">
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card shadow mb-2" style="border-radius: 10px;">
                        {{-- <a class="text-decoration-none" href="{{ route('detail.produk',$produk->id_produk) }}" style="color: black;"> --}}
                            @if (!empty($produk->jumlah_diskon))
                                <div class="text-center" style="position: relative;">
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                            @else
                                <div class="text-center" style="position: relative;" hidden>
                                    <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                        width:75px;
                                        height:50px;
                                        border-radius:0px 0px 8px 8px;">
                                            <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                    </div>
                                </div>
                            @endif
                            {{-- <form id="favorit-form" action="{{ route('partner.ubah-status') }}" method="POST"> --}}
                                {{-- @csrf --}}
                                {{-- <label class="switch"> --}}
                                {{-- <input id="statusFavorit" class="statusFavorit" type="checkbox" value="{{$produk->id_produk}}" name="status_favorit" onchange="event.preventDefault(); document.getElementById('favorit-form').submit();"
                                    checked hidden> --}}
                                {{-- </label> --}}

                                <input id="id_produk" name="id_produk" value="{{$produk->id_produk}}" hidden>
                                {{-- <form action="{{route('favorit.status')}}" method="POST">
                                    @csrf

                                </form> --}}
                                <i class="fa fa-heart fa-2x fa-responsive cursor-pointer" onclick="window.location.href='{{route('favorit.status')}}'"
                                    style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                </i>
                            {{-- </form> --}}

                            <img class="card-img-top cursor-pointer" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'" style="height: 180px; border-radius: 10px 10px 0px 0px;"
                            alt="Card image cap"/>
                            <div class="card-body cursor-pointer" onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'">
                                <div class="row justify-content-between">
                                    <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{$produk->partner->nama_toko ?? '-'}}</label>
                                    <label class="col-md-auto card-text text-right mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                </div>
                                <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">{{$produk->nama ?? ''}}</label>
                                <label class="card-text text-truncate-multiline" style="font-size: 18px; min-height:65px;">{{$produk->partner->alamat_toko}}</label>
                                <div class="row justify-content-left ml-0 mr-0">
                                    {{-- <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i>
                                        @if ($produk->berwarna === 0 && $produk->hitam_putih === 1)
                                            {{__('Hitam-Putih')}}
                                        @elseif ($produk->berwarna === 1 && $produk->hitam_putih === 0)
                                            {{__('Berwarna')}}
                                        @elseif ($produk->hitam_putih === 1 && $produk->berwarna === 1)
                                            {{__('Berwarna')}}
                                        @else
                                            {{__('-')}}
                                        @endif
                                    </label> --}}
                                    <label class="card-text text-truncate SemiBold mr-2" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$produk->jenis_kertas ?? ''}}</label>
                                    {{-- @foreach ($fitur['paket'] as $key => $value) --}}
                                        {{-- @if (!empty($key)) --}}
                                            {{-- <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label> --}}
                                        {{-- @endif --}}
                                    {{-- @endforeach --}}
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$produk->jenis_printer ?? ''}}</label>
                                </div>
                            </div>
                            <div class="card-footer card-footer-primary cursor-pointer" onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'" style="border-radius: 0px 0px 10px 10px;">
                                <div class="row justify-content-between ml-0 mr-0">
                                    <div>
                                        @php
                                            $jumlahDiskonGray = $produk->harga_hitam_putih * $produk->jumlah_diskon;
                                            $jumlahDiskonWarna = $produk->harga_berwarna * $produk->jumlah_diskon;

                                            if($jumlahDiskonGray > $produk->maksimal_diskon){
                                                $hargaHitamPutih = $produk->harga_hitam_putih - $produk->maksimal_diskon;
                                                $hargaBerwarna = $produk->harga_berwarna - $produk->maksimal_diskon;
                                            }
                                            else{
                                                $hargaHitamPutih = $produk->harga_hitam_putih - $jumlahDiskonGray;
                                                $hargaBerwarna = $produk->harga_berwarna - $jumlahDiskonWarna;
                                            }
                                        @endphp
                                        @if (!empty($produk->harga_hitam_putih) && !empty($produk->harga_berwarna) && !empty($produk->jumlah_diskon))
                                            <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm badge-light px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Hitam-Putih')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. <del>{{$produk->harga_hitam_putih ?? '-'}}</del>
                                            </label>
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                {{$hargaHitamPutih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Berwarna')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                Rp. <del>{{$produk->harga_berwarna ?? '-'}}</del>
                                            </label>
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                {{$hargaBerwarna ?? '-'}}
                                            </label>
                                        @elseif(!empty($produk->harga_hitam_putih) && !empty($produk->jumlah_diskon))
                                            <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm badge-light px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Hitam-Putih')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. <del>{{$produk->harga_hitam_putih ?? '-'}}</del>
                                            </label>
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                {{$hargaHitamPutih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Berwarna')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                {{__('Tidak Tersedia')}}
                                            </label>
                                        @elseif(!empty($produk->harga_berwarna))
                                            <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm badge-light px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Hitam-Putih')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. {{$produk->harga_hitam_putih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Berwarna')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                Rp. {{$produk->harga_berwarna ?? '-'}}
                                            </label>
                                        @else
                                            <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm badge-light px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Hitam-Putih')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. {{$produk->harga_hitam_putih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            {{-- <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1 mr-2" style="font-size: 12px; border-radius:5px;">
                                                {{__('Berwarna')}}
                                            </label> --}}
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                {{__('Tidak Tersedia')}}
                                            </label>
                                        @endif
                                    </div>
                                    <div class="my-auto">
                                        <label class="card-text mt-0 mr-0 SemiBold" style="font-size: 18px;">
                                            <i class="material-icons md-24 align-middle mr-1" style="color: #FCFF82">star</i>
                                            {{$produk->rating ?? '-'}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div>
                </div>
                <div class="col-md-8">
                    <label class="mb-5 ml-0" style="font-size: 24px; color:#BABABA">{{__('Dipesan pada: 21 Februari 2020, 20:35 WIB') }}</label>
                    <div class="row justify-content-left mb-4 ml-0">
                        <div class="rating">
                            <label>
                                <input type="radio" name="stars" value="1" />
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="2" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="3" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="4" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="5" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                        </div>
                        <label class="mt-2 ml-4" style="font-size: 36px;">{{__('Senang') }}</label>
                    </div>
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-9">
                            <div class="form-group mb-4">
                                <textarea class="form-control"
                                aria-label="Deskripsi Ulasan"
                                placeholder="Masukkan komentar Anda disini..."
                                style="font-size:18px; height:141px;"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary-wakprint btn-block SemiBold"
                                style="border-radius:30px; font-size:24px;">
                                    {{__('Kirim Ulasan') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="form-group">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                                class="img-responsive justify-content-center align-self-center center-block mb-4"
                                alt=""
                                width="141px"
                                height="141px"
                                style="border-radius:8px 8px 8px 8px;">
                                <a href="" class="btn btn-primary-yellow btn-block SemiBold align-self-center my-auto"
                                style="border-radius:30px; font-size:20px;">
                                    {{__('Unggah') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- @endforeach --}}

    </div>
@endsection
