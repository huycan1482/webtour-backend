@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Cấu hình
        {{-- <small><a href="{{ route('admin.category.index') }}">Danh sách</a></small> --}}
    </h1>
</section>

@if (session('msg'))
    <div class="pad margin no-print">
        <div class="alert alert-success alert-dismissible" style="" id="thongbao">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo !</h4>
            {{ session('msg') }}
        </div>
    </div>
@endif

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cấu hình</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form role="form" action="{{ route('admin.setting.update', ['id' => $data->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        @if ($errors->has('name'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ $data->name }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>

                        @if ($errors->has('company'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên công ty</label>
                            <input type="text" class="form-control" id="name" name="company" placeholder="Nhập tên" value="{{ $data->company }}">
                            <span class="help-block">{{ $errors->first('company') }}</span>
                        </div>

                        @if ($errors->has('new_image'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="" name="new_image">
                            @if ($data->image)
                                <img src="{{ asset($data->image) }}" width="200" alt="">
                            @endif
                            <span class="help-block">{{ $errors->first('new_image') }}</span>
                        </div>

                        @if ($errors->has('address'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ" value="{{ $data->address }}">
                            <span class="help-block">{{ $errors->first('address') }}</span>
                        </div>

                        @if ($errors->has('address2'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Địa chỉ 2</label>
                            <input type="text" class="form-control" name="address2" placeholder="Nhập địa chỉ 2" value="{{ $data->address }}">
                            <span class="help-block">{{ $errors->first('address2') }}</span>
                        </div>

                        @if ($errors->has('phone'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Điện thoại</label>
                            <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" value="{{ $data->phone }}">
                            <span class="help-block">{{ $errors->first('phone') }}</span>
                        </div>

                        @if ($errors->has('hotline'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Số điện thoại nóng</label>
                            <input type="text" class="form-control" name="hotline" placeholder="Nhập số điện thoại nóng" value="{{ $data->hotline }}">
                            <span class="help-block">{{ $errors->first('hotline') }}</span>
                        </div>

                        @if ($errors->has('tax'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tax</label>
                            <input type="text" class="form-control" name="tax" placeholder="Tax" value="{{ $data->tax }}">
                            <span class="help-block">{{ $errors->first('tax') }}</span>
                        </div>

                        @if ($errors->has('facebook'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Facebook</label>
                            <input type="text" class="form-control" name="facebook" placeholder="Facebook" value="{{ $data->facebook }}">
                            <span class="help-block">{{ $errors->first('facebook') }}</span>
                        </div>

                        @if ($errors->has('email'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $data->email }}">
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        </div>

                        @if ($errors->has('introduce'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="">Giới thiệu</label>
                            <textarea id="editor1" name="introduce" class="form-group rows=" 10">{{ $data->introduce }}</textarea>
                            <span class="help-block">{{ $errors->first('introduce') }}</span>
                        </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Sửa</button>
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
@section('ck_editor')

<script>
    // CKEDITOR.replace('description');
    CKEDITOR.replace('introduce');
</script>
    
@endsection