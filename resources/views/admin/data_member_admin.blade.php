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
    
                    <div class="row jusify-content-between mb-3">
                        <div class="col-10">
                            <div class="input-group mb-3" role="search">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari Data Member Disini" 
                                aria-label="Cari Data Member Disini" aria-describedby="basic-addon2" style="border-radius:30px;">
                                <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                                top: 50%; left: 95%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                    search
                                </i>
                            </div>
                        </div>
    
                        <div class="col-2">
                            <div class="dropdown">
                                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Semua
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Terbaru</a>
                                    <a class="dropdown-item" href="#">Tinggi ke Rendah</a>
                                    <a class="dropdown-item" href="#">Rendah ke Tinggi</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="table-scrollbar mb-5 pr-2" >
                        <table class="table table-hover">
                            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                    <td scope="row">000001</td>
                                    <td>Agus</td>
                                    <td>agus@gmail.com</td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                    </td>
                                </tr>
                                <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                    <td scope="row">000002</td>
                                    <td>Agus</td>
                                    <td>agus@gmail.com</td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                    </td>
                                </tr>
                                <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                    <td scope="row">000003</td>
                                    <td>Agus</td>
                                    <td>agus@gmail.com</td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                    </td>
                                </tr>
                                <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                    <td scope="row">000004</td>
                                    <td>Agus</td>
                                    <td>agus@gmail.com</td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                    </td>
                                </tr>
                                <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                    <td scope="row">000005</td>
                                    <td>Agus</td>
                                    <td>agus@gmail.com</td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                    </td>
                                </tr>
                                <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                    <td scope="row">000005</td>
                                    <td>Agus</td>
                                    <td>agus@gmail.com</td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                    </td>
                                </tr>
                                <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                    <td scope="row">000005</td>
                                    <td>Agus</td>
                                    <td>agus@gmail.com</td>
                                    <td>
                                        <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

