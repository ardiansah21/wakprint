@extends('layouts.pengelola')

@section('content')
<div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
    <button class="btn btn-outline-purple font-weight-bold pl-5 pr-5 mb-4"
        onclick="window.location.href='{{ route('partner.promo.create') }}'"
        style="border-radius:30px; font-size:16px;">
        {{__('Tambah Promo')}}
    </button>
    <div class="table-scrollbar mb-5 ml-0 pr-2">
        <table class="table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px; font-size:16px;">
                <tr>
                    <th class="align-middle" scope="col-md-auto">{{__('ID')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Produk')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Jumlah Diskon')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Maksimal Diskon')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Tanggal Berakhir')}}</th>
                    <th class="align-middle" scope="col-md-auto"></th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
                    @foreach (Auth::user()->products as $p)
                        @if ($p->jumlah_diskon != 0)
                        <tr>
                            <td scope="row">{{$p->id_produk}}</td>
                            <td>{{$p->nama}}</td>
                            <td>{{$p->jumlah_diskon * 100}} %</td>
                            <td>{{$p->maksimal_diskon}}</td>
                            <td>{{$p->selesai_waktu_diskon}}</td>
                            <td>
                                <a href="{{ route('partner.promo.edit',$p->id_produk) }}" style="margin-left: -50px;">
                                    <i class="material-icons md-18">
                                        edit
                                    </i>
                                </a>
                                <i class="material-icons md-18 pointer" style="color: #FF4949;" onclick="event.preventDefault();
                                        document.getElementById('delete-form{{$p->id_produk}}').submit();">
                                    delete
                                </i>
                                <form id="delete-form{{$p->id_produk}}" method="POST" style="display: none"
                                    action="{{ route('partner.promo.destroy',[$p->id_produk]) }}">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
