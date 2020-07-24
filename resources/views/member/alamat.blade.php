<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container mt-4 mb-5">
    <label class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Alamat Pengiriman')}}</label>
    <div class="mb-4">
        <button class="btn btn-primary-yellow shadow-sm font-weight-bold pl-4 pr-4" 
            data-toggle="modal" data-target="#alamatModal" style="border-radius:30px; font-size: 18px;">
            <i class="material-icons align-middle mr-2">location_on</i>
            {{__('Tambah Alamat Baru')}}
        </button>
    </div>
    <div class="table-scrollbar pr-4">
        <table id="table-wrapper" class="table table-hover" style="border-radius:25px 25px 15px 15px;">
            <thead class="bg-primary-purple text-white">
                <tr style="font-size: 18px;">
                    <th class="align-middle" scope="col-md-auto">{{__('Nama Pengguna')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Alamat')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('No. HP')}}</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">
                <tr>
                    <td class="align-middle" scope="row">{{__('Ilham Maulana Habibie')}}</td>
                    <td class="align-middle">{{__('Jl. Air Bersih Ujung, Medan Denai, Medan, Sumatera Utara (20228)')}}</td>
                    <td class="align-middle">{{__('+62831453435')}}</td>
                </tr>   
            </tbody>
        </table>
    </div>
    @include('member.tambah_alamat')
</div>
@endsection