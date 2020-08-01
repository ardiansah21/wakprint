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
                <a class="nav-link active mb-2" id="v-pills-info-tab" href="{{ route('partner.info') }}" role="tab"
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
                <div class="row justify-content-left mb-0 ml-0 mr-0">
                    <label class="text-primary-purple font-weight-bold ml-0 mr-4"
                        style="font-size: 48px;">
                        {{__('WAKPRINT')}}
                    </label>
                    <a class="align-self-center text-right mr-4"
                        href="">
                        <i class="material-icons md-36"
                            style="color: #C4C4C4">
                            help
                        </i>
                    </a>
                    <div class="my-auto">
                        <button class="btn btn-sm btn-danger bg-primary-danger font-weight-bold pl-4 pr-4"
                            style="border-radius:30px;
                                font-size:16px;">
                            {{__('Laporkan')}}
                        </button>
                    </div>
                </div>
                <label class="font-weight-bold mb-4 ml-0"
                    style="font-size: 18px;">
                    {{__('Wakprint - Web Versi 1.0')}}
                </label>
                <p class="mb-4 ml-0"
                    style="font-size: 16px;">
                    {{__('Wakprint adalah platform yang menghubungkan semua printer di seluruh Indonesia secara online untuk menjawab kebutuhan pencetakan dokumen Anda. Ribuan printer yang telah menjadi rekanan Wakprint, dapat diakses oleh Anda dengan mudah. Kirimkan dokumen dan ambil serta bayar dokumen anda langsung ke rekanan kami. Sekarang, mencetak dokumen dapat dilakukan di mana pun dengan
                    mudah pada jaringan printer di Wakprint.com
                    Untuk informasi lebih lanjut dapat Anda lihat selengkapnya di sosial media kami dibawah dan support terus karya anak bangsa untuk Indonesia lebih maju dan sejahtera.')}}
                </p>
                <div class="row justify-content-left mb-5 ml-0 mr-0">
                    <div class="col-md-auto ml-0">
                        <img src="{{url('img/instagram.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                    </div>
                    <div class="col-md-auto">
                        <img src="{{url('img/facebook.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                    </div>
                    <div class="col-md-auto">
                        <img src="{{url('img/youtube.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                    </div>
                    <div class="col-md-auto">
                        <img src="{{url('img/whatsapp.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
