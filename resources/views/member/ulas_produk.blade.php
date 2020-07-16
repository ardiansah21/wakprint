<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container-fluid pt-2 pb-5" style="margin-top:72px">
            <div class="container mt-5">
                <h1 class="font-weight-bold mb-0">Ulas</h1>
                <label class="text-sm mb-2 ml-1">Beri nilai dan ulas produk yang telah dipesan</label>
                
                {{-- @foreach ($collection as $item) --}}
                <div class="row mt-5">
                    <div class="col-3">
                        @include('card_produk')
                    </div>

                    <div class="col-9">
                        <h5 class="mb-5 ml-0">Dipesan pada: 21 Februari 2020, 20:35 WIB</h5>
                        <div class="row justify-content-left mb-4 ml-0">
                            <div>
                                <form class="rating">
                                    <label>
                                        <input type="radio" name="stars" value="1" />
                                        <span class="material-icons md-48">star</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="2" />
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="3" />
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="4" />
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="stars" value="5" />
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                        <span class="material-icons md-48">star</span>
                                    </label>
                                </form>
                            </div>
                            <h3 class="mt-2 ml-4">Senang</h3>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <div class="input-group mb-4" style="height:150px;">
                                        <textarea class="form-control" aria-label="Deskripsi Ulasan"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary-wakprint btn-block font-weight-bold"
                                        onclick="window.location='{{ url('/member/ulasan-saya') }}'"
                                        style="border-radius:30px;">Kirim Ulasan</button>
                                </div>
                                <div class="align-self-center col-auto">
                                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                                        class="img-responsive justify-content-center align-self-center center-block mb-4"
                                        alt="" width="150px" height="150px" style="border-radius:8px 8px 8px 8px;">
                                    <button type="button"
                                        class="btn btn-primary-yellow btn-block font-weight-bold align-self-center"
                                        style="border-radius:30px; width:150px;">Unggah</button>
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
