@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Đơn đặt hàng
        <small><a href="{{ route('admin.order.index') }}">Danh sách</a></small>
    </h1>
</section>

{{-- <section class="content">
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

                <form role="form" action="{{ route('admin.order.update', ['id' => $order->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="box-body">

                        <div class="form-group">
                            <label>Mã đơn hàng</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Tên Tour</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Tên khách hàng</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Ghi chú</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Số lượng người lớn</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Số lượng trẻ em dưới 2 tuổi</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Số lượng trẻ em từ 2 đến dưới 5 tuổi</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Số lượng trẻ em từ 5 đến dưới 11 tuổi</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Ngày đi</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Ngày về</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Tổng tiền</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Giảm giá</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Mã giảm giá</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                        </div>

                        <div class="form-group">
                            <label>Tình trạng Tour</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
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
</section> --}}
@if (session('msg'))
    <div class="pad margin no-print">
        <div class="alert alert-success alert-dismissible" style="" id="thongbao">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo !</h4>
            {{ session('msg') }}
        </div>
    </div>
@endif
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('admin.order.update', ['id' => $order->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="box-header with-border">
                        <button type="submit" class="btn btn-info btn-flat">
                            <i class="fa fa-edit"></i>
                            Cập nhật
                        </button>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td><label for="">Mã ĐH :</label></td>
                                <td>{{ $order->code }}</td>
                                <td><label>Ngày Đặt Hàng:</label></td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <td><label for="">Họ tên :</label></td>
                                <td>{{ $order->user_name }}</td>
                                <td><label>Mã giảm giá</label></td>
                                <td>{{ $order->coupon }}</td>
                            </tr>
                            <tr>
                                <td><label>SĐT :</label> </td>
                                <td>{{ $order->user_phone }}</td>
                                <td><label>Khuyến mại</label></td>
                                <td>{{ number_format($order->discount) }} đ</td>
                                
                            </tr>
                            <tr>
                                <td><label>Email :</label></td>
                                <td>{{ $order->user_mail }}</td>
                                <td><label>Tạm tính</label></td>
                                <td style="color: #c0392b; font-weight: 700">{{ number_format($order->price) }}đ</td>
                            </tr>
                            <tr>
                                <td><label>Địa chỉ :</label> </td>
                                <td colspan="">{{ $order->user_address }}</td>
                                <td><label>Trạng thái ĐH</label></td>
                                <td style="color: red">
                                    <select class="form-control " name="order_status_id" style="max-width: 150px;display: inline-block;"
                                        @if ($order->order_status_id == 3 || $order->order_status_id == 4) 
                                            {{ 'disabled="disabled"' }}
                                        @endif
                                    >
                                        <option value="0">-- chọn --</option>
                                        @foreach($order_status as $status)
                                            <option {{ ($order->order_status_id == $status->id ? 'selected':'') }} value="{{ $status->id }}"> {{ $status->name }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                {{-- <td><label>Ngày khởi hành</label></td>
                                <td> {{date('d-m-Y', strtotime($order->end_date))}} </td> --}}
                                {{-- <td><label>Thành tiền</label></td>
                                <td style="color: red">{{ number_format($order->price - $order->discount) }} đ</td> --}}
                            </tr>
                            {{-- <tr>
                                <td><label>Tên tour: </label></td>
                                <td style="color: #2980b9">
                                    @foreach ($tour as $item)
                                        {{ ($item->id == $order->tour_id) ? " $item->name " : '' }}
                                    @endforeach
                                </td>
                                <td></td>
                                <td></td>
                            </tr> --}}
                            {{-- <tr>
                                
                                
                                <td><label>Ngày về</label></td>
                                <td> {{date('d-m-Y', strtotime($order->start_date))}} </td>
                            </tr> --}}
                            <tr>
                                <td><label>Ghi chú :</label> </td>
                                <td colspan="3">
                                    <div class="form-group">
                                        <textarea name="note" class="form-control" rows="3" placeholder="">{{ $order->user_note }}</textarea>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <!-- /.box -->
            <div class="box">

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        {{-- <tr>
                            <th style="">Tên Tour</th>
                            <th>Người lớn</th>
                            <th>Trẻ em 2 < tuổi</th>
                            <th>Trẻ em 2 - dưới 5 tuổi</th>
                            <th>Trẻ em 5 - dưới 11 tuổi</th>
                            <th>Ngày đi</th>
                            <th>Ngày về</th>
                            <th>Số lượng Visa</th>
                            <th>Thành tiền</th>
                            <th class="text-center"></th>
                        </tr> --}}
                        <tr>
                            <td><label>Tên Tour</label></td>
                            <td style="color: #2980b9; font-weight: 700; max-width: 200px">
                                @foreach ($tour as $item)
                                    {{ ($item->id == $order->tour_id) ? " $item->name " : '' }}
                                @endforeach
                            </td>
                            <td><label>Số lượng người lớn</label></td>
                            <td> {{ $order->adults_num }} </td>
                        </tr>
                        <tr>
                            <td><label>Ngày đi: </label>  </td>
                            <td>{{date('d-m-Y', strtotime($order->start_date))}}</td>
                            <td><label>Số lượng trẻ < 2 tuổi</label></td>
                            <td> {{ $order->child_1_2 }} </td>
                        </tr>
                        <tr>
                            <td><label>Ngày về: </label>  </td>
                            <td>{{date('d-m-Y', strtotime($order->end_date))}}</td>
                            <td><label>Số lượng trẻ từ 2 - dưới 5 tuổi</label></td>
                            <td> {{ $order->child_2_5 }} </td>
                        </tr>
                        <tr>
                            <td><label>Phương tiện vận chuyển</label></td>
                            <td>
                                @foreach ($tour as $item)
                                    @if ($item->id == $order->tour_id) 
                                        @foreach ($transport as $index)
                                            @if ($item->transport_id == $index->id)
                                                {{ $index->name }}
                                            @endif
                                        @endforeach
                                    @endif 
                                @endforeach
                            </td>
                            <td><label>Số lượng trẻ từ 5 - dưới 11 tuổi</label></td>
                            <td> {{ $order->child_5_11 }} </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><label>Số lượng Visa</label></td>
                            <td> {{ $order->visa_num }} </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><label>Tổng tiền: </label></td>
                            <td style="color: #c0392b; font-weight: 700">{{ number_format($order->price) }}đ</td>
                        </tr>
                        </tbody>
                        
                    </table>
                </div>
                <!-- /.box-body -->

            </div>

        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('ck_editor')
<script>
    CKEDITOR.replace('note');
    CKEDITOR.replace('introduce');
</script>
    
@endsection

