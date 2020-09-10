@extends('layouts.member')

@section('content')
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Pesanan Saya') }}</h1>
    <div class="row justify-content-between mb-3">
        <div class="col-md-3">
            <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="filterpesanan" style="font-size: 18px;">
                <option value="Terbaru">{{__('Terbaru')}}</option>
                <option value="Harga Tertinggi">{{__('Harga Tertinggi')}}</option>
                <option value="Harga Terendah">{{__('Harga Terendah')}}</option>
                <option value="Pending">{{__('Pending')}}</option>
                <option value="Diproses">{{__('Diproses')}}</option>
                <option value="Selesai">{{__('Selesai')}}</option>
                <option value="Batal">{{__('Batal')}}</option>
            </select>
        </div>
        <div class="col-md-8 mb-4">
            <div class="search-input">
                <div class="main-search-input-item">
                    <input type="text" role="search" class="form-control" placeholder="Cari percetakan atau produk disini"
                        aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                        style="border:0px solid white; border-radius:30px; font-size:18px;">
                        <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                        style="position: absolute;
                        top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                        search
                        </i>
                </div>
            </div>
        </div>
    </div>
    <div class="table-scrollbar mb-5 ml-0 pr-2">
        <table class="table table-hover" style="border-radius:25px 25px 15px 15px;">
            <thead class="bg-primary-purple text-white">
                <tr style="font-size: 18px;">
                    <th scope="col-md-auto">{{__('ID') }}</th>
                    <th scope="col-md-auto">{{__('Waktu') }}</th>
                    <th scope="col-md-auto">{{__('Total') }}</th>
                    <th scope="col-md-auto">{{__('Metode') }}</th>
                    <th scope="col-md-auto">{{__('Biaya') }}</th>
                    <th scope="col-md-auto">{{__('Status') }}</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">

                {{-- @foreach ($collection as $item) --}}
                <tr onclick="window.location.href='{{ route('pesanan.detail') }}'">

                    {{-- @foreach ($collection as $item) --}}
                    <td scope="row">{{__('00000001') }}</td>
                    <td>{{__('5 hour ago') }}</td>
                    <td>{{__('10 file') }}</td>
                    <td>{{__('Ambil di Tempat') }}</td>
                    <td>{{__('Rp. 12.000') }}</td>
                    <td>{{__('Diproses') }}</td>
                    {{-- @endforeach --}}

                </tr>
                {{-- @endforeach --}}

            </tbody>
        </table>
    </div>
    </div>
@endsection
