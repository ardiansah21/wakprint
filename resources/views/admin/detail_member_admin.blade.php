<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.admin.navbar_after_admin')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:72px">
            <div class="row">
                <div class="col-4 mt-5">
                    <div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2" id="v-pills-home-tab" data-toggle="pill" onclick="window.location='{{ url('/admin') }}'" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">home</i>
                                Beranda
                            </a>
                            <a class="nav-link active mb-2" id="v-pills-data-member-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/data-member') }}'" href="#v-pills-data-member" role="tab" aria-controls="v-pills-data-member" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">history_edu</i>
                                Data Member
                            </a>
                            <a class="nav-link mb-2" id="v-pills-data-pengelola-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/data-pengelola') }}'" href="#v-pills-data-pengelola" role="tab" aria-controls="v-pills-data-pengelola" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">print</i>
                                Data Pengelola
                            </a>
                            <a class="nav-link mb-2" id="v-pills-saldo-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/konfirmasi-saldo') }}'" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">account_balance_wallet</i>
                                Saldo
                            </a>
                            <a class="nav-link mb-4" id="v-pills-keluhan-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/keluhan') }}'" href="#v-pills-keluhan" role="tab" aria-controls="v-pills-keluhan" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">chat</i>
                                Keluhan Pelanggan
                            </a>
                            <a class="nav-link mb-2" id="v-pills-keluar-tab" data-toggle="pill" onclick="window.location='{{ url('/admin/login') }}'" href="#v-pills-keluar" role="tab" aria-controls="v-pills-keluar" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons text-primary-danger md-32 align-middle mr-2">exit_to_app</i>
                                Keluar
                            </a>
                            
                        </div>
                    </div>
                </div>
    
                <div class="container col-8 mt-5">
    
                    <div class="card mb-5 pl-3 pr-3 ml-3" style="border-radius:10px;">
                        <div class="row justify-content-between mb-3 mt-3 ml-0">
                            <h1 class="col font-weight-bold mb-4">000000736</h1>
                            <a class="text-dark" href="{{url('admin/data-member')}}"><i class="col text-right material-icons md-48">close</i></a>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Nama Lengkap</p>
                            <p class="col mb-0">Raditya Dika</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Tanggal Lahir</p>
                            <p class="col mb-0">12 Februari 1997</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Jenis Kelamin</p>
                            <p class="col mb-0">Laki-Laki</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Email</p>
                            <p class="col mb-0">radit@gmail.com</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Nomor HP</p>
                            <p class="col mb-0">+6283145237</p>
                        </div>
    
                        <div class="row justify-content-between mb-2 ml-0">
                            <p class="col font-weight-bold mb-0">Alamat</p>
                            <p class="col mb-4">Medan, Sumatera Utara</p>
                        </div>
    
                        <div class="container mb-2" style="margin-left:-0px">
                            <button type="button" class="btn btn-outline-danger-primary btn-block font-weight-bold mb-4" style="border-radius:30px">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

