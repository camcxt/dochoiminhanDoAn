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
                            <i class="fas fa-user"></i> 
                            <h3>SỬA TÀI KHOẢN</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <form action="{{ route('updateUser', $staff->id) }}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label">Tên tài khoản <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input type="text" class="span3" name="name" value="{!! old('name') !!}">
                                            @else
                                                <input type="text" class="span3" name="name" value="{{ $staff->username }}">
                                            @endif

                                            @error ('name')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Số điện thoại <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                                <input type="text" class="span3" name="phone" value="{!! old('phone') !!}">
                                            @else
                                                <input type="text" class="span3" name="phone" value="{{ $staff->phone }}">
                                            @endif
                                            
                                            @error ('phone')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Email <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input type="text" class="span3" name="email" value="{!! old('email') !!}">
                                            @else
                                                <input type="text" class="span3" name="email" value="{{ $staff->email }}">
                                            @endif
                                            
                                            @error ('email')
                                                <br>
                                                <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <a href="{{ route('indexUser') }}" class="btn btn-danger">Hủy</a>
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