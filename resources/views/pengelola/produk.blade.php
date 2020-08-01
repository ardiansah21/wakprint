@extends('layouts.pengelola')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="row justify-content-left ml-0 mb-3" style="font-size: 18px;">
                <label class="font-weight-bold mr-3">
                    {{__('Percetakan')}}
                </label>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"
                style="font-size: 18px;">
                <a class="nav-link mb-2" id="v-pills-beranda-tab" href="{{ route('partner.home') }}" role="tab"
                    aria-controls="v-pills-beranda" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        home
                    </i>
                    {{__('Beranda')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-pesanan-tab" href="{{ route('partner.pesanan') }}" role="tab"
                    aria-controls="v-pills-pesanan" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        shopping_cart
                    </i>
                    {{__('Pesanan')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-saldo-tab" href="{{ route('partner.saldo') }}" role="tab"
                    aria-controls="v-pills-saldo" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        account_balance_wallet
                    </i>
                    {{__('Saldo')}}
                </a>
                <a class="nav-link active mb-2" id="v-pills-produk-tab"
                    href="{{ route('partner.produk') }}" role="tab" aria-controls="v-pills-produk" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        print
                    </i>
                    {{__('Produk')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-promo-tab" href="{{ route('partner.promo') }}" role="tab"
                    aria-controls="v-pills-promo" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        local_offer
                    </i>
                    {{__('Promo')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-atk-tab" href="{{ route('partner.atk') }}" role="tab"
                    aria-controls="v-pills-atk" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        architecture
                    </i>
                    {{__('Alat Tulis Kantor')}}
                </a>
                <a class="nav-link mb-2" id="v-pills-info-tab" href="{{ route('partner.info') }}" role="tab"
                    aria-controls="v-pills-info" aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        contact_support
                    </i>
                    {{__('Info dan Bantuan')}}
                </a>
                <a class="nav-link mb-2 mt-4" id="v-pills-keluar-tab" data-toggle="pill" href="#v-pills-keluar"
                    role="tab" aria-controls="v-pills-keluar" aria-selected="true"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons text-primary-danger md-36 align-middle mr-2">
                        exit_to_app
                    </i>
                    {{__('Keluar')}}
                </a>
                <form id="logout-form" action="{{ route('partner.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="tab-content col-md-8">
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

                                            <a href="{{ route('partner.produk.duplicate') }}"
                                                class="material-icons md-18 badge-sm badge-light p-1 mr-2"
                                                style="border-radius: 5px;">
                                                file_copy
                                            </a>
                                            <a href="" style="color: black;">
                                                <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2"
                                                    style="border-radius: 5px;">
                                                    edit
                                                </i>
                                            </a>
                                            <i class="material-icons md-18 badge-sm bg-primary-danger p-1 mr-2"
                                                style="border-radius: 5px;">
                                                delete
                                            </i>
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
        </div>
    </div>
</div>
@endsection
