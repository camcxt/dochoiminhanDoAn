@include ('admin.index')

<style>
    .detail {
        display: flex;
        justify-content: space-around;
    }

    td {
        text-align: center;
    }
</style>

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        <div class="widget-content">
                            <div class="detail">
                                <div class="col-sm-6 detail-child" style="width: 63%;">
                                    <div class="product-inner">
                                        <h2 class="product-name">{{ $product->name }}</h2>
                                        @foreach ($categories as $categoryList)
                                            @if ($categoryList->id == $product->category_id)
                                                <div style="display: flex;"><b>Danh mục:</b> &ensp; <p>
                                                        {{ $categoryList->name }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                        @foreach ($brands as $brandList)
                                            @if ($brandList->id == $product->brand_id)
                                                <div style="display: flex;"><b>Thương hiệu:</b> &ensp; <p>
                                                        {{ $brandList->name }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div style="display: flex;"><b>Thẻ:</b> &ensp; <p>{{ $product->tags }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Giá:</b> &ensp; $<p>
                                                {{ number_format($product->price) }}</p>
                                        </div>
                                        <div role="tabpanel">
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active">
                                                    <h2>Mô tả</h2>
                                                    <p>{!! $product->description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-child" style="width: 33%; margin-right: 1%;">
                                    <div class="col-sm-4">
                                        <div class="product-images">

                                            <div class="product-main-img">
                                                <img src="../images/{{ $product->image }}" width="400px" height="600px"
                                                    alt="k tải được">
                                            </div> &emsp;

                                            <div>
                                                <a href="{{ route('editProducts', $product->id) }}"
                                                    class="btn btn-success"><i class="icon-edit"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- hết  -->
                        </div>
                        &emsp;

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

                        <div class="widget-content">
                            <div class="col-sm-4" style="margin-left: 2%;">
                                <h2>THÊM HÌNH ẢNH</h2> &ensp;
                                <form action="{{ route('storeImage') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div style="display: flex; flex-direction: column;">
                                        <input type="hidden" value="{{ $product->id }}" name="productId">
                                        <div class="control-group"
                                            style="width: 50%; display: flex; align-items: center;">
                                            <label class="control-label" style="width: 15%;">Hình ảnh</label> &emsp;
                                            <input type="file" name="imageUrl[]" style="width: 50%;"
                                                multiple="multiple"> <br>

                                            @error('imageUrl')
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="control-group"
                                            style="width: 50%; display: flex; align-items: center;">
                                            <label class="control-label" style="width: 15%;">Ưu tiên</label> &emsp;
                                            <div class="controls">
                                                <input type="text" name="sortOrder" value="{!! old('sortOrder') !!}">
                                                @error('sortOrder')
                                                    <br>
                                                    <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        <button type="submit" class="btn btn-primary"
                                            style="width: 8%; margin-left: 8.8%;">Lưu</button>
                                    </div>
                                    &emsp;
                                    @if ($errors->any())
                                        <div class="alert alert-primary text-center">
                                            @foreach ($errors->all() as $errors)
                                                <p>{{ $errors }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="widget-content">
                                                    <table style="width:100%"
                                                        class="table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th style="width:5%; text-align: center;">STT</th>
                                                                <th style="width:15%; text-align: center;">Hình ảnh</th>
                                                                <th style="width:52%;"></th>
                                                                <th style="width:8%; text-align: center;">Ưu tiên</th>
                                                                <th style="width:10%; text-align: center;">Tác vụ</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($images as $key => $imageList)
                                                                @foreach (explode(', ', $imageList->image_url) as $imgUrl)
                                                                    <tr>
                                                                        <td style="text-align: center;">
                                                                            {{ $key++ + 1 }}</td>
                                                                        <td style="text-align: center;"><img
                                                                                src="../images/{{ $imgUrl }}"
                                                                                height="50px" width="150px"
                                                                                alt="Khong tai duoc"></td>
                                                                        <td></td>
                                                                        <td style="text-align: center;">
                                                                            {{ $imageList->sort_order }}</td>
                                                                        <td style="text-align: center;">
                                                                            <form method="post" action="">
                                                                                <input value="{{ $imageList->id }}"
                                                                                    type="hidden" name="id"
                                                                                    id="imageId">
                                                                                <a class="btn btn-danger"
                                                                                    href="{{ route('destroyImage',['id' => $imageList->id, 'idp' => $product->id])}}"
                                                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                                                    <i class="icon-trash"></i></a>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
