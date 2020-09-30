@extends('admin.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Danh sách Phương tiện
        <small><a href="{{ route('admin.transport.create') }}">Thêm mới</a></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
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
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>ID nhà cung cấp</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        <tbody>
                            @foreach ($data as $key =>$item)
                                <tr class="item-{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->image)
                                        <img src="{{ asset($item->image) }}" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $item->brand_id }}</td>
                                    <td>
                                        <span class="label label-{{ ($item->is_active == 1) ? 'success' : 'danger' }}">{{ ($item->is_active == 1) ? 'Hiển thị' : 'Ẩn' }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.transport.edit', ['id' => $item->id]) }}"class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="destroyModel('transport','{{ $item->id}}')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin">
                        {{ $data->links() }}
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection
