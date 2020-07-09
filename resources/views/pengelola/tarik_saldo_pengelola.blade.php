<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid mt-4">
        <div class="container" style="margin-top: 120px;">
            <h1 class="font-weight-bold ml-0 mb-5">Tarik Saldo</h1>

            <label class="font-weight-bold mb-0 ml-1">Nama Pemilik Rekening</label>
            <p class="mb-2 ml-1">Agus</p>

            <label class="font-weight-bold mb-0 ml-1">Nama Bank</label><br>
            <label class="mb-2 ml-1">BRI</label><br>

            <label class="font-weight-bold mb-0 ml-1">Nomor Rekening</label><br>
            <p class="mb-4 ml-1">016748359004048</p>
            
            <label class="font-weight-bold mb-2 ml-1">Jumlah Saldo yang Ditarik</label>
            <div class="row justify-content-between mb-2 ml-0">
                
                <label class="col-auto text-center mb-0 mr-0">Rp. </label>
                <div class="col input-group mb-4">
                    <input type="text" class="form-control form-control-lg border-primary-purple pt-2 pb-2" placeholder="300.000" 
                    aria-label="300.000" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            
            <div class="container bg-light-purple ml-0 mb-5" style="height:200px; border-radius:10px;">
                <div class="short-scrollbar">
                        <div class="container p-3">
                            <h4 class="font-weight-bold mb-4">Info Tarik Saldo, Syarat, dan Ketentuan</h4>
                            <p class=" mr-3 mb-4">Ini adalah halaman informasi untuk penarikan saldo serta syarat juga ketentuan apa saja yang harus di miliki oleh si penarik saldo. 
                            Silahkan perhatikan baik baik apa saja yang harus diperhatikan pada syarat.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, assumenda nostrum explicabo numquam eius cupiditate ducimus illo optio deserunt pariatur quod, magni necessitatibus fugiat, fugit ad unde qui quo sed!
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde consequatur quae expedita soluta repellat, libero itaque saepe alias sed sapiente totam, nobis minus deleniti natus, laboriosam molestiae eaque odit accusantium.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae autem sapiente cumque iusto at iure aliquam fuga, et repellat similique earum libero nulla voluptate distinctio. Temporibus labore ipsam provident est!
                            </p>
                        </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col text-right">
                    <div class="mb-3">
                        <button type="button" class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                        onclick="window.location='{{ url('/pengelola/saldo') }}'"
                        style="border-radius:30px;">Batal</button>
                    </div>
                </div>

                <div class="col-auto text-right">
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                        onclick="window.location='{{ url('/pengelola/transaksi/detail') }}'"
                        style="border-radius:30px;">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

