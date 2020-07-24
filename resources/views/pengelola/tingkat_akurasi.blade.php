<div class="modal fade"
    id="infoAtkdwhModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="infoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md"
        role="document">
        <div class="modal-content"
            style="border-radius: 10px;">
            <div class="modal-body">
                <button class="close material-icons md-32"
                    data-dismiss="modal">
                    close
                </button>
                <label id="infoAtkdwhModalLabel"
                    class="font-weight-bold mb-5 mt-5"
                    style="font-size: 36px;">
                    {{__('Akurasi Tingkat Keakuratan Deteksi Warna Halaman') }}
                </label>
                <div class="mb-4">
                    <label class="font-weight-bold mb-0 ml-0 mt-2"
                        style="font-size: 18px;">
                        {{__('1. Penuh') }}
                    </label>
                    <p class="mb-0 ml-0 mt-2"
                        style="font-size: 16px;">
                        {{__('Ini contoh dokumen yang menggunakan tingkat akurasi deteksi warna halaman yang maksimal') }}
                    </p>
                    <label class="mb-0 ml-0 mt-2 mb-3"
                            style="font-size: 18px;">
                            {{__('Contoh') }}
                    </label>
                    <br>
                    <img src="{{url('img/Deteksi-Penuh.png')}}"
                            class="img-responsive"
                            style="width:250px;
                                height:400px;
                                border-radius:10px;">
                </div>
                <div class="mb-4">
                    <label class="font-weight-bold mb-0 ml-0 mt-2"
                        style="font-size: 18px;">
                        {{__('2. Tinggi') }}
                    </label>
                    <p class="mb-0 ml-0 mt-2"
                        style="font-size: 16px;">
                        {{__('Ini contoh dokumen yang menggunakan tingkat akurasi deteksi warna halaman yang tinggi') }}
                    </p>
                    <label class="mb-0 ml-0 mt-2 mb-3"
                            style="font-size: 18px;">
                            {{__('Contoh') }}
                        </label>
                    <br>
                    <img src="{{url('img/Deteksi-Tinggi.png')}}"
                    class="img-responsive"
                    style="width:250px;
                        height:400px;
                        border-radius:10px;">
                </div>
                <div class="mb-4">
                    <label class="font-weight-bold mb-0 ml-0 mt-2"
                        style="font-size: 18px;">
                        {{__('3. Sedang') }}
                    </label>
                    <p class="mb-0 ml-0 mt-2"
                        style="font-size: 16px;">
                        {{__('Ini contoh dokumen yang menggunakan tingkat akurasi deteksi warna halaman yang sedang') }}
                    </p>
                    <label class="mb-0 ml-0 mt-2 mb-3"
                            style="font-size: 18px;">
                            {{__('Contoh') }}
                        </label>
                    <br>
                    <img src="{{url('img/Deteksi-Sedang.png')}}"
                        class="img-responsive"
                        style="width:250px;
                            height:400px;
                            border-radius:10px;">
                </div>
                <div class="mb-4">
                    <label class="font-weight-bold mb-0 ml-0 mt-2"
                        style="font-size: 18px;">
                        {{__('4. Rendah') }}
                    </label>
                    <p class="mb-0 ml-0 mt-2"
                        style="font-size: 16px;">
                        {{__('Ini contoh dokumen yang menggunakan tingkat akurasi deteksi warna halaman yang rendah') }}
                    </p>
                    <label class="mb-0 ml-0 mt-2 mb-3"
                            style="font-size: 18px;">
                            {{__('Contoh') }}
                        </label>
                    <br>
                    <img src="{{url('img/Deteksi-Rendah.png')}}"
                        class="img-responsive"
                        style="width:250px;
                            height:400px;
                            border-radius:10px;">
                </div>
                <div class="mb-4">
                    <label class="font-weight-bold mb-0 ml-0 mt-2"
                        style="font-size: 18px;">
                        {{__('5. Sangat Rendah') }}
                    </label>
                    <p class="mb-0 ml-0 mt-2"
                        style="font-size: 16px;">
                        {{__('Ini contoh dokumen yang menggunakan tingkat akurasi deteksi warna halaman yang sangat rendah') }}
                    </p>
                    <label class="mb-0 ml-0 mt-2 mb-3"
                            style="font-size: 18px;">
                            {{__('Contoh') }}
                        </label>
                    <br>
                    <img src="{{url('img/Deteksi-Sangat-Rendah.png')}}"
                        class="img-responsive"
                        style="width:250px;
                            height:400px;
                            border-radius:10px;">
                </div>
            </div>
        </div>
    </div>
</div>