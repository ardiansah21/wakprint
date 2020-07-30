@php
    // $member = DB::table('member')->get();
    // $monthName=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    // $date = $member->tanggal_lahir;
    // $tanggal = intval(substr($date,8,2));
    // $bulan = $monthName[intval(substr($date,5,2)-1)];
    // $tahun = substr($date,0,4);
    // $tanggalLahir =  "$tanggal $bulan $tahun";

    // $member = DB::table('member')->get();

    //     $alamatBaru = array(
    //         'id'=> $member->alamat->id,
    //         'NamaPenerima' => $member->alamat->NamaPenerima,
    //         'NomorHP' => $member->alamat->NomorHP,
    //         'Provinsi' => $member->alamat->Provinsi,
    //         'KabupatenKota' => $member->alamat->KabupatenKota,
    //         'Kecamatan' => $member->alamat->Kecamatan,
    //         'Kelurahan' => $member->alamat->Kelurahan,
    //         'KodePos' => $member->alamat->KodePos,
    //         'AlamatJalan' => $member->alamat->AlamatJalan
    //     );

    //     $member->alamat['alamat'][$alamat->id] = $alamatBaru;
    //     $member->alamat = $alamat;

@endphp

<div class="modal fade"
    id="memberModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="memberModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md"
        role="document">
        <div class="modal-content"
            style="border-radius: 10px;
            font-size:18px;">
            <div class="modal-body"
                style="border-radius: 10px;">
                <div class="mb-0"
                    style="border-radius:10px;">
                    <button class="close material-icons md-32"
                        data-dismiss="modal">
                        close
                    </button>
                    <label 
                        id="idMember"
                        name="idmember"
                        aria-valuetext="idmember"
                        class="text-break font-weight-bold mb-4"
                        style="font-size:36px;
                            width:100%;">
                        {{ $m->id_member }}
                    </label>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Nama Lengkap')}}
                        </label>
                        <label 
                            id="namaMember"
                            name="namamember"
                            class="col-md-6 mb-0">
                            {{ $m->nama_lengkap }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Tanggal Lahir')}}
                        </label>
                        <label 
                            id="tlMember"
                            name="tlmember"
                            class="col-md-6 mb-0">
                            {{ $tanggalLahir }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Jenis Kelamin')}}
                        </label>
                        <label 
                            id="jkMember"
                            name="jkmember"
                            class="col-md-6 mb-0">
                            @if ($m->jenis_kelamin === 'L')
                                {{__('Laki-Laki') }}
                            @elseif ($m->jenis_kelamin === 'P')
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
                        <label 
                            id="emailMember"
                            name="emailmember"    
                            class="col-md-6 mb-0">
                            {{ $m->email }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Nomor HP')}}
                        </label>
                        <label
                            id="nomorHPMember"
                            name="nomorhpmember"
                            class="col-md-6 mb-0">
                            {{ $m->nomor_hp }}
                        </label>
                    </div>
                    <div class="row justify-content-between mb-4 ml-0">
                        <label class="col-md-6 font-weight-bold mb-0">
                            {{__('Alamat')}}
                        </label>
                        <label
                            id="alamatMember"
                            name="alamatmember"
                            class="col-md-6 mb-0">
                            {{ $m->alamat }}
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
                    <div class="container mb-2"
                        style="font-size:18px;">
                        <button class="btn btn-danger btn-outline-danger-primary btn-block font-weight-bold mb-4"
                            style="border-radius:30px">
                            {{__('Hapus')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

