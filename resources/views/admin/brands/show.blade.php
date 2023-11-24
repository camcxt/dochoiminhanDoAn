@include ('admin.index')

<div class="main">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item" style="width: 95%;"><i class="icon-bookmark"></i> THƯƠNG HIỆU &emsp; &emsp;</li>
                    <li class="breadcrumb-item"> <a href="{{ route('createBrand') }}" class="btn btn-primary"> <i
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

                @if (session()->has('messageError'))
                    <div class="alert alert-danger">
                        {{ session('messageError') }}
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
                                    <th style="width:18%; text-align: center;">HÌNH ẢNH</th>
                                    <th style="width:20%; text-align: left;">THƯƠNG HIỆU</th>
                                    <th style="width:30%; text-align: center;">Link</th>
                                    <th style="width:7%; text-align: center;">HIỂN THỊ</th>
                                    <th style="width:7%; text-align: center;">ƯU TIÊN</th>
                                    <th style="width:13%; text-align: center;">TÁC VỤ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brandList as $brandKey => $brandData)
                                    <tr>
                                        <td style="text-align: center;">{{ $brandKey + 1 }}</td>
                                        <td style="text-align: center;"><img
                                                src="../public/images/{{ $brandData->image_url }}" width="150px"
                                                alt="No image"></td>
                                        <td style="text-align: left;">{{ $brandData->name }}</td>
                                        <td style="text-align: center;"><a href="{{ $brandData->link }}"
                                                target="_blank">{{ $brandData->link }}</a></td>
                                        <td style="text-align: center;"><input type="checkbox" class="toggle-position"
                                                value="{{ $brandData->id }}"
                                                data-url="/dochoiminhan/public/activeBrand" data-size="mini"
                                                data-id="{{ $brandData->id }}" data-on="Yes" data-off="No"
                                                {{ $brandData->active == 1 ? 'checked' : '' }} data-toggle="toggle"
                                                data-width="20" data-height="10"></td>
                                        <td style="text-align: center;">{{ $brandData->sort_order }}</td>
                                        <td style="text-align: center;">
                                            <input value="{{ $brandData->id }}" type="hidden" name="id"
                                                id="">
                                            <a class="btn btn-success" href="{{ route('editBrand', $brandData->id) }}">
                                                <i class="icon-edit"></i> </a> &emsp;
                                            <a class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item ?');"
                                                href="{{ route('destroyBrand', $brandData->id) }}"> <i
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
        $(document).on('change', '.toggle-position', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('activeBrand') }}",
                method: 'POST',
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
