<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
        <div class="container">
            <div class="row" style="margin-top:72px">
                <div class="container col-4 bg-light-purple mt-5 mb-5" style="border-radius:5px;">

                    <div class="mt-3">
                        <div class="input-group mb-3" role="search">
                            <input type="text" class="form-control form-control-lg"
                                placeholder="Cari nama percetakan disini" style="border-radius:30px;">
                            <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                                style="position: absolute;
                                top: 50%; left: 90%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                                search
                            </i>
                        </div>
                    </div>

                    <div class="my-custom-scrollbar mb-0" style="margin-left:-0px;">
                        <div>

                            {{-- @foreach ($collection as $item) --}}
                            <div class="row justify-content-between mb-4">
                                <div class="container align-self-center col-auto"
                                    style="margin-right:-10px; margin-left:0px;">
                                    <img class="img-responsive" src="https://ptetutorials.com/images/user-profile.png"
                                        width="64" height="64" alt="no logo">
                                </div>

                                <div class="container col-5 align-self-center" style="margin-left:0px;">
                                    <p class="font-weight-bold mb-0">Ali Susi</p>
                                    <small>
                                        <p class=" mb-0">Apa cerita kita hari bila...</p>
                                    </small>
                                </div>

                                <div class="container col-auto text-right" style="margin-left:0px;">
                                    <small>
                                        <p class="mb-2">14:00 WIB</p>
                                    </small>
                                    <label class="badge badge-danger bg-primary-danger"
                                        style="border-radius: 50px;">1</label>
                                </div>
                            </div>
                            {{-- @endforeach --}}

                        </div>
                    </div>
                </div>

                <div class="container col-8 mt-5">

                    <div class="container bg-light-purple mb-0 p-3 ml-3" style="border-radius:5px 5px 0px 0px;">
                        <div class="row justify-content-between mb-0 ml-0">
                            <div class="container align-self-center col-auto" style="margin-right:-10px; margin-left:0px;">
                                <img class="img-responsive" src="https://ptetutorials.com/images/user-profile.png"
                                    width="32" height="32" alt="no logo">
                            </div>

                            <div class="container col-8 align-self-center" style="margin-left:0px;">
                                <p class="font-weight-bold mb-0">Ali Susi <i
                                        class="material-icons md-18 text-primary-success align-middle ml-2">fiber_manual_record</i>
                                </p>
                            </div>

                            <div class="container col-auto text-right align-self-center" style="margin-left:0px;">
                                <div class="row justify-content-between">
                                    <i class="material-icons md-32 mr-4" style="color:#575757;">search</i>
                                    <i class="material-icons md-32 mr-4" style="color:#575757;">attach_file</i>
                                    <i class="material-icons md-32 mr-4" style="color:#575757;">more_vert</i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="my-custom-scrollbar mb-4 ml-3" style="height:550px;">
                            <div class="container mt-4">

                                {{-- @foreach ($collection as $item) --}}
                                <div class="container d-flex justify-content-end ml-0 mb-4">
                                    <div class="bg-primary-purple text-white pl-4 pr-4 pt-2 pb-2"
                                        style="width:50%; border-radius:15px 15px 0px 15px;">
                                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex neque,
                                            molestias id nulla tempore error cum vero? Nam dignissimos sed blanditiis,
                                            corporis ullam, placeat, nesciunt obcaecati debitis ex odio mollitia?</p>
                                        <p class="text-right mb-0 mr-2">14:00</p>
                                    </div>
                                </div>

                                <div class="container ml-0">
                                    <div class="pl-4 pr-4 pt-2 pb-2"
                                        style="background-color:#F4F4F4; width:50%; border-radius:15px 15px 15px 0px;">
                                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex neque,
                                            molestias id nulla tempore error cum vero? Nam dignissimos sed blanditiis,
                                            corporis ullam, placeat, nesciunt obcaecati debitis ex odio mollitia?</p>
                                        <p class="text-right mb-0 mr-2" style="">14:00</p>
                                    </div>
                                </div>

                                <div class="row justify-content-between mb-5 mt-5 ml-4 mr-4">
                                    <div class="col-5 row row-bordered"></div>
                                    <p class="col-auto align-middle" style="color: #C4C4C4; margin-bottom:-7px;">Hari ini
                                    </p>
                                    <div class="col-5 row row-bordered"></div>
                                </div>
                                {{-- @endforeach --}}

                            </div>
                        </div>

                        <div class="container mb-0" style="margin-right:-0px; margin-left:-0px;">
                            <div class="row justify-content-between mb-0 ml-0">
                                <div class="container align-self-center col-1"
                                    style="color:#575757; margin-right:0px; margin-left:0px;">
                                    <i class="material-icons align-middle md-48 mr-4">emoji_emotions</i>
                                </div>

                                <div class="col-10 input-group mb-0">
                                    <input type="text"
                                        class="form-control form-control-lg border-primary-purple pl-4 pr-4 pt-2 pb-2"
                                        placeholder="Masukkan Pesan Anda disini" style="border-radius:30px;">
                                </div>

                                <div class="container col-1 align-self-center text-primary-purple" style="margin-left:0px;">
                                    <i class="material-icons align-middle md-48 mr-4">send</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('member.footer_member')
@endsection
