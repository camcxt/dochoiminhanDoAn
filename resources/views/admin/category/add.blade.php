@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-list-alt"></i>
                            <h3>THÊM DANH MỤC</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('addCategory') }}" method="post" id="addCategory"
                                class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Danh mục<span style="color: red;">
                                                *</span></label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="name" id="name"
                                                value="{!! old('name') !!}"> <br>
                                            @error('name')
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Ưu tiên<span style="color: red;">
                                                *</span></label>
                                        <div class="controls">
                                            <input type="text" class="span3" name="sortOrder" id="sortOrder"
                                                value="{!! old('sortOrder') !!}"> <br>
                                            @error('sortOrder')
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
<!-- het main -->

@include ('admin.footer')
<!-- /footer -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
