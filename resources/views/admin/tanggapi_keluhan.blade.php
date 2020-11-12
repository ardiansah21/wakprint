@extends('layouts.admin')

@section('content')
<div class="tab-pane fade show active mb-0" style="border-radius:10px;">
    <div class="card shadow-sm mb-0 p-4">
        <span>
            <a class="close material-icons md-32" href="{{ route('admin.keluhan') }}">
                close
            </a>
            <label class="font-weight-bold ml-0 mb-4" style="font-size: 36px;">
                {{__('Tanggapi Keluhan')}}
            </label>
        </span>
        <div class="row justify-content-left mb-3 mr-0">
            <div class="col-md-1 align-self-center ml-0 mr-2">
                <img src="https://ptetutorials.com/images/user-profile.png" width="32" height="32" alt="no logo">
            </div>
            <div class="col-md-10 ml-0 mr-0">
                <label class="text-truncate font-weight-bold align-middle mt-2" style="width: 100%;">
                    {{$laporProduk->member->nama_lengkap}}
                </label>
            </div>
        </div>
        <div class="card shadow-sm mb-4 pl-3 pr-3 pt-2 pb-2">
            <label class="mb-1" style="font-size:16px;">
                {{$laporProduk->pesan}}
            </label>
        </div>
        <label class="mb-2" style="font-size:16px;">
            {{__('Tanggapan')}}
        </label>
        <form action="{{route('admin.keluhan.tanggapi')}}" method="POST">
            @csrf
            <div class="form-group mb-5">
                <textarea type="text" class="form-control form-control-lg pt-2 pb-2" id="tanggapan_keluhan"
                    name="tanggapan_keluhan" style="height:154px;"></textarea>
            </div>
            <div class="row justify-content-end">
                <div class="form-group mr-3">
                    <button
                        class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold pl-5 pr-5"
                        onclick="window.location.href='{{ route('admin.keluhan') }}'" style="border-radius:30px;
                        font-size:18px;">
                        {{__('Batal')}}
                    </button>
                </div>
                <input type="text" name="id_laporan" value="{{$laporProduk->id_lapor}}" hidden>
                <div class="form-group mr-3">
                    <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5" type="submit"
                        {{-- onclick="window.location.href='{{route('admin.keluhan.tanggapi',$laporProduk->member->id_member)}}'"
                        --}} style="border-radius:30px;
                        font-size:18px;">
                        {{__('Kirim')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection





{{-- <div class="modal fade"
    id="keluhanModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="keluhanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md"
        role="document">
        <div class="modal-content"
            style="border-radius: 10px;
            font-size:18px;">
            <div class="modal-body"
                style="border-radius: 10px;">
                <div class="mb-0">
                    <button class="close material-icons md-32"
                        data-dismiss="modal">
                        close
                    </button>
                    <label class="font-weight-bold ml-0 mb-4"
                        style="font-size: 36px;">
                        {{__('Tanggapi Keluhan')}}
</label>
<div class="row justify-content-left mb-3 mr-0">
    <div class="col-md-1 align-self-center ml-0 mr-2">
        <img src="https://ptetutorials.com/images/user-profile.png" width="32" height="32" alt="no logo">
    </div>
    <div class="col-md-10 ml-0 mr-0">
        <label class="text-truncate font-weight-bold align-middle mt-2" style="width: 100%;">
            {{__('Ali Susiasdasdasdasdsadsaajiiiibbbbsssssadasdadsadadsadssasadsa')}}
        </label>
    </div>
</div>
<div class="card shadow-sm mb-4 pl-3 pr-3 pt-2 pb-2">
    <label class="mb-1" style="font-size:16px;">
        {{__('Puas banget bisa ngeprint disini ajiiiibbbbsssssadasdadsadadsadssasadsa')}}
    </label>
</div>
<label class="mb-2" style="font-size:16px;">
    {{__('Tanggapan')}}
</label>
<div class="form-group mb-5">
    <textarea type="text" class="form-control form-control-lg pt-2 pb-2" style="height:154px;"></textarea>
</div>
<div class="row justify-content-end mb-0">
    <div class="form-group mr-3">
        <button
            class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold pl-5 pr-5 mb-0"
            style="border-radius:30px;
                                    font-size:18px;">
            {{__('Batal')}}
        </button>
    </div>
    <div class="form-group mr-3">
        <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0" style="border-radius:30px;
                                    font-size:18px;">
            {{__('Kirim')}}
        </button>
    </div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
