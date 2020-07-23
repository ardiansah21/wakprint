<div class="modal fade"
    id="tolakModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="tolakModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md"
        role="document">
        <div class="modal-content"
            style="border-radius: 10px;
            font-size:18px;">
            <div class="modal-body"
                style="border-radius: 10px;">
                <div class="mb-0">
                    <button class="close material-icons md-32"
                        data-dismiss="modal">
                        close
                    </button>
                    <label class="font-weight-bold ml-0 mb-5"
                        style="font-size:36px;">
                        {{__('Alasan Penolakan')}}
                    </label>
                
                    <div class="short-scrollbar mb-4 pr-2">
                        <div class="mb-3">
                            <button class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0">
                                {{__('Minimal Topup')}}
                            </button>
                        </div>
                
                        <div class="mb-3">
                            <button class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0">
                                {{__('Ada Kendala pada Verifikasi Pendaftaran')}}
                            </button>
                        </div>
                
                        <div class="mb-3">
                            <button class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0">
                                {{__('Saldo Tidak Mencukupi')}}
                            </button>
                        </div>
                
                        <div class="mb-3">
                            <button class="btn btn-outline-square-purple btn-lg btn-block text-left font-weight-bold pl-5 pr-5 mb-0">
                                {{__('Akun Dibekukan Sementara')}}
                            </button>
                        </div>
                    </div>
                    <label class="mb-2">
                        {{__('Isi Sendiri')}}
                    </label>
                    <div class="form-group mb-4">
                        <textarea type="text"
                            class="form-control pt-2 pb-2"
                            placeholder="Masukkan alasan selain diatas..."
                            style="font-size: 18px;"></textarea>
                    </div>
                    <div class="row justify-content-end mb-3"> 
                        <div class="form-group mr-3">
                            <button class="btn btn-danger btn-outline-danger-primary btn-lg text-primary-danger font-weight-bold pl-5 pr-5 mb-0" 
                                style="border-radius:30px;
                                    font-size:18px;">
                                {{__('Batal')}}
                            </button>
                        </div>
                        <div class="form-group mr-3">
                            <button class="btn btn-primary-wakprint btn-lg font-weight-bold pl-5 pr-5 mb-0"
                                style="border-radius:30px;
                                    font-size:18px;">
                                {{__('Kirim')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

