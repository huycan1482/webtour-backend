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
    <div class="body-wrapper">
        <div class="login-form">
            <div class="head">
                <i class="fas fa-user"></i>
            </div>
            <h1><span>Tạo mật khẩu mới</span></h1>
            <form action="new_password" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Email" value="{{ session()->get('mail_passForgot') }} ">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                        placeholder="Mật khẩu">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="re_password"
                        placeholder="Nhập lại mật khẩu">
                </div>

                @if($errors)
                    @foreach ($errors as $item)
                    <span class="errors-msg"> {{ $item }} </span>
                    @endforeach
                @endif

                <div class="submit">
                    <button>Thay đổi</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
