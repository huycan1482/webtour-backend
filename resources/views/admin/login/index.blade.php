<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="backend/login/login.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    
</head>

<body>

{{-- @if (session('success_mess'))

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
                <div class="thank">
                    <p> {{session('success_mess')}} </p>
                </div>
            </div>
            <div class="modal-footer">
              
                <a class="btn btn-primary extension" href="/">Tới trang chủ</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(window).load(function () {
        $('#exampleModalCenter').modal('show');
    });
</script>
@endif --}}

    <div class="body-wrapper">
        <!-- <div class="filter"></div> -->
        <div class="login-form">
            <div class="head">
                <i class="fas fa-user"></i>
            </div>
            <h1><span>My Tours</span></h1>
            <form action="postLogin" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                        aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                        placeholder="Mật khẩu">
                </div>
                <span class="errors-msg"> {{ session('message') ? session('message') : '' }} </span>
                <!-- <div class="bot"> -->
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                    <label class="form-check-label" for="exampleCheck1">Ghi nhớ mật khẩu</label>
                </div>
                <div class="submit">
                    <button>Đăng nhập</button>
                </div>
                {{-- <div > --}}
                <a class="pass-forgot" href="/pass_forgot">Quên mật khẩu?</a>
                {{-- </div> --}}

                <!-- </div> -->
            </form>

        </div>
    </div>


</body>

</html>
