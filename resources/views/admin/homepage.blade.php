@extends('layouts.admin')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="nav flex-column nav-pills"
                    id="v-pills-tab"
                    role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active mb-2"
                        id="v-pills-beranda-tab"
                        data-toggle="pill"
                        href="#v-pills-beranda"
                        role="tab"
                        aria-controls="v-pills-beranda"
                        aria-selected="true"
                        style="font-size:18px;">
                        <i class="material-icons md-36 align-middle mr-2">
                            home
                        </i>
                        {{__('Beranda')}}
                    </a>
                    <a class="nav-link mb-2"
                        id="v-pills-data-member-tab"
                        data-toggle="pill"
                        href="#v-pills-data-member"
                        role="tab"
                        aria-controls="v-pills-data-member"
                        aria-selected="true"
                        style="font-size:18px;">
                        <i class="material-icons md-36 align-middle mr-2">
                            history_edu
                        </i>
                        {{__('Data Member')}}
                    </a>
                    <a class="nav-link mb-2"
                        id="v-pills-data-pengelola-tab"
                        data-toggle="pill"
                        href="#v-pills-data-pengelola"
                        role="tab"
                        aria-controls="v-pills-data-pengelola"
                        aria-selected="true"
                        style="font-size:18px;">
                        <i class="material-icons md-36 align-middle mr-2">
                            print
                        </i>
                        {{__('Data Pengelola')}}
                    </a>
                    <a class="nav-link mb-2"
                        id="v-pills-saldo-tab"
                        data-toggle="pill"
                        href="#v-pills-saldo"
                        role="tab"
                        aria-controls="v-pills-saldo"
                        aria-selected="true"
                        style="font-size:18px;">
                        <i class="material-icons md-36 align-middle mr-2">
                            account_balance_wallet
                        </i>
                        {{__('Saldo')}}
                    </a>
                    <a class="nav-link mb-4"
                        id="v-pills-keluhan-tab"
                        data-toggle="pill"
                        href="#v-pills-keluhan"
                        role="tab"
                        aria-controls="v-pills-keluhan"
                        aria-selected="true"
                        style="font-size:18px;">
                        <i class="material-icons md-36 align-middle mr-2">
                            chat
                        </i>
                        {{__('Keluhan Pelanggan')}}
                    </a>
                    <a class="nav-link mb-2"
                        id="v-pills-keluar-tab"
                        data-toggle="pill"
                        href="#v-pills-keluar"
                        role="tab"
                        aria-controls="v-pills-keluar"
                        aria-selected="true"
                        style="font-size:18px;">
                        <i class="material-icons text-primary-danger md-36 align-middle mr-2">
                            exit_to_app
                        </i>
                        {{__('Keluar')}}
                    </a>
                </div>
            </div>
            <div class="tab-content col-md-8">
                <div class="tab-pane fade show active"
                    id="v-pills-beranda"
                    role="tabpanel"
                    style="font-size: 18px;">
                    <div class="row justify-content-between mb-4 ml-0">
                        <div class="col-md-6">
                            <label class="font-weight-bold">
                                {{__('Total Member')}}
                            </label>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light-purple p-4 col-md-12 text-center mr-4"
                                style="border-radius:10px;
                                font-size:48px;">
                                <label class="font-weight-bold text-break"
                                style="width: 100%;">
                                    {{__('43')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between mb-4 ml-0">
                        <div class="col-md-6">
                            <label class="font-weight-bold">
                                {{__('Total Pengelola Percetakan')}}
                            </label>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light-purple p-4 col-md-12 text-center mr-4"
                                style="border-radius:10px;
                                font-size:48px;">
                                <label class="font-weight-bold text-break"
                                style="width: 100%;">
                                    {{__('43')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between mb-4 ml-0">
                        <div class="col-md-6">
                            <label class="font-weight-bold">
                                {{__('Jumlah Transaksi')}}
                            </label>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light-purple p-4 col-md-12 text-center mr-4"
                                style="border-radius:10px;
                                font-size:48px;">
                                <label class="font-weight-bold text-break"
                                style="width: 100%;">
                                    {{__('43')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade"
                    id="v-pills-data-member"
                    role="tabpanel">
                    @include('admin.data_member')
                    {{-- @include('admin.detail_member') --}}
                </div>
                <div class="tab-pane fade"
                    id="v-pills-data-pengelola"
                    role="tabpanel">
                    @include('admin.data_pengelola')
                </div>
                <div class="tab-pane fade"
                    id="v-pills-saldo"
                    role="tabpanel">
                    @include('admin.konfirmasi_saldo')
                </div>
                <div class="tab-pane fade"
                    id="v-pills-keluhan"
                    role="tabpanel">
                    @include('admin.kelola_keluhan')
                </div>
            </div>
        </div>
    </div>
@endsection
