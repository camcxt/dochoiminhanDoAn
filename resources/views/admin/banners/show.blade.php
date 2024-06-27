@include ('admin.index')

<div class="main">
    <div class="container-fluid">
        <div class="card mb-4">

            <div class="card-header">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item" style="width: 95%;"><i class="icon-align-justify"></i> QUẢNG CÁO &emsp;
                        &emsp;</li>
                    <li class="breadcrumb-item"> <a href="{{ route('createBanners') }}" class="btn btn-primary"><i
                                class="icon-plus"></i> </a> </li>
                </ol>
            </div>

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
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="widget-content">
                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%; text-align: center;">STT</th>
                                    <th style="width:18%; text-align: center;">hình ảnh</th>
                                    <th style="width:47%; text-align: left;">tiêu đề</th>
                                    <th style="width:8%; text-align: center;">hiển thị</th>
                                    <th style="width:8%; text-align: center;">ưu tiên</th>
                                    <th style="width:13%; text-align: center;">tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $bannerKey => $bannerList)
                                    <tr>
                                        <td style="text-align: center;">{{ $bannerKey + 1 }}</td>
                                        <td style="text-align: center;"><img
                                                src="../images/{{ $bannerList->image_url }}" style="width: 150px"
                                                alt="No Image"></td>
                                        <td style="text-align: left;">{{ $bannerList->title }}</td>
                                        <td style="text-align: center;"><input type="checkbox" class="toggle-position"
                                                value="{{ $bannerList->id }}" data-size="mini"
                                                data-url="../activeBanner"
                                                data-id="{{ $bannerList->id }}" data-on="Yes" data-off="No"
                                                {{ $bannerList->active == 1 ? 'checked' : '' }} data-toggle="toggle"
                                                data-width="20" data-height="10"></td>
                                        <td style="text-align: center;">{{ $bannerList->sort_order }}</td>
                                        <td style="text-align: center;">
                                            <input value="{{ $bannerList->id }}" type="hidden" name="id">
                                            <a class="btn btn-success"
                                                href="{{ route('editBanners', $bannerList->id) }}"> <i
                                                    class="icon-edit"></i></a>&emsp;
                                            <a class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item ?');"
                                                href="{{ route('destroyBanners', $bannerList->id) }}"> <i
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
</div>

@include ('admin.footer')
<!-- /footer -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
    integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('.toggle-position').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('activeBanner') }}",
                method: 'GET',
                data: {
                    status: status,
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                },
            });
        });
    });
</script> -->
