@auth
@php
$m = Auth::user();
@endphp
@endauth

<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <div class="row justify-content-between mb-2 ml-0 mr-0">
            <div class="">
                <label class="font-weight-bold" style="font-size: 48px;">
                    {{__('Profil Saya') }}
                </label>
            </div>
            <div class="my-auto">
                <a class="align-self-center text-right text-primary-purple" href="{{route('profile.edit')}}"
                    style="font-size: 18px;">
                    {{__('Ubah Profil') }}
                </a>
            </div>
        </div>
        <table class="table borderless align-middle mb-5" style="font-size: 24px;
            table-layout: fixed;
            word-wrap: break-word;
            border-collapse: separate;
            border-spacing: 0 0em;">
            <tbody class="ml-0 mr-0">
                <tr class="mb-0">
                    <td class="SemiBold">
                        {{__('Nama Lengkap') }}
                    </td>
                    <td>
                        {{ $m->nama_lengkap }}
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{__('Tanggal Lahir') }}
                    </td>
                    <td>
                        {{ $tanggalLahir }}
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{__('Jenis Kelamin') }}
                    </td>
                    <td>
                        @if ($m->jenis_kelamin === 'L')
                        {{__('Laki-Laki') }}
                        @elseif ($m->jenis_kelamin === 'P')
                        {{__('Perempuan') }}
                        @else{
                        {{__('-') }}
                        }
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{__('Email') }}
                    </td>
                    <td class="row justify-content-left text-danger ml-0">
                        <a class="col-md-9 p-0 text-danger text-truncate" style="font-size: 24px;"
                            href="#">{{ $m->email }}
                        </a>
                        <i class="col-md-2 align-self-center fa fa-warning ml-2"></i>
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{__('Nomor HP') }}
                    </td>
                    <td>
                        {{ $m->nomor_hp }}
                    </td>
                </tr>
            </tbody>
        </table>
        <h1 class="font-weight-bold mb-5 ml-2" style="font-size: 48px;">{{__('Konfigurasi Terakhir') }}</h1>
        <div class="table-scrollbar mb-5 mr-0">
            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white" style="font-size: 18px;">
                    <tr>
                        <th scope="col-md-auto">{{__('ID') }}</th>
                        <th scope="col-md-auto">{{__('File') }}</th>
                        <th scope="col-md-auto">{{__('Kapan') }}</th>
                        <th scope="col-md-auto">{{__('Biaya') }}</th>
                        <th scope="col-md-auto">{{__('Sisa Waktu') }}</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @foreach ($collection as $item) --}}
                    <tr style="font-size: 14px;">

                        {{-- @foreach ($collection as $item) --}}
                        <td scope="row">{{__('00000001') }}</td>
                        <td><a href="#">{{__('Skripsilageee.pdf') }}</a></td>
                        <td>{{__('5 hour ago') }}</td>
                        <td>{{__('Rp. 12.000') }}</td>
                        <td>{{__('1h 5m') }}
                            <span class="material-icons md-18 align-middle text-danger ml-2">
                                delete
                            </span>
                        </td>
                        {{-- @endforeach --}}

                    </tr>
                    {{-- @endforeach --}}

                </tbody>
            </table>
        </div>
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
            alert(msg);
            }
        </script>
    </div>
    <div class="tab-pane fade ml-2 mr-0" id="v-pills-saldo" role="tabpanel">
        @include('member.topup_saldo')
    </div>
    <div class="tab-pane fade ml-2 mr-0" id="v-pills-riwayat" role="tabpanel">
        @include('member.riwayat')
    </div>
    <div class="tab-pane fade ml-2" id="v-pills-pesanan" role="tabpanel">
        @include('member.pesanan')
    </div>
    <div class="tab-pane fade ml-2" id="v-pills-favorit" role="tabpanel">
        @include('member.produk_favorit')
    </div>
    <div class="tab-pane fade ml-2" id="v-pills-ulasan" role="tabpanel">
        @include('member.ulasan')
    </div>


{{-- <div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-5">
            <div class="bg-light-purple text-center"
                style="height:300px; border-radius:0px 25px 25px 0px; position: relative;">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                    class="img-responsive" alt="" width="300px" height="300px" style="border-radius:8px 8px 8px 8px;">
                <div class="bg-dark" style="position: absolute; 
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, 140%); opacity:80%;
                    color: white;
                    width:300px;
                    border-radius:0px 0px 8px 8px;">
                    <label class="font-weight-bold text-truncate mx-auto"
                        style="font-size: 30px; width:100%;">{{ $m->nama_lengkap }}</label>
                </div>
            </div>
            <div class="mt-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link SemiBold mb-4" id="v-pills-alamat-tab" data-toggle="link"
                        href="{{ route('alamat') }}" role="tab" aria-controls="v-pills-alamat" aria-selected="true"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">
                            location_on
                        </i>
                        {{__('Medan ID') }}
                    </a>
                    <a class="nav-link SemiBold mb-2" id="v-pills-saldo-tab" data-toggle="pill" href="#v-pills-saldo"
                        role="tab" aria-controls="v-pills-saldo" aria-selected="false" style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">account_balance_wallet</i>
                        Rp. {{ $m->jumlah_saldo }}
                    </a>
                    <a class="nav-link SemiBold mb-4" id="v-pills-riwayat-tab mb-3" data-toggle="pill"
                        href="#v-pills-riwayat" role="tab" aria-controls="v-pills-riwayat" aria-selected="false"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">history</i>
                        {{__('Riwayat Transaksi') }}
                    </a>
                    <a class="nav-link SemiBold mb-2" id="v-pills-konfigurasi-tab" data-toggle="link"
                        href="{{ route('konfigurasiPesanan') }}" role="tab" aria-controls="v-pills-konfigurasi"
                        aria-selected="false" style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">phonelink_setup</i>
                        {{__('Konfigurasi File') }}
                    </a>
                    <a class="nav-link SemiBold mb-4" id="v-pills-pesanan-tab" data-toggle="pill"
                        href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan" aria-selected="false"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">shopping_cart</i>
                        {{__('Pesanan') }}
                    </a>
                    <a class="nav-link SemiBold mb-2" id="v-pills-favorit-tab" data-toggle="pill"
                        href="#v-pills-favorit" role="tab" aria-controls="v-pills-favorit" aria-selected="false"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">favorite</i>
                        {{__('Favorit') }}
                    </a>
                    <a class="nav-link SemiBold mb-4" id="v-pills-ulasan-tab" data-toggle="pill" href="#v-pills-ulasan"
                        role="tab" aria-controls="v-pills-ulasan" aria-selected="false" style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">rate_review</i>
                        {{__('Ulasan') }}
                    </a>
                    <a class="nav-link SemiBold" id="v-pills-keluar-tab" data-toggle="pill" href="{{ route('logout') }}"
                        role="tab" aria-controls="v-pills-keluar" aria-selected="true" style="font-size: 24px;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons align-middle md-32 mr-2">exit_to_app</i>
                        {{__('Keluar') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-content col-md-7">
            <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
                <div class="row justify-content-between mb-2 ml-0 mr-0">
                    <div class="">
                        <label class="font-weight-bold" style="font-size: 48px;">
                            {{__('Profil Saya') }}
                        </label>
                    </div>
                    <div class="my-auto">
                        <a class="align-self-center text-right text-primary-purple" href="{{route('profile.edit')}}"
                            style="font-size: 18px;">
                            {{__('Ubah Profil') }}
                        </a>
                    </div>
                </div>
                <table class="table borderless align-middle" style="font-size: 24px;
                    table-layout: fixed;
                    word-wrap: break-word;
                    border-collapse: separate;
                    border-spacing: 0 0em;">
                    <tbody class="ml-0 mr-0">
                        <tr class="mb-0">
                            <td class="SemiBold">
                                {{__('Nama Lengkap') }}
                            </td>
                            <td>
                                {{ $m->nama_lengkap }}
                            </td>
                        </tr>
                        <tr>
                            <td class="SemiBold">
                                {{__('Tanggal Lahir') }}
                            </td>
                            <td>
                                {{ $tanggalLahir }}
                            </td>
                        </tr>
                        <tr>
                            <td class="SemiBold">
                                {{__('Jenis Kelamin') }}
                            </td>
                            <td>
                                @if ($m->jenis_kelamin === 'L')
                                {{__('Laki-Laki') }}
                                @elseif ($m->jenis_kelamin === 'P')
                                {{__('Perempuan') }}
                                @else{
                                {{__('-') }}
                                }
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="SemiBold">
                                {{__('Email') }}
                            </td>
                            <td class="row justify-content-left text-danger ml-0">
                                <a class="col-md-9 p-0 text-danger text-truncate" style="font-size: 24px;"
                                    href="#">{{ $m->email }}
                                </a>
                                <i class="col-md-2 align-self-center fa fa-warning ml-2"></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="SemiBold">
                                {{__('Nomor HP') }}
                            </td>
                            <td>
                                {{ $m->nomor_hp }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h1 class="font-weight-bold mb-5 ml-2" style="font-size: 48px;">{{__('Konfigurasi Terakhir') }}</h1>
                <div class="table-scrollbar mb-5 mr-0">
                    <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                        <thead class="bg-primary-purple text-white" style="font-size: 18px;">
                            <tr>
                                <th scope="col-md-auto">{{__('ID') }}</th>
                                <th scope="col-md-auto">{{__('File') }}</th>
                                <th scope="col-md-auto">{{__('Kapan') }}</th>
                                <th scope="col-md-auto">{{__('Biaya') }}</th>
                                <th scope="col-md-auto">{{__('Sisa Waktu') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr style="font-size: 14px;">

                                <td scope="row">{{__('00000001') }}</td>
                                <td><a href="#">{{__('Skripsilageee.pdf') }}</a></td>
                                <td>{{__('5 hour ago') }}</td>
                                <td>{{__('Rp. 12.000') }}</td>
                                <td>{{__('1h 5m') }}
                                    <span class="material-icons md-18 align-middle text-danger ml-2">
                                        delete
                                    </span>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
                <script>
                    var msg = '{{Session::get('alert')}}';
                    var exist = '{{Session::has('alert')}}';
                    if(exist){
                      alert(msg);
                    }
                  </script>
            </div>
            <div class="tab-pane fade ml-2 mr-0" id="v-pills-saldo" role="tabpanel">
                @include('member.topup_saldo')
            </div>
            <div class="tab-pane fade ml-2 mr-0" id="v-pills-riwayat" role="tabpanel">
                @include('member.riwayat')
            </div>
            <div class="tab-pane fade ml-2" id="v-pills-pesanan" role="tabpanel">
                @include('member.pesanan')
            </div>
            <div class="tab-pane fade ml-2" id="v-pills-favorit" role="tabpanel">
                @include('member.produk_favorit')
            </div>
            <div class="tab-pane fade ml-2" id="v-pills-ulasan" role="tabpanel">
                @include('member.ulasan')
            </div>
        </div>
    </div>
</div> --}}
@endsection