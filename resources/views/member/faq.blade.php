<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @extends('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid" style="margin-top: 72px;">
        <div class="container pt-5 pb-5">
            <h1 class="font-weight-bold mb-5 ml-2">FAQ</h1>
            <p class="ml-3 mb-3">Apa yang bisa kami bantu ?</p>

            <div class="container mb-5" style="">
                <div class="input-group mb-3" role="search">
                    <input type="text" class="form-control form-control-lg" placeholder="Cari pertanyaan yang dapat membantu Anda"
                    style="border-radius:30px;">
                    <i class="material-icons md-36" style="position: absolute;
                    top: 50%; left: 96%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">search
                    </i>
                </div>
            </div>

            <div class="container my-custom-scrollbar">
                    <div class="card shadow mb-4" id="pesanProduk">
                        <div class="card-header bg-light-purple" id="headingTitleOne">
                            <h5 class="font-weight-bold text-primary-purple" data-toggle="collapse" data-parent="#pesanProduk" data-target="#collapseOne">
                                Pesan Produk
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingTitleOne" data-parent="#pesanProduk">
                            <div class="card-body">
                                <label>Bagaimana cara memesan produk?</label><br><br>
                                <label>Harus diantar ke rumah?</label>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4" id="menambahFiturToko">
                        <div class="card-header bg-light-purple" id="headingTitleTwo">
                            <h5 class="font-weight-bold text-primary-purple" data-toggle="collapse" data-parent="#menambahFiturToko" data-target="#collapseTwo">
                                Cara Menambah Fitur Toko
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTitleTwo" data-parent="#menambahFiturToko">
                            <div class="card-body">
                                <label>Bagaimana cara menambah fitur toko?</label><br><br>
                                <label>Harus ditambah fiturnya?</label>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4" id="formatDokumen">
                        <div class="card-header bg-light-purple" id="headingTitleThree">
                            <h5 class="font-weight-bold text-primary-purple" data-toggle="collapse" data-parent="#formatDokumen" data-target="#collapseThree">
                                Format dokumen yang mendukung
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingTitleThree" data-parent="#formatDokumen">
                            <div class="card-body">
                                <label>Apa saja format dokumen yang mendukung?</label><br><br>
                                <label>Apakah harus berbentuk format pdf?</label>
                            </div>
                        </div>
                    </div>
            </div>
        
        </div>
        
    </div>
@endsection

@section('footer')
        <footer>
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-3">
                            <h4 id="judulLogoWakprint" class="font-weight-bold">WAKPRINT</h4>
                    </div>

                    <div class="col-3">
                            <h4 class="mb-4 font-weight-bold">Kontak</h4>
                            <p class="mb-2">+6281263638</p>
                            <p class="mb-2">dev@wakprint.com</p>
                                    
                    </div>

                    <div class="col-3">
                            <h4 class="mb-4 font-weight-bold">Informasi Umum</h4>
                            <p class="mb-2"><a class="text-dark" href="">Tentang Kami</a></p>
                            <p><a class="text-dark" href="#">Kebijakan Privasi</a></p>
                            <p><a class="text-dark" href="#">Syarat & Ketentuan</a></p>
                            <p><a class="text-dark" href="{{ url('/member/faq') }}">FAQ</a></p>
                    </div>

                    <div class="col-md-3">
                            <h4 class="font-weight-bold mb-3">Sosial Media</h4>
                            <div class="row justify-content-left mb-4">
                                <img src="{{url('instagram.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('facebook.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('youtube.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                                <img src="{{url('whatsapp.png')}}" class="img-responsive ml-4" alt="" width="24" height="24">
                            </div>
                            <div class="" style="margin-left:-0px; margin-top:-10px">
                                <p>
                                    <i class="fa fa-copyright"> Copyright Wakprint 2020</i>
                                </p>
                            </div>
                    </div>
                </div>
            </div>
        </footer>
@endsection
