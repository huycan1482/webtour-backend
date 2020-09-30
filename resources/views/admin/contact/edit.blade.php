@extends('admin.layouts.main')
@section('content')

<section class="content-header">
    <h1>
        Sửa - Liên hệ
        <small><a href="{{ route('admin.contact.index') }}">Danh sách</a></small>
    </h1>
</section>
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
                <form action="{{ route('admin.contact.update', ['id' => $contact->id]) }}" method="post">
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
                                <td><label for="">Họ tên :</label></td>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <td><label>SĐT :</label> </td>
                                <td>{{ $contact->phone }}</td>
                                
                            </tr>
                            <tr>
                                <td><label>Email :</label></td>
                                <td>{{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <td><label>Ngày tạo :</label></td>
                                <td>{{date('d-m-Y', strtotime($contact->created_at))}}</td>
                            </tr>
                            <tr>
                                <td><label>Nội dung</label></td>
                                <td>
                                    {{-- <textarea name="content" class="form-control" rows="3" placeholder="">{{ $contact->content }}</textarea> --}}
                                    {{ $contact->content }}
                                </td>
                            </tr>
                            <tr>
                                <td><label>Ghi chú</label></td>
                                <td>
                                    <textarea name="note" class="form-control" rows="3" placeholder="">{{ $contact->note }}</textarea>
                                </td>
                                <td><label>Tình trạng liên hệ</label></td>
                                <td>
                                    <select class="form-control " name="status" style="max-width: 150px;display: inline-block;"
                                        @if ($contact->status == 3 || $contact->status == 4) 
                                            {{ 'disabled="disabled"' }}
                                        @endif
                                    >
                                        <option value="0">-- chọn --</option>
                                        @foreach($order_status as $status)
                                            <option {{ ($contact->status == $status->id ? 'selected':'') }} value="{{ $status->id }}"> {{ $status->name }} </option>
                                        @endforeach
                                    </select>
                                
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
    CKEDITOR.replace('note');
    CKEDITOR.replace('introduce');
</script>
    
@endsection

