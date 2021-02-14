@extends('layouts.pengelola')

@section('content')
<div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
    <div class="row justify-content-left mb-0 ml-0 mr-0">
        <label class="text-primary-purple font-weight-bold ml-0 mr-4" style="font-size: 48px;">
            {{__('WAKPRINT')}}
        </label>
        <a class="align-self-center text-right mr-4" href="">
            <i class="material-icons md-36" style="color: #C4C4C4">
                help
            </i>
        </a>
        <div class="my-auto">
            <button class="btn btn-sm btn-danger bg-primary-danger font-weight-bold pl-4 pr-4" onclick="window.location.href='mailto:wakprint.dev@gmail.com'" style="border-radius:30px; font-size:16px;">
                {{__('Laporkan')}}
            </button>
        </div>
    </div>
    <label class="font-weight-bold mb-4 ml-0" style="font-size: 18px;">
        {{__('Wakprint - Web Versi 1.0')}}
    </label>
    <p class="mb-4 ml-0" style="font-size: 16px;">
        {{__('Wakprint adalah platform yang menghubungkan semua printer di seluruh Indonesia secara online untuk menjawab kebutuhan pencetakan dokumen Anda. Ribuan printer yang telah menjadi rekanan Wakprint, dapat diakses oleh Anda dengan mudah. Kirimkan dokumen dan ambil serta bayar dokumen anda langsung ke rekanan kami. Sekarang, mencetak dokumen dapat dilakukan di mana pun dengan
                                mudah pada jaringan printer di Wakprint.com
                                Untuk informasi lebih lanjut dapat Anda lihat selengkapnya di sosial media kami dibawah dan support terus karya anak bangsa untuk Indonesia lebih maju dan sejahtera.')}}
    </p>
    <div class="row justify-content-left mb-5 ml-0 mr-0">
        <div class="col-md-auto ml-0">
            <img src="{{url('img/instagram.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
        </div>
        <div class="col-md-auto">
            <img src="{{url('img/facebook.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
        </div>
        <div class="col-md-auto">
            <img src="{{url('img/youtube.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
        </div>
        <div class="col-md-auto">
            <img src="{{url('img/whatsapp.png')}}" class="img-responsive ml-0" alt="" width="24" height="24">
        </div>
    </div>
</div>
@endsection
