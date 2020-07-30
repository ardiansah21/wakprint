<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
    <div class="container mt-5 mb-5">
        <h1 class="font-weight-bold mb-0" style="font-size: 48px;">{{__('Ulas') }}</h1>
        <label class="text-sm mb-2 ml-1" style="font-size: 18px;">{{__('Beri nilai dan ulas produk yang telah dipesan') }}</label>

        {{-- @foreach ($collection as $item) --}}
        <form action="{{ route('ulasan.ulasansaya') }}">
            <div class="row mt-5">
                <div class="col-md-3">
                    @include('member.card_produk')
                </div>
                <div class="col-md-9">
                    <label class="mb-5 ml-0" style="font-size: 24px; color:#BABABA">{{__('Dipesan pada: 21 Februari 2020, 20:35 WIB') }}</label>
                    <div class="row justify-content-left mb-4 ml-0">
                        <div class="rating">
                            <label>
                                <input type="radio" name="stars" value="1" />
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="2" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="3" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="4" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="5" />
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                                <span class="material-icons md-60">star</span>
                            </label>
                        </div>
                        <label class="mt-2 ml-4" style="font-size: 36px;">{{__('Senang') }}</label>
                    </div>
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-9">
                            <div class="form-group mb-4">
                                <textarea class="form-control" 
                                aria-label="Deskripsi Ulasan"
                                placeholder="Masukkan komentar Anda disini..."
                                style="font-size:18px; height:141px;"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary-wakprint btn-block SemiBold"
                                style="border-radius:30px; font-size:24px;">
                                    {{__('Kirim Ulasan') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="form-group">
                                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                                class="img-responsive justify-content-center align-self-center center-block mb-4"
                                alt="" 
                                width="141px" 
                                height="141px" 
                                style="border-radius:8px 8px 8px 8px;">
                                <a href="" class="btn btn-primary-yellow btn-block SemiBold align-self-center my-auto"
                                style="border-radius:30px; font-size:20px;">
                                    {{__('Unggah') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- @endforeach --}}             
        
    </div>
@endsection
