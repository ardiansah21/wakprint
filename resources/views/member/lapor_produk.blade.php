@extends('layouts.member')

@section('content')
    <form class="mb-3" action="{{route('lapor.store',$produk->id_produk)}}" method="POST">
    @csrf
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 mr-0 ml-0">
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
                            <form id="favorit-form" action="{{ route('favorit.status',$produk->id_produk) }}" method="POST">
                                @csrf
                                    <input id="id_produk" name="id_produk" value="{{$produk->id_produk}}" hidden>
                                    @auth
                                        @if ($member->cekProdukFavorit($member->id_member,$produk->id_produk))
                                            <button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer text-danger" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>
                                        @else
                                            <button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button>
                                        @endif
                                    @endauth
                                    {{-- <button type="submit" class="btn fa fa-heart fa-2x fa-responsive cursor-pointer" style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); background:transparent;"></button> --}}
                            </form>
                        <input id="fotoProduk" type="text" value="{{$produk->getFirstMediaUrl('foto_produk')}}" hidden>
                        <img class="card-img-top cursor-pointer" src="{{$produk->getFirstMediaUrl('foto_produk')}}" onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'" style="height: 180px; border-radius: 10px 10px 0px 0px;" alt="Terdapat Kesalahan Penampilan Foto"/>
                        <div class="card-body cursor-pointer" onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'">
                            <div class="row justify-content-between">
                                <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{$produk->partner->nama_toko ?? '-'}}</label>
                                <label class="col-md-auto card-text text-right mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i>{{ __(($produk->partner->jarak/1000).' km') }}</label>
                            </div>
                            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">{{$produk->nama ?? ''}}</label>
                            <label class="card-text text-truncate-multiline" style="font-size: 18px; min-height:65px;">{{$produk->partner->alamat_toko}}</label>
                            <div class="row justify-content-left ml-0 mr-0">
                                <label class="card-text text-truncate SemiBold mr-2" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$produk->jenis_kertas ?? ''}}</label>
                                <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$produk->jenis_printer ?? ''}}</label>
                            </div>
                        </div>
                        <div class="card-footer card-footer-primary cursor-pointer"
                            onclick="window.location.href='{{ route('detail.produk',$produk->id_produk) }}'"
                            style="border-radius: 0px 0px 10px 10px;">
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
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. <del>{{$produk->harga_hitam_putih ?? '-'}}</del>
                                            </label>
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                {{$hargaHitamPutih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                Rp. <del>{{$produk->harga_berwarna ?? '-'}}</del>
                                            </label>
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                {{$hargaBerwarna ?? '-'}}
                                            </label>
                                        @elseif(!empty($produk->harga_hitam_putih) && !empty($produk->jumlah_diskon))
                                            <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. <del>{{$produk->harga_hitam_putih ?? '-'}}</del>
                                            </label>
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                {{$hargaHitamPutih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                {{__('Tidak Tersedia')}}
                                            </label>
                                        @elseif(!empty($produk->harga_berwarna))
                                            <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. {{$produk->harga_hitam_putih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                Rp. {{$produk->harga_berwarna ?? '-'}}
                                            </label>
                                        @else
                                            <i class="material-icons md-24 align-middle text-white mr-2">color_lens</i>
                                            <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                Rp. {{$produk->harga_hitam_putih ?? '-'}}
                                            </label>
                                            <br>
                                            <i class="material-icons md-24 align-middle text-primary-yellow mr-2">color_lens</i>
                                            <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                {{__('Tidak Tersedia')}}
                                            </label>
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
                    </div>
                </div>
                <div class="col-md-8 ml-0">
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
                        <textarea class="form-control" id="pesan" name="pesan" aria-placeholder="Deskripsi Laporan" required style="height:241px;"></textarea>
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


