<h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Ulasan') }}</h1>
<div class="mb-4">
    <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="filterulasan" style="font-size: 18px;">
        <option value="Untuk Diulas (3)">{{__('Untuk Diulas (3)')}}</option>
        <option value="Sudah Diulas">{{__('Sudah Diulas')}}</option>
    </select>
    {{-- <div class="dropdown">
        <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="font-size: 18px;">
            {{__('Untuk Diulas (3)') }}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
        style="font-size: 18px;">
            <a class="dropdown-item" href="#">{{__('Sudah Diulas') }}</a>
            <a class="dropdown-item" href="#">{{__('Tidak Diulas') }}</a>
        </div>
    </div> --}}
</div>
<div class="custom-scrollbar-ulasan pr-4">

    {{-- @foreach ($collection as $item) --}}
    @include('member.card_ulasan_member')
    {{-- @endforeach --}}

</div>