@auth
@php
$m = Auth::user();
//$member = Member::all();

@endphp
@endauth

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
                    <th scope="col-md-auto"></th>
                </tr>
            </thead>

            {{-- 'Nama Penerima' => $request->namapenerima,
            'Nomor HP' => $request->nomorhp,
            'Provinsi' => $request->provinsi,
            'Kabupaten Kota' => $request->kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'Kode Pos' => $request->kodepos,
            'Alamat Jalan' => $request->alamatjalan --}}
            <tbody style="font-size: 14px;">
                {{-- @foreach ($member as $m) --}}
                    <tr>
                    
                        <td class="align-middle" scope="row"></td>
                        <td class="align-middle">
                                {{-- {{$m->alamat['Alamat Jalan']}} 
                                {{ $m->alamat['Kelurahan'] }}
                                {{ $m->alamat['Kecamatan'] }}
                                {{ $m->alamat['Kabupaten Kota']}}
                                {{ $m->alamat['Provinsi'] }}
                                {{ $m->alamat['Kode Pos'] }} --}}
                            {{-- @foreach ($m->alamat as $almt)
                                {{$almt['Alamat Jalan']}} 
                                {{ $almt['Kelurahan'] }}
                                {{ $almt['Kecamatan'] }}
                                {{ $almt['Kabupaten Kota']}}
                                {{ $almt['Provinsi'] }}
                                {{ $almt['Kode Pos'] }}
                            @endforeach --}}
                        </td>
                        <td class="align-middle"></td>
                        <td>
                            {{-- <span class="invisible">
                                Utama
                            </span> --}}
                            <span>
                                <a href="" action="" data-toggle="modal" data-target="#alamatModal">
                                    <i class="material-icons mr-2">
                                        edit
                                    </i>
                                </a>
                                
                                <i class="material-icons"
                                    style="color: red;">
                                    delete
                                </i>
                            </span>
                        </td>
                    
                    </tr>
                {{-- @endforeach --}}
               
            </tbody>
        </table>
    </div>
    @include('member.popup_tambah_alamat')
</div>
@endsection