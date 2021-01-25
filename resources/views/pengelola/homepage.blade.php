@extends('layouts.pengelola')

@section('content')
<div id="v-pills-beranda" role="tabpanel">
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row justify-content-between mb-5 ml-0 mr-0">
        <div class="col-md-3 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px; width:100%;">
                {{count($partner->pesanans)}}
            </label>
            <br>
            <label class="font-weight-bold" style="font-size: 18px;width:100%;">
                {{__('Total Pesanan')}}
            </label>
        </div>
        <div class=" col-md-4 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px; width:100%;">
                {{$totalPelanggan}}
            </label>
            <br>
            <label class="font-weight-bold text-break text-truncate" style="font-size: 18px; width:100%;">
                {{__('Total Pelanggan')}}
            </label>
        </div>

        <div class="col-md-4 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px;
                                    width:100%;">
                {{$partner->rating_toko}}
            </label>
            <br>
            <label class="font-weight-bold text-break" style="font-size: 18px; width:100%;">
                {{__('Rating Tempat Percetakan')}}
            </label>
        </div>
    </div>
    <label class="font-weight-bold mb-4 ml-0 mr-0" style="font-size: 36px;">
        {{__('Pesanan Masuk')}}
    </label>
    <div class="table-scrollbar mb-5 ml-0 mr-0">
        <table class="table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px; font-size:16px;">
                <tr>
                    <th scope="col-md-auto">{{__('ID')}}</th>
                    <th scope="col-md-auto">{{__('Waktu')}}</th>
                    <th scope="col-md-auto">{{__('Tanggal')}}</th>
                    <th scope="col-md-auto">{{__('Jumlah Dokumen')}}</th>
                    <th scope="col-md-auto">{{__('Pengambilan')}}</th>
                    <th scope="col-md-auto">{{__('Status')}}</th>
                </tr>
            </thead>
            <tbody style="font-size:12px;">
                @foreach ($partner->pesanans as $p => $value)
                    @if ($value->status === "Pending" && $value->transaksiSaldo->status === "Berhasil")
                        <tr onclick="window.location.href='{{ route('partner.detail.pesanan',$value->id_pesanan) }}'">
                            <td scope="row">{{$value->id_pesanan}}</td>
                            <td>{{Carbon::parse($value->updated_at)->translatedFormat('H:i')}} WIB</td>
                            <td>{{Carbon::parse($value->updated_at)->translatedFormat('d F Y')}}</td>
                            <td>{{count($value->konfigurasiFile)}}</td>
                            <td>
                                @if ($value->metode_penerimaan != "Ditempat")
                                    {{__('Antar ke Rumah')}}
                                @else
                                    {{__('Ambil di Tempat')}}
                                @endif
                            </td>
                            <td>{{$value->status}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')

@endsection
