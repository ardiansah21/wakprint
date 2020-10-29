<div class="card shadow mb-2" style="border-radius: 10px;">
    <a class="text-decoration-none" href="{{ route('detail.partner',$p->id_pengelola) }}" style="color: black;">
        @foreach ($atk as $a)
            @if($a->id_pengelola === $p->id_pengelola && $a->status === 'Tersedia')
                <label class="badge badge-pill badge-info bg-promo font-weight-bold align-bottom p-2 mb-1 mt-3" style="position: absolute;top: 0%; left: 80%; font-size: 12px;">{{__('ATK') }}</label>
            @else
                <label class="badge badge-pill badge-info bg-promo font-weight-bold align-bottom p-2 mb-1 mt-3" style="position: absolute;top: 0%; left: 80%; font-size: 12px;" hidden>{{__('ATK') }}</label>
            @endif
        @endforeach
        <img class="card-img-top"
        @if (count($p->getMedia('foto_produk')) > 0)
            src="{{$p->getFirstMediaUrl('foto_produk')}}"
        @else
            src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
        @endif
        style="height: 180px; border-radius: 10px 10px 0px 0px;"
        alt="Card image cap"/>
        <div class="card-body">
            <label class="card-title text-truncate-multiline font-weight-bold" style="font-size: 24px; min-height:75px;">{{$p->nama_toko}}</label>
            <label class="card-text text-truncate-multiline" style="font-size: 16px; min-height:55px;">{{$p->alamat_toko}}</label>
            <label class="card-text text-sm text-truncate" style="font-size: 14px; min-height:10px; width:100%">{{$p->deskripsi_toko ?? '-'}}</label>
        </div>
        <div class="card-footer card-footer-primary" style="border-radius: 0px 0px 10px 10px;">
            <div class="row justify-content-between ml-0">
                <label class="card-text font-weight-bold" style="font-size: 18px;">
                    <i class="material-icons md-24 mr-2 align-middle" style="color: #6081D7">location_on</i>
                    {{__('100 m') }}
                </label>

                <label class="card-text mr-4 font-weight-bold" style="font-size: 18px;">
                    <i class="material-icons md-24 mr-1 align-middle" style="color: #FCFF82">star</i>
                    {{$p->rating_toko}}
                </label>
            </div>
        </div>
    </a>
</div>
