@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Thêm - Thương Hiệu
        <small><a href="{{ route('admin.banner.index') }}">Danh Sách</a></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
    </ol>
</section>

<section class="content">
    <div class="row ">
        <!-- left column -->
        <div class="col-md-9 ">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề" name="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="exampleInputFile" name="image">
                        </div>
                        <div class="form-group">
                            <label for="url">Liên kết URL</label>
                            <input type="text" class="form-control" id="url" placeholder="URL" name="url">
                        </div>
                        <div class="form-group">
                            <label>Target</label>
                            <select class="form-control" name="target">
                                <option value="_blank">Mở tab mới</option>
                                <option value="_self">Trang hiện tại</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor1" name="description" class="form-group rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Loại Ảnh Bìa</label>
                            <select class="form-control" name="type">
                                <option value="1">Slide Home</option>
                                <option value="2">Banner Left </option>
                                <option value="3">Banner Right</option>
                                <option value="4">Banner Footer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Vị trí</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Website"
                                name="position" min="0" value="0">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_active" value="1"> Trạng thái
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->



        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection