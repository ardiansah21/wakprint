<h1 class="font-weight-bold mb-5" style="font-size: 48px;">{{__('Top Up Saldo') }}</h1>
<div class="bg-primary-yellow p-4 mb-5" style="border-radius:5px;">
    <label class="mb-2" style="font-size: 24px;">{{__('Masukkan Nominal') }}</label>
    {{-- <form action="{{ route('profil.topup') }}" method="POST"> --}}
    <div class="form-group mb-4">
        <input type="number" class="form-control form-control-lg form-control-yellow pt-2 pb-2" name="jumlah_saldo"
            style="font-size: 18px;" placeholder="Contoh : 1.000.000" aria-label="Contoh : 1.000.000"
            aria-describedby="inputGroup-sizing-sm"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
    </div>
    <div class="container pl-0 pr-0 mb-4">
        <button type="submit" class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold"
            {{-- onclick="window.location.href='{{ route('saldo.pembayaran') }}'" --}}
            {{-- data-toggle="modal" data-target="#topUpModal" --}}
            {{-- data-id="{{ $transaksi_saldo->id_transaksi }}"
            data-kode-pembayaran="{{ $transaksi_saldo->kode_pembayaran }}"
            data-waktu="{{ $transaksi_saldo->waktu }}" --}}
            style="border-radius:30px; font-size:24px;">
            <i class="material-icons md-48 align-middle mr-2">upgrade</i>
            {{__('Top Up') }}
        </button>
    </div>
    {{-- </form> --}}
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
                @if ($ts->jenis_transaksi === 'TopUp' || $ts->jenis_transaksi === 'Pembayaran')
                    <tr 
                        @if ($ts->jenis_transaksi === 'TopUp')
                            {{-- onclick="window.location.href='{{ url('/saldo/pembayaran/'. $ts->id_transaksi) }}'" --}}
                            onclick="window.location.href='/saldo/pembayaran/{{ $ts->id_transaksi }}'"
                            {{-- onclick="window.location.href='{{ route('saldo.pembayaran')->with($ts->id_transaksi) }}'" --}}
                        @else
                            onclick="window.location.href='{{ route('detail.riwayat') }}'"
                        @endif
                        {{-- {{ action('MemberController@show', ['id'=>$ts->id_transaksi]) }} --}}
                        {{-- data-toggle="modal" data-target="#topUpModal"
                        data-id="{{ $value['id_transaksi'] }}"
                        data-kode-pembayaran="{{ $value['kode_pembayaran'] }}"
                        data-waktu="{{ $value['waktu'] }}" --}}
                        >
                        <td class="align-middle" scope="row">{{$ts->id_transaksi}}</td>
                        <td class="align-middle">{{$ts->jenis_transaksi}}</td>
                        <td class="align-middle">Rp. {{$ts->jumlah_saldo}}</td>
                        <td class="align-middle">{{$ts->keterangan}}</td>
                    </tr>
                @endif
                @endforeach

            </tbody>
        </table>
    </div>
    <script>
        //topUp Modal
        $('#topUpModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            
            $(this).find('.modal-title').text(button.data('title'))
            $(this).find('#idTransaksi').text(button.data('id'))
            $(this).find('#kodePembayaran').text(button.data('kode-pembayaran'))
            $(this).find('#waktuTransaksi').text(button.data('waktu'))
    
            //$('#idTransaksi').html( id );
        })
    
        // $(document).on('ajaxComplete ready', function () {
        //     $('.modalMd').off('click').on('click', function () {
        //         $('#modalMdContent').load($(this).attr('value'));
        //         $('#modalMdTitle').html($(this).attr('title'));
        //     });
        // });
    </script>
    {{-- @include('member.popup_pembayaran_topup') --}}
@else
    <label>Belum ada data</label>    
@endif
