<!-- Menghubungkan dengan view template master -->
@extends('layouts.pengelola')

@section('content')
    <chat-partner-component inline-template>
        <div>
            <div v-if="pesanans.length > 0" class="container">
                <div class="row">
                    <div class="col-md-4 ">
                        <h4>Pesanan</h4>
                        <div class="list-group">
                            <a v-for="(pesanan, index) in pesanans" v-bind:key="index"
                                class="pointer list-group-item list-group-item-action flex-column align-items-start"
                                :class="[{'active': isActive === index}]" v-on:click="fetchMessages(pesanan.id)">
                                <div class="d-flex w-10 justify-content-between">
                                    <h5 class="mb-1">@{{ pesanan . id }}</h5>
                                    {{-- <small>3 days ago</small>
                                    --}}
                                    <span v-if="pesanan.count" class="badge badge-danger">@{{ pesanan . count }}</span>
                                </div>
                                <p class="mb-1">@{{ pesanan . nama_member }}</p>
                                <p class="mb-1">@{{ pesanan . penerimaan }}</p>
                                <p class="mb-1">@{{ pesanan . status }}</p>
                                {{-- <small>Donec id elit .</small>
                                --}}
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div v-if="isActive != null">
                            <div class="bg-light-purple mb-0">
                                <div class="row  mb-0 ml-0">
                                    <div class="">
                                        <img class=" rounded-md rounded-circle img-responsive" :src="member.avatar"
                                            alt="no logo">
                                    </div>
                                    <div class="align-self-center ml-3">
                                        <label class="text-truncate SemiBold mb-0" style="font-size:18px; max-width:420px;">
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
                            {{-- //TODO tambah url detail pesanan
                            --}}
                            <a :href="'/urlDetailPesanan/'+ pesanans[isActive].id_pesanan ">Lihat detail Pesanan</a>
                            <div class="card-body card-message" id="message-scroll">
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
                            <form @submit.prevent="sendMessage" style="font-size:18px;">
                                <div class="row mb-0 ml-0">
                                    <div class="form-group mb-0 align-self-center" style="width: 90%">
                                        <input v-model="form.pesan" type="text"
                                            class=" form-control form-control-lg border-primary-purple pl-4 pr-4 pt-2 pb-2"
                                            placeholder="Masukkan Pesan Anda disini" style="border-radius:30px;">
                                    </div>
                                    <div class=" align-self-center text-primary-purple" style="width: 10%">
                                        <button type="submit" class="btn text-primary-purple">
                                            <i class="material-icons align-middle md-48">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-else>
                            <h3 class="text-primary  mt-5 text-center">Pilih pesanan untuk melihat percakapan</h3>
                        </div>

                    </div>
                </div>
            </div>
            <div v-else>
                <div class="container">

                    <div style="height: 700px" class="d-flex align-items-center">
                        <h3 class="text-*-center font-weight-bold">
                            Anda dapat melukan chat jika pengguna telah melakukan pemesanan dan membayar nya.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </chat-partner-component>

@endsection
