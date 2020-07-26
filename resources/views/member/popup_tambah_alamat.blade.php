{{-- isi popup tambah alamat --}}
<div class="modal fade" id="alamatModal" tabindex="-1" role="dialog" aria-labelledby="alamatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <form action="{{ route('alamat.tambah') }}" class="mb-3" method="POST">
            {{ csrf_field() }}
                <button class="close material-icons md-32" data-dismiss="modal">
                    close
                </button>
                <h1 id="alamatModalLabel" class="modal-title font-weight-bold ml-0 mb-5" style="font-size: 48px;">{{__('Tambah Alamat Pengiriman')}}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Nama Penerima')}}</label>
                            <div class="input-group">
                                <input type="text" name="namapenerima" class="form-control pt-2 pb-2" value=""
                                placeholder="Masukkan Nama Penerima" aria-label="Masukkan Nama Penerima" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 18px;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Nomor HP')}}</label>
                            <div class="input-group">
                                <input type="text" name="nomorhp" class="form-control pt-2 pb-2" value=""
                                placeholder="Masukkan Nomor HP Penerima" aria-label="Masukkan Nomor HP Penerima" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 18px;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Provinsi')}}</label>
                            <div class="input-group mb-3">
                                <input type="text" name="provinsi" class="form-control pt-2 pb-2" value=""
                                placeholder="Masukkan Provinsi" aria-label="Masukkan Provinsi" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 18px;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Kabupaten / Kota')}}</label>
                            <div class="input-group mb-3">
                                <input type="text" name="kota" class="form-control pt-2 pb-2" value=""
                                placeholder="Masukkan Nama Kabupaten / Kota" aria-label="Masukkan Nama Kabupaten / Kota" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 18px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Kecamatan')}}</label>
                            <div class="input-group">
                                <input type="text" name="kecamatan" class="form-control pt-2 pb-2" value=""
                                placeholder="Masukkan Nama Kecamatan" aria-label="Masukkan Nama Kecamatan" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 18px;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Kelurahan')}}</label>
                            <div class="input-group">
                                <input type="text" name="kelurahan" class="form-control pt-2 pb-2" value=""
                                placeholder="Masukkan Nama Kelurahan" aria-label="Masukkan Nama Kelurahan" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 18px;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Kode Pos')}}</label>
                            <div class="input-group">
                                <input type="text" name="kodepos" class="form-control pt-2 pb-2" value="" 
                                placeholder="Masukkan Kode Pos" aria-label="Masukkan Kode Pos" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 18px;">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2" style="font-size: 18px;">{{__('Alamat')}}</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control" type="text" name="alamatjalan" aria-label="Alamat" style="font-size: 18px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row float-right mr-0">
                    <div class="form-group mb-3 mr-3">
                        <button class="btn btn-default text-primary-purple font-weight-bold pl-4 pr-4"
                        data-dismiss="modal" 
                        style="border-radius:30px; font-size:18px;">
                            {{__('Batal')}}
                        </button>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-primary-wakprint text-right font-weight-bold pl-4 pr-4"
                        style="border-radius:30px; font-size:18px;">
                            {{__('Simpan')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>