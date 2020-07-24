<div class="row jusify-content-between mb-3 mr-0">
    <div class="col-md-10">
        <div class="form-group search-input">
            <div class="main-search-input-item">
                <input type="text"
                    role="search"
                    class="form-control"
                    placeholder="Cari data member disini..."
                    aria-label="Cari data member disini"
                    aria-describedby="basic-addon2"
                    style="border:0px solid white;
                        border-radius:30px;
                        font-size:16px;">
                    <i class="material-icons ml-1 pt-1 pb-1 pl-3 pr-3"
                        style="position: absolute;
                            top: 50%; left: 95%;
                            transform: translate(-50%, -50%);
                            -ms-transform: translate(-50%, -50%);">
                        search
                    </i>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="dropdown">
            <button class="btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                id="filterDataMember"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                style="font-size: 16px;">
                {{__('Semua')}}
            </button>
            <div class="dropdown-menu"
                aria-labelledby="filterDataMember"
                style="font-size: 16px;">
                <a class="dropdown-item"
                    href="#">
                    {{__('Terbaru')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('A-Z')}}
                </a>
                <a class="dropdown-item"
                    href="#">
                    {{__('Z-A')}}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="table-scrollbar mb-5 pr-2" >
    <table class="table table-hover">
        <thead class="bg-primary-purple text-white"
            style="border-radius:25px 25px 15px 15px;
                font-size:16px;">
            <tr>
                <th scope="col-md-auto">
                    {{__('ID')}}
                </th>
                <th scope="col-md-auto">
                    {{__('Nama')}}
                </th>
                <th scope="col-md-auto">
                    {{__('Email')}}
                </th>
                <th scope="col-md-auto"></th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">

            {{-- @foreach ($collection as $item) --}}
                <tr class="clickable-row" data-toggle="modal"
                    data-target="#memberModal">
                    
                    {{-- @foreach ($collection as $item) --}}
                        <td scope="row">
                            {{__('000001')}}
                        </td>
                        <td>
                            {{__('Agus')}}
                        </td>
                        <td>
                            {{__('agus@gmail.com')}}
                        </td>
                        <td>
                            <i class="material-icons"
                                style="color: red;"
                                style="margin-left: -200px;">
                                delete
                            </i>
                        </td>
                    {{-- @endforeach --}}

                </tr>
            {{-- @endforeach --}}

        </tbody>
    </table>
</div>
@include('admin.detail_member')

