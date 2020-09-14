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
                            @include('member.card_produk')
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
