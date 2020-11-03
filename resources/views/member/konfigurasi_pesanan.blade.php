@extends('layouts.member')

@section('content')
    @php
        $arrKonfigurasi = array();
        $hargaKonfigurasi = array();
        $biayaOngkir = 0;

        $arrAtk = array();
        $posAtk = array();
        $hargaAtk = array();

        for ($i=0; $i < count($konfigurasi); $i++) {
            if (!empty($konfigurasi) && $konfigurasi[$i]->id_member === $member->id_member) {
                array_push($arrKonfigurasi,$konfigurasi[$i]->id_konfigurasi);
                array_push($hargaKonfigurasi,$konfigurasi[$i]->biaya);
                $jumlahSubtotalFile = count($arrKonfigurasi);
                $hargaSubTotalFile = array_sum($hargaKonfigurasi);
                $hargaTotalPesanan = $hargaSubTotalFile + $biayaOngkir;
                $sisaSaldo = $member->jumlah_saldo - $hargaTotalPesanan;
            } else {
                // $jumlahSubtotalFile = 0;
            }
        }

        foreach ($konfigurasi as $k){
            foreach ($produk as $p){
                if (!empty($k) && $k->id_member === $member->id_member){
                    if ($k->id_produk === $p->id_produk){
                        foreach ($atk as $a => $value){
                            if ($value->id_pengelola === $p->partner->id_pengelola){
                                array_push($arrAtk,$value->id_atk);
                                array_push($hargaAtk,$value->harga);
                                // dd(count($arrAtk));
                            }
                        }
                    }
                }
            }
            break;
        }

        for ($i=0; $i < count($arrAtk); $i++) {
            $posAtk[$i] = $arrAtk[$i];
            // dd($arrAtk[$i]);
        }
        // dd($a);
    @endphp
    <div class="container mt-5 mb-5">
        <label class="font-weight-bold"
            style="font-size:48px;">
            {{__('Konfigurasi Pesanan') }}
        </label>
        <div class="row justify-content-between mb-5">
            <div class="col-md-4 mt-5"
                style="border-radius:10px;">
                <div class="bg-light-purple pl-4 pr-4 pt-4 pb-4 mb-4"
                    style="border-radius:10px;">
                    <label class="font-weight-bold mb-3"
                        style="font-size: 24px;">
                        {{__('Penerimaan') }}
                    </label>
                    <div class="form-group custom-control custom-radio mb-4" style="font-size: 14px;">
                        <input id="rbAmbilTempat" name="radio" class="custom-control-input" type="radio" value="Ditempat" checked>
                        <label class="custom-control-label" for="rbAmbilTempat">
                            {{__('Ambil di Tempat Percetakan') }}
                        </label>
                        <label class="text-truncate-multiline mb-2">
                            @foreach ($konfigurasi as $k)
                                @foreach ($produk as $p)
                                    @if (!empty($k) && $k->id_member === $member->id_member)
                                        @if ($k->id_produk === $p->id_produk)
                                            {{$p->partner->alamat_toko ?? '-'}}
                                        @endif
                                    @endif
                                @endforeach
                                @break
                            @endforeach
                        </label>
                    </div>
                    <div class="form-group custom-control custom-radio mr-0 mb-4">
                        <div class="row justify-content-between ml-0">
                            <input id="rbAntarTempat" name="radio" class="custom-control-input" type="radio" value="Diantar">
                            <label class="custom-control-label" for="rbAntarTempat">
                                {{__('Pengantaran') }}
                            </label>
                            <a class="col-md-auto text-right mb-2" href="" style="font-size: 12px;">
                                @if(!empty($member->alamat))
                                    {{__('Ubah') }}
                                @else
                                    {{__('Tambah Alamat') }}
                                @endif
                            </a>
                        </div>
                        <label class="text-truncate SemiBold mb-2 ml-0">
                            {{$member->nama_lengkap}}
                        </label>
                        <label class="text-truncate-multiline mb-2 ml-0 mb-5">
                            @if(!empty($member->alamat))
                                @for($i=0 ; $i < count($member->alamat['alamat']); $i++)
                                    {{ $member->alamat['alamat'][$i]['Alamat Jalan'] }},
                                    {{ $member->alamat['alamat'][$i]['Kelurahan'] }},
                                    {{ $member->alamat['alamat'][$i]['Kecamatan'] }},
                                    {{ $member->alamat['alamat'][$i]['Kabupaten Kota'] }},
                                    {{ $member->alamat['alamat'][$i]['Provinsi'] }},
                                    {{ $member->alamat['alamat'][$i]['Kode Pos'] }}
                                @endfor
                            @else
                                {{__('-')}}
                            @endif
                        </label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto font-weight-bold mb-2">
                            {{__('Biaya') }}
                        </label>
                        <label id="biayaOngkir" class="col-md-auto font-weight-bold text-right mb-2">
                            Rp. {{0}}
                        </label>
                    </div>
                </div>
                <div class="bg-light-purple pl-4 pr-4 pt-4 pb-4"
                    style="border-radius:10px;
                        font-size: 14px;">
                    <label class="font-weight-bold mb-3"
                        style="font-size: 24px;">
                        {{__('Ringkasan Pemesanan') }}
                    </label>
                    <div class="row justify-content-between">
                        <label id="subTotalFile" class="col-md-auto mb-2">
                            @foreach ($konfigurasi as $k => $value)
                                @if (!empty($value) && $value->id_member === $member->id_member)
                                    Subtotal {{$jumlahSubtotalFile}} file
                                @else
                                    {{__('Subtotal (0 file)') }}
                                @endif
                                @break
                            @endforeach
                        </label>
                        <label id="hargaSubTotalFile" class="col-md-auto text-right mb-2">
                            @foreach ($konfigurasi as $k)
                                @if (!empty($k) && $k->id_member === $member->id_member)
                                    Rp. {{$hargaSubTotalFile}}
                                @else
                                    {{__('Rp. 0') }}
                                @endif
                                @break
                            @endforeach
                        </label>
                    </div>
                    <div class="row justify-content-between mb-2">
                        <label class="col-md-auto mb-2">{{__('Biaya Pengiriman') }}</label>
                        <input id="hargaOngkir" type="number" value="{{5000}}" hidden>
                        <label id="biayaPengiriman" class="col-md-auto text-right mb-2">Rp. {{0}}</label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2">{{__('Total') }}</label>
                        <label id="totalHargaPesanan" class="col-md-auto SemiBold text-right mb-2">Rp. {{$hargaTotalPesanan}}</label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2">{{__('Saldo Kamu') }}</label>
                        <input type="number" name="totalSaldo" id="totalSaldo" value="{{$member->jumlah_saldo ?? 0 }}" hidden>
                        <label id="totalSaldoLabel" class="col-md-auto SemiBold text-right mb-2">Rp. {{$member->jumlah_saldo ?? 0 }}</label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2">{{__('Sisa Saldo Kamu') }}</label>
                        <label id="totalSisaSaldo" class="col-md-auto SemiBold text-right mb-3">Rp. {{$sisaSaldo}}</label>
                    </div>
                    @if ($sisaSaldo < 0)
                        <label id="warningSaldo" class="text-muted text-justify mb-2">
                            {{__('Saldo kamu tidak mencukupi, silahkan melakukan pengisian saldo setelah pesanan kamu dibuat') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="col-md-8 ml-0 mt-5"
                style="font-size: 18px;">
                <div class="row justify-content-between mb-4 ml-0 mr-2">
                    <div class="custom-control custom-checkbox mt-2 ml-1">
                    <input type="checkbox" class="custom-control-input" id="checkboxPilihSemua"
                        @foreach ($konfigurasi as $k => $value)
                            @if (!empty($value) && $value->id_member === $member->id_member)
                                value="{{count($konfigurasi)}}"
                            @endif
                        @endforeach
                        checked>
                        <label class="custom-control-label" for="checkboxPilihSemua">{{__('Pilih Semua') }}</label>
                    </div>
                    <button class="btn btn-primary-yellow btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center"
                        style="border-radius:30px">{{__('Tambah File') }}</button>
                </div>
                <div class="table-scrollbar pl-0 pr-2 mb-5">
                    <table class="table table-hover">
                        <thead class="bg-primary-purple text-white"
                            style="border-radius:25px 25px 15px 15px;">
                            <tr>
                                <th scope="col-md-auto"></th>
                                <th scope="col-md-auto">{{__('ID') }}</th>
                                <th scope="col-md-auto">{{__('Nama File') }}</th>
                                <th scope="col-md-auto">{{__('Produk') }}</th>
                                <th scope="col-md-auto">{{__('Biaya') }}</th>
                                <th scope="col-md-auto"></th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px;">
                            @foreach ($konfigurasi as $k => $value)
                                @if (!empty($value) && $value->id_member === $member->id_member)
                                    <tr id="barisKonfigurasi{{$k}}">
                                        <td scope="row">
                                            <div class="custom-control custom-checkbox mt-0 ml-1">
                                                <input id="checkboxKonfigurasi{{$k}}" type="checkbox" class="custom-control-input" value="{{$value->id_konfigurasi}}" checked>
                                                <input id="hargaKonfigurasi{{$k}}" type="number" value="{{$value->biaya}}" hidden>
                                                <label class="custom-control-label" for="checkboxKonfigurasi{{$k}}"></label>
                                            </div>
                                        </td>
                                        <td>{{$value->id_produk}}</td>
                                        <td>{{$value->nama_file}}</td>
                                        <td>{{$value->nama_produk}}</td>
                                        <td>Rp. {{$value->biaya}}</td>
                                        <td>
                                            <span>
                                                <i class="material-icons mr-2">
                                                    edit
                                                </i>
                                                <i class="material-icons"
                                                    style="color: red;">
                                                    delete
                                                </i>
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <label class="SemiBold mb-2 ml-0 mr-2">{{__('ATK') }}</label>

                @foreach ($konfigurasi as $k)
                    @foreach ($produk as $p)
                        @if (!empty($k) && $k->id_member === $member->id_member)
                            @if ($k->id_produk === $p->id_produk)
                                @foreach ($atk as $a => $value)
                                    @if ($value->id_pengelola === $p->partner->id_pengelola)
                                        <div class="row justify-content-between ml-0 mr-2">
                                        {{-- <input type="number" id="banyakAtk" value="{{count($atk)}}"> --}}
                                            <div class="col-md-4 form-group custom-control custom-checkbox">
                                            <input type="number" id="indexAtk" value="{{$posAtk}}" hidden>
                                            <input type="checkbox" class="custom-control-input" id="checkboxAtk{{$a}}" value="{{$value->id_atk}}" style="width: 100%;">
                                                <label class="custom-control-label text-break align-middle" for="checkboxAtk{{$a}}" style="width: 100%;">
                                                    {{$value->nama ?? '-'}}
                                                    <i class="material-icons align-middle ml-2" style="color: #C4C4C4">help</i>
                                                </label>
                                            </div>
                                            <div class="col-md-auto form-group">
                                                <label>{{__('Jumlah') }}
                                                <i id="plusAtk{{$a}}" class="fa fa-plus ml-2 mr-2"></i>
                                                </label>
                                                <input id="jumlahAtk{{$a}}" type="number" class="form-input" min="1" max="{{$value->jumlah}}" value="1" style="width:48px;">
                                                <i id="minusAtk{{$a}}" class="fa fa-minus ml-2 mr-2"></i>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <label id="hargaAtkLabel{{$a}}" class="SemiBold mb-2 ml-0" style="width: 100%;">
                                                    Rp. {{$value->harga ?? 0}}
                                                </label>
                                                <input type="number" name="hargaAtk" id="hargaAtk{{$a}}" value="{{$value->harga ?? 0}}" hidden>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                    @break
                @endforeach
            </div>
        </div>
        <button class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold mb-5"
            style="border-radius:30px;
                font-size:24px;">
            {{__('Buat Pesanan') }}
        </button>
    </div>
    <script>
        $(document).ready(function(){
            var batas = $('#checkboxPilihSemua').val();
            var indexAtk = $('#indexAtk').val();
            var arrKonfig = [];
            var arrSubTotalFile = [];
            var subTotalFile = 0;
            var hargaSubTotalFile = 0;
            var biayaOngkir = parseInt($('#hargaOngkir').val());
            var totalHargaPesanan = 0;
            var totalSaldo = parseInt($('#totalSaldo').val());
            var totalSisaSaldo = 0;

            $('input[type=checkbox]').each(function(index, value){
                $('#checkboxKonfigurasi' + index).bind('change', function(){

                    // $('#checkboxPilihSemua').not(this).prop('checked', this.checked);

                    // subTotalFile = 0;
                    // hargaSubTotalFile = 0;
                    // totalHargaPesanan = 0;
                    // totalSisaSaldo = 0;

                    if($('#checkboxKonfigurasi' + index).is(':checked')){
                        // if (index === 0) {
                        //     $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                        // }

                        if ($('#rbAmbilTempat').is(':checked')){
                            biayaOngkir = 0;
                        }
                        else{
                            biayaOngkir = parseInt($('#hargaOngkir').val());
                        }

                        arrKonfig.push($('#checkboxKonfigurasi' + index).val());
                        arrSubTotalFile.push($('#hargaKonfigurasi' + index).val());
                        subTotalFile = arrKonfig.length;
                        hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                        totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                        totalSisaSaldo = totalSaldo - totalHargaPesanan;

                        $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                        $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                        $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                        $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                        $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                        $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                    }
                    else{
                        var pos = arrKonfig.indexOf($('#checkboxKonfigurasi' + index).val());
                        var posHarga = arrSubTotalFile.indexOf($('#hargaKonfigurasi' + index).val());

                        if(pos > -1){
                            arrKonfig.splice(pos,1);
                            subTotalFile = arrKonfig.length;
                            arrSubTotalFile.splice(posHarga,1);
                            if(subTotalFile === 0){
                                hargaSubTotalFile = 0;
                            }
                            else {
                                hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                            }
                        }

                        // if ($('#checkboxPilihSemua').not(':checked')) {
                        //     for (i = index; i < batas-1; i++) {
                        //         arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                        //         arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                        //     }
                        //     subTotalFile = arrKonfig.length;
                        //     hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                        //     totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                        //     totalSisaSaldo = totalSaldo - totalHargaPesanan;
                        // }

                        if ($('#rbAmbilTempat').is(':checked')){
                            biayaOngkir = 0;
                        }
                        else{
                            biayaOngkir = parseInt($('#hargaOngkir').val());
                        }

                        totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                        totalSisaSaldo = totalSaldo - totalHargaPesanan;

                        $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                        $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                        $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                        $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                        $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                        $('#checkboxKonfigurasi' + index).not(this).prop('checked', this.checked);
                        $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                    }

                    if(totalSaldo < totalHargaPesanan){
                        $('#warningSaldo').show();
                    }
                    else{
                        $('#warningSaldo').hide();
                    }

                    // $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                });
                $('#checkboxAtk' + index).bind('change', function(){
                    if($('#checkboxAtk' + index).prop('checked', this.checked)){
                        console.log($('#checkboxAtk' + index).val());
                    }
                    $('#checkboxAtk' + index).not(this).prop('checked', this.checked);
                });
            });

            $('#checkboxPilihSemua').on('change',function(){
                subTotalFile = 0;
                hargaSubTotalFile = 0;
                arrKonfig = [];
                arrSubTotalFile = [];
                totalHargaPesanan = 0;
                totalSisaSaldo = 0;

                for (i = 0; i < batas-1; i++) {
                    if ($('#checkboxPilihSemua').is(':checked')) {
                        $('#checkboxKonfigurasi' + i).prop('checked', this.checked);

                        if ($('#rbAmbilTempat').is(':checked')){
                            biayaOngkir = 0;
                            $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                            $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                        }
                        else{
                            biayaOngkir = parseInt($('#hargaOngkir').val());
                            $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                            $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                        }

                        arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                        subTotalFile = arrKonfig.length;
                        arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                        hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                        totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                        totalSisaSaldo = totalSaldo - totalHargaPesanan;

                        $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                        $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                        $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                        $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                        $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                        console.log(arrSubTotalFile);
                    }
                    else{

                        if ($('#rbAmbilTempat').is(':checked')){
                            biayaOngkir = 0;
                            $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                            $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                        }
                        else{
                            biayaOngkir = parseInt($('#hargaOngkir').val());
                            $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                            $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                        }

                        arrKonfig = [];
                        subTotalFile = arrKonfig.length;
                        hargaSubTotalFile = subTotalFile;
                        totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                        totalSisaSaldo = totalSaldo - totalHargaPesanan;

                        $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                        $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                        $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                        $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                        $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                        $('#checkboxKonfigurasi' + i).not(this).prop('checked', this.checked);
                    }
                }

                if(totalSaldo < totalHargaPesanan){
                    $('#warningSaldo').show();
                }
                else{
                    $('#warningSaldo').hide();
                }
            });

            $('input[type=radio]').on('click change',(function(){
                var related_class=$(this).val();
                $('.'+related_class).prop('disabled',false);

                subTotalFile = 0;
                hargaSubTotalFile = 0;
                arrKonfig = [];
                arrSubTotalFile = [];
                totalHargaPesanan = 0;
                totalSisaSaldo = 0;

                if($('#rbAmbilTempat').is(':checked')){
                    biayaOngkir = 0;
                    $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    $('#biayaPengiriman').text('Rp. ' + biayaOngkir);

                    // subTotalFile = 0;
                    // hargaSubTotalFile = 0;
                    // arrKonfig = [];
                    // arrSubTotalFile = [];
                    // totalHargaPesanan = 0;
                    // totalSisaSaldo = 0;

                    for (i = 0; i < batas-1; i++) {
                        if ($('#checkboxPilihSemua').is(':checked')) {
                            $('#checkboxKonfigurasi' + i).prop('checked', this.checked);

                            arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                            subTotalFile = arrKonfig.length;
                            arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                            hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                            totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                            totalSisaSaldo = totalSaldo - totalHargaPesanan;

                            $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                            $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                            $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                            $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                            $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                        }
                        else{
                            if($('#checkboxKonfigurasi' + i).is(':checked')){
                                arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                                arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                                subTotalFile = arrKonfig.length;
                                hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                                totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                                totalSisaSaldo = totalSaldo - totalHargaPesanan;

                                $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                                $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                                $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                                $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                                $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                                $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                            }
                            else{
                                var pos = arrKonfig.indexOf($('#checkboxKonfigurasi' + i).val());
                                var posHarga = arrSubTotalFile.indexOf($('#hargaKonfigurasi' + i).val());

                                if(pos > -1){
                                    arrKonfig.splice(pos,1);
                                    subTotalFile = arrKonfig.length;
                                    arrSubTotalFile.splice(posHarga,1);
                                    if(subTotalFile === 0){
                                        hargaSubTotalFile = 0;
                                    }
                                    else {
                                        hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                                    }
                                    totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                                    totalSisaSaldo = totalSaldo - totalHargaPesanan;
                                }

                                $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                                $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                                $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                                $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                                $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                                $('#checkboxKonfigurasi' + index).not(this).prop('checked', this.checked);
                                $('#checkboxPilihSemua').not(this).prop('checked', this.checked);

                            }
                        }
                    }

                    if(totalSaldo < totalHargaPesanan){
                        $('#warningSaldo').show();
                    }
                    else{
                        $('#warningSaldo').hide();
                    }

                    // $('#checkboxPilihSemua').on('change',function(){
                    //     subTotalFile = 0;
                    //     hargaSubTotalFile = 0;
                    //     arrKonfig = [];
                    //     arrSubTotalFile = [];
                    //     totalHargaPesanan = 0;
                    //     totalSisaSaldo = 0;

                    //     for (i = 0; i < batas-1; i++) {
                    //         if ($('#checkboxPilihSemua').is(':checked')) {
                    //             $('#checkboxKonfigurasi' + i).prop('checked', this.checked);

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                    //             subTotalFile = arrKonfig.length;
                    //             arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                    //             hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                    //             console.log(arrSubTotalFile);
                    //         }
                    //         else{

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             arrKonfig = [];
                    //             subTotalFile = arrKonfig.length;
                    //             hargaSubTotalFile = subTotalFile;
                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                    //             $('#checkboxKonfigurasi' + i).not(this).prop('checked', this.checked);
                    //         }
                    //     }

                    //     if(totalSaldo < totalHargaPesanan){
                    //         $('#warningSaldo').show();
                    //     }
                    //     else{
                    //         $('#warningSaldo').hide();
                    //     }
                    // });

                    // $('input[type=checkbox]').each(function(index, value){
                    //     $('#checkboxAtk' + indexAtk).bind('change', function(){
                    //         if($('#checkboxAtk' + indexAtk).prop('checked', this.checked)){
                    //             console.log($('#checkboxAtk' + indexAtk).val());
                    //         }
                    //         $('#checkboxAtk' + indexAtk).not(this).prop('checked', this.checked);
                    //     });

                    //     $('#checkboxKonfigurasi' + index).bind('change', function(){
                    //         subTotalFile = 0;
                    //         hargaSubTotalFile = 0;
                    //         totalHargaPesanan = 0;
                    //         totalSisaSaldo = 0;

                    //         if($('#checkboxKonfigurasi' + index).is(':checked')){

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             arrKonfig.push($('#checkboxKonfigurasi' + index).val());
                    //             arrSubTotalFile.push($('#hargaKonfigurasi' + index).val());
                    //             subTotalFile = arrKonfig.length;
                    //             hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);

                    //             console.log(arrKonfig);
                    //             console.log(arrSubTotalFile);
                    //         }
                    //         else{
                    //             var pos = arrKonfig.indexOf($('#checkboxKonfigurasi' + index).val());
                    //             var posHarga = arrSubTotalFile.indexOf($('#hargaKonfigurasi' + index).val());

                    //             if(pos > -1){
                    //                 arrKonfig.splice(pos,1);
                    //                 subTotalFile = arrKonfig.length;
                    //                 arrSubTotalFile.splice(posHarga,1);
                    //                 if(subTotalFile === 0){
                    //                     hargaSubTotalFile = 0;
                    //                 }
                    //                 else {
                    //                     hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                    //                 }
                    //             }

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                    //             $('#checkboxKonfigurasi' + index).not(this).prop('checked', this.checked);

                    //             console.log(arrKonfig);
                    //             console.log(arrSubTotalFile);
                    //         }

                    //         if(totalSaldo < totalHargaPesanan){
                    //             $('#warningSaldo').show();
                    //         }
                    //         else{
                    //             $('#warningSaldo').hide();
                    //         }

                    //         $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                    //     });
                    // });
                }
                else{
                    biayaOngkir = parseInt($('#hargaOngkir').val());
                    $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    $('#biayaPengiriman').text('Rp. ' + biayaOngkir);

                    // subTotalFile = 0;
                    // hargaSubTotalFile = 0;
                    // arrKonfig = [];
                    // arrSubTotalFile = [];
                    // totalHargaPesanan = 0;
                    // totalSisaSaldo = 0;

                    for (i = 0; i < batas-1; i++) {
                        if ($('#checkboxPilihSemua').is(':checked')) {
                            $('#checkboxKonfigurasi' + i).prop('checked', this.checked);
                            arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                            subTotalFile = arrKonfig.length;
                            arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                            hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                            totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                            totalSisaSaldo = totalSaldo - totalHargaPesanan;

                            $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                            $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                            $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                            $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                            $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                        }
                        else{
                            if($('#checkboxKonfigurasi' + i).is(':checked')){
                                arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                                arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                                subTotalFile = arrKonfig.length;
                                hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                                totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                                totalSisaSaldo = totalSaldo - totalHargaPesanan;

                                $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                                $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                                $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                                $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                                $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                                $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                            }
                            else{
                                var pos = arrKonfig.indexOf($('#checkboxKonfigurasi' + i).val());
                                var posHarga = arrSubTotalFile.indexOf($('#hargaKonfigurasi' + i).val());

                                if(pos > -1){
                                    arrKonfig.splice(pos,1);
                                    subTotalFile = arrKonfig.length;
                                    arrSubTotalFile.splice(posHarga,1);
                                    if(subTotalFile === 0){
                                        hargaSubTotalFile = 0;
                                    }
                                    else {
                                        hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                                    }
                                }

                                totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                                totalSisaSaldo = totalSaldo - totalHargaPesanan;

                                $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                                $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                                $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                                $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                                $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                                $('#checkboxKonfigurasi' + index).not(this).prop('checked', this.checked);
                                $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                            }
                        }
                    }

                    if(totalSaldo < totalHargaPesanan){
                        $('#warningSaldo').show();
                    }
                    else{
                        $('#warningSaldo').hide();
                    }

                    // $('#checkboxPilihSemua').on('change',function(){
                    //     subTotalFile = 0;
                    //     hargaSubTotalFile = 0;
                    //     arrKonfig = [];
                    //     arrSubTotalFile = [];
                    //     totalHargaPesanan = 0;
                    //     totalSisaSaldo = 0;

                    //     for (i = 0; i < batas-1; i++) {
                    //         if ($('#checkboxPilihSemua').is(':checked')) {
                    //             $('#checkboxKonfigurasi' + i).prop('checked', this.checked);

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             arrKonfig.push($('#checkboxKonfigurasi' + i).val());
                    //             subTotalFile = arrKonfig.length;
                    //             arrSubTotalFile.push($('#hargaKonfigurasi' + i).val());
                    //             hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                    //             console.log(arrSubTotalFile);
                    //         }
                    //         else{

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             arrKonfig = [];
                    //             subTotalFile = arrKonfig.length;
                    //             hargaSubTotalFile = subTotalFile;
                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                    //             $('#checkboxKonfigurasi' + i).not(this).prop('checked', this.checked);
                    //         }
                    //     }

                    //     if(totalSaldo < totalHargaPesanan){
                    //         $('#warningSaldo').show();
                    //     }
                    //     else{
                    //         $('#warningSaldo').hide();
                    //     }
                    // });

                    // $('input[type=checkbox]').each(function(index, value){
                    //     $('#checkboxAtk' + indexAtk).bind('change', function(){
                    //         if($('#checkboxAtk' + indexAtk).prop('checked', this.checked)){
                    //             console.log($('#checkboxAtk' + indexAtk).val());
                    //         }
                    //         $('#checkboxAtk' + indexAtk).not(this).prop('checked', this.checked);
                    //     });

                    //     $('#checkboxKonfigurasi' + index).bind('change', function(){
                    //         subTotalFile = 0;
                    //         hargaSubTotalFile = 0;
                    //         totalHargaPesanan = 0;
                    //         totalSisaSaldo = 0;

                    //         if($('#checkboxKonfigurasi' + index).is(':checked')){

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             arrKonfig.push($('#checkboxKonfigurasi' + index).val());
                    //             arrSubTotalFile.push($('#hargaKonfigurasi' + index).val());
                    //             subTotalFile = arrKonfig.length;
                    //             hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);

                    //             console.log(arrKonfig);
                    //             console.log(arrSubTotalFile);
                    //         }
                    //         else{
                    //             var pos = arrKonfig.indexOf($('#checkboxKonfigurasi' + index).val());
                    //             var posHarga = arrSubTotalFile.indexOf($('#hargaKonfigurasi' + index).val());

                    //             if(pos > -1){
                    //                 arrKonfig.splice(pos,1);
                    //                 subTotalFile = arrKonfig.length;
                    //                 arrSubTotalFile.splice(posHarga,1);
                    //                 if(subTotalFile === 0){
                    //                     hargaSubTotalFile = 0;
                    //                 }
                    //                 else {
                    //                     hargaSubTotalFile = eval(arrSubTotalFile.join("+"));
                    //                 }
                    //             }

                    //             if ($('#rbAmbilTempat').is(':checked')){
                    //                 biayaOngkir = 0;
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }
                    //             else{
                    //                 biayaOngkir = parseInt($('#hargaOngkir').val());
                    //                 $('#biayaOngkir').text('Rp. ' + biayaOngkir);
                    //                 $('#biayaPengiriman').text('Rp. ' + biayaOngkir);
                    //             }

                    //             totalHargaPesanan = hargaSubTotalFile + biayaOngkir;
                    //             totalSisaSaldo = totalSaldo - totalHargaPesanan;

                    //             $('#subTotalFile').text('Subtotal ' + subTotalFile + ' File');
                    //             $('#hargaSubTotalFile').text('Rp. ' + hargaSubTotalFile);
                    //             $('#totalHargaPesanan').text('Rp. ' + totalHargaPesanan);
                    //             $('#totalSaldoLabel').text('Rp. ' + totalSaldo);
                    //             $('#totalSisaSaldo').text('Rp. ' + totalSisaSaldo);
                    //             $('#checkboxKonfigurasi' + index).not(this).prop('checked', this.checked);

                    //             console.log(arrKonfig);
                    //             console.log(arrSubTotalFile);
                    //         }

                    //         if(totalSaldo < totalHargaPesanan){
                    //             $('#warningSaldo').show();
                    //         }
                    //         else{
                    //             $('#warningSaldo').hide();
                    //         }

                    //         $('#checkboxPilihSemua').not(this).prop('checked', this.checked);
                    //     });
                    // });
                }

                $('input[type=radio]').not(':checked').each(function(){
                    var other_class=$(this).val();
                    $('.'+other_class).prop('disabled',true);
                });
            }));

            $('input[type=number]').each(function(index, value){
                $('#jumlahAtk' + index).on('change input', function(){
                    var max = $('#jumlahAtk' + index).attr('max');
                    var min = $('#jumlahAtk' + index).attr('min');
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                    var val = parseInt($('#jumlahAtk' + index).val());

                    if ($('#jumlahAtk' + index).val().length < 1) {
                        val = 0;
                        $('#jumlahAtk' + index).prop('required',true);
                    }
                    else if($('#jumlahAtk' + index).val().length > max.length){
                        val = max;
                        $('#jumlahAtk' + index).val(max);
                    }
                    else {
                        if ($('#jumlahAtk' + index).val() > max) {
                            val = max;
                            $('#jumlahAtk' + index).val(max);
                        } else if($('#jumlahAtk' + index).val() < min) {
                            val = min;
                            $('#jumlahAtk' + index).val(min);
                        }
                    }
                    $('#hargaAtkLabel' + index).text('Rp. ' + val * parseInt($('#hargaAtk' + index).val()));
                });
            });
            $('#plusAtk').click(function(){
                var val = parseInt($('#jumlahAtk').val());
                if(val >= $('#jumlahAtk').attr('max')){
                    $('#jumlahAtk').val((val));
                }
                else {
                    val += 1;
                    $('#jumlahAtk').val((val));
                }
                $('#hargaAtkLabel').text('Rp. ' + val * parseInt($('#hargaAtk').val()));
            })

            $('#minusAtk').click(function(){
                var val = parseInt($('#jumlahAtk').val());
                if(val>1){
                    val -= 1;
                    $('#jumlahAtk').val((val));
                }
                else {
                    val = 1;
                    $('#jumlahAtk').val((val));
                }
                $('#hargaAtkLabel').text('Rp. ' + val * parseInt($('#hargaAtk').val()));
            })

            // $('#jumlahAtk').on('change input', function(){
            //     var max = $('#jumlahAtk').attr('max');
            //     var min = $('#jumlahAtk').attr('min');
            //     this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
            //     var val = parseInt($('#jumlahAtk').val());

            //     if ($('#jumlahAtk').val().length < 1) {
            //         val = 0;
            //         $('#jumlahAtk').prop('required',true);
            //     }
            //     else if($('#jumlahAtk').val().length > max.length){
            //         val = max;
            //         $('#jumlahAtk').val(max);
            //     }
            //     else {
            //         if ($('#jumlahAtk').val() > max) {
            //             val = max;
            //             $('#jumlahAtk').val(max);
            //         } else if($('#jumlahAtk').val() < min) {
            //             val = min;
            //             $('#jumlahAtk').val(min);
            //         }
            //     }
            //     $('#hargaAtkLabel').text('Rp. ' + val * parseInt($('#hargaAtk').val()));
            // });
        });
    </script>
@endsection
