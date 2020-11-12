<!-- Menghubungkan dengan view template master -->
@extends('layouts.member')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>

                <div class="panel-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-4 bg-light-purple" style="border-radius:5px;">
            <div class="search-input mt-3 mb-3">
                <div class="main-search-input-item">
                    <input type="text" role="search" class="form-control" placeholder="Cari pengelola percetakan disini"
                        aria-label="Cari percetakan atau produk disini" aria-describedby="basic-addon2"
                        style="border:0px solid white; border-radius:30px; font-size:18px;">
                    <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3" style="position: absolute;
                            top: 50%; left: 95%;
                            transform:
                            translate(-50%, -50%);
                            -ms-transform: translate(-50%, -50%);">
                        search
                    </i>
                </div>
            </div>
            <div class="my-custom-scrollbar mb-0">

                {{-- @foreach ($collection as $item) --}}
                <div class="row justify-content-between mb-4">
                    <div class="align-self-center col-md-auto" style="max-width: 50px;">
                        <img class="img-responsive" src="https://ptetutorials.com/images/user-profile.png" width="50"
                            height="50" alt="no logo">
                    </div>
                    <div class="col-md-auto">
                        <label class="d-inline-block text-truncate SemiBold mb-0"
                            style="font-size:18px; max-width: 170px;">{{__('Ali Susi')}}</label>
                        <br>
                        <label class="d-inline-block text-truncate mb-0"
                            style="font-size:14px; max-width: 170px;">{{__('Apa cerita kita hari')}}</label>
                    </div>
                    <div class="col-md-auto text-right">
                        <label class="mb-2" style="font-size:12px; color:#575757">{{__('14:00 WIB')}}</label>
                        <br>
                        <label class="badge bg-primary-danger text-white pl-1 pr-1"
                            style="border-radius: 50px;font-size:8px;">{{__('1')}}</label>
                    </div>
                </div>
                {{-- @endforeach --}}

            </div>
        </div>
        <div class="col-md-8">
            <div class="bg-light-purple mb-0 p-3 ml-3" style="border-radius:5px 5px 0px 0px;">
                <div class="row justify-content-between mb-0 ml-0">
                    <div class="col-md-1" style="max-width: 40px;">
                        <img class="img-responsive" src="https://ptetutorials.com/images/user-profile.png" width="40"
                            height="40" alt="no logo">
                    </div>
                    <div class="col-md-8 align-self-center">
                        <label class="text-truncate SemiBold mb-0" style="font-size:18px; max-width:420px;">
                            {{__('Ali Susisadsadsadssadassadsadasdsadsaasddadssadsas')}}
                            <i class="material-icons md-18 text-primary-success ml-2">
                                fiber_manual_record
                            </i>
                        </label>
                    </div>
                    <div class="col-md-auto text-right align-self-center">
                        <div class="row justify-content-between">
                            <i class="material-icons md-32 mr-4" style="color:#575757;">search</i>
                            <i class="material-icons md-32 mr-4" style="color:#575757;">attach_file</i>
                            <i class="material-icons md-32 mr-4" style="color:#575757;">more_vert</i>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="my-custom-scrollbar mb-4" style="height:550px;">
                    <div class="mt-4 ml-4">

                        {{-- @foreach ($collection as $item) --}}
                        <div class="d-flex justify-content-end ml-0 mb-4 mr-4">
                            <div class="bg-primary-purple text-white pl-4 pr-4 pt-2 pb-2"
                                style="width:50%; border-radius:15px 15px 0px 15px;">
                                <p class="mb-0" style="font-size:14px;">
                                    {{__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex neque,
                                        molestias id nulla tempore error cum vero? Nam dignissimos sed blanditiis,
                                        corporis ullam, placeat, nesciunt obcaecati debitis ex odio mollitia?')}}
                                </p>
                                <p class="text-right mb-0 mr-2" style="font-size:12px;">{{__('14:00')}}</p>
                            </div>
                        </div>
                        <div class="ml-0 pl-4 pr-4 pt-2 pb-2"
                            style="background-color:#F4F4F4; width:50%; border-radius:15px 15px 15px 0px;">
                            <p class="mb-0" style="font-size:14px;">
                                {{__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex neque,
                                    molestias id nulla tempore error cum vero? Nam dignissimos sed blanditiis,
                                    corporis ullam, placeat, nesciunt obcaecati debitis ex odio mollitia?')}}
                            </p>
                            <p class="text-right mb-0 mr-2" style="font-size:12px;">{{__('14:00')}}</p>
                        </div>
                        <div class="row justify-content-between mb-4 mt-4 ml-4 mr-4">
                            <div class="col-md-5 row row-bordered"></div>
                            <p class="col-md-auto my-auto" style="color: #C4C4C4; font-size:12px;">
                                {{__('Hari ini')}}
                            </p>
                            <div class="col-md-5 row row-bordered"></div>
                        </div>
                        {{-- @endforeach --}}

                    </div>
                </div>

                <form action="" style="font-size:18px;">
                    <div class="row justify-content-between mb-0 ml-0">
                        <div class="align-self-center col-md-1"
                            style="color:#575757; margin-right:0px; margin-left:0px;">
                            <i class="material-icons align-middle md-48 mr-4">emoji_emotions</i>
                        </div>
                        <div class="col-md-10 form-group mb-0">
                            <input type="text"
                                class="form-control form-control-lg border-primary-purple pl-4 pr-4 pt-2 pb-2"
                                placeholder="Masukkan Pesan Anda disini" style="border-radius:30px;">
                        </div>
                        <div class="col-md-1 align-self-center text-primary-purple">
                            <i class="material-icons align-middle md-48 mr-4">send</i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
