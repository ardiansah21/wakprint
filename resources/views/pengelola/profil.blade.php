@extends('layouts.pengelola')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="row justify-content-left ml-0 mb-3"
                style="font-size: 18px;">
                <label class="font-weight-bold mr-3">
                    {{__('Percetakan')}}
                </label>
                <!-- Rounded switch -->
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="nav flex-column nav-pills"
                id="v-pills-tab"
                role="tablist"
                aria-orientation="vertical"
                style="font-size: 18px;">
                <a class="nav-link mb-2"
                    id="v-pills-beranda-tab"
                    data-toggle="pill"
                    href="#v-pills-beranda"
                    role="tab"
                    aria-controls="v-pills-beranda"
                    aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        home
                    </i>
                    {{__('Beranda')}}
                </a>
                <a class="nav-link mb-2"
                    id="v-pills-pesanan-tab"
                    data-toggle="pill"
                    href="#v-pills-pesanan"
                    role="tab"
                    aria-controls="v-pills-pesanan"
                    aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        shopping_cart
                    </i>
                    {{__('Pesanan')}}
                </a>
                <a class="nav-link mb-2"
                    id="v-pills-saldo-tab"
                    data-toggle="pill"
                    href="#v-pills-saldo"
                    role="tab"
                    aria-controls="v-pills-saldo"
                    aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        account_balance_wallet
                    </i>
                    {{__('Saldo')}}
                </a>
                <a class="nav-link mb-2"
                    id="v-pills-produk-tab"
                    data-toggle="pill"
                    href="#v-pills-produk"
                    role="tab"
                    aria-controls="v-pills-produk"
                    aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        print
                    </i>
                    {{__('Produk')}}
                </a>
                <a class="nav-link mb-2"
                    id="v-pills-promo-tab"
                    data-toggle="pill"
                    href="#v-pills-promo"
                    role="tab"
                    aria-controls="v-pills-promo"
                    aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        local_offer
                    </i>
                    {{__('Promo')}}
                </a>
                <a class="nav-link mb-2"
                    id="v-pills-atk-tab"
                    data-toggle="pill"
                    href="#v-pills-atk"
                    role="tab"
                    aria-controls="v-pills-atk"
                    aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        architecture
                    </i>
                    {{__('Alat Tulis Kantor')}}
                </a>
                <a class="nav-link mb-2"
                    id="v-pills-info-tab"
                    data-toggle="pill"
                    href="#v-pills-info"
                    role="tab"
                    aria-controls="v-pills-info"
                    aria-selected="true">
                    <i class="material-icons md-36 align-middle mr-2">
                        contact_support
                    </i>
                    {{__('Info dan Bantuan')}}
                </a>
                <a class="nav-link mb-2 mt-4"
                    id="v-pills-keluar-tab"
                    data-toggle="pill"
                    href="#v-pills-keluar"
                    role="tab"
                    aria-controls="v-pills-keluar"
                    aria-selected="true"
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
            <div class="tab-pane fade show"
                    id="v-pills-beranda"
                    role="tabpanel">
                    <div class="row justify-content-between mb-5 ml-0 mr-0">
                        <div class="col-md-3 bg-light-purple p-4 text-center"
                            style="border-radius:10px;">
                            <label class="font-weight-bold text-break text-truncate"
                                    style="font-size: 48px;
                                        width:100%;">
                                    {{__('43')}}
                            </label>
                            <br>
                            <label class="font-weight-bold"
                                style="font-size: 18px;
                                    width:100%;">
                                {{__('Total Pesanan')}}
                            </label>
                        </div>
                        <div class=" col-md-4 bg-light-purple p-4 text-center"
                            style="border-radius:10px;">
                            <label class="font-weight-bold text-break text-truncate"
                                style="font-size: 48px;
                                width:100%;">
                                {{__('30')}}
                            </label>
                            <br>
                            <label class="font-weight-bold text-break text-truncate"
                                style="font-size: 18px;
                                width:100%;">
                                {{__('Total Pelanggan')}}
                            </label>
                        </div>

                        <div class="col-md-4 bg-light-purple p-4 text-center"
                            style="border-radius:10px;">
                            <label class="font-weight-bold text-break text-truncate"
                                style="font-size: 48px;
                                    width:100%;">
                                {{__('4.5')}}
                            </label>
                            <br>
                            <label class="font-weight-bold text-break"
                                style="font-size: 18px;
                                    width:100%;">
                                {{__('Rating Tempat Percetakan')}}
                            </label>
                        </div>
                    </div>
                    <label class="font-weight-bold mb-4 ml-0 mr-0"
                        style="font-size: 36px;">
                        {{__('Pesanan Masuk')}}
                    </label>
                    <div class="table-scrollbar mb-5 ml-0 mr-0">
                        <table class="table table-hover">
                            <thead class="bg-primary-purple text-white"
                                style="border-radius:25px 25px 15px 15px;
                                    font-size:16px;">
                                <tr>
                                    <th scope="col-md-auto">{{__('No')}}</th>
                                    <th scope="col-md-auto">{{__('Waktu')}}</th>
                                    <th scope="col-md-auto">{{__('Tanggal')}}</th>
                                    <th scope="col-md-auto">{{__('Jumlah Dokumen')}}</th>
                                    <th scope="col-md-auto">{{__('Pengambilan')}}</th>
                                    <th scope="col-md-auto">{{__('Status')}}</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:12px;">

                                {{-- @foreach ($collection as $item) --}}
                                    <tr>
                                        
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
            <div class="tab-pane fade show active"
                role="tabpanel">
                <div class="pl-2 pr-2 pt-2 pb-2 mb-4"
                    style="height:210px; 
                    border-radius:5px; 
                    background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg');
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                    justify-content: space-between;
                    flex-direction: column;
                    display: flex;">
                    <label class="font-weight-bold mb-5 ml-2"
                        style="font-size: 24px;">
                        {{$partner->nama_toko}}
                    </label>
                    <div class="">
                        <a href="{{ route('partner.profile.edit') }}" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4"
                        style="border-radius:30px;
                            font-size: 16px;
                            float:right;">
                            {{__('Ubah Profil')}}
                        </a>
                    </div>
                </div>
                <div class="table-scrollbar"
                    style="font-size:18px;">
                    <div class="row justify-content-left mb-0">
                        <label class="col-4 ml-0">
                            {{__('Nama Pemilik')}}
                        </label>
                        <label class="col-8 SemiBold ml-0">
                            {{$partner->nama_lengkap}}
                        </label>
                    </div>
                    <div class="row justify-content-left mb-0">
                        <label class="col-4 ml-0">
                            {{__('Nomor HP')}}
                        </label>
                        <label class="col-8 SemiBold ml-0">
                            {{$partner->nomor_hp}}
                        </label>
                    </div>
                    <div class="row justify-content-left mb-0">
                        <label class="col-4 ml-0">
                            {{__('Nama Bank')}}
                        </label>
                        <label class="col-8 SemiBold ml-0">
                            {{$partner->nama_bank}}
                        </label>
                    </div>
                    <div class="row justify-content-left mb-0">
                        <label class="col-4 ml-0">
                            {{__('Nomor Rekening')}}
                        </label>
                        <label class="col-8 SemiBold ml-0">
                            {{$partner->nomor_rekening}}
                        </label>
                    </div>
                    <div class="row justify-content-left mb-2">
                        <label class="col-4 ml-0">
                            {{__('Alamat')}}
                        </label>
                        <label class="col-8 SemiBold ml-0">
                            {{$partner->alamat_toko}}
                        </label>
                    </div>
                    <div class="row justify-content-left mb-4">
                        <label class="col-4 ml-0">
                            {{__('Deskripsi Tempat Percetakan')}}
                        </label>
                        <label class="col-8 SemiBold">
                            {{$partner->deskripsi_toko}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade ml-0 mr-0"
                id="v-pills-pesanan"
                role="tabpanel">
                @include('pengelola.pesanan')
            </div>
            <div class="tab-pane fade"
                id="v-pills-saldo"
                role="tabpanel">
                @include('pengelola.saldo')
            </div>
            <div class="tab-pane fade"
                id="v-pills-produk"
                role="tabpanel">
                @include('pengelola.produk')
            </div>
            <div class="tab-pane fade"
                id="v-pills-promo"
                role="tabpanel">
                @include('pengelola.promo')
            </div>
            <div class="tab-pane fade"
                id="v-pills-atk"
                role="tabpanel">
                @include('pengelola.atk')
            </div>
            <div class="tab-pane fade"
                id="v-pills-info"
                role="tabpanel">
                @include('pengelola.info_bantuan')
            </div>
        </div>
    </div>
</div>
@endsection

