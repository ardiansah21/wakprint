
<li>
    <div class='row justify-content-between mb-2'>
        <div class='col-md-2' style='position: relative'>
            <img src='https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg'
                class='img-responsive bg-light' style='width:163px;
                        height:163px;
                        border-radius:10px;'>
            <a href='' style='color: black;
                        position: relative;
                        bottom: 40px;
                        left:130px;
                        right: 0px;'>
                <i class='material-icons md-18 badge-sm bg-primary-yellow p-1 mr-2' style='border-radius: 5px;'>
                    edit
                </i>
            </a>
        </div>
        <div class='col-md-9'>
            <div class='row justify-content-between mr-1'>
                <div class='col-md-5 form-group mb-3'>
                    <input type='text' class='form-control form-control-lg pt-2 pb-2' placeholder='Masukkan Nama Paket'
                        aria-label='' aria-describedby='inputGroup-sizing-sm'
                        style='font-size: 16px; ' required>
                </div>
                <div class='row col-md-5 form-group '>
                    <label class='align-self-center' style=' display: inline-block; width: 10%; text-align: right; padding-right:8px'>
                        Rp
                    </label>
                    <input id='temp' name='fitur[paket][temp]' type='number' min='0' class='form-control pt-2 pb-2 optional-step-100' placeholder='Masukkan Harga Produk' aria-label='Masukkan Harga Produk'
                        aria-describedby='inputGroup-sizing-sm' style='font-size: 16px; width:90%' required>
                </div>
            </div>
            <label class='mb-2 '>
                Deskripsi Fitur
            </label>
            <div class='form-group mb-4 mr-0'>
                <textarea class='form-control d-flex' aria-label='Deskripsi Fitur'
                    placeholder='Masukkan Deskripsi Paket Tambahan Anda'></textarea>
            </div>
        </div>
        <div class='col-md-auto align-self-center mr-0 mb-3'>
            <button class='btn btn-circle-trash shadow-sm' type='button'
                role='button'>
                <i class='fa fa-trash fa-2x' style='color: white' aria-hidden='true'></i>
            </button>
        </div>
    </div>
</li>