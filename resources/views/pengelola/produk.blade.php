@extends('layouts.pengelola')

{{-- @foreach ( as $p)
   <img src="{{$p}}" alt=""/>
@endforeach --}}


@section('content')
<div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
    <button onclick="location.href='{{ route('partner.produk.create') }}'"
        class="btn btn-outline-purple font-weight-bold pl-5 pr-5 mb-4" style="border-radius:30px;
                                    font-size:16px;">
        {{__('Tambah Produk')}}
    </button>
    <div class="my-custom-scrollbar mb-5 pr-4">
        <div class="row justify-content-between">

            @foreach ($produk as $p)
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <label class="card-title text-truncate-multiline font-weight-bold mb-2"
                            style="font-size: 18px;">
                            {{$p->nama}}
                        </label>
                        <label class="card-title font-weight-bold mb-0" style="font-size: 16px;">
                            {{__('Deskripsi Produk')}}
                        </label>
                        <label class="card-text text-truncate-multiline" style="font-size: 16px;">
                            {{$p->deskripsi}}
                        </label>
                    </div>
                    <div class="card-footer bg-primary-purple">
                        <div class="row justify-content-between ml-0 mb-0">
                            <label class="card-text SemiBold text-white my-auto" style="font-size: 16px;">
                                Rp. {{$p->harga}}
                            </label>
                            <label class="my-auto">
                                <a href="{{ route('partner.produk.duplicate',['id'=>$p->id_produk]) }}"
                                    class="material-icons md-18 badge-sm badge-light p-1 mr-2"
                                    style="border-radius: 5px; text-decoration: none;">
                                    file_copy
                                </a>
                                <a href="" style="color: black;" style="text-decoration: none;">
                                    <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2"
                                        style="border-radius: 5px;">
                                        edit
                                    </i>
                                </a>
                                <i class="material-icons md-18 badge-sm bg-primary-danger pointer p-1 mr-2"
                                    style="border-radius: 5px;" onclick="event.preventDefault();
                                        document.getElementById('delete-form{{$p->id_produk}}').submit();">
                                    delete
                                </i>
                                <form id="delete-form{{$p->id_produk}}" method="post" style="display: none"
                                    action="{{ route('partner.produk.destroy',[$p->id_produk]) }}">
                                    @csrf @method('DELETE')
                                </form>
                            </label>
                        </div>
                    </div>
                </div>
                {{-- @include('pengelola.card_produk_pengelola') --}}
            </div>
            @endforeach

        </div>
    </div>

</div>



{{-- @foreach ($produk as $article)
  @foreach ($article->getMedia('foto_produk') as $image)
  <div class="-item">
      {{ $image }}
</div>
@endforeach
@endforeach --}}

{{-- {{$produk->first()->getMedia('foto_produk')}} --}}

@endsection
