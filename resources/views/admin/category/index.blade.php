@extends('admin.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Danh sách Danh Mục
        <small><a href="{{ route('admin.category.create') }}">Thêm mới</a></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header ">
                    <h3 class="box-title"></h3>

                    <form class="box-tools" action="{{  route('category.search') }}" method="GET">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="search_name" class="form-control pull-right" placeholder="Name">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="dataTables_length">
                        <label>

                            "check"
                            <select name="" id="" class="form-control">
                                <option value="">1</option>
                                <option value="">1</option>
                            </select>
                        </label>
                    </div> --}}
                    

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table-hover table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <tbody>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Danh mục cha</th>
                                <th>Vị trí hiển thị</th>
                                <th>Trạng thái</th>
                                <th>Người tạo</th>
                                <th class="text-center">Hành động</th>

                            </tr>
                        </tbody>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        @foreach($data as $key => $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $key + 1}}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if ($item->image)
                                <img src="{{ asset($item->image) }}" width="50" height="50">
                                @endif
                            </td>
                            <td>
                                @foreach ($categories as $cates)
                                @if ($cates->id == $item->parent_id)
                                {{$cates->name}}
                                @break
                                @endif
                                @endforeach
                            </td>
                            <td>{{ $item->position }}</td>
                            <td>
                                <span
                                    class="label label-{{ ($item->is_active == 1) ? 'success' : 'danger' }}">{{ ($item->is_active == 1) ? 'Hiển thị' : 'Ẩn' }}</span>
                            </td>
                            <td>
                                {{  ($item->user->name) ?? '' }}  
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.category.edit', ['id'=> $item->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger"
                                    onclick="destroyModel('category', '{{ $item->id }}' )"><i class="fa fa-trash"></i>
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
                        {{-- <ul class="pagination" role="navigation">

                            <li class="page-item">
                                <a class="page-link" href="http://tour.local:8080/admin/category?page=2" rel="prev"
                                    aria-label="&laquo; Previous">&lsaquo;</a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                    href="http://tour.local:8080/admin/category?page=1">1</a></li> 
                            <li class="page-item"><a class="page-link"
                                    href="http://tour.local:8080/admin/category?page=2">2</a></li> 
                            <li class="page-item active" aria-current="page"><span class="page-link">3</span></li> 
                            <li class="page-item disabled" aria-disabled="true" aria-label="Next &raquo;">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>
                        </ul> --}}
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection
