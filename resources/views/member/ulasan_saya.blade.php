<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container pt-5 pb-5">
        <h1 class="font-weight-bold mb-2" style="font-size: 48px;">{{__('Ulasan Saya') }}</h1>
        <label class="ml-1 mb-2" style="font-size: 18px;">{{__('Detail produk yang telah Anda ulas') }}</label>
        <div class="row justify-content-between ml-0 mr-0 mt-5">
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
                        <form id="favorit-form" action="{{ route('favorit.status', $produk->id_produk) }}" method="POST">
                            @csrf
                            <input id="id_produk" name="id_produk" value="{{ $produk->id_produk }}" hidden>
                            @auth
                                @if ($member->cekProdukFavorit($member->id_member, $produk->id_produk))
                                    <button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer text-danger"
                                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>
                                @else
                                    <button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer"
                                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>
                                @endif
                            @endauth
                        </form>
                        <img class="card-img-top cursor-pointer"
                        @if (!empty($produk->getFirstMediaUrl('foto_produk')))
                            src="{{$produk->getFirstMediaUrl('foto_produk')}}"
                        @else
                            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                        @endif onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'" style="height: 180px; border-radius: 10px 10px 0px 0px; object-fit:cover;" alt="no picture"/>
                        <div class="card-body cursor-pointer" onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'">
                            <div class="row justify-content-between">
                                <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{$produk->partner->nama_toko ?? '-'}}</label>
                                <label class="col-md-auto card-text text-right mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                            </div>
                            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">{{$produk->nama ?? ''}}</label>
                            <label class="card-text text-truncate-multiline" style="font-size: 18px; min-height:65px;">{{$produk->partner->alamat_toko}}</label>
                            <div class="row justify-content-left ml-0 mr-0">
                                <label class="card-text text-truncate SemiBold mr-2" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$produk->jenis_kertas ?? ''}}</label>
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
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;">
                                            <del>{{rupiah($produk->harga_hitam_putih) ?? '-'}}</del>
                                        </label>
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                            {{rupiah($hargaHitamPutih) ?? '-'}}
                                        </label>
                                        <br>
                                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 12px;">
                                            <del>{{rupiah($produk->harga_berwarna) ?? '-'}}</del>
                                        </label>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                            {{rupiah($hargaBerwarna) ?? '-'}}
                                        </label>
                                    @elseif(!empty($produk->harga_hitam_putih) && !empty($produk->jumlah_diskon))
                                        <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;">
                                            <del>{{rupiah($produk->harga_hitam_putih) ?? '-'}}</del>
                                        </label>
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                            {{rupiah($hargaHitamPutih) ?? '-'}}
                                        </label>
                                        <br>
                                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                            {{__('Tidak Tersedia')}}
                                        </label>
                                    @elseif(!empty($produk->harga_berwarna))
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                            {{rupiah($produk->harga_hitam_putih) ?? '-'}}
                                        </label>
                                        <br>
                                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                        <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                            {{rupiah($produk->harga_berwarna) ?? '-'}}
                                        </label>
                                    @else
                                        <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                            {{rupiah($produk->harga_hitam_putih) ?? '-'}}
                                        </label>
                                        <br>
                                        <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
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
                {{-- @include('member.card_produk') --}}
            </div>
            <div class="col-md-8">
                <div class="row mb-5">
                    <div class="col-md-9 ml-0 my-auto">
                        <label class="mb-5 ml-0" style="font-size: 24px; color:#BABABA">{{__('Diulas pada: '.Carbon::parse($ulasan->updated_at)->translatedFormat('d F Y H:m').' WIB') }}</label>
                    </div>
                    <div class="col-md-3 align-self-right">
                        <button class="btn btn-primary-yellow btn-sm btn-block SemiBold" onclick="window.location.href='{{route('detail.produk', $produk->id_produk)}}'"
                            style="border-radius:30px; font-size:24px;">{{__('Pesan Lagi') }}</button>
                    </div>
                </div>
                <div class="row justify-content-left ml-0 mb-4">
                    <div style="color:#FCFF82;">
                        @for ($i = 0; $i < $ulasan->rating; $i++)
                            <span class="material-icons md-60">star</span>
                        @endfor
                    </div>
                    <label class="my-auto ml-4" style="font-size: 36px;">
                        @if ($ulasan->rating == 1.0)
                            {{__('Sangat Buruk') }}
                        @elseif ($ulasan->rating == 2.0)
                            {{__('Buruk') }}
                        @elseif ($ulasan->rating == 3.0)
                            {{__('Lumayan') }}
                        @elseif ($ulasan->rating == 4.0)
                            {{__('Baik') }}
                        @else
                            {{__('Sangat Baik') }}
                        @endif
                    </label>
                </div>
                <div class="row ml-0 mb-3">
                    <div class="col-md-2">
                        @if (!empty($ulasan->getFirstMediaUrl('foto_ulasan')))
                            <a data-fancybox="gallery" id="linkFotoUlasan" href="{{ $ulasan->getFirstMediaUrl('foto_ulasan') }}">
                                <img src="{{$ulasan->getFirstMediaUrl('foto_ulasan')}}" class="img-responsive justify-content-center align-self-center center-block" alt="" width="141px" height="141px" style="border: solid 1px #BC41BE; border-radius:8px; object-fit:contain;">
                            </a>
                        @else
                            <a data-fancybox="gallery" id="linkFotoUlasan" href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" class="img-responsive justify-content-center align-self-center center-block" alt="" width="141px" height="141px" style="border: solid 1px #BC41BE; border-radius:8px; object-fit:contain;">
                            </a>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="card ml-5" style="height:232px;">
                            <p class="card-text text-truncate mb-2 ml-4 mt-3"style="font-size: 18px;">
                                "{{$ulasan->pesan}}"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
