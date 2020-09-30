@extends('admin.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Danh sách Đơn đặt hàng
        {{-- <small><a href="{{ route('admin.category.create') }}">Thêm mới</a></small> --}}
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header ">
                    <h3 class="box-title"></h3>

                    {{-- <form class="box-tools" action="{{ (route('admin.tour.search')) }}" method="GET">
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
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>STT</th>
                                <th>Ngày</th>
                                <th>Mã ĐH</th>
                                <th>Trạng thái</th>
                                <th>Tên</th>
                                <th>Email</th>  
                                <th>SĐT</th>
                                <th>Tổng tiền</th>
                                <th class="text-center">Hành động</th>

                            </tr>
                        </tbody>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        @foreach($data as $key => $item)
                        <tr class="item-{{ $item->id }}">
                            <td> {{ $key + 1}} </td>
                            <td> {{ $item->created_at }} </td>
                            <td> {{ $item->code }} </td>
                            <td>

                                @if ( $item->order_status_id == 1 )           
                                    <span class="label label-info">Mới</span>
                                @elseif ( $item->order_status_id == 2 )
                                    <span class="label label-warning">Đang xử lí</span>
                                @elseif ( $item->order_status_id == 3 )
                                    <span class="label label-success">Hoàn thành</span>
                                @else
                                    <span class="label label-danger">Hủy</span>
                                @endif
                                
                            </td>
                            <td> {{ $item->user_name }} </td>
                            <td> {{ $item->user_mail }} </td>
                            <td> {{ $item->user_phone }} </td>
                            <td> {{ $item->price }} </td>
                            <td class="text-center">
                                <a href="{{ route('admin.order.edit', ['id'=> $item->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger"
                                    onclick="destroyModel('order', '{{ $item->id }}' )"><i class="fa fa-trash"></i>
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
