@extends('layouts.admin')

@section('content')
    <div class="tab-pane fade show active card shadow-sm mb-0 p-4" style="border-radius:10px;">
        <a class="close material-icons md-32" href="{{ route('admin.member') }}">
            close
        </a>
        <label class="text-break font-weight-bold mb-4 ml-2" style="font-size:36px; width:100%;">
            {{ $member->id_member ?? '-'}}  
        </label>
        <div class="row justify-content-between mb-2 ml-0">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Nama Lengkap')}}
            </label>
            <label id="namaMember" name="namamember" class="col-md-6 mb-0">
                {{ $member->nama_lengkap ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2 ml-0">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Tanggal Lahir')}}
            </label>
            <label id="tlMember" name="tlmember" class="col-md-6 mb-0">
                {{ $tanggalLahir ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2 ml-0">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Jenis Kelamin')}}
            </label>
            <label id="jkMember" name="jkmember" class="col-md-6 mb-0">
                @if ($member->jenis_kelamin === 'L')
                {{__('Laki-Laki') }}
                @elseif ($member->jenis_kelamin === 'P')
                {{__('Perempuan') }}
                @else{
                {{__('-') }}
                }
                @endif
            </label>
        </div>
        <div class="row justify-content-between mb-2 ml-0">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Email')}}
            </label>
            <label id="emailMember" name="emailmember" class="col-md-6 mb-0">
                {{ $member->email ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-2 ml-0">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Nomor HP')}}
            </label>
            <label id="nomorHPMember" name="nomorhpmember" class="col-md-6 mb-0">
                {{ $member->nomor_hp ?? '-'}}
            </label>
        </div>
        <div class="row justify-content-between mb-4 ml-0">
            <label class="col-md-6 font-weight-bold mb-0">
                {{__('Alamat')}}
            </label>
            <label id="alamatMember" name="alamatmember" class="col-md-6 mb-0">
                {{-- {{ $member->alamat }} --}}
                {{-- @for($i=0 ; $i < count($member->alamat['alamat']);$i++)
                {{ $member->alamat['alamat'][$i]['AlamatJalan'] }},
                {{ $member->alamat['alamat'][$i]['Kelurahan'] }},
                {{ $member->alamat['alamat'][$i]['Kecamatan'] }},
                {{ $member->alamat['alamat'][$i]['KabupatenKota'] }},
                {{ $member->alamat['alamat'][$i]['Provinsi'] }},
                {{ $member->alamat['alamat'][$i]['KodePos'] }}
                @endfor --}}
            </label>
        </div>
        <div class="container" style="font-size:18px;">
            <button class="btn btn-danger btn-outline-danger-primary btn-block font-weight-bold"
                style="border-radius:30px">
                {{__('Hapus')}}
            </button>
        </div>
    </div>
@endsection
