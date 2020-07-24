@extends('layouts.pengelola')

@section('content')
    <div class="container mt-5 mb-5"
        style="font-size: 16px;">
        <label class="font-weight-bold mb-4 ml-0 mr-0"
            style="font-size:36px;">
            {{__('Tambah ATK') }}
        </label>
        <div class="row justify-content-between mb-4 ml-0 mr-0">
            <label class="mb-0 mt-2">
                {{__('ATK') }}
            </label>
            <label class="mb-0 mt-2">
                {{__('Harga ATK') }}
            </label>
            <label class="mb-0 mt-2">
                {{__('Jumlah ATK') }}
            </label>
        </div>
        <form action="">
            {{-- @foreach ($collection as $item) --}}
            <div class="row justify-content-between ml-0 mr-0">
                <div class="form-group custom-control custom-checkbox">
                    <input type="checkbox"
                        class="custom-control-input"
                        id="checkboxPensil">
                    <label class="custom-control-label align-middle"
                        for="checkboxPensil">
                        {{__('Pensil') }}
                    </label>
                </div>
                <label class="font-weight-bold mb-2 ml-0">
                    {{__('Rp. 5.000') }}
                </label>
                <div class="form-group">
                    <label class="ml-0">
                        <i class="fa fa-plus ml-2 mr-2"></i>
                    </label>
                    <input type="text ml-3"
                        class="form-input"
                        style="width:48px;">
                    <label class="ml-2">
                        <i class="fa fa-minus ml-0 mr-0"></i>
                    </label>
                </div>
            </div>
            {{-- @endforeach --}}

            <div>
                <label class="mb-4 ml-0 mt-2">
                    {{__('Tambahan ATK Anda') }}
                </label>
                <div class="row justify-content-between mb-2">
                    <div class="col-md-2"
                        style="position: relative">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                            class="img-responsive bg-light"
                            style="width:163px;
                                height:163px;
                                border-radius:10px;">
                        <a href=""
                            style="color: black;
                                position: relative;
                                bottom: 40px;
                                left:130px;
                                right: 0px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2"
                                style="border-radius: 5px;">
                                edit
                            </i>
                        </a>
                    </div>
                    <div class="col-md-9">
                        <div class="row justify-content-between">
                            <div class="col-md-7 form-group mb-3">
                                <input type="text"
                                    class="form-control form-control-lg pt-2 pb-2"
                                    placeholder="Laminating"
                                    aria-label="Laminating"
                                    aria-describedby="inputGroup-sizing-sm"
                                    style="font-size: 16px;">
                            </div>
                            <div class="col-md-5 form-group input-group mb-3">
                                Rp &nbsp;
                                <input type="text"
                                    class="form-control form-control-lg pt-2 pb-2"
                                    placeholder="3.000" 
                                    aria-label="3.000" 
                                    aria-describedby="inputGroup-sizing-sm"
                                    style="font-size: 16px;">
                            </div>
                        </div>
                        <label class="mb-2">
                            {{__('Deskripsi Fitur') }}
                        </label>
                        <div class="form-group mb-4">
                            <textarea class="form-control"
                                aria-label="Deskripsi Fitur"
                                placeholder="Masukkan Deskripsi ATK Anda"></textarea>
                        </div>
                    </div>
                    <div class="col-md-auto align-self-center">
                        <button class="btn btn-circle shadow-sm mb-3"
                            role="button">
                            <i class="material-icons md-36 align-middle"
                                style="color: white; 
                                    margin-left:-7px;">
                                add
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between mb-5 ml-0">
                <div class="col-md-11 bg-light-purple pl-4 pr-2 pt-2 pb-2"
                    style="border-radius:10px;">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between"
                        style="width:100%;">
                        <label class="col-md-9 text-break mb-0">
                            {{__('Tulang Kliping Warna') }}
                        </label>
                        <label class="col-md-3 text-right mb-0">
                            {{__('Rp. 500') }}
                        </label>
                    </div>
                    {{-- @endforeach --}}

                </div>
                <div class="col-md-auto pt-2 pb-2">

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mr-0">
                        <i class="material-icons align-middle ml-2">
                            edit
                        </i>
                        <i class="material-icons align-middle text-primary-danger ml-2">
                            delete
                        </i>
                    </div>
                    {{-- @endforeach --}}

                </div>
            </div>
            <div class="row justify-content-end ml-0 mr-0 mb-5">
                <div class="form-group mr-3">
                    <button class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;">
                        {{__('Batal') }}
                    </button>
                </div>
                <div class="form-group mr-0">
                    <button class="btn btn-lg btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;">
                        {{__('Tambah') }}
                    </button>
                </div>
            </div>
        </form>
        
    </div>
@endsection
