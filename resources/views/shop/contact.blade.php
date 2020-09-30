@extends('shop.layouts.main')
@section('content')



@if (isset($finish) && $finish == 'true')
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle" style="color: #2980b9;">My Tours</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Thông tin đã được gửi, chúng tôi sẽ trả lời sớm nhất có thể, cảm ơn bạn.
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button> --}}
                <a class="btn btn-primary" href="/">Tới trang chủ</a>
            </div>
        </div>
    </div>
</div>

@section('modal')
<script>
    $(window).load(function () {
        $('#exampleModalCenter').modal('show');
    });
</script>
@endsection

@endif

<div class="container">

    <div class="row">
        <div class="col-lg-6">
            <h1 class="contact-title">
                Giới thiệu
            </h1>
            <div class="contact-content">
                <p>Tên công ty: {{ $setting->company }}</p>
                <p>Chi nhánh 1: {{ $setting->address }} </p>
                <p>Chi nhánh 2: {{ $setting->address2 }} </p>
                <p>Điện thoại: {{ $setting->phone }} </p>
                <p>Hot line: {{ $setting->hotline }} </p>
                <p>Tax: {{ $setting->tax }} </p>
                <p> {{ $setting->introduce }} </p>
            </div>
            <div class="list-icons">
                <h1 class="">Kết nối với chúng tôi</h1>
                <ul class="contact-icons">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>

        </div>
        <div class="col-lg-6">
            <h1 class="contact-title">
                Liên hệ
            </h1>
            <div class="contact-form">
                <form action=" {{route('shop.contactRequest')}} " method="post">
                    @csrf
                    <div class="form-group">
                        @if ($errors->has('name'))
                        <input type="text" class="form-control is-invalid" id="" name="name" placeholder="Họ tên">
                        <div id="" class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @else
                        <input type="text" class="form-control" id="" name="name" placeholder="Họ tên">
                        @endif
                    </div>

                    <div class="form-group">
                        @if ($errors->has('phone'))
                        <input type="text" class="form-control is-invalid" id="" name="phone"
                            placeholder="Số điện thoại">
                        <div id="" class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                        @else
                        <input type="text" class="form-control" id="" name="phone" placeholder="Số điện thoại">
                        @endif
                    </div>

                    <div class="form-group">
                        @if ($errors->has('email'))
                        <input type="email" class="form-control is-invalid" id="" name="email" placeholder="Email">
                        <div id="" class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @else
                        <input type="email" class="form-control" id="" name="email" placeholder="Email">
                        @endif
                    </div>
                    <div class="form-group">
                        @if ($errors->has('content'))
                        <textarea class="form-control is-invalid" name="" id="" name="content"
                            placeholder="Thông tin liên hệ"></textarea>
                        <div id="" class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @else
                        <textarea class="form-control" id="" name="content" placeholder="Thông tin liên hệ"></textarea>
                        @endif
                    </div>
                    <button class="">Gửi thông tin</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
