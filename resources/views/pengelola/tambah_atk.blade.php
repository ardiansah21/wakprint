<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.pengelola.navbar_after_pengelola')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container" style="margin-top:120px;">
            <h1 class="font-weight-bold mb-5 mt-5">Tambah ATK</h1>

            <div class="row justify-content-between mb-4">
                <label class="mb-0 ml-3 mt-2">ATK</label>
                <label class="mb-0 ml-0 mt-2">Harga ATK</label>
                <label class="mb-0 mr-5 mt-2">Jumlah ATK</label>
            </div>

            {{-- @foreach ($collection as $item) --}}
            <div class="row justify-content-between ml-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkboxPensil">
                    <label class="custom-control-label align-middle" for="checkboxPensil">Pensil <i
                            class="material-icons align-middle md-18 ml-2">help</i></label>
                </div>

                <div class="">
                    <p class="font-weight-bold mb-2 ml-4">Rp. 500</p>
                </div>

                <div class="form-group">
                    <label class="label ml-3">Jumlah <i class="fa fa-plus ml-2 mr-2"></i></label>

                    <input type="text ml-3" class="form-input" style="width:48px;">

                    <label class="label ml-2"><i class="fa fa-minus ml-0 mr-5"></i></label>

                </div>
            </div>
            {{-- @endforeach --}}

            <div>
                <label class="mb-4 ml-0 mt-2">Tambahan ATK Anda</label>
                <div class="row justify-content-between mb-2">
                    <div class="col-2">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                            class="img-responsive bg-light" style="width:170px; height:170px; border-radius:10px;">
                        <a href="{{ url('pengelola/produk/tambah') }}" style="color: black;
                            position: absolute;
                            bottom: 40px;
                            right: 5px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2"
                                style="border-radius: 5px;">edit</i>
                        </a>
                    </div>

                    <div class="col-9">
                        <div class="row justify-content-between">
                            <div class="col input-group mb-3">
                                <input type="text" class="form-control form-control-lg pt-2 pb-2" placeholder="Laminating"
                                    aria-label="Laminating" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="col-5 input-group mb-3" style="margin-left:-5px;">
                                Rp &nbsp;<input type="text" class="form-control form-control-lg pt-2 pb-2"
                                    placeholder="3.000" aria-label="3.000" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <p class="mb-2">Deskripsi Fitur</p>
                        <div class="input-group mb-4">
                            <textarea class="form-control" aria-label="Deskripsi Fitur"></textarea>
                        </div>

                    </div>

                    <div class="col-1 align-self-center">
                        <span class="mb-3">
                            <button class="btn btn-circle shadow-sm" role="button"><i
                                    class="material-icons md-36 align-middle"
                                    style="color: white; margin-left:-7px;">add</i></button>
                        </span>
                    </div>

                </div>
            </div>

            <div class="row mb-5 ml-0">
                <div class="col-11 bg-light-purple pl-4 pr-4 pt-2 pb-2" style="border-radius:10px;">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between">
                        <p class="mb-0 ml-2 mt-2">Tulang Kliping Warna</p>
                        <p class="mb-0 ml-2 mt-2">Rp. 500</p>
                    </div>
                    {{-- @endforeach --}}

                </div>

                <div class="col-auto pt-2 pb-2">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mt-2">
                        <i class="material-icons align-middle ml-2">edit</i>
                        <i class="material-icons align-middle text-primary-danger ml-2">delete</i>
                    </div>
                    {{-- @endforeach --}}

                </div>
            </div>

            <div class="row justify-content-between mr-0 mb-5">

                <div class="col text-right">
                    <div class="mb-3">
                        <button type="button"
                            class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                            onclick="window.location='{{ url('/pengelola/kelola-atk') }}'"
                            style="border-radius:30px;">Batal</button>
                    </div>
                </div>

                <div class="col-auto text-right">
                    <div class="mb-3">
                        <button type="button" class="btn btn-lg btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                            onclick="window.location='{{ url('/pengelola/kelola-atk') }}'"
                            style="border-radius:30px;">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
