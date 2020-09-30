@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Ảnh Bìa
        <small><a href="{{route('admin.banner.create')}}">Thêm mới</a></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header" style="height: 40px">
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Hình ảnh</th>
                                <th>URL</th>
                                <th>Target</th>
                                <th>Mô tả</th>
                                <th>Loại</th>
                                <th>Vị trí</th>
                                <th>Hiển thị</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </tbody>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        @foreach($data as $key => $item)
                        <tr class="item-{{ $item->id }}">
                            <!-- Thêm Class Cho Dòng -->
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if ($item->image)
                                <!-- Kiểm tra hình ảnh tồn tại -->
                                <img src="{{asset($item->image)}}" width="50" height="50">
                                @endif
                            </td>
                            <td>{{ $item->url }}</td>
                            <td>{{ $item->target }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->position }}</td>
                            <td>
                                <span class="label label-{{ ($item->is_active == 1) ? 'success' : 'danger' }}">{{ ($item->is_active == 1) ? 'Hiển thị' : 'Ẩn' }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{route('admin.banner.edit', ['id'=> $item->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                <!-- Thêm sự kiện onlick cho nút xóa -->
                                <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{ $data->links() }}
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>

<!-- /.content -->
@endsection