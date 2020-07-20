@extends('layouts.member')

@section('content')
    <div class="mt-5 mb-5">        
        <div class="row">
            <div class="col-md-3 mr-0 ml-0">
                @include('member.card_produk')
            </div>
            <div class="col-md-9 ml-0">
                <label class="font-weight-bold mb-0"
                    style="font-size:48px;">
                    {{__('Laporkan') }}
                </label>
                <br>
                <label class="mb-4 ml-1"
                    style="font-size:18px;">
                    {{__('Kenapa kamu ingin melapor produk ini ?') }}
                </label>
                <form class="mb-3">
                    <div class="form-group mb-5">
                        <textarea class="form-control"
                            aria-label="Deskripsi Laporan"
                            style="height:241px;">
                        </textarea>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
                            style="border-radius:30px;
                                font-size:24px;">
                                {{__('Kirim Laporan') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


