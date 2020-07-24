<button class="btn btn-outline-purple font-weight-bold pl-5 pr-5 mb-4"
    style="border-radius:30px;
        font-size:16px;">
    {{__('Tambah Produk')}}
</button>
<div class="my-custom-scrollbar mb-5">
    <div class="row justify-content-between">
        
        {{-- @foreach ($collection as $item) --}}
            <div class="col-md-6">
                @include('pengelola.card_produk_pengelola')
            </div>
        {{-- @endforeach --}}
        
    </div>
</div>