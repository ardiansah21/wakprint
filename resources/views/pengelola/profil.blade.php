@extends('layouts.pengelola')

@section('content')

<div class="tab-pane fade show active" role="tabpanel">
    <div class="pl-2 pr-2 pt-2 pb-2 mb-4" style="height:210px;
                    border-radius:5px;
                    background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg');
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                    justify-content: space-between;
                    flex-direction: column;
                    display: flex;">
        <label class="font-weight-bold mb-5 ml-2" style="font-size: 24px;">
            {{$partner->nama_toko}}
        </label>
        <div class="">
            <a href="{{ route('partner.profile.edit') }}" class="btn btn-outline-yellow font-weight-bold pl-4 pr-4"
                style="border-radius:30px;
                            font-size: 16px;
                            float:right;">
                {{__('Ubah Profil')}}
            </a>
        </div>
    </div>
    <div class="table-scrollbar" style="font-size:18px;">
        <div class="row justify-content-left mb-0">
            <label class="col-4 ml-0">
                {{__('Nama Pemilik')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nama_lengkap}}
            </label>
        </div>
        <div class="row justify-content-left mb-0">
            <label class="col-4 ml-0">
                {{__('Nomor HP')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nomor_hp}}
            </label>
        </div>
        <div class="row justify-content-left mb-0">
            <label class="col-4 ml-0">
                {{__('Nama Bank')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nama_bank}}
            </label>
        </div>
        <div class="row justify-content-left mb-0">
            <label class="col-4 ml-0">
                {{__('Nomor Rekening')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->nomor_rekening}}
            </label>
        </div>
        <div class="row justify-content-left mb-2">
            <label class="col-4 ml-0">
                {{__('Alamat')}}
            </label>
            <label class="col-8 SemiBold ml-0">
                {{$partner->alamat_toko}}
            </label>
        </div>
        <div class="row justify-content-left mb-4">
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
