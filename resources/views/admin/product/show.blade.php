@include ('admin.index')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
    integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/product-admin.css') }}">
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="card-header">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item" style="width: 95%;"><i class="icon-inbox"></i> SẢN PHẨM &emsp; &emsp;
                    </li>
                    <li class="breadcrumb-item"> <a href="{{ route('createProduct') }}" class="btn btn-primary"> <i
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
                        <form action=" {{ route('indexProduct') }} " method="get">
                            <div class="search"> &emsp;
                                <div class="search-element">
                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Sản phẩm</label>
                                        <input id='searchInput' style="width: 57%;" class="form-control"
                                            name="searchInput" type='text' placeholder="Product's name"
                                            value="{{ $name }}" />
                                    </div>

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Thương hiệu</label>
                                        <select name="brand" style="height: 28px;" class="form-control detail-right">
                                            <option value="">-----</option>
                                            @foreach ($brands as $brand)
                                                @if ($productBrand == $brand->id)
                                                    <option value="{{ $brand->id }}" selected>{{ $brand->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Danh mục</label>
                                        <select class="detail-right" style="height: 28px;" name="category">
                                            <option value="">-----</option>
                                            @foreach ($categories as $category)
                                                @if ($productCategory == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="search-element">
                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Mới</label>
                                        <select class="detail-right" style="height: 28px;" name="isNew">
                                            @if ($productNew == 1)
                                                <option value="">-----</option>
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                            @elseif ($productNew == 0)
                                                <option value="">-----</option>
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            @elseif (!empty($productNew))
                                                <option value="">-----</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Đặc biệt</label>
                                        <select class="detail-right" style="height: 28px;" name="bestSell">
                                            @if ($productBestSell == 1)
                                                <option value="">-----</option>
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                            @elseif ($productBestSell == 0)
                                                <option value="">-----</option>
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            @elseif (!empty($productBestSell))
                                                <option value="">-----</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="control-group" style="width: 30%; height: 90%;">
                                        <button class="btn btn-secondary" name="btnSearch" value="btnSearch"
                                            style="color: black ;border-radius: 20px; height: 90%;"><i
                                                class="icon-search"></i></button> &emsp;
                                        <a href="{{ route('indexProduct') }}" class="btn btn-secondary"
                                            style="color: black ;border-radius: 20px; height: 70%;"><i
                                                class="icon-retweet"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:2%; text-align: center;">STT</th>
                                    <th style="width:10%; text-align: center;">hình ảnh</th>
                                    <th style="width:18%; text-align: center;">sản phẩm</th>
                                    <th style="width:10%; text-align: center;">thương hiệu</th>
                                    <th style="width:10%; text-align: center;">danh mục</th>
                                    <th style="width:7%; text-align: center;">số lượng</th>
                                    <th style="width:5%; text-align: center;">giá</th>
                                    <th style="width:7%; text-align: center;">giá cũ</th>
                                    <th style="width:7%; text-align: center;">đặc biệt</th>
                                    <th style="width:5%; text-align: center;">mới</th>
                                    <th style="width:4%; text-align: center;">hiển thị</th>
                                    <th style="width:18%; text-align: center;">tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $productKey => $product)
                                    <tr>
                                        <td style="text-align: center;"> {{ $productKey + 1 }} </td>
                                        <td style="text-align: center;"><img
                                                src="/dochoiminhan/public/images/{{ $product->image }}"
                                                width="100px" alt="No Image"></td>
                                        <td style="text-align: center;">{{ $product->name }}</td>
                                        @foreach ($brands as $brand)
                                            @if ($brand->id == $product->brand_id)
                                                <td style="text-align: center;">{{ $brand->name }}</td>
                                            @endif
                                        @endforeach
                                        @foreach ($categories as $category)
                                            @if ($category->id == $product->category_id)
                                                <td style="text-align: center;">{{ $category->name }}</td>
                                            @endif
                                        @endforeach
                                        <td style="text-align: center;">{{ $product->amount }}</td>
                                        <td style="text-align: right;">{{ number_format($product->price) }}đ</td>
                                        @if ($product->old_price != 0)
                                            <td style="text-align: right;">{{ number_format($product->old_price) }}đ
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if ($product->is_best_sell == 1)
                                            <td style="text-align: center;"><i style="color: green"
                                                    class="icon-check"></i></td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if ($product->is_new == 1)
                                            <td style="text-align: center;"><i style="color: green"
                                                    class="icon-check"></i></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <input type="hidden" value="{{ $product->id }}" class="id"
                                            id="idp">
                                        <td style="text-align: center;"><input type="checkbox"
                                                class="toggle-position mini" value="{{ $product->id }}"
                                                data-url="/dochoiminhan/public/active" data-id="{{ $product->id }}"
                                                data-on="Yes" data-off="No" data-size="mini" data-toggle="toggle"
                                                data-width="15" data-height="10"
                                                {{ $product->active == 1 ? 'checked' : '' }}></td>
                                        <td style="text-align: center;">
                                            <input value="{{ $product->id }}" type="hidden" name="id">
                                            <a class="btn btn-success"
                                                href="{{ route('editProducts', $product->id) }}"><i
                                                    class="icon-edit"></i></a>
                                            <a class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item ?');"
                                                href="{{ route('destroyProducts', $product->id) }}"> <i
                                                    class="icon-trash"></i></a>
                                            <a class="btn btn-info" href="{{ route('showImage', $product->id) }}"><i
                                                    class="icon-eye-open"></i></a>
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
                    @if (!isset($_GET['btnSearch']))
                        {!! $products->links() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include ('admin.footer')
<!-- /footer -->

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('.toggle-position').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('active') }}",
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
