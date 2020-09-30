@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Thêm - Người dùng
        <small><a href="{{ route('admin.user.index') }}">Danh sách</a></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin danh mục</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form role="form" action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        @if ($errors->has('name'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ $user->name }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>

                        @if ($errors->has('email'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="eamil" placeholder="Nhập mail" value="{{ $user->email }}">
                            <span class="help-block">{{ $errors->first('mail') }}</span>
                        </div>

                        @if ($errors->has('password'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>**Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" value="">
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        </div>

                        @if ($errors->has('re_password'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>**Mật khẩu mới</label>
                            <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Nhập lại mật khẩu" value="">
                            <span class="help-block">{{ $errors->first('re_password') }}</span>
                        </div>

                        @if ($errors->has('avatar'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="" name="new_avatar">
                            @if ($user->avatar)
                                <img src="{{ asset($user->avatar) }}" width="200" alt="">
                            @endif
                            <span class="help-block">{{ $errors->first('avatar') }}</span>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_active" {{ ($user->is_active == 1) ? 'checked' : '' }}> Trạng thái hiển thị
                            </label>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->


        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
@endsection