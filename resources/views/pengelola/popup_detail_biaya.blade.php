<div class="modal fade" id="detailBiayaModal" tabindex="-1" role="dialog" aria-labelledby="detailBiayaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bg-light-purple" style="border-radius:10px;">
            <div class="modal-body" style="font-size: 18px;">
                <div class="p-4 ml-0 mr-0">
                    <button class="close material-icons md-32" data-dismiss="modal">
                        close
                    </button>
                    <label class="font-weight-bold mb-4" style="font-size: 36px;">
                        {{__('Rincian Harga') }}
                    </label>
                    <div class="row justify-content-between">
                        <div class="col-md-auto text-left">
                            <label class="mb-2">
                                {{__('Jumlah Dokumen Pesanan') }}
                            </label>
                            <br>
                            <label class="mb-2">
                                {{__('Total Produk Pesanan') }}
                            </label>
                        </div>
                        <div class="col-md-auto text-right">
                            <label class="mb-2">
                                {{count($pesanan->konfigurasiFile)}}
                            </label>
                            <br>
                            <label class="mb-2">
                                {{count($pesanan->konfigurasiFile)}}
                            </label>
                        </div>
                    </div>
                    <div class="row row-bordered mt-2 mb-4"></div>
                    <label class="font-weight-bold mt-2 mb-3">
                        {{__('Produk yang Dipesan')}}
                    </label>
                    <br>
                    @foreach ($pesanan->konfigurasiFile as $p => $value)
                        <label class="font-weight-bold mt-2 mb-3" style="font-size: 16px;">
                            {{($p+1).'. '.$value->nama_produk}}
                        </label>
                        <br>
                        <label class="font-weight-bold mb-2" style="font-size: 14px;">
                            {{$value->nama_file}}
                        </label>
                        <div class="row justify-content-between">
                            <div class="col-md-6 text-left">
                                <label style="font-size: 16px;">
                                    {{__($value->jumlah_halaman_hitamputih.' Halaman Hitam Putih') }}
                                </label>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>
                                    @if ($value->timbal_balik != 0)
                                        {{rupiah($value->jumlah_halaman_hitamputih * $value->product->harga_timbal_balik_hitam_putih)}}
                                    @else
                                        {{rupiah($value->jumlah_halaman_hitamputih * $value->product->harga_hitam_putih)}}
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-6 text-left">
                                <label>
                                    {{__($value->jumlah_halaman_berwarna.' Halaman Berwarna') }}
                                </label>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>
                                    @if ($value->timbal_balik != 0)
                                        {{rupiah($value->jumlah_halaman_berwarna * $value->product->harga_timbal_balik_berwarna)}}
                                    @else
                                        {{rupiah($value->jumlah_halaman_berwarna * $value->product->harga_berwarna)}}
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="row justify-content-between mb-2">
                            <div class="col-md-6 text-left">
                                <label>
                                    {{__('Jumlah Salinan') }}
                                </label>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>
                                    {{$value->jumlah_salinan}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <label class="font-weight-bold mt-2 mb-2">
                        {{__('Fitur yang Dipesan') }}
                    </label>
                    <br>
                    @if (!empty(json_decode($value->fitur_terpilih)))
                        @foreach (json_decode($value->fitur_terpilih) as $ft)
                            <div class="row justify-content-between mb-2">
                                <div class="col-md-6 text-left">
                                    <label>
                                        {{$ft->namaFitur}}
                                    </label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <label>
                                        {{$ft->hargaFitur}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row justify-content-between mb-2">
                            <div class="col-md-6 text-left">
                                <label>Tidak Ada</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>Rp. 0</label>
                            </div>
                        </div>
                    @endif
                    <div class="row row-bordered mt-2 mb-4"></div>
                    <label class="font-weight-bold mb-2">
                        {{__('ATK yang Dipesan') }}
                    </label>
                    @foreach ($atks as $idx => $a)
                        @if (!empty($a[0]) && !empty($a[1]) && !empty($a[2]) && !empty($a[3]))
                            <div class="row justify-content-between">
                                <div class="col-md-1 text-left">
                                    <label>
                                        {{ ($idx + 1).'.' }} &nbsp;
                                    </label>
                                </div>
                                <div class="col-md-5 text-left">
                                    <label>
                                        {{ $a[0] }}
                                        (x{{ $a[2] }})
                                    </label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <label>
                                        {{ rupiah($a[3]) }}
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="row justify-content-between">
                                <div class="col-md-6 text-left">
                                    <label>Tidak Ada</label>
                                </div>
                                <div class="col-md-6 text-right">
                                    <label>Rp. 0</label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <label class="font-weight-bold mt-3 mb-2">
                        {{__('Biaya Pengiriman') }}
                    </label>
                    <div class="row justify-content-between mb-2">
                        <div class="col-md-6 text-left">
                            <label>
                                @if ($pesanan->metode_penerimaan != "Ditempat")
                                    {{__('Antar ke Rumah')}}
                                @else
                                    {{__('Ambil di Tempat')}}
                                @endif
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                @if ($pesanan->metode_penerimaan != "Ditempat")
                                    {{rupiah($pesanan->ongkos_kirim)}}
                                @else
                                    {{rupiah(0)}}
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="row row-bordered">
                    </div>
                    <div class="row justify-content-between font-weight-bold mt-2">
                        <div class="col-md-6 text-left">
                            <label>
                                {{__('Total Harga Pesanan') }}
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                {{rupiah($pesanan->biaya)}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
