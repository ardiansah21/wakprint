<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="pt-5 pb-5">
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('FAQ') }}</h1>
        <label class="mb-3" style="font-size: 18px;">{{__('Apa yang bisa kami bantu ?') }}</label>
        <div class="search-input ml-0 mb-5" style="font-size: 18px;">
            <div class="main-search-input-item">
                <input type="text" role="search" class="form-control" placeholder="Cari percetakan atau produk disini"
                    aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                    style="border:0px solid white; border-radius:30px; font-size:18px;">
                    <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                    style="position: absolute;
                    top: 50%; left: 97%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                        search
                    </i>
            </div>
        </div>
        <div class="my-custom-scrollbar pr-2" style="font-size: 18px;">
            <div class="card shadow mb-4" id="pesanProduk">
                <div class="card-header bg-light-purple" id="headingTitleOne">
                    <label class="font-weight-bold text-primary-purple"
                    data-toggle="collapse"
                    data-parent="#pesanProduk"
                    data-target="#collapseOne">
                        {{__('Pesan Produk') }}
                    </label>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingTitleOne" data-parent="#pesanProduk">
                    <div class="card-body">
                        <label>{{__('Bagaimana cara memesan produk?') }}</label>
                        <br><br>
                        <label>{{__('Harus diantar ke rumah?') }}</label>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4" id="menambahFiturToko">
                <div class="card-header bg-light-purple" id="headingTitleTwo">
                    <label class="font-weight-bold text-primary-purple" data-toggle="collapse" data-parent="#menambahFiturToko" data-target="#collapseTwo">
                        {{__('Cara Menambah Fitur Toko') }}
                    </label>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTitleTwo" data-parent="#menambahFiturToko">
                    <div class="card-body">
                        <label>{{__('Bagaimana cara menambah fitur toko?') }}</label>
                        <br><br>
                        <label>{{__('Harus ditambah fiturnya?') }}</label>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4" id="formatDokumen">
                <div class="card-header bg-light-purple" id="headingTitleThree">
                    <h5 class="font-weight-bold text-primary-purple" data-toggle="collapse" data-parent="#formatDokumen" data-target="#collapseThree">
                        {{__('Format dokumen yang mendukung') }}
                    </h5>
                </div>
                <div id="collapseThree" class="collapse show" aria-labelledby="headingTitleThree" data-parent="#formatDokumen">
                    <div class="card-body">
                        <label>{{__('Apa saja format dokumen yang mendukung?') }}</label>
                        <br><br>
                        <label>{{__('Apakah harus berbentuk format pdf?') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
