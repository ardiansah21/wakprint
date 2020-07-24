<button class="btn btn-outline-purple font-weight-bold pl-5 pr-5 mb-4" 
    style="border-radius:30px;
        font-size:16px;">
    {{__('Tambah ATK')}}
</button>
<div class="table-scrollbar mb-5 ml-0 pr-2">
    <table class="table table-hover">
        <thead class="bg-primary-purple text-white"
            style="border-radius:25px 25px 15px 15px;
                font-size:16px;">
            <tr>
                <th class="align-middle" scope="col-md-auto">{{__('No')}}</th>
                <th class="align-middle" scope="col-md-auto">{{__('Nama ATK')}}</th>
                <th class="align-middle" scope="col-md-auto">{{__('Harga')}}</th>
                <th class="align-middle" scope="col-md-auto">{{__('Jumlah')}}</th>
                <th class="align-middle" scope="col-md-auto"></th>
            </tr>
        </thead>
        <tbody style="font-size:12px;">

            {{-- @foreach ($collection as $item) --}}
                <tr>

                    {{-- @foreach ($collection as $item) --}}
                        <td scope="row">{{__('1')}}</td>
                        <td>{{__('Pensil')}}</td>
                        <td>{{__('Rp. 2.000')}}</td>
                        <td>{{__('40')}}</td>
                        <td class="text-right">
                            <a href=""
                                style="margin-left: -50px;">
                                <i class="material-icons md-18">
                                    edit
                                </i>
                            </a>
                            <i class="material-icons md-18"
                                style="color: #FF4949;">
                                delete
                            </i>
                        </td>
                    {{-- @endforeach --}}
                    
                </tr>
            {{-- @endforeach --}}

        </tbody>
    </table>
</div>
                    