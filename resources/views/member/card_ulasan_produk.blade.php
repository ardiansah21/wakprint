@php
    use Carbon\Carbon;
@endphp
<div class="card shadow-sm mb-3 pl-4 pr-4 pt-3 pb-3">
    <div class="row justify-content-left ml-0 mr-0 mb-4">
        <div class="col-md-auto my-auto ml-0 mr-0">
            <img src="{{$value->member->avatar}}" width="56" height="56" alt="no logo" style="object-fit: cover; border-radius: 30px; border:solid 2px #BC41BE;">
        </div>
        <div class="col-md-6">
            <label class="text-truncate font-weight-bold mb-0" style="font-size: 18px;">
                {{$value->member->nama_lengkap}}
            </label>
            <br>
            <label style="font-size: 12px;">
                {{Carbon::parse($value->waktu)->translatedFormat('d F Y')}}
            </label>
        </div>
        <div class="col-md-5 row justify-content-end">
            <label class="SemiBold" style="font-size: 18px;">
                @for ($i = 0; $i < $value->rating; $i++)
                    <i class="material-icons md-32 align-middle" style="color:#FCFF82;">
                        star
                    </i>
                @endfor
                @if ($value->rating == 1.0)
                    {{__('Sangat Buruk') }}
                @elseif ($value->rating == 2.0)
                    {{__('Buruk') }}
                @elseif ($value->rating == 3.0)
                    {{__('Lumayan') }}
                @elseif ($value->rating == 4.0)
                    {{__('Baik') }}
                @else
                    {{__('Sangat Baik') }}
                @endif
            </label>
        </div>
    </div>
    <p class="mb-4" style="font-size: 18px;">
        {{$value->pesan}}
    </p>
    @if (!empty($value->getFirstMediaUrl('foto_ulasan')))
        <a data-fancybox="gallery" href="{{$value->getFirstMediaUrl('foto_ulasan')}}">
            <img class="img-responsive mr-0" src="{{$value->getFirstMediaUrl('foto_ulasan')}}" alt="no picture" style="width:100px; height:100px; object-fit:contain; border-radius:8px; border:solid 1px #C4C4C4;">
        </a>
    @endif

    <input type="text" name="fotoUlasan" id="fotoUlasan" value="{{$value->getFirstMediaUrl('foto_ulasan')}}" hidden>
    <input type="text" name="fotoMember" id="fotoMember" value="{{$value->member->avatar}}" hidden>
    <input type="text" name="namaMember" id="namaMember" value="{{$value->member->nama_lengkap}}" hidden>
    <input type="text" name="tanggalUlasan" id="tanggalUlasan" value="{{Carbon::parse($value->waktu)->translatedFormat('d F Y')}}" hidden>
</div>
