@extends('layouts.member')

@section('content')
    @php
        use Carbon\Carbon;
        $month=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    @endphp
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <div class="mb-4 ">
            <h1 class="font-weight-bold mb-0" style="font-size: 48px;">{{ __('Ubah Profil') }}</h1>
            <label
                style="font-size: 18px;">{{ __('Kelola informasi pribadi kamu untuk mengobrol, melindungi, dan mengamankan akun') }}</label>
        </div>
        <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="border-radius:10px;">
                <img id="gambarMember" src="{{ $member->avatar }}"
                        class="img-responsive" style="width:120px; height:120px; border-radius:10px;" alt="">
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
                    <div class="form-group col-md-auto">
                        <div class="dropdown" aria-required="true">
                            <input name="date" type="text" id="date"
                                @if (!empty($member->tanggal_lahir))
                                    value="{{Carbon::parse($member->tanggal_lahir)->translatedFormat('d')}}"
                                @endif class="form-control" hidden>
                            <button id="dateButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                @if (!empty($member->tanggal_lahir))
                                    {{Carbon::parse($member->tanggal_lahir)->translatedFormat('d')}}
                                @else
                                    {{__('1')}}
                                @endif
                            </button>
                            <div id="dateList" class="dropdown-menu" aria-labelledby="dropdownDate" style="font-size: 16px; width:100%;">
                                @for($i=1;$i<32;$i++)
                                    <span class="dropdown-item cursor-pointer ">{{$i}}</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-auto">
                        <div class="dropdown" aria-required="true">
                            <input name="month" type="text" id="month"
                                @if (!empty($member->tanggal_lahir))
                                    value="{{Carbon::parse($member->tanggal_lahir)->translatedFormat('F')}}"
                                @endif class="form-control" hidden>
                            <button id="monthButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownMonth" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                @if (!empty($member->tanggal_lahir))
                                    {{Carbon::parse($member->tanggal_lahir)->translatedFormat('F')}}
                                @else
                                    {{__('Januari')}}
                                @endif
                            </button>
                            <div id="monthList" class="dropdown-menu" aria-labelledby="dropdownMonth" style="font-size: 16px; width:100%;">
                                @for($i=1;$i<13;$i++)
                                    <span class="dropdown-item cursor-pointer ">{{$month[$i-1]}}</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="dropdown" aria-required="true">
                            <input name="year" type="text" id="year"
                                @if (!empty($member->tanggal_lahir))
                                    value="{{Carbon::parse($member->tanggal_lahir)->translatedFormat('Y')}}"
                                @endif class="form-control" hidden>
                            <button id="yearButton" class="is-flex btn btn-default btn-lg btn-block shadow-sm dropdown-toggle border border-gray" id="dropdownYear" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px; text-align:left;">
                                @if (!empty($member->tanggal_lahir))
                                    {{Carbon::parse($member->tanggal_lahir)->translatedFormat('Y')}}
                                @else
                                    {{__('2015')}}
                                @endif
                            </button>
                            <div id="yearList" class="dropdown-menu" aria-labelledby="dropdownYear" style="font-size: 16px; width:100%;">
                                @for($i = 2015; $i > 1979; $i--)
                                    <span class="dropdown-item cursor-pointer ">{{$i}}</span>
                                @endfor
                            </div>
                        </div>
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
                            class="fa fa-fw fa-eye field_icon toggle-password1">
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
                    <input id="new-password" type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan Kata Sandi Baru" data-toggle="password" autofocus>
                    <div class="input-group-append">
                        <span class="input-group-text bg-white"
                        style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword" toggle="#password-field"
                            class="fa fa-fw fa-eye field_icon toggle-password2">
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
                    <input id="confirm-password" type="password"
                    name="confirm-password"
                    class="form-control form-control-lg"
                    placeholder="Konfirmasi Kata Sandi Baru"
                    data-toggle="password">
                    <div class="input-group-append">
                        <span class="input-group-text bg-white"
                        style="border-radius: 0px 5px 5px 0px;">
                            <i id="togglePassword"
                            toggle="#password-field"
                            class="fa fa-fw fa-eye field_icon toggle-password3">
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
            $("#editPhotoButton").on("click",function(){
                $('#imgupload').trigger('click'); return false;
            });

            $("#gambarMember").on("change","#imgupload",function(){
                document.getElementById('gambarMember').src=window.URL.createObjectURL(this.files[0]);
            });
            $('#dateList span').on('click', function () {
                $('#dateButton').text($(this).text());
                $('#date').val($(this).text());
            });
            $('#monthList span').on('click', function () {
                $('#monthButton').text($(this).text());
                $('#month').val($(this).text());
            });
            $('#yearList span').on('click', function () {
                $('#yearButton').text($(this).text());
                $('#year').val($(this).text());
            });

            $("body").on('click', '.toggle-password1', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var inputCurrentPass = $("#current-password");
                if (inputCurrentPass.attr("type") === "password") {
                    inputCurrentPass.attr("type", "text");
                } else {
                    inputCurrentPass.attr("type", "password");
                }
            });

            $("body").on('click', '.toggle-password2', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var inputNewPass = $("#new-password");
                if (inputNewPass.attr("type") === "password") {
                    inputNewPass.attr("type", "text");
                } else {
                    inputNewPass.attr("type", "password");
                }
            });

            $("body").on('click', '.toggle-password3', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var inputConfirmPass = $("#confirm-password");
                if (inputConfirmPass.attr("type") === "password") {
                    inputConfirmPass.attr("type", "text");
                } else {
                    inputConfirmPass.attr("type", "password");
                }
            });
        });

    </script>
@endsection
