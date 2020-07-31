@inject('mbr', 'App\Member')

@extends('layouts.admin')

@section('content')
<div class="tab-pane fade show active" id="v-pills-beranda" role="tabpanel" style="font-size: 18px;">
    <div class="row justify-content-between mb-4 ml-0">
        <div class="col-md-6">
            <label class="font-weight-bold">
                {{__('Total Member')}}
            </label>
        </div>
        <div class="col-md-6">
            <div class="bg-light-purple p-4 col-md-12 text-center mr-4" style="border-radius:10px;
                    font-size:48px;">
                <label class="font-weight-bold text-break" style="width: 100%;">
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
            <div class="bg-light-purple p-4 col-md-12 text-center mr-4" style="border-radius:10px;
                    font-size:48px;">
                <label class="font-weight-bold text-break" style="width: 100%;">
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
            <div class="bg-light-purple p-4 col-md-12 text-center mr-4" style="border-radius:10px;
                    font-size:48px;">
                <label class="font-weight-bold text-break" style="width: 100%;">
                    {{__('43')}}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="v-pills-data-member" role="tabpanel">
    @include('admin.data_member')
</div>
<div class="tab-pane fade" id="v-pills-data-pengelola" role="tabpanel">
    @include('admin.data_pengelola')
</div>
<div class="tab-pane fade" id="v-pills-saldo" role="tabpanel">
    @include('admin.konfirmasi_saldo')
</div>
<div class="tab-pane fade" id="v-pills-keluhan" role="tabpanel">
    @include('admin.kelola_keluhan')
</div>

@section('script')
    <script>
            //dataMemberModal
            $('#memberModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                $(this).find('#idMember').text(button.data('id'))
            })
            //dataPengelolaModal
            $('#pengelolaModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                $(this).find('#idMember').val(button.data('id-member'))
                $(this).find('#namaMember').val(button.data('nama-member'))
                $(this).find('#tlMember').val(button.data('tl-member'))
                $(this).find('#jkMember').val(button.data('jk-member'))
                $(this).find('#emailMember').val(button.data('email-member'))
                $(this).find('#nomorHPMember').val(button.data('nomor-hp-member'))
                $(this).find('#alamatMember').val(button.data('alamat-member'))
            })
    </script>
@endsection

@endsection