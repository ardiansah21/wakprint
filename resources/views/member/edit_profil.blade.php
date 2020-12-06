@auth
@php
//$m = Auth::user();
$month=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
@endphp
@endauth

@extends('layouts.member')

@section('content')
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <div class="mb-4 ">
            <h1 class="font-weight-bold mb-0" style="font-size: 48px;">{{ __('Ubah Profil') }}</h1>
            <label
                style="font-size: 18px;">{{ __('Kelola informasi pribadi kamu untuk mengobrol, melindungi, dan mengamankan akun') }}</label>
        </div>
        <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="border-radius:10px;">
                @if (!empty($member->getFirstMediaUrl()))
                    <img id="gambarMember" src="{{ $member->getFirstMediaUrl() }}"
                        class="img-responsive" style="width:120px; height:120px; border-radius:10px;" alt="Foto Kosong">
                    <a id="editPhotoButton" class="bg-light-purple material-icons text-decorations-none pointer" onclick="document.getElementById('imgupload').click();"
                        style="border-radius:3px;
                        position: relative;
                        top: 15%; right:5%;
                        transform: translate(-20%, 200%);
                        opacity:90%;
                        color: #BC41BE;">
                        edit
                    </a>
                    <input id="imgupload" type="file" name="foto_member" hidden accept="image/png, image/jpeg" onchange="document.getElementById('gambarMember').src=window.URL.createObjectURL(this.files[0]);" hidden>
                @else
                    <img id="gambarMember" src="https://unsplash.it/600/400"
                        class="img-responsive" style="width:120px;height:120px; border-radius:10px;" alt="Foto Kosong">
                    <a href="" id="editPhotoButton" class="bg-light-purple material-icons text-decorations-none" onclick="document.getElementById('imgupload').click();"
                        style="border-radius:3px;
                        position: relative;
                        top: 15%; right:5%;
                        transform: translate(-20%, 200%);
                        opacity:90%;
                        color: #BC41BE;">
                        edit
                    </a>
                    <input id="imgupload" type="file" name="foto_member" hidden accept="image/png, image/jpeg" onchange="document.getElementById('gambarMember').src=window.URL.createObjectURL(this.files[0]);" hidden>
                @endif
            </div>
            <label class="SemiBold mb-1" style="font-size: 24px;">
                {{ __('Biodata Diri') }}
            </label>
            <br>
            <div class="form-group mb-3">
                <label class="mb-2" style="font-size: 18px;">
                    {{ __('Nama Lengkap') }}
                </label>
                <input id="nama" type="text" class="form-control" name="nama" value="{{ $member->nama_lengkap }}"
                    placeholder="Masukkan Nama Lengkap" aria-label="Masukkan Nama Lengkap"
                    aria-describedby="inputGroup-sizing-sm" style="font-size: 18px;">
            </div>
            <div class="form-group mb-3">
                <label class="mb-2" style="font-size: 18px;">
                    {{ __('Tanggal Lahir') }}
                </label>
                <div class="row">
                    <div class="col-md-auto">
                        <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="date" style="font-size: 18px;">
                            @for($date = 1; $date < 32; $date++)
                                {{-- @if (!empty($member->tanggal_lahir))
                                    <option value="{{ $date }}">
                                        {{ $date }}
                                    </option> --}}
                                {{-- @else --}}
                                    <option value="{{ $date }}">
                                        {{ $date }}
                                    </option>
                                {{-- @endif --}}
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="month" style="font-size: 18px;">
                            @for($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">
                                    {{ $month[$i-1] }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="year" style="font-size: 18px;">
                                @for($year = 2015; $year > 1979; $year--)
                                    <option value="{{ $year }}">
                                        {{ $year }}
                                    </option>
                                @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label class="mb-2" style="font-size: 18px;">
                    {{ __('Jenis Kelamin') }}
                </label>
                <div class="row ml-0" style="font-size: 18px;">
                    <div class="form-group custom-control custom-radio col-md-3">

                        <input id="rbLK" name="jk" value="L" {{ $member->jenis_kelamin == 'L' ? 'checked' : '' }}
                            class="custom-control-input" type="radio">
                        <label class="custom-control-label" for="rbLK">
                            {{ __('Laki-Laki') }}
                        </label>
                    </div>
                    <div class="form-group custom-control custom-radio col-md-9">
                        <input id="rbPR" name="jk" value="P" {{ $member->jenis_kelamin == 'P' ? 'checked' : '' }}
                            class="custom-control-input" type="radio">
                        <label class="custom-control-label" for="rbPR">
                            {{ __('Perempuan') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="SemiBold mb-2" style="font-size: 24px;">{{ __('Password') }}</label>
                <br>
                <label for="password" class="">{{ __('Password Lama') }}</label>
                <div class="input-group-append">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="current-password"
                    type="password"
                    class="form-control form-control-lg
                    @error('password')
                    is-invalid
                    @enderror"
                    name="current-password"
                    autocomplete="current-password"
                    placeholder="Masukkan Kata Sandi Lama">
                    <span class="input-group-text bg-white"
                        style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field"
                            class="fa fa-fw fa-eye field_icon toggle-password">
                            </i>
                        </span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
            <div class="form-group">
                <label for="password" class="mb-2">{{__('Password Baru')}}</label>
                <div class="input-group mb-3">
                    <input type="password"
                    name="password"
                    class="form-control form-control-lg"
                    placeholder="Masukkan Kata Sandi Baru"
                    data-toggle="password"
                    autofocus>
                    <div class="input-group-append">
                        <span class="input-group-text bg-white"
                        style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field"
                            class="fa fa-fw fa-eye field_icon toggle-password">
                            </i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-5">
                <label for="confirm-password" class="mb-2">
                    {{__('Konfirmasi Password Baru')}}
                </label>
                <div class="input-group mb-3">
                    <input type="password"
                    name="confirm-password"
                    class="form-control form-control-lg"
                    placeholder="Konfirmasi Kata Sandi Baru"
                    data-toggle="password">
                    <div class="input-group-append">
                        <span class="input-group-text bg-white"
                        style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword"
                            toggle="#password-field"
                            class="fa fa-fw fa-eye field_icon toggle-password">
                            </i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-5">
                <input type="submit" value="{{ __('Simpan Perubahan') }}"
                    class="btn btn-primary-yellow shadow-sm font-weight-bold pl-4 pr-4"
                    style="border-radius:30px; font-size: 24px;">
            </div>
        </form>
        <script>

        </script>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }

            $("#editPhotoButton").on("click",function(){
                $('#imgupload').trigger('click'); return false;
            });

            $("#gambarMember").on("change","#imgupload",function(){
                document.getElementById('gambarMember').src=window.URL.createObjectURL(this.files[0]);
            });
        });

    </script>
@endsection
