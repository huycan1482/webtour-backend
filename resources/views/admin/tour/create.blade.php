@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Thêm - Tour
        <small><a href="{{ route('admin.tour.index') }}">Danh sách</a></small>
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

                <form role="form" action="{{ route('admin.tour.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        @if ($errors->has('name'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên tour">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>


                        @if ($errors->has('category_id'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Địa điểm</label>
                            <select class="form-control" name="category_id">
                                <option value="0">-- chọn --</option>
                                @foreach ($categories as $item )
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('category_id') }}</span>
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


                        @if ($errors->has('start_date'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="">Ngày khởi hành</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" name="start_date"
                                    placeholder="MM/DD/YYYY">
                            </div>
                            <span class="help-block">{{ $errors->first('start_date') }}</span>
                        </div>


                        @if ($errors->has('end_date'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="">Ngày kết thúc</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" name="end_date"
                                    placeholder="MM/DD/YYYY">
                            </div>
                            <span class="help-block">{{ $errors->first('end_date') }}</span>
                        </div>


                        @if ($errors->has('schedule'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputPassword1">Lịch trình</label>
                            <textarea id="editor1" name="schedule" class="form-group rows=" 10"></textarea>
                            <span class="help-block">{{ $errors->first('schedule') }}</span>
                        </div>


                        @if ($errors->has('note'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <textarea id="editor" name="note" class="form-group rows=" 10"></textarea>
                            <span class="help-block">{{ $errors->first('note') }}</span>
                        </div>


                        @if ($errors->has('transport_id'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Phương tiện vận chuyển</label>
                            <select class="form-control" name="transport_id">
                                <option value="0">-- chọn --</option>
                                @foreach ($transports as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('transport_id') }}</span>
                        </div>


                        @if ($errors->has('starting_position'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Địa điểm xuất phát</label>
                            <select class="form-control" name="starting_position">
                                <option value="0">-- chọn --</option>
                                @foreach ($positions as $item)
                                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('starting_position') }}</span>
                        </div>

                        @if ($errors->has('total_num'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Số lượng người của tour</label>
                            <input type="number" class="form-control" name="total_num" placeholder="Số lượng người"
                                min="0">
                            <span class="help-block">{{ $errors->first('total_num') }}</span>
                        </div>

                        @if ($errors->has('member_num'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Số lượng người đã đặt tour</label>
                            <input type="number" class="form-control" name="member_num" placeholder="Số lượng người đã đặt"
                                min="0">
                            <span class="help-block">{{ $errors->first('member_num') }}</span>
                        </div>

                        @if ($errors->has('price'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá</label>
                            <input type="number" class="form-control" name="price" placeholder="Giá" min="0">
                            <span class="help-block">{{ $errors->first('price') }}</span>
                        </div>

                        @if ($errors->has('price_1_2'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá cho trẻ dưới 2 tuổi</label>
                            <input type="number" class="form-control" name="price_1_2" placeholder="Giá" min="0">
                            <span class="help-block">{{ $errors->first('price_1_2 ') }}</span>
                        </div>

                        @if ($errors->has('price_2_5'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá cho trẻ từ 2 đến dưới 5 tuổi</label>
                            <input type="number" class="form-control" name="price_2_5" placeholder="Giá" min="0">
                            <span class="help-block">{{ $errors->first('price_2_5') }}</span>
                        </div>

                        @if ($errors->has('price_5_11'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá cho từ 5 đến dưới 11 tuổi</label>
                            <input type="number" class="form-control" name="price_5_11" placeholder="Giá" min="0">
                            <span class="help-block">{{ $errors->first('price_5_11') }}</span>
                        </div>

                        @if ($errors->has('visa_price'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá Visa nếu có</label>
                            <input type="number" class="form-control" name="visa_price" placeholder="Giá" min="0">
                            <span class="help-block">{{ $errors->first('visa_price') }}</span>
                        </div>


                        @if ($errors->has('discount'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giảm giá</label>
                            <input type="number" class="form-control" name="discount" placeholder="Giảm giá" min="0">
                            <span class="help-block">{{ $errors->first('discount') }}</span>
                        </div>


                        @if ($errors->has('position'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="">Vị trí</label>
                            <input type="number" class="form-control" id="position" name="position" value="0" min="0">
                            <span class="help-block">{{ $errors->first('position') }}</span>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_hot"> Tour Hot ?
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

@section('ck_editor')

<script>
    // CKEDITOR.replace('description');
    CKEDITOR.replace('schedule');
    CKEDITOR.replace('note');
</script>
    
@endsection