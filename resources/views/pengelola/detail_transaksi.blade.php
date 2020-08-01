@extends('layouts.pengelola')

@section('content')

<div class="tab-pane fade" id="v-pills-beranda" role="tabpanel">
    <div class="row justify-content-between mb-5 ml-0 mr-0">
        <div class="col-md-3 bg-light-purple p-4 text-center" style="border-radius:10px;">
            <label class="font-weight-bold text-break text-truncate" style="font-size: 48px;
                                        width:100%;">
                {{__('43')}}
            </label>
            <br>
            <label class="font-weight-bold" style="font-size: 18px;
                                    width:100%;">
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
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;
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
<div class="tab-pane fade show active" role="tabpanel">
    <div class="container card shadow-sm p-4">
        <span>
            <a class="close material-icons md-32" href="{{ route('partner.home') }}">
                close
            </a>
            <label class="font-weight-bold mb-5"
                style="font-size: 36px;">
                {{__('Detail Transaksi')}}
            </label>
        </span>
        
        <div class="row justify-content-between mb-5">
            <div class="col-md-auto">
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Nama Pemilik Rekening')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{$partner->nama_lengkap}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Nama Bank')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{$partner->nama_bank}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Nomor Rekening')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{$partner->nomor_rekening}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Status Transaksi')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{-- {{$transaksi_saldo->status}} --}}
                </label>
            </div>
    
            <div class="container col-md-auto">
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Tanggal dan Waktu Transaksi')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{__('20 Januari 2020 23:00 WIB')}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Jenis Dana')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{__('Masuk')}}
                </label>
                <br>
                <label class="font-weight-bold mb-0"
                    style="font-size: 16px;">
                    {{__('Jumlah Saldo')}}
                </label>
                <br>
                <label class="mb-2"
                    style="font-size: 18px;">
                    {{__('Rp. 400.000')}}
                </label>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade ml-0 mr-0" id="v-pills-pesanan" role="tabpanel">
    @include('pengelola.pesanan')
</div>
<div class="tab-pane fade" id="v-pills-saldo" role="tabpanel">
    @include('pengelola.saldo')
</div>
<div class="tab-pane fade" id="v-pills-produk" role="tabpanel">
    @include('pengelola.produk')
</div>
<div class="tab-pane fade" id="v-pills-promo" role="tabpanel">
    @include('pengelola.promo')
</div>
<div class="tab-pane fade" id="v-pills-atk" role="tabpanel">
    @include('pengelola.atk')
</div>
<div class="tab-pane fade" id="v-pills-info" role="tabpanel">
    @include('pengelola.info_bantuan')
</div>

@endsection



