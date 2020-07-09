<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.admin.navbar_after_admin')
@endsection

@section('konten')
    <div class="container-fluid mt-4">
        <div class="container" style="margin-top: 120px;">
            <h1 class="font-weight-bold ml-0 mb-5">Tanggapi Keluhan</h1>

            <div class="row mb-3">
                <div class="container align-self-center col-md-auto" style="margin-right:-20px; margin-left:0px;">
                    <img src="https://ptetutorials.com/images/user-profile.png" width="32" height="32" alt="no logo">
                </div>

                <div class="container col-md-auto align-self-center" style="margin-left:0px;">
                    <small><p class="font-weight-bold mb-0">Ali Susi</p></small>
                </div>
            </div>

            <div class="card shadow-sm mb-4 pl-3 pr-3 pt-2 pb-2" style="height:100px;">
                <p class="mb-1">Puas banget bisa ngeprint disini ajiiiibbbbssss</p>
            </div>
            
            <p class="mb-2">Tanggapan</p>
            <div class="input-group mb-5" style="height:100px;">
                <textarea type="text" class="form-control form-control-lg pt-2 pb-2"></textarea>
            </div>

            <div class="row justify-content-between">
                            
                <div class="container col text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-default text-primary-purple font-weight-bold pl-5 pr-5 mb-0" 
                        onclick="window.location='{{ url('/admin/keluhan') }}'"
                        style="border-radius:30px; margin-right:0px;">Batal</button>
                    </div>
                </div>

                <div class="container col-auto text-right">
                    <div class="container mb-3">
                        <button type="button" class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0" 
                        onclick="window.location='{{ url('/admin/keluhan') }}'"
                        style="border-radius:30px; margin-right:-20px;">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

