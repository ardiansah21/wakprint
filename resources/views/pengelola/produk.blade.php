@extends('layouts.pengelola')

@section('content')
    <div>
        <button onclick="location.href='{{ route('partner.produk.create') }}'" class="btn btn-outline-purple font-weight-bold pl-5 pr-5 mb-4" style="border-radius:30px; font-size:16px;">
            {{__('Tambah Produk')}}
        </button>
        <div class="my-custom-scrollbar mb-5 pr-4">
            <div class="row justify-content-between">
                @foreach ($produk as $p)
                    @if ($p->id_pengelola === $partner->id_pengelola)
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <label class="card-title text-truncate-multiline font-weight-bold mb-2"
                                        style="font-size: 18px; min-height:60px">
                                        {{$p->nama ?? '-'}}
                                    </label>
                                    <label class="card-title font-weight-bold mb-0" style="font-size: 16px;">
                                        {{__('Deskripsi Produk')}}
                                    </label>
                                    <label class="card-text text-truncate-multiline" style="font-size: 16px; min-height:50px">
                                        {{$p->deskripsi ?? '-'}}
                                    </label>
                                </div>
                                <div class="card-footer bg-primary-purple">
                                    <div class="row justify-content-between ml-0 mb-0">
                                        <div>
                                            @if ($p->status_diskon != 'Tersedia')
                                                <i class="material-icons md-24 text-white align-middle mr-2">
                                                    color_lens
                                                </i>
                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                    {{rupiah($p->harga_hitam_putih) ?? '-'}}
                                                </label>
                                                <br>
                                                @if (!empty($p->harga_berwarna))
                                                    <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                                        color_lens
                                                    </i>
                                                    <label class="card-text SemiBold text-primary-yellow my-auto mr-2"
                                                        style="font-size: 16px;">
                                                        {{rupiah($p->harga_berwarna)}}
                                                    </label>
                                                    @else
                                                    <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                                        color_lens
                                                    </i>
                                                    <label class="card-text SemiBold text-primary-yellow my-auto mr-2"
                                                        style="font-size: 16px;">
                                                        {{__('Tidak Tersedia')}}
                                                    </label>
                                                @endif
                                            @else
                                                @php
                                                    $hargaDiskonHitamPutih = $p->jumlah_diskon * $p->harga_hitam_putih;
                                                    $hargaDiskonBerwarna = $p->jumlah_diskon * $p->harga_berwarna;

                                                    if($hargaDiskonHitamPutih > $p->maksimal_diskon){
                                                        $hargaFinalHitamPutih = $p->harga_hitam_putih - $p->maksimal_diskon;
                                                    }
                                                    else{
                                                        $hargaFinalHitamPutih = $p->harga_hitam_putih - $hargaDiskonHitamPutih;
                                                    }

                                                    if($hargaDiskonBerwarna > $p->maksimal_diskon){
                                                        $hargaFinalBerwarna = $p->harga_berwarna - $p->maksimal_diskon;
                                                    }
                                                    else{
                                                        $hargaFinalBerwarna = $p->harga_berwarna - $hargaDiskonBerwarna;
                                                    }
                                                @endphp
                                                <i class="material-icons md-24 text-white align-middle mr-2">
                                                    color_lens
                                                </i>
                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 12px;">
                                                    <del>{{rupiah($p->harga_hitam_putih)}}</del>
                                                </label>
                                                <label class="card-text SemiBold text-white my-auto mr-2" style="font-size: 16px;">
                                                    {{rupiah($hargaFinalHitamPutih)}}
                                                </label>
                                                <br>
                                                @if (!empty($p->harga_berwarna))
                                                    <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                                        color_lens
                                                    </i>
                                                    <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 12px;">
                                                        <del>{{rupiah($p->harga_berwarna)}}</del>
                                                    </label>
                                                    <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                        {{rupiah($hargaFinalBerwarna)}}
                                                    </label>
                                                @else
                                                    <i class="material-icons md-24 text-primary-yellow align-middle mr-2">
                                                        color_lens
                                                    </i>
                                                    <label class="card-text SemiBold text-primary-yellow my-auto mr-2" style="font-size: 16px;">
                                                        {{__('Tidak Tersedia')}}
                                                    </label>
                                                @endif
                                            @endif
                                        </div>
                                        <label class="my-auto">
                                            <a href="{{ route('partner.produk.duplicate',['id'=>$p->id_produk]) }}"
                                                class="material-icons md-18 badge-sm badge-light p-1 mr-2"
                                                style="border-radius: 5px; text-decoration: none;">
                                                file_copy
                                            </a>
                                            <a href="{{route('partner.produk.edit',['produk'=>$p->id_produk])}}"
                                                style="color: black;" style="text-decoration: none;">
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
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
