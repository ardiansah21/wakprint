@extends('layouts.member')

@section('content')
    <div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
        <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Ulasan') }}</h1>
        <div class="mb-4">
            <select class="btn btn-default dropdown dropdown-toggle border border-gray" name="filterulasan" style="font-size: 18px;">
                <option value="Untuk Diulas (3)">{{__('Untuk Diulas (3)')}}</option>
                <option value="Sudah Diulas">{{__('Sudah Diulas')}}</option>
            </select>
            {{-- <div class="dropdown">
                <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" style="font-size: 18px;">
                    {{__('Untuk Diulas (3)') }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                style="font-size: 18px;">
                    <a class="dropdown-item" href="#">{{__('Sudah Diulas') }}</a>
                    <a class="dropdown-item" href="#">{{__('Tidak Diulas') }}</a>
                </div>
            </div> --}}
        </div>
        <div class="custom-scrollbar-ulasan pr-4">
            @foreach ($produk as $p)
                <div class="card shadow-sm mb-3 pl-4 pr-2" style="border-radius: 10px;">
                    <div class="row">
                        <div class="container text-center align-self-center col-md-2">
                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg" width="100" height="100" alt="no logo">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title text-truncate SemiBold mb-1" style="font-size: 24px;">{{$p->nama}}</h5>
                                <label class="card-text text-truncate mb-2" style="font-size: 18px;">{{$p->partner->nama_toko}}</label>
                                <div class="row align-middle" style="font-size: 14px;">
                                    <div class="col-md-9 my-auto">
                                        <label class="card-text text-muted">{{__('Dipesan pada: 21 Februari 2020 20:35 WIB') }}</label>
                                    </div>
                                    <div class="text-right col-md-3">
                                        <a href="{{ route('ulasan.ulas',$p->id_produk) }}"
                                            class="btn btn-primary-wakprint btn-rounded
                                            ml-1 pt-1 pb-1 pl-4 pr-4
                                            font-weight-bold text-center"
                                            style="border-radius:30px">{{__('Ulas') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
