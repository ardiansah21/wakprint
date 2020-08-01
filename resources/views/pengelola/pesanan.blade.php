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
                    <a class="nav-link active mb-2" id="v-pills-pesanan-tab" href="{{ route('partner.pesanan') }}" role="tab"
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
                    <a class="nav-link mb-2" id="v-pills-produk-tab" href="{{ route('partner.produk') }}" role="tab"
                        aria-controls="v-pills-produk" aria-selected="true">
                        <i class="material-icons md-36 align-middle mr-2">
                            print
                        </i>
                        {{__('Produk')}}
                    </a>
                    <a class="nav-link mb-2" id="v-pills-promo-tab"  href="{{ route('partner.promo') }}" role="tab"
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
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-10">
                            <div class="form-group search-input">
                                <div class="main-search-input-item">
                                    <input type="text"
                                        role="search"
                                        class="form-control"
                                        placeholder="Cari pesanan anda disini..."
                                        aria-label="Cari percetakan atau produk disini"
                                        aria-describedby="basic-addon2"
                                        style="border:0px solid white;
                                            border-radius:30px;
                                            font-size:16px;">
                                        <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                                            style="position: absolute;
                                                top: 50%; left: 95%;
                                                transform: translate(-50%, -50%);
                                                -ms-transform: translate(-50%, -50%);">
                                            search
                                        </i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mr-0">
                            <div class="form-group dropdown">
                                <button class="btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray"
                                    id="filter-pesanan"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    style="font-size: 16px;">
                                    {{__('Semua')}}
                                </button>
                                <div class="dropdown-menu"
                                    aria-labelledby="filter-pesanan"
                                    style="font-size: 16px;">
                                    <a class="dropdown-item"
                                        href="#">
                                        {{__('Terbaru')}}
                                    </a>
                                    <a class="dropdown-item"
                                        href="#">
                                        {{__('Harga Tertinggi')}}
                                    </a>
                                    <a class="dropdown-item"
                                        href="#">
                                        {{__('Harga Terendah')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollbar mb-5 mr-0 pr-2">
                        <table class="table table-hover">
                            <thead class="bg-primary-purple text-white"
                                style="border-radius:25px 25px 15px 15px;">
                                <tr style="font-size: 16px;">
                                    <th scope="col-md-auto">{{__('No')}}</th>
                                    <th scope="col-md-auto">{{__('Waktu')}}</th>
                                    <th scope="col-md-auto">{{__('Tanggal')}}</th>
                                    <th scope="col-md-auto">{{__('Jumlah Dokumen')}}</th>
                                    <th scope="col-md-auto">{{__('Pengambilan')}}</th>
                                    <th scope="col-md-auto">{{__('Status')}}</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px;">

                                {{-- @foreach ($collection as $item) --}}
                                    <tr onclick="window.location.href='{{ route('partner.detail.pesanan') }}'">

                                        {{-- @foreach ($collection as $item) --}}
                                            <td scope="row">{{__('1')}}</td>
                                            <td>{{__('09:34')}}</td>
                                            <td>{{__('5/7/2020')}}</td>
                                            <td>{{__('2')}}</td>
                                            <td>{{__('Ambil Sendiri')}}</td>
                                            <td>{{__('Pending')}}</td>
                                        {{-- @endforeach --}}

                                    </tr>
                                {{-- @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


