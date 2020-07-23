<div class="modal fade"
    id="tolakPesananModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="tolakPesananModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg"
        role="document">
        <div class="modal-content"
            style="border-radius:10px;">
            <div class="modal-body">
                <div class="container mt-4">
                    <button class="close material-icons md-32"
                        data-dismiss="modal">
                        close
                    </button>
                    <label class="font-weight-bold ml-0 mb-5"
                        style="font-size: 36px;">
                        {{__('Alasan Penolakan') }}
                    </label>
                    <form style="font-size: 16px;">
                        <label class="font-weight-bold mb-2">
                            {{__('Isi Sendiri') }}
                        </label>
                        <div class="form-group mb-4">
                            <textarea type="text" class="form-control pt-2 pb-2"
                            style="font-size: 16px;"></textarea>
                        </div>
                        <div class="form-group row justify-content-end mr-0 ml-0">
                            <button class="btn btn-default text-primary-purple font-weight-bold pl-5 pr-5 mr-2 mb-0"
                                data-dismiss="modal"
                                aria-label="Close"
                                style="border-radius:30px;
                                    font-size: 16px;">
                                {{__('Batal') }}
                            </button>
                            <button class="btn btn-primary-wakprint font-weight-bold pl-5 pr-5 mb-0"
                                    style="border-radius:30px;
                                    font-size: 16px;">
                                    {{__('Kirim') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>            
</div>

