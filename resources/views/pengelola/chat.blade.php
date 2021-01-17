<!-- Menghubungkan dengan view template master -->
@extends('layouts.pengelola')
@section('style')
    <style>
        .active {
            color: black !important;
            background-color: #EBD1EC !important;
            border: #EBD1EC 1px solid !important;
        }

    </style>
@endsection
@section('content')
    <chat-partner-component inline-template>
        <div>
            <div v-if="pesanans.length > 0" class="container my-5">
                <div class="row">
                    <div class="col-md-4">
                        <label class="SemiBold mb-4" style="font-size: 24px;">Pesanan</label>
                        <div class="my-custom-scrollbar">
                            <div class="list-group mb-4" style="border-radius: 10px;">
                                <a v-for="(pesanan, index) in pesanans" v-bind:key="index"
                                    class="pointer list-group-item list-group-item-action flex-column align-items-start"
                                    :class="[{'active': isActive === index}]" v-on:click="fetchMessages(pesanan.id)">
                                    <div class="d-flex w-10 justify-content-between">
                                        <label class="SemiBold mb-4" style="font-size: 18px;">ID Pesanan :
                                            @{{ pesanan . id }}</label>
                                        {{-- <small>3 days ago</small>
                                        --}}
                                        <span v-if="pesanan.count" class="badge badge-danger">@{{ pesanan . count }}</span>
                                    </div>
                                    <div class="row justify-content-left ml-0 mr-0">
                                        <label class="align-self-center mb-1 mr-2" style="font-size: 14px;">Pelanggan
                                            :</label>
                                        <p class="SemiBold mb-2" style="font-size: 16px;">@{{ pesanan . nama_member }}</p>
                                    </div>
                                    <label class="badge badge-sm text-white SemiBold py-2 px-2 mb-1 mr-2"
                                        style="background-color:#BC41BE; border-radius:8px; font-size: 12px;">@{{ pesanan . penerimaan }}</label>
                                    <label v-if="pesanan.status === 'Pending' || pesanan.status === 'Diproses'"
                                        class="badge badge-sm SemiBold py-2 px-2 mb-1"
                                        style="background-color: #FCFF82; border-radius:8px; color: black; font-size: 12px;">@{{ pesanan . status }}</label>
                                    <label v-else-if="pesanan.status === 'Selesai'"
                                        class="badge badge-sm SemiBold py-2 px-2 mb-1"
                                        style="background-color: #7BD6AF; border-radius:8px; color: white; font-size: 12px;">@{{ pesanan . status }}</label>
                                    <label v-else class="badge badge-sm SemiBold py-2 px-2 mb-1"
                                        style="background-color: #FF4949; border-radius:8px; color: white; font-size: 12px;">@{{ pesanan . status }}</label>

                                    {{-- <small>Donec id elit .</small>
                                    --}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div v-if="isActive != null" style="border: #EBD1EC 1px solid; border-radius: 10px;">
                            <div class="bg-light-purple px-4 py-3 mb-0" style="border-radius: 10px 10px 0px 0px;">
                                <div class="row  mb-0 ml-0">
                                    <div class="">
                                        <img class="rounded-md rounded-circle img-responsive" :src="member.avatar"
                                            alt="no logo" style="width: 45px;height:45px;">
                                    </div>
                                    <div class="align-self-center ml-3">
                                        <label class="text-truncate align-middle SemiBold mb-0"
                                            style="font-size:18px; max-width:420px;">
                                            {{-- @{{ users[this . isActive] . name }}
                                            --}}
                                            @{{ member . nama }}
                                            {{-- <i
                                                class="material-icons md-18 text-primary-success ml-2">
                                                fiber_manual_record
                                            </i> --}}
                                        </label>
                                    </div>
                                    {{-- <div
                                        class="col-md-auto text-right align-self-center">
                                        <div class="row justify-content-between">
                                            <i class="material-icons md-32 mr-4" style="color:#575757;">search</i>
                                            <i class="material-icons md-32 mr-4" style="color:#575757;">attach_file</i>
                                            <i class="material-icons md-32 mr-4" style="color:#575757;">more_vert</i>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="row justify-content-end py-3 px-2 ml-0 mr-0 mb-0"
                                style="border-bottom: #EBD1EC 1px solid; border-radius: 0px;">
                                <a :href="'pesanan/detail/'+ pesanans[isActive].id_pesanan "
                                    class="SemiBold align-self-right py-2 px-4"
                                    style="border-radius: 10px; background-color: #7BD6AF; color:white; text-decoration:none;">Lihat
                                    Detail Pesanan</a>
                            </div>
                            <div class="card-body card-message my-custom-scrollbar" id="message-scroll">
                                <div v-if="messages.length == 0">
                                    <label class="mt-5 center" style="font-size: 24px; color:#BC41BE;">Belum Ada
                                        Pesan</label>
                                </div>
                                <div v-else>
                                    <div v-for="(message, index) in messages" v-bind:key="index" class="mt-4 ml-4">
                                        <div v-if="message.from_user == 'partner'"
                                            class="d-flex justify-content-end ml-0 mb-4 mr-4">
                                            <div class="bg-primary-purple text-white pl-4 pr-4 pt-2 pb-2"
                                                style="width:50%; border-radius:15px 15px 0px 15px;">
                                                <p class="mb-0" style="font-size:14px;">
                                                    @{{ message . pesan }}
                                                </p>
                                                <p class="text-right mb-0 mr-2" style="font-size:12px;">
                                                    @{{ new Date(message . created_at) . toLocaleString() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div v-if="message.from_user == 'member'" class="ml-0 pl-4 pr-4 pt-2 pb-2"
                                            style="background-color:#F4F4F4; width:50%; border-radius:15px 15px 15px 0px;">
                                            <p class="mb-0" style="font-size:14px;">
                                                @{{ message . pesan }}
                                            </p>
                                            <p class="text-right mb-0 mr-2" style="font-size:12px;">
                                                @{{ new Date(message . created_at) . toLocaleString() }}
                                            </p>
                                        </div>

                                        {{-- <div
                                            class="row justify-content-between mb-4 mt-4 ml-4 mr-4">
                                            <div class="col-md-5 row row-bordered"></div>
                                            <p class="col-md-auto my-auto" style="color: #C4C4C4; font-size:12px;">
                                                {{ __('Hari ini') }}
                                            </p>
                                            <div class="col-md-5 row row-bordered"></div>
                                        </div> --}}


                                    </div>
                                </div>
                            </div>
                            <form @submit.prevent="sendMessage" style="font-size:18px;">
                                <div class="row justify-content-between pl-2 mt-2 mb-0 ml-0 mr-0"
                                    style="background-color:#EBD1EC; border-top:#EBD1EC 1px solid; border-radius:0px 0px 10px 10px; width: 100%;">
                                    <div class="form-group mb-0 align-self-center" style="width: 90%;">
                                        <input v-model="form.pesan" type="text"
                                            class=" form-control form-control-lg border-primary-purple pl-4 pr-4 pt-2 pb-2"
                                            placeholder="Masukkan Pesan Anda disini" style="border-radius:30px;">
                                    </div>
                                    <div class="align-self-center text-primary-purple" style="width: 10%;">
                                        <button type="submit" class="btn text-primary-purple">
                                            <i class="material-icons align-middle md-48">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-else class="text-center"
                            style="border: #EBD1EC 1px solid; border-radius: 10px; height:600px;">
                            <label class="mt-5" style="font-size: 24px; color:#BC41BE;">Pilih Pesanan untuk Melihat
                                Percakapan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="container">
                    <div style="height: 600px" class="d-flex align-items-center">
                        <h3 class="text-*-center font-weight-bold">
                            Untuk memulai chat anda harus melakukan proses pemesanan terlebih dahulu
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </chat-partner-component>

@endsection
