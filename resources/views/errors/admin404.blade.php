<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/backend/404/notfound.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div class="error-page">
        <!-- <i class="far fa-frown"></i> -->
        <!-- <i class="fas fa-frown"></i> -->
        <span>404</span>
        <p>Trang bạn tìm kiếm không tồn tại!</p>
        <a href=" {{ route('admin.dashboard') }} ">Quay lại trang chủ</a>
    </div>


</body>

</html>