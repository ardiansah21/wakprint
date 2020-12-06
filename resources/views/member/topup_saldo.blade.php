@extends('layouts.member')

@section('content')
<div class="tab-pane fade show active ml-2 mr-0" role="tabpanel">
    <h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Top Up Saldo') }}</h1>
    <div class="bg-primary-yellow p-4 mb-5" style="border-radius:5px;">
        <label class="mb-2" style="font-size: 24px;">{{__('Masukkan Nominal') }}</label>
        <form action="{{ route('saldo.topup') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <input type="number" name="jumlah_saldo"
                    class="form-control form-control-lg form-control-yellow optional-step-100 pt-2 pb-2"
                    placeholder="Contoh : 1.000.000" aria-label="Contoh : 1.000.000"
                    aria-describedby="inputGroup-sizing-sm"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    style="font-size: 18px;">
            </div>
            <div class="container pl-0 pr-0 mb-4">
                <button type="submit" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
                    style="border-radius:30px; font-size:24px;">
                    <i class="material-icons md-48 align-middle mr-2">upgrade</i>
                    {{__('Top Up') }}
                </button>
            </div>
        </form>
    </div>
    <h1 class="font-weight-bold mb-5 ml-1" style="font-size:48px;">{{__('Transaksi Terakhir Kamu') }}</h1>
    @if (!empty($transaksi_saldo))
    <div class="table-scrollbar pr-3 mb-5 ml-1">

        <table class="table table-hover">
            <thead class="bg-primary-purple text-white" style="border-radius:25px 25px 15px 15px;">
                <tr style="font-size:18px;">
                    <th class="align-middle" scope="col-md-auto">{{__('ID') }}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Jenis Transaksi') }}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Biaya') }}</th>
                    <th class="align-middle" scope="col-md-auto">{{__('Keterangan') }}</th>
                </tr>
            </thead>
            <tbody style="font-size:14px;">

                @foreach ($transaksi_saldo as $ts)
                @if (($ts->jenis_transaksi === 'TopUp' || $ts->jenis_transaksi === 'Pembayaran') && $ts->status === 'Pending' && $ts->id_member === $member->id_member)
                <tr @if ($ts->jenis_transaksi === 'TopUp')
                    {{-- onclick="window.location.href='{{ url('/saldo/pembayaran/'. $ts->id_transaksi) }}'" --}}
                    onclick="window.location.href='/saldo/pembayaran/{{ $ts->id_transaksi }}'"
                    {{-- onclick="window.location.href='{{ route('saldo.pembayaran')->with($ts->id_transaksi) }}'" --}}
                    @else
                    onclick="window.location.href='{{ route('pesanan.detail') }}'"
                    @endif
                    {{-- {{ action('MemberController@show', ['id'=>$ts->id_transaksi]) }} --}}
                    {{-- data-toggle="modal" data-target="#topUpModal"
                            data-id="{{ $value['id_transaksi'] }}"
                    data-kode-pembayaran="{{ $value['kode_pembayaran'] }}"
                    data-waktu="{{ $value['waktu'] }}" --}}
                    >
                    <td class="align-middle" scope="row">{{$ts->id_transaksi ?? '-'}}</td>
                    <td class="align-middle">{{$ts->jenis_transaksi ?? '-'}}</td>
                    <td class="align-middle">Rp. {{$ts->jumlah_saldo ?? '-'}}</td>
                    <td class="align-middle">{{$ts->keterangan ?? '-'}}</td>
                </tr>
                @endif
                @endforeach

            </tbody>
        </table>
    </div>
    @else
    <label>Belum ada data</label>
    @endif
</div>
@endsection
@section('script')
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
@endsection
