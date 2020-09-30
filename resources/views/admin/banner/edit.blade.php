@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Thương Hiệu
        <small><a href="{{ route('admin.banner.index') }}">Danh sách</a></small>
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
                            <input type="text" class="form-control" id="title" placeholder="{{ $banner->title }}" name="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="exampleInputFile" name="image">
                            @if ($banner->image)
                                <img src="{{ asset($banner->image) }}" alt="" width="200px"
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="url">Liên kết URL</label>
                            <input type="text" class="form-control" id="url" placeholder="{{ $banner->url }}" name="url">
                        </div>
                        <!--  -->
                        <div class="form-group">
                            <label>Target</label>
                            <select class="form-control" name="target">
                            <!-- @foreach ($data as $item)
                                <option value="{{ $item->target }}" {{ ($item->target == $banner->target) ? 'selected' : '' }} ></option>
                            @endforeach -->
                                <option value="_blank" {{ ($banner->target == '_blank' || $banner->target == '0') ? 'selected' : '' }}>Mở tab mới</option>
                                <option value="_self" {{ ($banner->target == '_self' || $banner->target == '1' ) ? 'selected' : '' }} >Trang hiện tại</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor1" name="description" class="form-group rows="10">{{ $banner->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Loại Banner</label>
                            <select class="form-control" name="type">
                            <!-- @foreach ($data as $item)
                                <option {{ ($banner->type == $item->type) ? 'selected' : '' }} value="{{ $item->type }}"  >
                                    {{ ($item->type == 1) ? 'Slide Home' : '' }}
                                    {{ ($item->type == 2) ? 'Banner Left' : '' }}
                                    {{ ($item->type == 3) ? 'Banner Right' : '' }}
                                    {{ ($item->type == 4) ? 'Banner Footer' : '' }}
                                </option>
                            @endforeach -->
                                <option value="1" {{ ($banner->type == 1) ? 'selected' : '' }}>Slide Home</option>
                                <option value="2" {{ ($banner->type == 2) ? 'selected' : '' }}>Banner Left</option>
                                <option value="3" {{ ($banner->type == 3) ? 'selected' : '' }}>Banner Right</option>
                                <option value="4" {{ ($banner->type == 4) ? 'selected' : '' }}>Banner Footer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Vị trí</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Website"
                                name="position" min="0" value="{{ $banner->position }}">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" type="is_active" value="1" {{ ($banner->is_active == 1) ? 'checked' : '' }}>Trạng thái
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Sửa</button>
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