@include ('admin.index')

<style>
    input.first {
        min-height: 100px;
    }
</style>

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-inbox"></i>
                            <h3>THÊM SẢN PHẨM</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('storeProduct') }}" method="post" id="edit-profile"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="control-group">
                                        <label class="control-label">Danh mục <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="category">
                                                <option value="">------</option>
                                                @foreach ($categories as $category)
                                                    @if ($errors->any())
                                                        @if (old('category') == $category->id)
                                                            <option selected value="{!! old('category') !!}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Thương hiệu <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="brand">
                                                <option value="">------</option>
                                                @foreach ($brands as $brand)
                                                    @if ($errors->any())
                                                        @if (old('brand') == $brand->id)
                                                            <option selected value="{!! old('brand') !!}">
                                                                {{ $brand->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Sản phẩm <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="name"
                                                value="{!! old('name') !!}">
                                            @error('name')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Giá <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input class="span3" name="price" type="text"
                                                value="{!! old('price') !!}" />
                                            @error('price')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Giá cũ</label>
                                        <div class="controls">
                                            <input class="span3" name="oldPrice" type="text"
                                                value="{!! old('oldPrice') !!}" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Thẻ</label>
                                        <div class="controls">
                                            <input class="span3" name="tags" type="text"
                                                value="{!! old('tags') !!}" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Đặc biệt</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="bestSell">
                                                @if (old('bestSell') == 1)
                                                    <option value="0">No</option>
                                                    <option value="1" selected>Yes</option>
                                                @else
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Mới</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="isNew">
                                                @if (old('isNew') == 1)
                                                    <option value="0">No</option>
                                                    <option value="1" selected>Yes</option>
                                                @else
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Ưu tiên <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="sortOrder"
                                                value="{!! old('sortOrder') !!}">
                                            @error('sortOrder')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Số lượng</label>
                                        <div class="controls">
                                            <input type="number" class="span3" name="amount"
                                                value="{!! old('amount') !!}">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Active</label>
                                        <div class="controls">
                                            <select class="span3" style="height: 28px;" name="acTive">
                                                @if ($errors->any())
                                                    @if (old('acTive') == 1)
                                                        <option value="0">No</option>
                                                        <option value="1" selected>Yes</option>
                                                    @elseif (old('acTive') == 0)
                                                        <option value="0" selected>No</option>
                                                        <option value="1">Yes</option>
                                                    @endif
                                                @else
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label ">Hình ảnh</label>
                                        <div class="controls">
                                            <input class="span2" name="image" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->
                                    <!--
                                    <div class="control-group">
                                        <label class="control-label ">Image Description</label>
                                        <div class="controls">
                                            <input class="span2" name="images[]" type="file" multiple="multiple" />
                                        </div>
                                    </div>   -->

                                    <div class="control-group">
                                        <label class="control-label">Mô tả <span
                                                style="color: red;">*</span></label>
                                        <div class="controls">
                                            <textarea id="textareaDescription" name="description" style="height: 150px;" class="span10 first">{!! old('description') !!}</textarea>
                                            @error('description')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('indexProduct') }}" class="btn btn-danger">Hủy</a>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                        </div> <!-- /widget-content -->
                    </div> <!-- /widget -->
                </div> <!-- /span8 -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div>
</div>
<!-- het main -->
@include ('admin.footer')
<!-- /footer -->
