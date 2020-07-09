<!-- Menghubungkan dengan view template master -->
@extends('master')

@section('header')
    @include('navbar.member.navbar_after_member')
@endsection

@section('konten')
    <div class="container-fluid">
                
        <div class="container-fluid pt-2 pb-5" style="margin-top:72px">
            <div class="container mt-5">
                <div class="row mt-5">
                    <div class="container col-3 mr-0 ml-0">
                        @include('card_produk')
                    </div>

                    <div class="container col-9 ml-0">
                        <h1 class="font-weight-bold mb-0">Laporkan</h1>
                        <label class="mb-4 ml-1">Kenapa kamu ingin melapor produk ini ?</label>
                        
                        <div class="container mb-3">
                            <div class="input-group mb-3" style="height:250px; margin-left:-10px;">
                                <textarea class="form-control" aria-label="Deskripsi Laporan"></textarea>
                            </div>
                        </div>
                        
                        <div class="container text-center" style="margin-left:-10px;">
                            <button type="button" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold" style="border-radius:30px;">Kirim Laporan</button>
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


