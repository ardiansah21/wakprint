<div class="modal fade"
    id="detailBiayaModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="detailBiayaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md"
        role="document">
        <div class="modal-content bg-light-purple"
        style="border-radius:10px;">
            <div class="modal-body"
                style="font-size: 18px;">
                <div class="p-4 ml-0 mr-0">
                    <button class="close material-icons md-32"
                        data-dismiss="modal">
                        close
                    </button>
                    <label class="font-weight-bold mb-4"
                        style="font-size: 36px;">
                        {{__('Rincian Harga') }}
                    </label>
                    <div class="row justify-content-between">
                        <div class="col-md-auto text-left">
                            <label class="mb-2">
                                {{__('Jumlah File Pesanan') }}
                            </label>
                            <br>
                            <label class="mb-2">
                                {{__('Total Produk Pesanan') }}
                            </label>
                        </div>
                        <div class="col-md-auto text-right">
                            <label class="mb-2">
                                {{__('2') }}
                            </label>
                            <br>
                            <label class="mb-2">
                                {{__('2') }}
                            </label>
                        </div>
                    </div>
                    <div class="row row-bordered mt-2 mb-4">
                    </div>

                    {{-- @foreach ($collection as $item) --}}
                    <label class="font-weight-bold mt-2 mb-3">
                        {{__('Cetak Skripsi Mahasiswa') }}
                    </label>
                    <br>
                    <label class="font-weight-bold mb-2">
                        {{__('Skripsilagee.pdf') }}
                    </label>
                    <div class="row justify-content-between">
                        <div class="col-md-6 text-left">
                            <label>
                                {{__('25 Halaman Hitam-Putih') }}
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                {{__('Rp. 10.000') }}
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-6 text-left">
                            <label>
                                {{__('25 Halaman Berwarna') }}
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                {{__('Rp. 15.000') }}
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
                                {{__('1') }}
                            </label>
                        </div>
                    </div>
                    <label class="font-weight-bold mt-2 mb-2">
                        {{__('Fitur') }}
                    </label>

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between mb-2">
                        <div class="col-md-6 text-left">
                            <label>
                                {{__('Paket Jilid Lakban Hitam') }}
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                {{__('Rp. 10.000') }}
                            </label>
                        </div>
                    </div>
                    {{-- @endforeach --}}

                    <div class="row row-bordered mt-2 mb-4">
                    </div>

                    <label class="font-weight-bold mb-2">
                        {{__('ATK') }}
                    </label>

                    {{-- @foreach ($collection as $item) --}}
                    <div class="row justify-content-between">
                        <div class="col-md-6 text-left">
                            <label>
                                {{__('Pensil (x4)') }}
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                {{__('Rp. 2.000') }}
                            </label>
                        </div>
                    </div>
                    {{-- @endforeach --}}

                    <label class="font-weight-bold mt-3 mb-2">
                        {{__('Biaya Pengiriman') }}
                    </label>
                    <div class="row justify-content-between mb-2">
                        <div class="col-md-6 text-left">
                            <label>
                                {{__('Diantar ke Tempat') }}
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label>
                                {{__('Rp. 10.000') }}
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
                                {{__('Rp. 20.000') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
