@extends('layouts.pengelola')

@section('content')
<div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel">
    <button class="btn btn-outline-purple font-weight-bold pl-5 pr-5 mb-4"
        onclick="window.location.href='{{ route('partner.atk.create') }}'" style="border-radius:30px; font-size:16px;">
        {{__('Tambah ATK')}}
    </button>
    <div class="table-scrollbar mb-5 ml-0 pr-2">
        <table class="table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px; font-size:16px;">
                <tr>
                    <th class="align-middle" scope="col-md-auto">{{__('ID')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Nama ATK')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Harga')}}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Jumlah')}}</th>
                    <th class="align-middle" scope="col-md-auto"></th>
                </tr>
            </thead>
            <tbody style="font-size:12px;">

                @foreach ($atk as $a)
                    @if ($a->id_pengelola === $partner->id_pengelola)
                        <tr>
                            <td scope="row">{{$a->id_atk}}</td>
                            <td>{{$a->nama}}</td>
                            <td>{{rupiah($a->harga)}}</td>
                            <td>{{$a->jumlah}}</td>
                            <td class="text-right">
                                <a href="{{ route('partner.atk.edit',$a->id_atk) }}" style="margin-left: -50px;">
                                    <i class="material-icons md-18">
                                        edit
                                    </i>
                                </a>
                                <i class="material-icons md-18 pointer p-1 mr-2"
                                    style="color: #FF4949;" onclick="event.preventDefault();
                                    document.getElementById('delete-form{{$a->id_atk}}').submit();">
                                    delete
                                </i>
                                <form id="delete-form{{$a->id_atk}}" method="POST" style="display: none"
                                    action="{{ route('partner.atk.destroy',[$a->id_atk]) }}">
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

