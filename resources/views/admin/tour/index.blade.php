@extends('admin.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Danh sách Danh Mục
        <small><a href="{{ route('admin.tour.create') }}">Thêm mới</a></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Lọc Tour</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class=""><a><i class="fa fa-map-marker-alt"></i>Địa điểm
                            <select name="" id="location" class="form-control">
                                <option value="">--Chọn--</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->slug }}" {{ ($location == $item->slug) ? 'selected' : '' }}> {{ $item->name }} </option>
                                @endforeach
                            </select>
                        </a></li>
                        <li class=""><a><i class="fa fa-ticket-alt"></i>Tình trạng chỗ 
                            <select name="" id="number" class="form-control">
                                <option value="">--Chọn--</option>
                                <option value="con-cho" {{ ($number == 'con-cho') ? 'selected' : '' }} >Còn chỗ</option>
                                {{-- <option value="gan-day">Gần đầy</option> --}}
                                <option value="het-cho" {{ ($number == 'het-cho') ? 'selected' : '' }}>Hết chỗ</option>
                            </select>
                        </a></li>
                        <li class=""><a><i class="fa fa-clock"></i>Thời gian
                            <select name="" id="time" class="form-control">
                                <option value="">--Chọn--</option>
                                <option value="kha-dung" {{ ($time == 'kha-dung') ? 'selected' : '' }} >Khả dụng</option>
                                <option value="khong-kha-dung" {{ ($time == 'khong-kha-dung') ? 'selected' : '' }} >Không khả dụng</option>
                            </select>
                        </a></li>
                        <li class=""><a><i class="fa fa-eye"></i>Trạng thái
                            <select name="" id="status" class="form-control">
                                <option value="">--Chọn--</option>
                                <option value="hien-thi" {{ ($status == 'hien-thi') ? 'selected' : '' }} >Hiển thị</option>
                                <option value="khong-hien-thi" {{ ($status == 'khong-hien-thi') ? 'selected' : '' }} >Không hiển thị</option>
                            </select>
                        </a></li>
                    </ul>
                </div>
                
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a><h4>Tổng số lượng Tour: <span class="badge bg-light-blue" style="margin-bottom: 3px">{{ $total_tour }}</span></h4></a>
                        </li>
                        <li>
                            <a> Số lượng Tour khả dụng: <span class="badge bg-green" style="margin-bottom: 3px">{{ $enable_tour }} </span> 
                            <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar progress-bar-success" style="width: {{ ($enable_tour/$total_tour)*100 }}%"></div>
                            </div></a>
                        </li>
                        <li>
                            <a> Số lượng Tour quá hạn: <span class="badge bg-yellow" style="margin-bottom: 3px">{{ $outdate_tour }} </span> 
                            <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar progress-bar-yellow" style="width: {{ ($outdate_tour/$total_tour)*100 }}%"></div>
                            </div></a>
                        </li>
                        <li>
                            <a> Số lượng Tour hết chỗ: <span class="badge bg-red" style="margin-bottom: 3px">{{ $outnumber_tour }} </span> 
                            <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar progress-bar-danger" style="width: {{ ($outnumber_tour/$total_tour)*100 }}%"></div>
                            </div></a>
                        </li>
                    </ul>
                    
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-solid">
                
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-9">
            <div class="box">
                <div class="box-header" style="display: flex; justify-content:">
                    <h3 class="box-title">Tours</h3>
                    <form class="box-tools" action="{{ (route('tour.search')) }}" method="GET">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <input type="text" name="search_name" class="form-control pull-right" placeholder="Name">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Thời gian</th>
                                <th>Địa điểm</th>
                                <th>Số chỗ</th>
                                <th>Trạng thái</th>
                                <th>Người tạo</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </tbody>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        @foreach($data as $key => $item)
                        <tr class="item-{{ $item->id }}">
                            <td>{{ $key + 1}}</td>
                            <td style="max-width: 300px">{{ $item->name }}</td>
                            <td>
                                @if ($item->image)
                                <img src="{{ asset($item->image) }}" width="50" height="50">
                                @endif
                            </td>
                            <td>
                                <span
                                    class="label label-{{ ($item->start_date > date('Y-m-d')) ? 'success' : 'warning' }}">
                                    {{ ($item->start_date > date('Y-m-d')) ? 'Khả dụng' : 'Quá hạn' }}</span>
                            </td>
                            <td>
                                @foreach ($categories as $key => $cate )
                                    {{ ($cate->id == $item->category_id) ? "$cate->name" : '' }}
                                @endforeach
                            </td>

                            <td>
                                @if ( $item->total_num - $item->member_num == 0 )
                                    <span class="label label-danger">{{ $item->member_num }} / {{ $item->total_num }}</span>
                                @elseif ( $item->total_num - $item->member_num < 3 ) <span class="label label-warning">
                                    {{ $item->member_num }} / {{ $item->total_num }}</span>
                                @else
                                    <span class="label label-info">{{ $item->member_num }} / {{ $item->total_num }}</span>
                                 @endif
                            </td>

                            <td>
                                <span
                                    class="label label-{{ ($item->is_active == 1) ? 'success' : 'danger' }}">{{ ($item->is_active == 1) ? 'Hiển thị' : 'Ẩn' }}</span>
                            </td>
                            <td>
                                {{  ($item->user->name) ?? '' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.tour.edit', ['id'=> $item->id]) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger"
                                    onclick="destroyModel('tour', '{{ $item->id }}')"><i class="fa fa-trash"></i>
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

@section('my_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        var pathname = window.location.pathname;
        var urlParams = new URLSearchParams(window.location.search);

        $(document).on('change', '#location', function() {
            var val = $(this).val();
            if (val == '') 
                urlParams.delete('diem-den');
            else
                urlParams.set('diem-den', val);
            // console.log(pathname + "?" +decodeURIComponent(urlParams.toString()));
            
            window.location.href = pathname + "?" +decodeURIComponent(urlParams.toString());
        });

        $(document).on('change', '#number', function() {
            var val = $(this).val();
            if (val == '') 
                urlParams.delete('tinh-trang-cho');
            else
                urlParams.set('tinh-trang-cho', val);
            window.location.href = pathname + "?" +decodeURIComponent(urlParams.toString());
        });

        $(document).on('change', '#time', function() {
            var val = $(this).val();
            if (val == '') 
                urlParams.delete('thoi-gian');
            else
                urlParams.set('thoi-gian', val);
            window.location.href = pathname + "?" +decodeURIComponent(urlParams.toString());
        });

        $(document).on('change', '#status', function() {
            var val = $(this).val();
            if (val == '') 
                urlParams.delete('trang-thai');
            else
                urlParams.set('trang-thai', val);
            window.location.href = pathname + "?" +decodeURIComponent(urlParams.toString());
        });

    </script>
@endsection
