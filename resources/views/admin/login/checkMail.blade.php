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
            <h1><span>Lấy lại mật khẩu</span></h1>
            <form action="/check_email" method="POST">
                @csrf
                <p>Yêu cầu nhập email xác thực chúng tôi sẽ gửi mã xác nhận đến email của bạn</p> 
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                        aria-describedby="emailHelp" placeholder="Email">
                </div>
                <span class="errors-msg"> {{ session('message') ? session('message') : '' }} </span>         
                <div class="submit">
                    <button>Xác nhận email</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
