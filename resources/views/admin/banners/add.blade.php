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
                            <i class="icon-align-justify"></i>
                            <h3>THÊM QUẢNG CÁO</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('storeBanners') }}" method="post" id="edit-profile"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Tiêu đề <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="title"
                                                value="{!! old('title') !!}">
                                            @error('title')
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
                                            <input class="span3" id="image" name="imageUrl" type="file"
                                                value="{!! old('imageUrl') !!}" title="No Image" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Nội dung <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <textarea id="textareaDescription" name="content" style="height: 150px;" class="span10 first" value="">{!! old('content') !!}</textarea>
                                            @error('content')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('indexBanners') }}" class="btn btn-danger">Hủy</a>
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
