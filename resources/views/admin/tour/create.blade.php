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
                    {{-- @csrf --}}

                    {{-- {{ dd(csrf_field()) }} --}}
                    <div class="box-body">

                        <div class="form-group" id="form-name">
                            <label>Tên</label>  
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên tour"> 
                        </div>

                        <div class="form-group" id="form-category_id">
                            <label>Địa điểm</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="0">-- chọn --</option>
                                @foreach ($categories as $item )
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group" id="form-image">
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="image" name="image">
                        </div>

                        {{-- <div id="ckfinder1" name="image">
                        
                        </div> --}}


                        <div class="form-group" id="form-start_date">
                            <label for="">Ngày khởi hành</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="start_date" name="start_date"
                                    placeholder="DD-MM-YYYY">
                            </div>
                        </div>

                        <div class="form-group" id="form-end_date">
                            <label for="">Ngày kết thúc</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="end_date" name="end_date"
                                    placeholder="DD-MM-YYYY">
                            </div>
                        </div>

                        <div class="form-group" id="form-schedule">
                            <label for="exampleInputPassword1">Lịch trình</label>
                            <textarea id="schedule" name="schedule" class="form-group"></textarea>
                        </div>

                        <div class="form-group" id="form-note">
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <textarea id="note" name="note" class="form-group rows=" 10" ></textarea>
                        </div>

                        <div class="form-group" id="form-transport_id">
                            <label>Phương tiện vận chuyển</label>
                            <select class="form-control" id="transport_id" name="transport_id">
                                <option value="0">-- chọn --</option>
                                @foreach ($transports as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group" id="form-starting_position">
                            <label>Địa điểm xuất phát</label>
                            <select class="form-control" id="starting_position" name="starting_position">
                                <option value="0">-- chọn --</option>
                                @foreach ($positions as $item)
                                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="form-total_num">
                            <label>Số lượng người của tour</label>
                            <input type="number" id="total_num" class="form-control" name="total_num" placeholder="Số lượng người"
                                min="0" >
                        </div>

                        <div class="form-group" id="form-member_num">
                            <label>Số lượng người đã đặt tour</label>
                            <input type="number" class="form-control" id="member_num" name="member_num" placeholder="Số lượng người đã đặt" min="0">
                        </div>

                        <div class="form-group" id="form-price">
                            <label>Giá</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Giá" min="0">
                        </div>

                        <div class="form-group" id="form-price_1_2">
                            <label>Giá cho trẻ dưới 2 tuổi</label>
                            <input type="number" class="form-control" id="price_1_2" name="price_1_2" placeholder="Giá" min="0" >
                        </div>

                        <div class="form-group" id="form-price_2_5">
                            <label>Giá cho trẻ từ 2 đến dưới 5 tuổi</label>
                            <input type="number" class="form-control" id="price_2_5" name="price_2_5" placeholder="Giá" min="0"> 
                        </div>

                        <div class="form-group" id="form-price_5_11">
                            <label>Giá cho từ 5 đến dưới 11 tuổi</label>
                            <input type="number" class="form-control" id="price_5_11" name="price_5_11" placeholder="Giá" min="0">
                        </div>

                        <div class="form-group" id="form-visa_price">
                            <label>Giá Visa nếu có</label>
                            <input type="number" class="form-control" id="visa_price" name="visa_price" placeholder="Giá" min="0">
                        </div>

                        <div class="form-group" id="form-number">
                            <label>Giảm giá</label>
                            <input type="number" class="form-control" id="discount" name="discount" placeholder="Giảm giá" min="0">
                        </div>

                        <div class="form-group" id="form-position">
                            <label for="">Vị trí</label>
                            <input type="number" class="form-control" id="position" name="position" min="0" placeholder="Vị trí hiển thị">
                        </div>

                        <div class="form-group" id="form-is_hot">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="is_hot" name="is_hot"> Tour Hot ?
                                </label>
                            </div>
                        </div>

                        <div class="form-group" id="form-is_active">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="is_active" name="is_active"> Trạng thái hiển thị?
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a class="btn btn-primary" onclick="addTour()">Add</a>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        {{-- <button>taoj</button> --}}
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

{{-- @section('ck_finder')
<script>
    CKFinder.widget( 'ckfinder1', {
        
    } );
</script>
@endsection --}}

@section('ck_editor')
<script>
        CKEDITOR.replace('schedule');
        CKEDITOR.replace('note');
</script> 
@endsection

@section('my_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        
        $(function() {
            //Date picker
            $('.datepicker').datepicker({
                // autoclose: false,
                format: 'dd-mm-yyyy',
                forceParse: false,
            })
        });
        
        function addTour() {
            var name = document.querySelector('#name').value;
            var category_id = document.querySelector('#category_id').value;
            var image = document.querySelector('#image').value;
            var start_date = document.querySelector('#start_date').value;
            var end_date = document.querySelector('#end_date').value;
            var schedule = CKEDITOR.instances.schedule.getData();
            var note = CKEDITOR.instances.note.getData();
            var transport_id = document.querySelector('#transport_id').value;
            var starting_position = document.querySelector('#starting_position').value;
            var total_num = document.querySelector('#total_num').value;
            var member_num = document.querySelector('#member_num').value;
            var price = document.querySelector('#price').value;
            var price_1_2 = document.querySelector('#price_1_2').value;
            var price_2_5 = document.querySelector('#price_2_5').value;
            var price_5_11 = document.querySelector('#price_5_11').value;
            var visa_price = document.querySelector('#visa_price').value;
            var discount = document.querySelector('#discount').value;
            var position = document.querySelector('#position').value;
            var is_hot = document.querySelector('#is_hot').value;
            var is_active = document.querySelector('#is_active').value;
            // console.log(name);
            var data;
            data = new FormData();
            data.append('name', name);
            data.append('category_id', category_id);
            data.append('image', $( '#image' )[0].files[0] );
            data.append('start_date', start_date);
            data.append('end_date', end_date);
            data.append('schedule', schedule);
            data.append('note', note);
            data.append('transport_id', transport_id);
            data.append('starting_position', starting_position);
            data.append('total_num', total_num);
            data.append('member_num', member_num);
            data.append('price', price);
            data.append('price_1_2', price_1_2);
            data.append('price_2_5', price_2_5);
            data.append('price_5_11', price_5_11);
            data.append('visa_price', visa_price);
            data.append('discount', discount);
            data.append('position', position);
            data.append('is_hot', is_hot);
            data.append('is_active', is_active);

            // console.log(CKEDITOR.instances.schedule.getData());

            $.ajax({
                type: "POST",
                url: base_url + '/admin/tour',
                data: data,
                // dataType : "formData",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.error) {
                        if(response.error.name) {
                            $('.sp-name').remove();
                            error = response.error.name[0];
                            $('#form-name').addClass('has-error');
                            $('#form-name').append("<span class='help-block sp-name sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-name').removeClass('has-error');
                            $('.sp-name').remove();
                        }

                        if(response.error.category_id) {
                            $('.sp-category_id').remove();
                            error = response.error.category_id[0];
                            $('#form-category_id').addClass('has-error');
                            $('#form-category_id').append("<span class='help-block sp-category_id sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-category_id').removeClass('has-error');
                            $('.sp-category_id').remove();
                        }

                        if(response.error.image) {
                            $('.sp-image').remove();
                            error = response.error.image[0];
                            $('#form-image').addClass('has-error');
                            $('#form-image').append("<span class='help-block sp-image sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-image').removeClass('has-error');
                            $('.sp-image').remove();
                        }

                        if(response.error.start_date) {
                            $('.sp-start_date').remove();
                            error = response.error.start_date[0];
                            $('#form-start_date').addClass('has-error');
                            $('#form-start_date').append("<span class='help-block sp-start_date sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-start_date').removeClass('has-error');
                            $('.sp-start_date').remove();
                        }

                        if(response.error.end_date) {
                            $('.sp-end_date').remove();
                            error = response.error.end_date[0];
                            $('#form-end_date').addClass('has-error');
                            $('#form-end_date').append("<span class='help-block sp-end_date sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-end_date').removeClass('has-error');
                            $('.sp-end_date').remove();
                        }

                        if(response.error.schedule) {
                            $('.sp-schedule').remove();
                            error = response.error.schedule[0];
                            $('#form-schedule').addClass('has-error');
                            $('#form-schedule').append("<span class='help-block sp-schedule sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-schedule').removeClass('has-error');
                            $('.sp-schedule').remove();
                        }

                        if(response.error.note) {
                            $('.sp-note').remove();
                            error = response.error.note[0];
                            $('#form-note').addClass('has-error');
                            $('#form-note').append("<span class='help-block sp-note sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-note').removeClass('has-error');
                            $('.sp-note').remove();
                        }

                        if(response.error.transport_id) {
                            $('.sp-transport_id').remove();
                            error = response.error.transport_id[0];
                            $('#form-transport_id').addClass('has-error');
                            $('#form-transport_id').append("<span class='help-block sp-transport_id sp-error'>"+ error +"</span>"); 
                        } else {
                            $('#form-transport_id').removeClass('has-error');
                            $('.sp-transport_id').remove();
                        }

                    }


                }


            }


        }

                    }
                }
            });
        }
    </script>
@endsection