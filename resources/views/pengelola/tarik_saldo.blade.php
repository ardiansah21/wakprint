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
                <a class="nav-link active mb-2" id="v-pills-saldo-tab" href="{{ route('partner.saldo') }}" role="tab"
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
            <div class="tab-pane fade show active" role="tabpanel">
                <div class="container card shadow-sm p-4">
                    <span>
                        <a class="close material-icons md-32" href="{{ route('partner.saldo') }}">
                            close
                        </a>
                        <label class="font-weight-bold ml-0 mb-5"
                            style="font-size: 36px;">
                            {{__('Tarik Saldo')}}
                        </label>
                    </span>
                    <br>
                    <label class="font-weight-bold mb-0 ml-1"
                    style="font-size: 14px;">
                        {{__('Nama Pemilik Rekening')}}
                    </label>
                    <br>
                    <label class="mb-2 ml-1"
                        style="font-size: 16px;">
                        {{__('Agus')}}
                    </label>
                    <br>
                    <label class="font-weight-bold mb-0 ml-1"
                    style="font-size: 14px;">
                        {{__('Nama Bank')}}
                    </label>
                    <br>
                    <label class="mb-2 ml-1"
                        style="font-size: 16px;">
                        {{__('BRI')}}
                    </label>
                    <br>
                    <label class="font-weight-bold mb-0 ml-1"
                    style="font-size: 14px;">
                        {{__('Nomor Rekening')}}
                    </label>
                    <br>
                    <label class="mb-2 ml-1"
                        style="font-size: 16px;">
                        {{__('016748359004048')}}
                    </label>
                    <br>
                    <label class="font-weight-bold mb-2 ml-1"
                    style="font-size: 14px;">
                        {{__('Jumlah Saldo yang Ditarik')}}
                    </label>
                    <br>
                    <form>
                        <div class="row justify-content-between mb-2 ml-0">
                            <label class="col-auto text-center mb-0 mr-0"
                                style="font-size: 16px;">
                                {{__('Rp.')}}
                            </label>
                            <div class="col-md-11 form-group mb-4">
                                <input type="text"
                                    class="form-control form-control-lg border-primary-purple pt-2 pb-2"
                                    placeholder="300.000"
                                    aria-label="300.000"
                                    aria-describedby="inputGroup-sizing-sm"
                                    style="font-size: 16px;">
                            </div>
                        </div>
                        <div class="container bg-light-purple ml-0 mb-5"
                            style="height:200px;
                                border-radius:10px;">
                            <div class="short-scrollbar">
                                <div class="p-3">
                                    <label class="SemiBold mb-4"
                                        style="font-size:24px;">
                                        {{__('Info Tarik Saldo, Syarat, dan Ketentuan')}}
                                    </label>
                                    <p class=" mr-3 mb-4"
                                        style="font-size:16px;">
                                        {{__('Ini adalah halaman informasi untuk penarikan saldo serta syarat juga ketentuan apa saja yang harus di miliki oleh si penarik saldo.
                                        Silahkan perhatikan baik baik apa saja yang harus diperhatikan pada syarat.
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, assumenda nostrum explicabo numquam eius cupiditate ducimus illo optio deserunt pariatur quod, magni necessitatibus fugiat, fugit ad unde qui quo sed!
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde consequatur quae expedita soluta repellat, libero itaque saepe alias sed sapiente totam, nobis minus deleniti natus, laboriosam molestiae eaque odit accusantium.
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae autem sapiente cumque iusto at iure aliquam fuga, et repellat similique earum libero nulla voluptate distinctio. Temporibus labore ipsam provident est!')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end ml-0 mr-0 mb-3">
                            <div class="form-group mr-3">
                                <button class="btn btn-default btn-lg text-primary-purple SemiBold pl-5 pr-5 mb-0"
                                style="border-radius:30px;
                                    font-size:18px;">
                                    {{__('Batal')}}
                                </button>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                                    style="border-radius:30px;
                                    font-size:18px;">
                                    {{__('Konfirmasi')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
