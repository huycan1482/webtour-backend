@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Thêm - Danh mục
        <small><a href="{{ route('admin.category.index') }}">Danh sách</a></small>
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

                <form role="form" action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        @if ($errors->has('name'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>

                        @if ($errors->has('image'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="image" name="image">
                            <span class="help-block">{{ $errors->first('image') }}</span>
                        </div>

                        @if ($errors->has('parent_id'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Danh mục cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">-- chọn --</option>
                                @foreach($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('parent_id') }}</span>
                        </div>

                        @if ($errors->has('position'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="">Vị trí hiển thị</label>
                            <input type="number" class="form-control" id="position" name="position" value="0" min="0">
                            <span class="help-block">{{ $errors->first('position') }}</span>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_hot"> Địa điểm Hot ?
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_active"> Trạng thái hiển thị
                            </label>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tạo</button>
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