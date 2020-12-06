@extends('layouts.member')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="ml-2 mr-0" role="tabpanel">
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Pesanan Saya') }}</h1>
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
                </tbody>
            </table>
        </div>
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Pesanan Tertunda Saya') }}</h1>
        <div class="table-scrollbar mb-5 ml-0 pr-2">
            <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
                <thead class="bg-primary-purple text-white align-middle">
                    <tr style="font-size: 18px;">
                        <th scope="col-md-auto">{{__('ID') }}</th>
                        <th scope="col-md-auto">{{__('Nama Percetakan') }}</th>
                        <th scope="col-md-auto">{{__('Metode') }}</th>
                        <th scope="col-md-auto">{{__('Total File') }}</th>
                        <th scope="col-md-auto">{{__('Tanggal') }}</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @foreach ($pesanan as $p)
                        @if (empty($p->status))
                            <tr class="cursor-pointer" onclick="window.location.href='{{ route('konfigurasi.pesanan') }}'">
                                <td scope="row">{{$p->id_pesanan}}</td>
                                <td>{{$p->partner->nama_toko}}</td>
                                <td>
                                    @if ($p->metode_penerimaan != "Ditempat")
                                        {{__('Antar ke Rumah')}}
                                    @else
                                        {{__('Ambil di Tempat')}}
                                    @endif
                                </td>
                                <td>{{count($p->konfigurasiFile)}}</td>
                                <td>{{Carbon::parse($p->updated_at)->translatedFormat('d F Y')}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
