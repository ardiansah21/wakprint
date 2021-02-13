@extends('layouts.member')

@section('content')
    <div class="container mb-5 mt-5">
        <div>
            <label class="font-weight-bold mb-5" style="font-size:48px;">
                {{ __('Pesanan Kamu') }}
            </label>
            @foreach ($konFileTerpilih as $idx => $k)
                <div class="row justify-content-between shadow-sm mb-5 pt-3 ml-0 mr-0" @if ($idx % 2 == 0) style="background-color: #fdff97; border-radius:8px;"
                    @else
                                                        style="background-color: #ebebeb; border-radius:8px;" @endif>
                    <div class="col-md-4">
                        @include('member.card_produk', ['p' => $k->product])
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="SemiBold" style="font-size:24px;">
                                {{ __('File Kamu') }}
                            </label>
                        </div>
                        <div class="row justify-content-left ml-0 mb-4">
                            @php
                            $tokens = explode('/', $k->getMedia('file_konfigurasi')[0]->getUrl() );
                            $url ='/'.$tokens[sizeof($tokens)-2].'/'.$tokens[sizeof($tokens)-1];
                            @endphp
                            <a class="text-truncate mb-2 mr-3" href="{{ '/storage' . $url }}" style="font-size:18px;">
                                {{ $k->getMedia('file_konfigurasi')[0]->file_name }}
                            </a>
                            <label class="my-auto mb-2" style="font-size:14px;">
                                {{ $k->jumlah_halaman_berwarna + $k->jumlah_halaman_hitamputih }} Halaman
                            </label>
                        </div>
                        <div class="mb-4">
                            <label class="SemiBold mb-1" style="font-size:24px;">
                                {{ __('Halaman yang dipilih') }}
                            </label>
                            <br>
                            <label class="mb-2" style="font-size:18px;">
                                {{-- {{ count(explode(',', $k->halaman_terpilih)) }} Halaman
                                --}}
                                @php
                                if(count(explode(',', $k->halaman_terpilih)) == $k->jumlah_halaman_berwarna +
                                $k->jumlah_halaman_hitamputih )
                                echo "Semua halaman";
                                else echo json_decode($k->halaman_terpilih)
                                @endphp

                            </label>
                        </div>
                        <div class="mb-4">
                            <label class="SemiBold mb-1" style="font-size:24px;">
                                {{ __('Jumlah Salinan') }}
                            </label>
                            <br>
                            <label class="mb-2" style="font-size:18px;">
                                {{ $k->jumlah_salinan }}
                            </label>
                        </div>

                        <div class="mb-4">
                            <label class="SemiBold mb-1" style="font-size:24px;">
                                {{ __('Cetak') }}
                            </label>
                            <br>
                            @if ($k->timbal_balik != 0)
                                <label class="mb-2" style="font-size:18px;">
                                    {{ __('Timbal Balik') }}
                                </label>
                                <br>
                            @else
                                <label class="mb-2" style="font-size:18px;">
                                    {{ __('Satu Sisi') }}
                                </label>
                                <br>
                            @endif
                            @if ($k->paksa_hitamputih != 0)
                                <label class="mb-2" style="font-size:18px;">
                                    {{ __('Hitam Putih Seluruh Halaman') }}
                                </label>
                            @endif
                        </div>
                        <label class="SemiBold mb-3" style="font-size:24px;">
                            {{ __('Catatan Tambahan') }}
                        </label>
                        <div class="mb-5" style="font-size:18px;">
                            <p class="mb-2">
                                {{ $k->catatan_tambahan ?? '-' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{-- <label class="SemiBold mb-3" style="font-size:24px;">
                            {{ __('Catatan Tambahan') }}
                        </label>
                        <div class="card pt-2 pb-2 pl-4 pr-4 mb-5" style="width:370px; min-height:120px; font-size:18px;">
                            <p class="mb-2">
                                {{ $k->catatan_tambahan }}
                            </p>
                        </div> --}}
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Halaman Hitam-Putih') }}
                        </label>
                        <br>
                        @if ($k->timbal_balik != 0)
                            <div class="row justify-content-between px-3">
                                <label class="mb-2" style="font-size:18px;">
                                    {{ $k->jumlah_halaman_hitamputih }} halaman
                                </label>
                                <label class="mb-2 text-right" style="font-size:18px;">
                                    {{ rupiah($k->jumlah_halaman_hitamputih * $k->product->harga_timbal_balik_hitam_putih) }}
                                </label>
                            </div>
                        @else
                            <div class="row justify-content-between px-3">
                                <label class="mb-2" style="font-size:18px;">
                                    {{ $k->jumlah_halaman_hitamputih }} halaman
                                </label>
                                <label class="mb-2 text-right" style="font-size:18px;">
                                    {{ rupiah($k->jumlah_halaman_hitamputih * $k->product->harga_hitam_putih) }}
                                </label>
                            </div>
                        @endif
                        <br>
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Halaman Berwarna') }}
                        </label>
                        <br>
                        @if ($k->timbal_balik != 0)
                            <div class="row justify-content-between px-3">
                                <label class="mb-2" style="font-size:18px;">
                                    {{ $k->jumlah_halaman_berwarna }} halaman
                                </label>
                                <label class="mb-2 text-right" style="font-size:18px;">
                                    {{ rupiah($k->jumlah_halaman_berwarna * $k->product->harga_timbal_balik_berwarna) }}
                                </label>
                            </div>
                        @else
                            <div class="row justify-content-between px-3">
                                <label class="mb-2" style="font-size:18px;">
                                    {{ $k->jumlah_halaman_berwarna }} halaman
                                </label>
                                <label class="mb-2 text-right" style="font-size:18px;">
                                    {{ rupiah($k->jumlah_halaman_berwarna * $k->product->harga_berwarna) }}
                                </label>
                            </div>
                        @endif
                        <br>
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Fitur') }}
                        </label>
                        <br>
                        @if (!empty(json_decode($k->fitur_terpilih)))
                            @foreach (json_decode($k->fitur_terpilih) as $ft)
                                <div class="row justify-content-between px-3">
                                    <label class="mb-2" style="font-size:18px;">
                                        {{ $ft->namaFitur }}
                                    </label>
                                    <label class="mb-2 text-right" style="font-size:18px;">
                                        {{ rupiah($ft->hargaFitur) }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <div class="row justify-content-between px-3">
                                <label class="mb-2" style="font-size:18px;">
                                    0 item
                                </label>
                                <label class="mb-2 text-right" style="font-size:18px;">
                                    Rp. 0
                                </label>
                            </div>
                        @endif
                        <br>
                        <label class="SemiBold mb-1" style="font-size:24px;">
                            {{ __('Total Biaya') }}
                        </label>
                        <br>
                        <label class="mb-2" style="font-size:18px;">
                            {{ rupiah($k->biaya) }}
                        </label>
                    </div>
                </div>
            @endforeach
            <div class="bg-light-purple p-4 mb-5"
                style="border-radius:10px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      font-size:18px;">
                <label class="font-weight-bold mb-4" style="font-size:36px;">
                    {{ __('Rincian Harga') }}
                </label>
                <div class="row justify-content-between mb-4">
                    <div class="col-md-auto text-left">
                        <label class="mb-2 SemiBold">
                            {{ count($konFileTerpilih) }} &nbsp;File
                        </label>
                    </div>
                    <div class="col-md-auto text-right">
                        <label class="SemiBold mb-2">
                            {{ rupiah($subTotalFile) }}
                        </label>
                    </div>
                </div>

                <label class="SemiBold mb-2">
                    {{ __('ATK') }}
                </label>

                @foreach ($atks as $a)
                    @if (!empty($a[0]) && !empty($a[1]) && !empty($a[2]) && !empty($a[3]))
                        <div class="row justify-content-between">
                            <div class="col-md-6 text-left">
                                <label>
                                    {{ $a[0] }} &nbsp;
                                    (x{{ $a[2] }})
                                </label>
                            </div>
                            <div class="col-md-6 SemiBold text-right">
                                <label>
                                    {{ rupiah($a[3]) }}
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-between">
                            <div class="col-md-6 text-left">
                                <label>
                                    Item (x0)
                                </label>
                            </div>
                            <div class="col-md-6 SemiBold text-right">
                                <label>
                                    Rp. 0
                                </label>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row row-bordered mt-2 mb-2">
                </div>
                <div class="row justify-content-between">
                    <div class="col-md-6 text-left mb-2">
                        <label>
                            Total Biaya ATK
                        </label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            @if (!empty($a[0]) && !empty($a[1]) && !empty($a[2]) && !empty($a[3]))
                                @php
                                $t= 0;
                                foreach ($atks as $a)
                                $t+= $a[3]
                                @endphp
                            @else
                                @php
                                $t= 0;
                                @endphp
                            @endif
                            {{ rupiah($t) }}
                        </label>
                    </div>
                </div>

                <label class="font-weight-bold mt-3 mb-2">
                    {{ __('Penerimaan Dokumen') }}
                </label>
                <div class="row justify-content-between mb-2">
                    <div class="col-md-6 text-left">
                        <label>
                            @if($penerimaan != "Ditempat")
                                {{ __('Antar ke Tempat') }}
                            @else
                                {{ __('Ambil di Tempat') }}
                            @endif
                        </label>
                    </div>
                    <div class="col-md-6 SemiBold text-right">
                        <label>
                            @if($penerimaan != "Ditempat")
                                {{ rupiah($ongkir) }}
                            @else
                                {{ rupiah(0) }}
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row row-bordered">
                </div>
                <div class="row justify-content-between SemiBold mt-2">
                    <div class="col-md-6 text-left">
                        <label>
                            {{ __('Total Harga Pesanan') }}
                        </label>
                    </div>
                    <div class="col-md-6 text-right">
                        <label>
                            {{ rupiah($totalBiaya) }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @php
            $atkFinal = json_encode($atks);
            if (!empty($member->alamat->alamat)){
                for ($i = 0; $i < count($member->alamat->alamat); $i++){
                    if ($member->alamat->alamat[$i]->id === $member->alamat->IdAlamatUtama){
                        $alamatPenerima = $member->alamat->alamat[$i]->AlamatJalan.",".$member->alamat->alamat[$i]->Kelurahan.",".$member->alamat->alamat[$i]->Kecamatan.",".$member->alamat->alamat[$i]->KabupatenKota.",".$member->alamat->alamat[$i]->Provinsi.",".$member->alamat->alamat[$i]->KodePos;
                    }
                }
            }
        @endphp
            <div class="row justify-content-end mb-5 mr-0">
                {{-- <form id="deleteKonfirmasiPesananForm" action="{{ route('konfirmasi.pesanan.delete', $idPesanan) }}" method="DELETE" enctype="multipart/form-data"> --}}
                    <button id="batalkanBtn" class="btn btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold mr-4" style="border-radius:30px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      font-size:24px;">
                        {{ __('Batalkan Pemesanan') }}
                    </button>
                {{-- </form> --}}
                <form action="{{ route('konfirmasi.pesanan.update', $idPesanan) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="idPesanan" id="idPesanan" value="{{ $idPesanan }}" hidden>
                    <input type="text" name="atkTerpilih" id="atkTerpilih" value="{{ $atkFinal }}" hidden>
                    <input type="number" id="ongkir" name="ongkir" value="{{ $ongkir }}" hidden>
                    <input type="text" name="metodePenerimaan" id="metodePenerimaan" value="{{ $penerimaan }}" hidden>
                    <input type="text" name="alamatPenerima" id="alamatPenerima" value="{{ $alamatPenerima ?? '' }}" hidden>
                    <input type="number" id="totalBiaya" name="totalBiaya" value="{{ $totalBiaya }}" hidden>
                    <button type="submit" class="btn btn-primary-wakprint btn-lg font-weight-bold pl-4 pr-4"
                        style="border-radius:30px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        font-size:24px;">
                        {{ __('Konfirmasi dan Lanjutkan') }}
                    </button>
                </form>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    $('#batalkanBtn').click(function() {
                        swal({
                            title: "Apakah Anda yakin ingin membatalkan pemesanan ?",
                            text: "Pesanan Anda akan dihapus secara permanen dan diharuskan untuk membuat ulang pesanan Anda dari awal",
                            icon: "warning",
                            buttons: {
                                cancel: 'Jangan Dulu',
                                confirm: {
                                    text: 'Hapus'
                                },
                            },
                            dangerMode: true,
                        }).then((willDelete) => {
                            if (willDelete) {
                                swal("Pesanan telah berhasil dihapus !", {
                                    icon: "success",
                                }).then(function() {
                                    // $("#deleteKonfirmasiPesananForm").submit();
                                    window.location.href = "{{ route('konfirmasi.pesanan.delete','') }}" + "/" + $('#idPesanan').val();
                                });
                            }
                            else {
                                swal({
                                    text: "Anda telah membatalkan untuk menghapus pesanan ini",
                                    button: "Lanjutkan Pemesanan",
                                });
                            }
                        });
                    });
                });

            </script>
    </div>
@endsection
