@extends('layouts.pengelola')

@section('content')

<div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
    <div class="row justify-content-between mb-5 ml-0 mr-0">
        <div class="col-md-3 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px; width:100%;">
                {{__('43')}}
            </label>
            <br>
            <label class="font-weight-bold" style="font-size: 18px;width:100%;">
                {{__('Total Pesanan')}}
            </label>
        </div>
        <div class=" col-md-4 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px;
                                width:100%;">
                {{__('30')}}
            </label>
            <br>
            <label class="font-weight-bold text-break text-truncate" style="font-size: 18px;
                                width:100%;">
                {{__('Total Pelanggan')}}
            </label>
        </div>

        <div class="col-md-4 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px;
                                    width:100%;">
                {{__('4.5')}}
            </label>
            <br>
            <label class="font-weight-bold text-break" style="font-size: 18px;
                                    width:100%;">
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
@endsection
