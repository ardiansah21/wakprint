@extends('layouts.member')

@section('content')
    <form class="mb-3" action="{{route('lapor.store',$produk->id_produk)}}" method="POST">
    @csrf
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 mr-0 ml-0">
                    <div class="card shadow mb-2" style="border-radius: 10px;">
                        <a class="text-decoration-none" href="{{ route('detail.produk',$produk->partner->id_pengelola) }}" style="color: black;">
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
                            <i class="fa fa-heart fa-2x fa-responsive"
                            style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                            </i>
                            <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                            style="height: 180px; border-radius: 10px 10px 0px 0px;"
                            alt="Card image cap"/>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{$produk->partner->nama_toko ?? '-'}}</label>
                                    <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                </div>
                                <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{$produk->nama ?? ''}}</label>
                                <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{$produk->partner->alamat_toko}}</label>
                                <div class="row justify-content-between ml-0 mr-0">
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i>
                                        @if ($produk->berwarna === 0 && $produk->hitam_putih === 1)
                                            {{__('Hitam-Putih')}}
                                        @elseif ($produk->berwarna === 1 && $produk->hitam_putih === 0)
                                            {{__('Berwarna')}}
                                        @elseif ($produk->hitam_putih === 1 && $produk->berwarna === 1)
                                            {{__('Berwarna')}}
                                        @else
                                            {{__('-')}}
                                        @endif
                                    </label>
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$produk->jenis_kertas ?? ''}}</label>
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                    <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$produk->jenis_printer ?? ''}}</label>
                                </div>
                            </div>
                            <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                <div class="row justify-content-between ml-0 mr-0">
                                    <div>
                                        @if (!empty($produk->jumlah_diskon))
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
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                            Rp. <del>{{$produk->harga_hitam_putih ?? '-'}}</del>
                                        </label>
                                        <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                            {{$hargaHitamPutih ?? '-'}}
                                        </label>
                                        @else
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. {{$produk->harga_hitam_putih ?? '-'}}
                                            </label>
                                        @endif
                                        <label class="card-text SemiBold badge-sm badge-light px-1" style="font-size: 12px; border-radius:5px;">
                                            {{__('Hitam-Putih')}}
                                        </label>
                                        <br>
                                        @if (!empty($produk->harga_berwarna) && !empty($produk->jumlah_diskon))
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                Rp. <del>{{$produk->harga_berwarna ?? '-'}}</del>
                                            </label>
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                {{$hargaBerwarna ?? '-'}}
                                            </label>
                                            <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1" style="font-size: 12px; border-radius:5px;">
                                                {{__('Berwarna')}}
                                            </label>
                                        @else
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;" hidden>
                                                Rp. {{$produk->harga_berwarna ?? '-'}}
                                            </label>
                                            <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1" style="font-size: 12px; border-radius:5px;" hidden>
                                                {{__('Berwarna')}}
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
                        </a>
                    </div>
                </div>
                <div class="col-md-9 ml-0">
                    <label class="font-weight-bold mb-0"
                        style="font-size:48px;">
                        {{__('Laporkan') }}
                    </label>
                    <br>
                    <label class="mb-4 ml-1"
                        style="font-size:18px;">
                        {{__('Kenapa kamu ingin melapor produk ini ?') }}
                    </label>
                    <div class="form-group mb-5">
                        <textarea class="form-control" id="pesan" name="pesan"
                            aria-placeholder="Deskripsi Laporan"
                            style="height:241px;"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold" type="submit"
                            style="border-radius:30px;
                                font-size:24px;">
                                {{__('Kirim Laporan') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


