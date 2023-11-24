@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        <div class="widget-header">
                            <i class="icon-bookmark"></i>
                            <h3>THÊM THƯƠNG HIỆU</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('storeBrand') }}" method="post" id="edit-profile"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Thương hiệu <span
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
                                        <label class="control-label">Link <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="link" class="span3" name="link"
                                                value="{!! old('link') !!}">
                                            @error('link')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
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
                                        <label class="control-label">Hiển thị</label>
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
                                        <label class="control-label">Hình ảnh</label>
                                        <div class="controls">
                                            <input class="span3" name="imageUrl" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('showBrand') }}" class="btn btn-danger">Hủy</a>
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
