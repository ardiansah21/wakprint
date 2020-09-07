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
    {{-- <div class="tab-pane fade ml-2 mr-0" id="v-pills-saldo" role="tabpanel">
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
    </div> --}}

@endsection
