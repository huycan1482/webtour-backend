@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Banner
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
            Add new Role
        </button> <br> <br>
    </h1>
</section>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form action="" method=""> -->
                <h2>Add Modal</h2>
                <div class="form-group">
                    <label for="">Name: </label>
                    <input type="text" name="name" id="createName" class="form-control" placeholder=""
                        aria-describedby="helpId">
                    <small id="helpId" class="text-muted"></small>
                </div>
                <button type="button" class="btn btn-primary" id="btnCreate" name="btnCreate"
                    data-dismiss="">Add</button>
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form action="" method=""> -->
                <h2>Update Modal</h2>
                <div class="form-group">
                    <label for="" class="roleId"></label><br>
                    <label for="">Name: </label>
                    <input type="text" name="updateName" id="updateName" class="form-control roleName" placeholder=""
                        aria-describedby="helpId">
                    <!-- <small id="helpId" class="text-muted"></small> -->

                </div>
                <button type="button" class="btn btn-primary" id="btnUpdate" name="btnUpdate" data-dismiss="">Up
                    Date</button>
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header" style="height: 40px">
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
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </tbody>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        @foreach($data as $key => $item)
                        <tr class="item-{{ $item->id }}">
                            <!-- Thêm Class Cho Dòng -->
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                <button data-id="{{ $item->id }}" data-name="{{ $item->name }}" type="button"
                                    class="btn btn-outline-primary btnUpdate" data-toggle="modal"
                                    data-target="#modalUpdate">Sửa</button>
                                <button data-id="{{ $item->id }}" type="button"
                                    class="btn btn-outline-danger btnDel">Xóa</button>
                                    <button type="button" class="btn btn-primary">Primary</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>

@endsection