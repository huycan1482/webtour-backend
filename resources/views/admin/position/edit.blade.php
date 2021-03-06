@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Vị trí xuất phát
        <small><a href="{{ route('admin.position.index') }}">Danh sách</a></small>
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

                <form role="form" action="{{ route('admin.position.update', ['id' => $position->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        @if ($errors->has('name'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{$position->name}}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_active" {{ ($position->is_active == 1) ? 'checked' : '' }}> Trạng thái hiển thị
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
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
@endsection