@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Phương tiện
        <small><a href="{{ route('admin.transport.index') }}">Danh sách</a></small>
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

                <form role="form" action="{{ route('admin.transport.update', ['id' => $transport->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        @if ($errors->has('name'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên phương tiện</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ $transport->name }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>

                        @if ($errors->has('new_image'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="image" name="image" >
                            @if ($transport->image)
                                <img src="{{asset($transport->image)}}" alt="" width="200">
                            @endif
                            <span class="help-block">{{ $errors->first('new_image') }}</span>
                        </div>

                        @if ($errors->has('brand_id'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>ID Nhà cung cấp</label>
                            <input type="number" class="form-control" id="" name="brand_id" value="{{$transport->brand_id}}" min="0">
                            <span class="help-block">{{ $errors->first('brand_id') }}</span>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_active" {{($transport->is_active == '1') ? 'checked' : '' }}> Trạng thái hiển thị
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