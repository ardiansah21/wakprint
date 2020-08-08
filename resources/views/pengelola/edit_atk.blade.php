@extends('layouts.pengelola')

@section('content')
    <div class="container mt-5 mb-5"
        style="font-size: 16px;">
        <label class="font-weight-bold mb-4 ml-0 mr-0"
            style="font-size:36px;">
            {{__('Ubah ATK') }}
        </label>
        <form action="{{ route('partner.atk.update',$atk->id_atk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row justify-content-between mb-2 ml-0" style="list-style-position: inside">
                <div class="col-md-2">
                    @if (!empty($atk->getFirstMediaUrl()))
                        <img id="gambarAtk" src="{{ $atk->getFirstMediaUrl() }}"
                            class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px;" alt="foto atk">
                        <a id="editGambarAtk" class="pointer" onclick="document.getElementById('imgupload').click();"
                            style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;"> edit
                            </i>
                        </a>
                        <input id="imgupload" type="file" name="foto_atk" hidden accept="image/png, image/jpeg"
                            onchange="document.getElementById('gambarAtk').src=window.URL.createObjectURL(this.files[0]);" hidden>
                    @else
                        <img id="gambarAtk" src="https://unsplash.it/600/400"
                            class="img-responsive bg-light" style="width:163px;height:163px;border-radius:10px;" alt="foto atk">
                        <a id="editGambarAtk" class="pointer" onclick="document.getElementById('imgupload').click();"
                            style="color: black; position: relative;bottom: 40px;left:130px;right: 0px;">
                            <i class="material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2" style="border-radius: 5px;"> edit
                            </i>
                        </a>
                        <input id="imgupload" type="file" name="foto_atk" hidden accept="image/png, image/jpeg"
                            onchange="document.getElementById('gambarAtk').src=window.URL.createObjectURL(this.files[0]);" hidden>
                    @endif
                </div>
                <div class="col-md-10">
                    <label class="mb-2">Nama Atk</label>
                    <div class="form-group mb-4">
                        <input name="nama" id="nama" type="text" value="{{ $atk->nama }}"
                            class="form-control form-control-lg pt-2 pb-2" placeholder="Masukkan Nama ATK" aria-label=""
                            aria-describedby="inputGroup-sizing-sm" style="font-size: 16px;" required>
                    </div>
                    <div class="row justify-content-between">
                        <div class="row col-md-6 form-group ">
                            <label class="align-self-center"
                                style="display: inline-block; width: 10%; text-align: right; padding-right:8px"> Rp </label>
                            <input id="harga" name="harga" type="number" min="0" value="{{ $atk->harga }}"
                                class="form-control pt-2 pb-2 optional-step-100" placeholder="Masukkan Harga ATK"
                                aria-label="Masukkan Harga Produk" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 16px; width:90%" required>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <input id="jumlah" type="number" name="jumlah" min="0" value="{{ $atk->jumlah }}"
                                class="form-control pt-2 pb-2" aria-label="Jumlah Atk" placeholder="Masukkan Jumlah Atk"
                                aria-label="Masukkan Jumlah ATK" aria-describedby="inputGroup-sizing-sm"
                                style="font-size: 16px;" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end ml-0 mr-0 mb-5">
                <div class="form-group mr-3">
                    <button onclick="window.location.href='{{ route('partner.atk.index') }}'" class="btn btn-default btn-lg text-primary-purple font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;">
                        {{__('Batal') }}
                    </button>
                </div>
                <div class="form-group mr-0">
                    <button
                        type="submit" class="btn btn-lg btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                        style="border-radius:30px;">
                        {{__('Simpan') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $("#editGambarAtk").on("click",function(){
            $('#imgupload').trigger('click'); return false;
        });

        $("#gambarAtk").on("change","#imgupload",function(){
            document.getElementById('gambarAtk').src=window.URL.createObjectURL(this.files[0]);
        });

    });
</script>
@endsection
