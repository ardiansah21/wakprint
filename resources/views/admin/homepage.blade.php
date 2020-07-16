<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.admin.navbar_after_admin')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:72px">
            <div class="row">
                <div class="col-4 mt-5">
                    <div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-2" id="v-pills-beranda-tab" data-toggle="pill"href="#v-pills-beranda" role="tab" aria-controls="v-pills-beranda" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">home</i>
                                Beranda
                            </a>
                            <a class="nav-link mb-2" id="v-pills-data-member-tab" data-toggle="pill" href="#v-pills-data-member" role="tab" aria-controls="v-pills-data-member" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">history_edu</i>
                                Data Member
                            </a>
                            <a class="nav-link mb-2" id="v-pills-data-pengelola-tab" data-toggle="pill" href="#v-pills-data-pengelola" role="tab" aria-controls="v-pills-data-pengelola" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">print</i>
                                Data Pengelola
                            </a>
                            <a class="nav-link mb-2" id="v-pills-saldo-tab" data-toggle="pill" href="#v-pills-saldo" role="tab" aria-controls="v-pills-saldo" aria-selected="true" style="font-size: 24px;">
                                <i class="material-icons md-32 align-middle mr-2">account_balance_wallet</i>
                                Saldo
                            </a>
                            <a class="nav-link mb-4" id="v-pills-keluhan-tab" data-toggle="pill" href="#v-pills-keluhan" role="tab" aria-controls="v-pills-keluhan" aria-selected="true" style="font-size: 24px;">
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
    
                <div class="tab-content col-8 mt-5">
                    <div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
                        <div class="row justify-content-between mb-4 ml-0">
                            <div class="col">
                                <p class="font-weight-bold">Total Member</p>
                            </div>
        
                            <div class="col">
                                <div class="container bg-light-purple p-4 col text-center mr-4" style="border-radius:10px;">
                                    <h1 class="font-weight-bold">43</h1>
                                </div>
                            </div>
                        </div>
        
                        <div class="row justify-content-between mb-4 ml-0">
                            <div class="col">
                                <p class="font-weight-bold">Total Pengelola Percetakan</p>
                            </div>
        
                            <div class="col">
                                <div class="container bg-light-purple p-4 col text-center mr-4" style="border-radius:10px;">
                                    <h1 class="font-weight-bold">43</h1>
                                </div>
                            </div>
                        </div>
        
                        <div class="row justify-content-between mb-4 ml-0">
                            <div class="col">
                                <p class="font-weight-bold">Jumlah Transaksi</p>
                            </div>
        
                            <div class="col">
                                <div class="container bg-light-purple p-4 col text-center mr-4" style="border-radius:10px;">
                                    <h1 class="font-weight-bold">143</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-data-member" role="tabpanel">
                        <div class="container row jusify-content-between mb-3">
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
                        
                        <div class="container table-scrollbar mb-5 pr-2" >
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

                                    {{-- @foreach ($collection as $item) --}}
                                        <tr onclick="window.location='{{ url('/admin/data-member/detail') }}'">
                                            
                                            {{-- @foreach ($collection as $item) --}}
                                                <td scope="row">000001</td>
                                                <td>Agus</td>
                                                <td>agus@gmail.com</td>
                                                <td>
                                                    <i class="material-icons" style="color: red;" style="margin-left: -100px;">delete</i>
                                                </td>
                                            {{-- @endforeach --}}

                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-data-pengelola" role="tabpanel">
                        <div class="container row jusify-content-between mb-3">
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
                        
                        <div class="container table-scrollbar mb-5 pr-2">
                            <table class="table table-hover">
                                <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                    <tr>
                                        <th></th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Tempat Percetakan</th>
                                        <th scope="col">Email Pemilik Percetakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($collection as $item) --}}
                                        <tr onclick="window.location='{{ url('/admin/data-pengelola/detail') }}'">
                                            {{-- @foreach ($collection as $item) --}}
                                                <th scope="row" class="text-center"><i id="statusVerifikasi" class="material-icons" style="color: #7BD6AF;">check_circle</i></th>
                                                <td>000001</td>
                                                <td>Agus</td>
                                                <td>agus@gmail.com</td>
                                            {{-- @endforeach --}}
                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-saldo" role="tabpanel">
                        <div class="container row jusify-content-between mb-3">
                            <div class="col-10 ml-0">
                                <div class="input-group mb-3 ml-2" role="search">
                                    <input type="text" class="form-control form-control-lg" placeholder="Cari Data Saldo Disini" 
                                    aria-label="Cari Data Saldo Disini" aria-describedby="basic-addon2" style="border-radius:30px;">
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
        
                        <div class="container">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item mr-3">
                                    <a class="nav-link active" id="pills-saldo-member-tab" data-toggle="tab" href="#pills-saldo-member" role="tab"
                                    aria-controls="pills-saldo-member" aria-selected="true" style="border-radius:10px 10px 0px 0px;">
                                    <i class="material-icons align-middle mr-2">account_circle</i>Member</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-saldo-pengelola-tab" data-toggle="tab" href="#pills-saldo-pengelola" role="tab" 
                                    aria-controls="pills-saldo-pengelola" aria-selected="false" style="border-radius:10px 10px 0px 0px;">
                                    <i class="material-icons align-middle mr-2">print</i>Pengelola Percetakan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent" style="margin-left:-20px; margin-right:-40px;">
                                <div class="tab-pane fade show active" id="pills-saldo-member" role="tabpanel" aria-labelledby="pills-saldo-member-tab">
                                    <div class="container my-custom-scrollbar">
                                        <div class="table-scrollbar mb-5 pr-2">
                                            <table class="table table-hover">
                                                <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Kode Pembayaran</th>
                                                        <th scope="col">Jumlah Top Up</th>
                                                        <th scope="col">Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    {{-- @foreach ($collection as $item) --}}
                                                        <tr>

                                                            {{-- @foreach ($collection as $item) --}}
                                                                <td scope="row">000001</td>
                                                                <td>Agus</td>
                                                                <td>329842617</td>
                                                                <td>Rp. 20.000</td>
                                                                <td>Pending</td>
                                                                <td>
                                                                    <a href="{{url('')}}">
                                                                        <i class="material-icons" style="color: #7BD6AF;">check_circle</i>
                                                                    </a>
                                                                    <a href="{{url('/admin/tolak-pengelola')}}">
                                                                        <i class="material-icons" style="color: #FF4949;">cancel</i>
                                                                    </a>
                                                                </td>
                                                            {{-- @endforeach --}}
                                                            
                                                        </tr>
                                                    {{-- @endforeach --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-saldo-pengelola" role="tabpanel" aria-labelledby="pills-saldo-pengelola-tab">
                                    <div class="container my-custom-scrollbar">
                                        <div class="table-scrollbar mb-5 pr-2">
                                            <table class="table table-hover">
                                                <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Jumlah Penarikan</th>
                                                        <th scope="col">Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    {{-- @foreach ($collection as $item) --}}
                                                        <tr>

                                                            {{-- @foreach ($collection as $item) --}}
                                                                <td scope="row">000001</td>
                                                                <td>Agus</td>
                                                                <td>Rp. 20.000</td>
                                                                <td>Pending</td>
                                                                <td>
                                                                    <a href="{{url('')}}">
                                                                        <i class="material-icons" style="color: #7BD6AF;">check_circle</i>
                                                                    </a>
                                                                    <a href="{{url('/admin/tolak-pengelola')}}">
                                                                        <i class="material-icons" style="color: #FF4949;">cancel</i>
                                                                    </a>
                                                                </td>
                                                            {{-- @endforeach --}}
                                                            
                                                        </tr>
                                                    {{-- @endforeach --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-keluhan" role="tabpanel">
                        <div class="container row jusify-content-between mb-3">
                        <div class="col-10">
                            <div class="input-group mb-3 ml-2" role="search">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari Data Saldo Disini" 
                                aria-label="Cari Data Saldo Disini" aria-describedby="basic-addon2" style="border-radius:30px;">
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
                    
                    <div class="container table-scrollbar mb-5 pr-2">
                        <table class="table table-hover">
                            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @foreach ($collection as $item) --}}
                                    <tr>

                                        {{-- @foreach ($collection as $item) --}}
                                            <td scope="row">000001</td>
                                            <td>Agus</td>
                                            <td>Cemananya ini bla bla bla bla</td>
                                            <td>Pending</td>
                                            <td>
                                                <a href="{{url('admin/tanggapi-keluhan')}}">
                                                    <i class="material-icons" style="color: #BC41BE;">play_circle_filled</i>
                                                </a>
                                            </td>
                                        {{-- @endforeach --}}
                                        
                                    </tr>
                                {{-- @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
@endsection
