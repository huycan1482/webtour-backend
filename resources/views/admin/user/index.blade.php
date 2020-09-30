@extends('admin.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Danh sách Danh Mục
        <small><a href="{{ route('admin.user.create') }}">Thêm mới</a></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header ">
                    <h3 class="box-title"></h3>

                    {{-- <form class="box-tools" action="{{ (route('admin.category.search')) }}" method="GET">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="search_name" class="form-control pull-right" placeholder="Name">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form> --}}

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table-hover table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <tbody>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Avatar</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Hành động</th>

                            </tr>
                        </tbody>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        @foreach($data as $key => $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $key + 1}}</td>
                            <td>{{ $item->name }}</td>
                            <td> {{ $item->email }} </td>
                            <td>
                                @if ($item->avatar)
                                    <img src="{{ asset($item->avatar) }}" width="50" height="50">
                                @endif
                            </td>
                            
                            <td>
                                <span
                                    class="label label-{{ ($item->is_active == 1) ? 'success' : 'danger' }}">{{ ($item->is_active == 1) ? 'Kích hoạt' : 'Ẩn' }}</span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.user.edit', ['id'=> $item->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger"
                                    onclick="destroyModel('user', '{{ $item->id }}' )"><i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
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
