@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-list-alt"></i>
                            <h3>SỬA DANH MỤC</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('updateCate', $category->id) }}" method="post" id="edit-profile"
                                class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Danh mục<span style="color: red;">
                                                *</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input class="span3" name="name" value="{!! old('name') !!}"
                                                    type="text" />
                                            @else
                                                <input type="text" class="span3" name="name"
                                                    value="{{ $category->name }}">
                                            @endif
                                            @error('name')
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
                                                    value="{{ $category->sort_order }}">
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
                                                @elseif ($category->active == 0)
                                                    <option value="0" selected>No</option>
                                                    <option value="1">Yes</option>
                                                @else
                                                    <option value="0">No</option>
                                                    <option value="1" selected>Yes</option>
                                                @endif
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    @if ($errors->any())
                                        <div class="alert alert-primary text-center">
                                            @foreach ($errors->all() as $errors)
                                                <p>{{ $errors }}</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('showCate') }}" class="btn btn-danger">Hủy</a>
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
