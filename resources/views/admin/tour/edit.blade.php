@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Tour
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

                <form role="form" action="{{ route('admin.tour.update', ['id' => $tour->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="box-body">
                        @if ($errors->has('name'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên tour" value="{{(old('name')) ? old('name') : $tour->name }}">
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        </div>


                        @if ($errors->has('category_id'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Địa điểm</label>
                            <select class="form-control" name="category_id">
                                <option value="">-- Chọn --</option>
                                @foreach ($categories as $item)
                                    <option value=" {{ $item->id }} " {{  ($tour->category_id == $item->id) ? 'selected' : '' }}> {{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('category_id') }}</span>
                        </div>

                        

                        @if ($errors->has('new_image'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputFile">Ảnh đại diện</label>
                            <input type="file" name="new_image">
                            @if ($tour->image)
                                <img src="{{ asset($tour->image) }}" width="200" alt="">
                            @endif
                            <span class="help-block">{{ $errors->first('new_image') }}</span>
                        </div>


                        <div>
                            <div><label>Ảnh giới thiệu</label></div>
                            @foreach ($images as $item)
                                <img src="{{ asset($item->image) }}" width="190" alt="">
                            @endforeach  
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
                                    placeholder="DD/MM/YYYY" value=" {{(old('start_date')) ? old('start_date') : date_format(date_create($tour->start_date), 'd-m-Y')}} ">
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
                                    placeholder="DD/MM/YYYY" value=" {{(old('end_date')) ? old('end_date') : date_format(date_create($tour->end_date), 'd-m-Y')}} ">
                            </div>
                            <span class="help-block">{{ $errors->first('end_date') }}</span>
                        </div>


                        @if ($errors->has('schedule'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputPassword1">Lịch trình</label>
                            <textarea id="editor1" name="schedule" class="form-group rows=" 10">{{(old('schedule')) ? old('schedule') : $tour->schedule }}</textarea>
                            <span class="help-block">{{ $errors->first('schedule') }}</span>
                        </div>


                        @if ($errors->has('note'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <textarea id="editor" name="note" class="form-group rows=" 10">{{(old('note')) ? old('note') : $tour->note }}</textarea>
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
                                    <option value="{{ $item->id }}" {{($tour->transport_id == $item->id) ? 'selected' : ''}}>{{ $item->name }}</option>
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
                                    <option value="{{ $item->id }}" {{ ($tour->starting_position_id == $item->id) ? 'selected' : ''}} >{{ $item->name}}</option>
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
                                min="0" value="{{(old('total_num')) ? old('total_num') : $tour->total_num  }}">
                            <span class="help-block">{{ $errors->first('total_num') }}</span>
                        </div>

                        @if ($errors->has('member_num'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Số lượng người đã đặt Tour</label>
                            <input type="number" class="form-control" name="member_num" placeholder="Số lượng người đã đặt Tour"
                                min="0" value="{{(old('member_num')) ? old('member_num') : $tour->member_num }}">
                            <span class="help-block">{{ $errors->first('member_num') }}</span>
                        </div>

                        @if ($errors->has('price'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá</label>
                            <input type="number" class="form-control" name="price" placeholder="Giá" min="0" value="{{(old('price')) ? old('price') : $tour->price }}">
                            <span class="help-block">{{ $errors->first('price') }}</span>
                        </div>

                        @if ($errors->has('price_1_2'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá cho trẻ dưới 2 tuổi</label>
                            <input type="number" class="form-control" name="price_1_2" placeholder="Giá" min="0" value="{{(old('price_1_2')) ? old('price_1_2') : $tour->price_1_2}}">
                            <span class="help-block">{{ $errors->first('price_1_2 ') }}</span>
                        </div>

                        @if ($errors->has('price_2_5'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá cho trẻ từ 2 đến dưới 5 tuổi</label>
                            <input type="number" class="form-control" name="price_2_5" placeholder="Giá" min="0" value="{{(old('price_2_5')) ? old('price_2_5') : $tour->price_2_5 }}">
                            <span class="help-block">{{ $errors->first('price_2_5') }}</span>
                        </div>

                        @if ($errors->has('price_5_11'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá cho từ 5 đến dưới 11 tuổi</label>
                            <input type="number" class="form-control" name="price_5_11" placeholder="Giá" min="0" value="{{(old('price_5_11')) ? old('price_5_11') : $tour->price_5_11}}">
                            <span class="help-block">{{ $errors->first('price_5_11') }}</span>
                        </div>

                        @if ($errors->has('visa_price'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giá Visa nếu có</label>
                            <input type="number" class="form-control" name="visa_price" placeholder="Giá" min="0" value="{{(old('visa_price')) ? old('visa_price') : $tour->visa_price }}">
                            <span class="help-block">{{ $errors->first('visa_price') }}</span>
                        </div>

                        
                        @if ($errors->has('discount'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label>Giảm giá</label>
                            <input type="number" class="form-control" name="discount" placeholder="Giảm giá" min="0" value="{{(old('discount')) ? old('discount') : $tour->discount}}"> 
                            <span class="help-block">{{ $errors->first('discount') }}</span>
                        </div>


                        @if ($errors->has('position'))
                            <div class="form-group has-error">
                        @else
                            <div class="form-group">
                        @endif
                            <label for="">Vị trí</label>
                            <input type="number" class="form-control"  name="position" value="{{(old('position')) ? old('position') : $tour->position }}">
                            <span class="help-block">{{ $errors->first('position') }}</span>
                        </div>

                        <div class="checkbox">
                            <label>          
                                <input type="checkbox" value="1" name="is_hot" {{($tour->is_hot == '1') ? 'checked' : ''}}> Tour Hot ?
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_active" {{($tour->is_active == '1') ? 'checked' : '' }} > Trạng thái hiển thị
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
@section('ck_editor')

<script>
    // CKEDITOR.replace('description');
    CKEDITOR.replace('schedule');
    CKEDITOR.replace('note');

</script>
    
@endsection