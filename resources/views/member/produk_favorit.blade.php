<h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Produk Favorit') }}</h1>
<div class="custom-scrollbar-favorit">
    <div class="row justify-content-between">

        {{-- @foreach ($collection as $item) --}}
        <div class="col-md-6 mb-4">
            <div class="col-md-auto mb-4">
                @include('member.card_produk')
            </div>
        </div>
        {{-- @endforeach --}}

    </div>
</div>