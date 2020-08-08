@extends('layouts.member')

@section('content')
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Produk Favorit') }}</h1>
        @if (!empty($produk))
            <div class="custom-scrollbar-favorit">
                <div class="row justify-content-between">
                    @foreach ($produk as $p)
                    <div class="col-md-6 mb-4">
                        <div class="col-md-auto mb-4">
                            <div class="card shadow mb-2" style="border-radius: 10px;">
                                <a class="text-decoration-none" href="{{ route('detail.produk',$p->id_produk) }}" style="color: black;">
                                    <div class="text-center" style="position: relative;">
                                        <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                            width:75px;
                                            height:50px;
                                            border-radius:0px 0px 8px 8px;">
                                                <label class="font-weight-bold mb-1 mt-3" style="font-size: 12px;">{{__('Promo') }}</label>
                                        </div>
                                    </div>
                                    <i class="fa fa-heart fa-2x fa-responsive"
                                    style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                    </i>
                                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                                    style="height: 180px; border-radius: 10px 10px 0px 0px;"
                                    alt="Card image cap"/>
                                    <div class="card-body">
                                        <div class="row">
                                            <label class="col-md-7 text-truncate ml-0" style="font-size: 14px;">{{$p->partner->nama_toko ?? '-'}}</label>
                                            <label class="col-md-auto card-text mr-0" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-0">location_on</i> {{__('100 m') }}</label>
                                        </div>
                                        <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px;">{{$p->nama ?? ''}}</label>
                                        <label class="card-text text-truncate-multiline" style="font-size: 18px;">{{$p->partner->alamat_toko}}</label>
                                        <div class="row justify-content-between ml-0 mr-0">
                                            <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">color_lens</i>
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
                                            <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">description</i>{{$p->jenis_kertas ?? ''}}</label>
                                            <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">menu_book</i> {{__('Jilid') }}</label>
                                            <label class="card-text text-truncate SemiBold" style="font-size: 14px;"><i class="material-icons md-18 align-middle mr-1">print</i>{{$p->jenis_printer ?? ''}}</label>
                                        </div>
                                    </div>
                                    <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
                                        <div class="row justify-content-between ml-0 mr-0">
                                            <div>
                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                    Rp. {{$p->harga_hitam_putih ?? '-'}}
                                                </label>
                                                <label class="card-text SemiBold badge-sm badge-light px-1" style="font-size: 12px; border-radius:5px;">
                                                    {{__('Hitam-Putih')}}
                                                </label>
                                                <br>
                                                @if (!empty($p->harga_berwarna))
                                                    <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                        Rp. {{$p->harga_berwarna}}
                                                    </label>
                                                    <label class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1" style="font-size: 12px; border-radius:5px;">
                                                        {{__('Berwarna')}}
                                                    </label>
                                                @endif
                                            </div>
                                            <div class="my-auto">
                                                <label class="card-text mt-0 mr-0 SemiBold" style="font-size: 18px;">
                                                    <i class="material-icons md-24 align-middle mr-1" style="color: #FCFF82">star</i>
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
            </div>
        @else
        <label>Produk Favorit Kosong</label>
        @endif
    </div>
@endsection
