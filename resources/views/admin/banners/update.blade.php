@include ('admin.index')
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-align-justify"></i>
                            <h3>SỬA QUẢNG CÁO</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('updateBanners', $banner->id) }}" enctype="multipart/form-data"
                                method="post" id="edit-profile" class="form-horizontal">
                                @csrf

                                <fieldset>
                                    <div class="control-group">
                                        <label class="control-label">Tiêu đề <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input class="span3" name="title" value="{!! old('title') !!}"
                                                    type="text" />
                                            @else
                                                <input type="text" class="span3" name="title"
                                                    value="{{ $banner->title }}">
                                            @endif
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
                                            @if ($errors->any())
                                                <input class="span3" name="sortOrder" value="{!! old('sortOrder') !!}"
                                                    type="text" />
                                            @else
                                                <input type="text" class="span3" name="sortOrder"
                                                    value="{{ $banner->sort_order }}">
                                            @endif
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
                                                @elseif ($banner->active == 0)
                                                    <option value="0" selected>No</option>
                                                    <option value="1">Yes</option>
                                                @else
                                                    <option value="0">No</option>
                                                    <option value="1" selected>Yes</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Hình ảnh</label>
                                        <div class="controls">
                                            <input type="hidden" name="imageOld" value="{{ $banner->image_url }}">
                                            <input value="" class="" name="image" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <div class="controls">
                                            <img width="100px" src="../images/{{ $banner->image_url }}" alt="">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Nội dung<span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <textarea id="textareaDescription" name="content" style="height: 150px;" class="span10 first">{!! old('content') !!}</textarea>
                                            @else
                                                <textarea id="textareaDescription" name="content" style="height: 150px;" class="span10 first">{{ $banner->content }}</textarea>
                                            @endif
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
@include ('admin.footer')
<!-- /footer -->
