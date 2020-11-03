@extends('layouts.pengelola')

@section('content')

<div class="tab-pane fade show active" role="tabpanel">
    <div class="pl-2 pr-2 pt-2 pb-2 mb-0" style="border-radius:5px; background-size: cover; flex-direction: column; display: flex;">
        @if (!empty($partner->getFirstMediaUrl()))
            <img src="{{ $partner->getFirstMediaUrl() }}" alt="Belum Ada Foto Profil" style="height:210px; border-radius:5px; ">
            <label class="font-weight-bold text-primary-yellow mb-5 ml-4 mt-2" style="font-size: 24px; position: absolute; top: 8px; left: 16px;">
                {{$partner->nama_toko}}
            </label>
            <div class="">
                <a href="{{ route('partner.profile.edit') }}" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4"
                    style="border-radius:30px; position: relative; bottom: 58px; right: 16px; font-size: 16px; float:right;">
                    {{__('Ubah Profil')}}
                </a>
            </div>
        @else
            <img src="https://unsplash.it/600/400" alt="Belum Ada Foto Profil" style="height:210px; border-radius:5px; ">
            <label class="font-weight-bold text-primary-yellow mb-5 ml-4 mt-2" style="font-size: 24px; position: absolute; top: 8px; left: 16px;">
                {{$partner->nama_toko}}
            </label>
            <div class="">
                <a href="{{ route('partner.profile.edit') }}" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4"
                    style="border-radius:30px; position: relative; bottom: 58px; right: 16px; font-size: 16px; float:right;">
                    {{__('Ubah Profil')}}
                </a>
            </div>
        @endif

    </div>
    <div class="table-scrollbar" style="font-size:18px;">
        <div class="row justify-content-left ml-0 mr-0 mb-4">
            <label class="col-4 ml-0">
                {{__('Nilai Toleransi Kandungan Warna Halaman')}}
            </label>
            <label class="col-8 SemiBold">
                {{$partner->ntkwh}} %
            </label>
        </div>
        <div class="row justify-content-left ml-0 mr-0 mb-0">
            <label class="col-4 ml-0">
                {{__('Nama Pemilik')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nama_lengkap}}
            </label>
        </div>
        <div class="row justify-content-left ml-0 mr-0 mb-0">
            <label class="col-4 ml-0">
                {{__('Nomor HP')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nomor_hp}}
            </label>
        </div>
        <div class="row justify-content-left ml-0 mr-0 mb-0">
            <label class="col-4 ml-0">
                {{__('Nama Bank')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nama_bank}}
            </label>
        </div>
        <div class="row justify-content-left ml-0 mr-0 mb-0">
            <label class="col-4 ml-0">
                {{__('Nomor Rekening')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nomor_rekening}}
            </label>
        </div>
        <div class="row justify-content-left ml-0 mr-0 mb-2">
            <label class="col-4 ml-0">
                {{__('Alamat')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->alamat_toko}}
            </label>
        </div>
        <div class="row justify-content-left ml-0 mr-0 mb-4">
            <label class="col-4 ml-0">
                {{__('Deskripsi Tempat Percetakan')}}
            </label>
            <label class="col-8 SemiBold">
                {{$partner->deskripsi_toko}}
            </label>
        </div>
    </div>
</div>
@endsection
