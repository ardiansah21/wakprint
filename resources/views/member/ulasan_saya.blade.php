<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">

        <div class="container-fluid pt-2 pb-5" style="margin-top:72px">

            <div class="container mt-5">
                <h1 class="font-weight-bold mb-0">Ulasan Saya</h1>
                <p class="mb-2 ml-1">Detail produk yang telah Anda ulas</p>

                {{-- @foreach ($collection as $item) --}}
                <div class="row mt-5">
                    <div class="col-3">
                        @include('card_produk')
                    </div>

                    <div class="col-9">
                        <div class="container mb-5">
                            <div class="row">
                                <div class="col-9 ml-0">
                                    <h5>Dipesan pada: 21 Februari 2020, 20:35 WIB</h5>
                                </div>
                                <div class="text-center align-self-right col-3">
                                    <button type="button" class="btn btn-primary-yellow btn-sm btn-block font-weight-bold"
                                        onclick="window.location='{{ url('/member/konfigurasi-file') }}'"
                                        style="border-radius:30px;">Pesan Lagi</button>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-left ml-0 mb-4">
                            <div style="color:#FCFF82;">
                                <span class="material-icons md-48">star</span>
                                <span class="material-icons md-48">star</span>
                                <span class="material-icons md-48">star</span>
                                <span class="material-icons md-48">star</span>
                                <span class="material-icons md-48">star</span>
                            </div>
                            <h3 class="mt-2 ml-4">Senang</h3>
                        </div>

                        <div class="container ml-0 mb-3">
                            <div class="row">
                                <div class="container col-2">
                                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                                        class="img-responsive justify-content-center align-self-center center-block" alt=""
                                        width="120px" height="120px" style="border-radius:8px 8px 8px 8px;">
                                </div>
                                <div class="container col-10 ml-0">
                                    <div class="card" style="height:250px;">
                                        <p class="card-text mb-2 ml-4 mt-3">"Mantap sekali gannnn"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer')
@endsection
