@auth
@php
$m = Auth::user();
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
        <div class="form-group mb-4" style="position: relative; width: 100%;">
            
            <input type="file" class="form-control-file" name="photoprofile" id="photoProfileFile" aria-describedby="fileHelp">
            <img src=""
                class="img-responsive shadow-sm justify-content-center align-self-center center-block" alt=""
                width="120px" height="120px" style="border-radius:8px 8px 8px 8px;">
            <a href="" class="bg-light-purple material-icons text-decorations-none" style="border-radius:3px;
                position: absolute;
                top: 55%; left:14%;
                transform: translate(-20%, 100%); 
                opacity:90%;
                color: #BC41BE;">
                edit
            </a>
        </div>

        <form action="{{ route('profile.edit') }}" method="POST">
            @csrf
            <label class="SemiBold mb-1" style="font-size: 24px;">
                {{ __('Biodata Diri') }}
            </label>
            <br>
            <div class="form-group mb-3">
                <label class="mb-2" style="font-size: 18px;">
                    {{ __('Nama Lengkap') }}
                </label>
                <input id="nama" type="text" class="form-control" name="nama" value="{{ $m->nama_lengkap }}"
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
                                <option value="<?= $date ?>">
                                    <?= $date ?>
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="month" style="font-size: 18px;">
                            @for($i = 1; $i < 13; $i++) 
                                <option value="<?= $i ?>">
                                    <?= $month[$i-1] ?>
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="year" style="font-size: 18px;">
                                @for($year = 2015; $year > 1979; $year--) 
                                    <option value="<?= $year ?>">
                                        <?= $year ?>
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

                        <input id="rbLK" name="jk" value="L" {{ $m->jenis_kelamin == 'L' ? 'checked' : '' }}
                            class="custom-control-input" type="radio">
                        <label class="custom-control-label" for="rbLK">
                            {{ __('Laki-Laki') }}
                        </label>
                    </div>
                    <div class="form-group custom-control custom-radio col-md-9">
                        <input id="rbPR" name="jk" value="P" {{ $m->jenis_kelamin == 'P' ? 'checked' : '' }}
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
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
            alert(msg);
            }
        </script>

    </div>
    <div class="tab-pane fade ml-2 mr-0" id="v-pills-saldo" role="tabpanel">
        @include('member.topup_saldo')
    </div>
    <div class="tab-pane fade ml-2 mr-0" id="v-pills-riwayat" role="tabpanel">
        @include('member.riwayat')
    </div>
    <div class="tab-pane fade ml-2" id="v-pills-pesanan" role="tabpanel">
        @include('member.pesanan')
    </div>
    <div class="tab-pane fade ml-2" id="v-pills-favorit" role="tabpanel">
        @include('member.produk_favorit')
    </div>
    <div class="tab-pane fade ml-2" id="v-pills-ulasan" role="tabpanel">
        @include('member.ulasan')
    </div>
{{-- <div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-5">
            <div class="bg-light-purple text-center"
                style="height:300px; border-radius:0px 25px 25px 0px; position: relative;">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                    class="img-responsive" alt="" width="300px" height="300px" style="border-radius:8px 8px 8px 8px;">
                <div class="bg-dark" style="position: absolute; 
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, 140%); opacity:80%;
                                        color: white;
                                        width:300px;
                                        border-radius:0px 0px 8px 8px;">
                    <label class="font-weight-bold text-truncate mx-auto" style="font-size: 30px;
                                                width:100%;">
                        {{ $m->nama_lengkap }}
                    </label>
                </div>
            </div>
            <div class="mt-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link SemiBold mb-4" id="v-pills-alamat-tab" data-toggle="pill" href="#v-pills-alamat"
                        role="tab" aria-controls="v-pills-alamat" aria-selected="true" style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">location_on</i>
                        {{ __('Medan ID') }}
                    </a>
                    <a class="nav-link SemiBold mb-2" id="v-pills-saldo-tab" data-toggle="pill" href="#v-pills-saldo"
                        role="tab" aria-controls="v-pills-saldo" aria-selected="false" style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">account_balance_wallet</i>
                        Rp. {{ $m->jumlah_saldo }}
                    </a>
                    <a class="nav-link SemiBold mb-4" id="v-pills-riwayat-tab mb-3" data-toggle="pill"
                        href="#v-pills-riwayat" role="tab" aria-controls="v-pills-riwayat" aria-selected="false"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">history</i>
                        {{ __('Riwayat Transaksi') }}
                    </a>
                    <a class="nav-link SemiBold mb-2" id="v-pills-konfigurasi-tab" data-toggle="pill"
                        href="#v-pills-konfigurasi" role="tab" aria-controls="v-pills-konfigurasi" aria-selected="false"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">phonelink_setup</i>
                        {{ __('Konfigurasi File') }}
                    </a>
                    <a class="nav-link SemiBold mb-4" id="v-pills-pesanan-tab" data-toggle="pill"
                        href="#v-pills-pesanan" role="tab" aria-controls="v-pills-pesanan" aria-selected="false"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">shopping_cart</i>
                        {{ __('Pesanan') }}
                    </a>
                    <a class="nav-link SemiBold mb-2" id="v-pills-favorit-tab" data-toggle="pill"
                        href="#v-pills-favorit" role="tab" aria-controls="v-pills-favorit" aria-selected="false"
                        style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">favorite</i>
                        {{ __('Favorit') }}
                    </a>
                    <a class="nav-link SemiBold mb-4" id="v-pills-ulasan-tab" data-toggle="pill" href="#v-pills-ulasan"
                        role="tab" aria-controls="v-pills-ulasan" aria-selected="false" style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">rate_review</i>
                        {{ __('Ulasan') }}
                    </a>
                    <a class="nav-link SemiBold" id="v-pills-keluar-tab" data-toggle="pill" href="#v-pills-keluar"
                        role="tab" aria-controls="v-pills-keluar" aria-selected="true" style="font-size: 24px;">
                        <i class="material-icons align-middle md-32 mr-2">exit_to_app</i>
                        {{ __('Keluar') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-content col-md-7">
            <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
                <div class="mb-4 ">
                    <h1 class="font-weight-bold mb-0" style="font-size: 48px;">{{ __('Ubah Profil') }}</h1>
                    <label
                        style="font-size: 18px;">{{ __('Kelola informasi pribadi kamu untuk mengobrol, melindungi, dan mengamankan akun') }}</label>
                </div>
                <div class="form-group mb-4" style="position: relative; width: 100%;">
                    
                    <input type="file" class="form-control-file" name="photoprofile" id="photoProfileFile" aria-describedby="fileHelp">
                    <img src=""
                        class="img-responsive shadow-sm justify-content-center align-self-center center-block" alt=""
                        width="120px" height="120px" style="border-radius:8px 8px 8px 8px;">
                    <a href="" class="bg-light-purple material-icons text-decorations-none" style="border-radius:3px;
                        position: absolute;
                        top: 55%; left:14%;
                        transform: translate(-20%, 100%); 
                        opacity:90%;
                        color: #BC41BE;">
                        edit
                    </a>
                </div>

                <form action="{{ route('profile.edit') }}" method="POST">
                    @csrf
                    <label class="SemiBold mb-1" style="font-size: 24px;">
                        {{ __('Biodata Diri') }}
                    </label>
                    <br>
                    <div class="form-group mb-3">
                        <label class="mb-2" style="font-size: 18px;">
                            {{ __('Nama Lengkap') }}
                        </label>
                        <input id="nama" type="text" class="form-control" name="nama" value="{{ $m->nama_lengkap }}"
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
                                        <option value="<?= $date ?>">
                                            <?= $date ?>
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-auto">
                                <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="month" style="font-size: 18px;">
                                    @for($i = 1; $i < 13; $i++) 
                                        <option value="<?= $i ?>">
                                            <?= $month[$i-1] ?>
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-auto">
                                <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="year" style="font-size: 18px;">
                                        @for($year = 2015; $year > 1979; $year--) 
                                            <option value="<?= $year ?>">
                                                <?= $year ?>
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

                                <input id="rbLK" name="jk" value="L" {{ $m->jenis_kelamin == 'L' ? 'checked' : '' }}
                                    class="custom-control-input" type="radio">
                                <label class="custom-control-label" for="rbLK">
                                    {{ __('Laki-Laki') }}
                                </label>
                            </div>
                            <div class="form-group custom-control custom-radio col-md-9">
                                <input id="rbPR" name="jk" value="P" {{ $m->jenis_kelamin == 'P' ? 'checked' : '' }} 
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
                    var msg = '{{Session::get('alert')}}';
                    var exist = '{{Session::has('alert')}}';
                    if(exist){
                      alert(msg);
                    }
                  </script>

            </div>
            <div class="tab-pane fade ml-2 mr-0" id="v-pills-saldo" role="tabpanel">
                @include('member.topup_saldo')
            </div>
            <div class="tab-pane fade ml-2 mr-0" id="v-pills-riwayat" role="tabpanel">
                @include('member.riwayat')
            </div>
            <div class="tab-pane fade ml-2" id="v-pills-pesanan" role="tabpanel">
                @include('member.pesanan')
            </div>
            <div class="tab-pane fade ml-2" id="v-pills-favorit" role="tabpanel">
                @include('member.produk_favorit')
            </div>
            <div class="tab-pane fade ml-2" id="v-pills-ulasan" role="tabpanel">
                @include('member.ulasan')
            </div>
        </div>
    </div>
</div> --}}
@endsection
