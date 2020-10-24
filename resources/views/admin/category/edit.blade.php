@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Danh mục
        <small><a href="{{ route('admin.category.index') }}">Danh sách</a></small>
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

                <form role="form" action="{{(route('admin.category.update', ['id' => $category->id ])) }}" method="post" enctype="multipart/form-data">
                    {{-- @csrf --}}
                    {{-- @method('PUT') --}}
                    <div class="box-body">

                        <div class="form-group" id="form-name">
                            <label>Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ $category->name }}">
                        </div> 

                        <div class="form-group" id="form-new_image">
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" id="new_image" name="new_image">
                            @if ($category->image)
                                <img src="{{ asset($category->image) }}" width="200" alt="">
                            @endif
                        </div>


                        <div class="form-group" id="form-parent_id">
                            <label>Danh mục cha</label>
                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="0">-- chọn --</option>
                                @foreach($data as $item)
                                    <option value="{{ $item->id }}" {{ ($category->parent_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="form-position">
                            <label for="">Vị trí hiển thị</label>
                            <input type="number" class="form-control" id="position" name="position" min="0" value="{{$category->position}}">
                        </div>

                        <div class="checkbox form-group" id="form-is_hot">
                            <label>
                                <input type="checkbox" value="1" id="is_hot" name="is_hot" {{ ($category->is_hot == 1) ? 'checked' : '' }} > Địa điểm Hot ?
                            </label>
                        </div>

                        <div class="checkbox form-group" id="form-is_active">
                            <label>
                                <input type="checkbox" value="1" id="is_active" name="is_active" {{ ($category->is_active == 1) ? 'checked' : '' }}> Trạng thái hiển thị
                            </label>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a class="btn btn-primary" onclick="editCate({{ $category->id }})">Sửa</a>
                        {{-- <button type="submit" class="btn btn-primary">Sửa</button> --}}
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

@section('my_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function editCate(id) {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            var name = document.getElementById('name').value;
            var image = document.getElementById('new_image').value;
            var parent_id = document.getElementById('parent_id').value;
            var position = document.getElementById('position').value;
            var is_hot = document.getElementById('is_hot').value;
            var is_active = document.getElementById('is_active').value; 
            var data;
            data = new FormData();
            if (image) {
                data.append( 'new_image', $( '#new_image' )[0].files[0] );
            }
            data.append('_method', 'PUT');
            data.append( 'name', name);
            data.append('parent_id', parent_id);
            data.append('position', position);
            data.append('is_hot', is_hot);
            data.append('is_active', is_active);

            $.ajax({
                type: "POST",
                url: base_url + '/admin/category/' + id,
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

                        if(response.error.new_image) {
                            $('.sp-new_image').remove();
                            error = response.error.image[0];
                            $('#form-new_image').addClass('has-error');
                            $('#form-new_image').append("<span class='help-block sp-new_image sp-error'>"+ error +"</span>");
                        } else {
                            $('#form-new_image').removeClass('has-error');
                            $('.sp-new_image').remove();
                        }

                        if(response.error.parent_id) {
                            $('.sp-parent_id').remove();
                            error = response.error.parent_id[0];
                            $('#form-parent_id').append("<span class='help-block sp-parent_id sp-error'>"+ error +"</span>");
                            $('#form-parent_id').addClass('has-error');
                        } else {
                            $('#form-parent_id').removeClass('has-error');
                            $('.sp-parent_id').remove();
                        }

                        if(response.error.is_hot) {
                            $('.sp-is_hot').remove();
                            error = response.error.is_hot[0];
                            $('#form-is_hot').append("<span class='help-block sp-is_hot sp-error'>"+ error +"</span>");
                            $('#form-is_hot').addClass('has-error');
                        } else {
                            $('#form-is_hot').removeClass('has-error');
                            $('.sp-is_hot').remove();
                        }

                        if(response.error.is_active) {
                            $('.sp-is_active').remove();
                            error = response.error.is_active[0];
                            $('#form-is_active').append("<span class='help-block sp-is_active sp-error'>"+ error +"</span>");
                            $('#form-is_active').addClass('has-error');
                        } else {
                            $('#form-is_active').removeClass('has-error');
                            $('.sp-is_active').remove();
                        }
                    }

                    else {
                        $('.sp-error').remove();
                        $('.form-group').removeClass('has-error');

                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        
                        var succ = "<div class='pad margin no-print' id='thongbao'><div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Thông báo !</h4>"+ response.success +"</div></div>"
                        if ( $('#thongbao') ) {
                            $('#thongbao').remove();
                        }

                        $('.content-header').after(succ);
                    }
                }
            });

            
        }
        
    </script>
@endsection