@extends('layouts.member')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <div class="row justify-content-between mb-2 ml-0 mr-0">
            <div class="">
                <label class="font-weight-bold" style="font-size: 48px;">
                    {{ __('Profil Saya') }}
                </label>
            </div>
            <div class="my-auto">
                <a class="align-self-center text-right text-primary-purple" href="{{ route('profile.edit') }}"
                    style="font-size: 18px;">
                    {{ __('Ubah Profil') }}
                </a>
            </div>
        </div>
        <table class="table borderless align-middle mb-5" style="font-size: 24px; table-layout: fixed; word-wrap: break-word; border-collapse: separate; border-spacing: 0 0em;">
            <tbody class="ml-0 mr-0">
                <tr class="mb-0">
                    <td class="SemiBold">
                        {{ __('Nama Lengkap') }}
                    </td>
                    <td>
                        {{ $member->nama_lengkap }}
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Tanggal Lahir') }}
                    </td>
                    <td>
                        {{ $tanggalLahir }}
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Jenis Kelamin') }}
                    </td>
                    <td>
                        @if ($member->jenis_kelamin === 'L')
                            {{ __('Laki-Laki') }}
                        @elseif ($member->jenis_kelamin === 'P')
                            {{ __('Perempuan') }}
                        @else
                            {{ __('-') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Email') }}
                    </td>
                    <td class="row justify-content-left ml-0">
                        @if (!empty($member->email_verified_at))
                            <label class="text-truncate" style="font-size: 24px;">
                                {{ $member->email }}
                            </label>
                        @else
                            <a class="col-md-9 p-0 text-danger text-truncate" style="font-size: 24px;"
                                href="#">{{ $member->email }}
                            </a>
                            <a class="col-md-2 text-danger align-self-center" style="font-size: 24px;" href="#">
                                <i class="fa fa-warning ml-2"></i>
                            </a>
                        @endif

                    </td>
                </tr>
                <tr>
                    <td class="SemiBold">
                        {{ __('Nomor HP') }}
                    </td>
                    <td>
                        {{ $member->nomor_hp }}
                    </td>
                </tr>
            </tbody>
        </table>
        <h1 class="font-weight-bold mb-5 ml-2" style="font-size: 48px;">{{__('Konfigurasi Terakhir') }}</h1>
        <div class="table-scrollbar mb-5 ml-0 pr-2">
            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white">
                    <tr style="font-size: 18px;">
                        <th scope="col-md-auto">{{__('ID') }}</th>
                        <th scope="col-md-auto">{{__('Tanggal') }}</th>
                        <th scope="col-md-auto">{{__('Total File') }}</th>
                        <th scope="col-md-auto">{{__('Metode') }}</th>
                        <th scope="col-md-auto">{{__('Biaya') }}</th>
                        <th scope="col-md-auto">{{__('Status') }}</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @if (!empty($pesanan))
                        @foreach ($pesanan as $p)
                            @if (!empty($p->status))
                                <tr class="cursor-pointer" onclick="window.location.href='{{ route('konfirmasi.pembayaran',$p->id_pesanan) }}'">
                                    <td scope="row">{{$p->id_pesanan}}</td>
                                    <td>{{Carbon::parse($p->updated_at)->translatedFormat('d F Y')}}</td>
                                    <td>{{count($p->konfigurasiFile)}}</td>
                                    <td>
                                        @if ($p->metode_penerimaan != "Ditempat")
                                            {{__('Antar ke Rumah')}}
                                        @else
                                            {{__('Ambil di Tempat')}}
                                        @endif
                                    </td>
                                    <td>{{rupiah($p->biaya)}}</td>
                                    <td>{{$p->status}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
