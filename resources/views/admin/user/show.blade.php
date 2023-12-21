@include ('admin.index')

<style>
    .center {
        margin: auto;
        width: 50%;
        text-align: center;
        padding: 10px;
    }

    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a,
    .pagination>li>span {
        float: left;
        padding: 4px 12px;
        line-height: 1.428571429;
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        border-left-width: 0;
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span {
        border-left-width: 1px;
    }

    .pagination>li>a:hover,
    .pagination>li>a:focus,
    .pagination>.active>a,
    .pagination>.active>span {
        background-color: #f5f5f5;
    }

    .pagination>.active>a,
    .pagination>.active>span {
        color: #999999;
        cursor: default;
    }

    .pagination>.disabled>span,
    .pagination>.disabled>a,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>a:focus {
        color: #999999;
        cursor: not-allowed;
        background-color: #ffffff;
    }

    .pagination-large>li>a,
    .pagination-large>li>span {
        padding: 14px 16px;
        font-size: 18px;
    }

    .pagination-small>li>a,
    .pagination-small>li>span {
        padding: 5px 10px;
        font-size: 12px;
    }

    .search-element {
        display: flex;
        justify-content: space-around;
        height: 28px;
    }

    .input-search {
        border-radius: 20px;
        border: solid 1px #cccccc;
        width: 20%;
    }

    .search {
        display: flex;

        align-content: space-between;
    }
</style>

<div class="main">
    <div class="tabbable">
        <div>
            @if (session()->has('messageAdd'))
                <div class="alert alert-success">
                    {{ session('messageAdd') }}
                </div>
            @endif

            @if (session()->has('messageUpdate'))
                <div class="alert alert-success">
                    {{ session('messageUpdate') }}
                </div>
            @endif

            @if (session()->has('messageDelete'))
                <div class="alert alert-success">
                    {{ session('messageDelete') }}
                </div>
            @endif

            @if (session()->has('messageError'))
                <div class="alert alert-danger">
                    {{ session('messageError') }}
                </div>
            @endif
        </div>
        <ul class="nav nav-tabs">
            <li>
                <a href="#user" data-toggle="tab">TÀI KHOẢN NHÂN VIÊN</a>
            </li>
            <li ><a href="#guest" data-toggle="tab">TÀI KHOẢN KHÁCH HÀNG</a></li>
        </ul>
        <br>
        <div class="tab-content">
            <div class="tab-pane active" id="user">
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-header">
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item" style="width: 95%;"><i class="fas fa-user"></i> TÀI KHOẢN &emsp;
                                    &emsp;</li>
                                @if (Auth::user()->permission == 0)
                                <li class="breadcrumb-item"> <a href="{{ route('createUser') }}" class="btn btn-primary"><i
                                            class="icon-plus"></i> </a> </li>
                                @endif
                            </ol>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="widget-content">
                                    <table style="width:100%" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:45%">Tên tài khoản</th>
                                                <th style="width:30%;">Email</th>
                                                <th style="width:15%; text-align: center;">Số điện thoại</th>
                                                <th style="width:10%">Tác vụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $userData)
                                                @if ($userData->id != Auth::user()->id)
                                                    <tr>
                                                        <td>{{ $userData->username }}</td>
                                                        <td>{{ $userData->email }}</td>
                                                        <td style="text-align: center;">{{ $userData->phone }}</td>
                                                        <td style="text-align: center;">
                                                            <a class="btn btn-success"
                                                                href="{{ route('editUser', $userData->id) }}"><i
                                                                    class="icon-edit"></i></a>
                                                            @if (Auth::user()->permission == 0)
                                                                <a class="btn btn-danger"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản nhân viên này ?');"
                                                                    href="{{ route('destroyUser', $userData->id) }}"> <i
                                                                        class="icon-trash"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <div class="center">
                            <div class="pagination">
                                <li>{!! $users->links() !!}</li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane " id="guest">
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-header">
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item" style="width: 95%;"><i class="fas fa-user"></i> TÀI KHOẢN &emsp;
                                    &emsp;</li>
                            </ol>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="widget-content">
                                    <table style="width:100%" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:45%">Tên tài khoản</th>
                                                <th style="width:30%;">Email</th>
                                                <th style="width:15%; text-align: center;">Số điện thoại</th>
                                                <th style="width:10%">Tác vụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($guest as $guestData)
                                                    <tr>
                                                        <td>{{ $guestData->username }}</td>
                                                        <td>{{ $guestData->email }}</td>
                                                        <td style="text-align: center;">{{ $guestData->phone }}</td>
                                                        <td style="text-align: center;">
                                                                <a class="btn btn-danger"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản khách hàng này ?');"
                                                                    href="{{ route('destroyGuest', $guestData->id) }}"> <i
                                                                        class="icon-trash"></i></a>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <div class="center">
                            <div class="pagination">
                                <li>{!! $guest->links() !!}</li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@include ('admin.footer')
<!-- /footer -->
