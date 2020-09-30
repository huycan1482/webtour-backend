@extends('shop.layouts.main')
@section('content')

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="shop/images/test9.jpg" class="d-block w-100 slide-img" alt="...">
        </div>
        <div class="carousel-item">
            <img src="shop/images/test10.jpg" class="d-block w-100 slide-img" alt="...">
        </div>
        <div class="carousel-item">
            <img src="shop/images/test11.jpg" class="d-block w-100 slide-img" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="search-box">
    <div class="shadow">
        <h2>Bạn muốn du lịch ở đâu</h2>
        <form action="{{ route('shop.search') }}"" method="GET">
            <input type="text" class="form-control shadow" value="{{ isset($keyword) ? $keyword : '' }}" placeholder="Nhập địa danh..." name="tim-kiem" >
            <button><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<div class="container">
    <div class="tour">
        <h2><i class="fas fa-fire-alt"></i>Địa Điểm Nổi Bật<i class="fas fa-fire-alt"></i></h2>
        <div class="article">

            @foreach($hot as $key => $item)
            <div class="tours col-lg-3 col-sm-12 col-md-6 wow bounceInUp" data-wow-delay=".{{$key}}s">
            <a href="categories/{{ $item->slug }}">
                    <div class="zoom">
                        <img src="{{ $item->image }}" class="img-tour-content" alt="{{ $item->name }}"
                            title="{{ $item->name }}">

                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="tour-content">
                        <h5>{{ $item->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>

    <div class="tour">
        <h2><i class="fas fa-map-marker-alt"></i>Điểm Đến Nổi Bật Trong Nước<i class="fas fa-map-marker-alt"></i>
        </h2>
        <div class="article">

            @foreach ($country as $key => $item)
            <div class="tours col-lg-4 col-sm-12 col-md-6 wow animate__animated  animate__slideInLeft"
                data-wow-delay=".{{$key}}s">
                <a href="categories/{{ $item->slug }}">
                    <div class="zoom">
                        <img src="{{ $item->image }}" class="img-tour-content" alt="{{ $item->name }}"
                            title="{{ $item->name }}" style="min-height: 250px">
                    </div>
                    <div class="tour-content">
                        <h5>{{ $item->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach


        </div>
    </div>

    <div class="tour">
        <h2><i class="fas fa-location-arrow"></i>Điểm Đến Nổi Bật Nước Ngoài<i class="fas fa-location-arrow"></i>
        </h2>
        <div class="article">

            @foreach ($foreign as $item)
            <div class="tours col-lg-4 col-sm-12 col-md-6 wow animate__animated animate__fadeInDown "
                data-wow-delay=".{{$key}}s">
                <a href="categories/{{ $item->slug }}">
                    <div class="zoom">
                        <img src="{{ $item->image }}" class="img-tour-content" alt="{{ $item->name }}"
                            title="{{ $item->name }}" style="min-height: 250px">
                    </div>
                    <div class="tour-content">
                        <h5>{{ $item->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach

                
        </div>
    </div>

    <div class="discount tour">
        <h2><i class="fas fa-tags"></i>Giảm giá cho Thành viên<i class="fas fa-tags"></i></h2>
        <div class="article">
            <div class="left-discount col-sm-12 col-md-12 col-lg-6 wow animate__animated animate__bounceInLeft">
                <a href="#">
                    <img src="https://staticproxy.mytourcdn.com/0x0/resources/pictures/banners/advertising1578982831.jpg"
                        alt="">
                </a>
            </div>
            <div class="right-discount col-sm-12 col-md-12 col-lg-6 wow animate__animated animate__bounceInRight">
                <a href="#">
                    <img src="shop/images/banner-introduce2.webp" alt="">
                </a>
            </div>
        </div>
        <div class="extension">
            <a href="#">Đăng kí ngay<i class="fas fa-exclamation"></i></a>
        </div>

    </div>
    <div class="introduce tour">
        <h2><i class="fas fa-thumbs-up"></i>Tại sao nên chọn chúng tôi<i class="fas fa-thumbs-up"></i></h2>
        <div class="introduce-content row">
            <div id="" class="introduces col-sm-12 col-md-6 col-lg-6">
                <i class="fas fa-dollar-sign col-sm-12 col-lg-3"></i>
                <div class="col-sm-12 col-lg-7">
                    <h4>Giá Cả</h4>
                    <ul>
                        <li>Luôn có mức giá tốt nhất</li>
                        <li> Giá tốt hơn so với đặt phòng trực tiếp tại khách sạn</li>
                    </ul>
                </div>
            </div>
            <div id="" class="introduces col-sm-12 col-md-6 col-lg-6">
                <i class="fas fa-shopping-basket col-sm-12 col-lg-3"></i>
                <div class="col-sm-12 col-lg-7">
                    <h4>Sản phẩm</h4>
                    <ul>
                        <li>Đa dạng, đạt chất lượng tốt nhất</li>
                        <li>Nhiều chương trình khuyến mãi và tích lũy điểm</li>
                    </ul>
                </div>
            </div>
            <div id="" class="introduces col-sm-12 col-md-6 col-lg-6">
                <i class="fas fa-user-clock col-sm-12 col-lg-3"></i>
                <div class="col-sm-12 col-lg-7">
                    <h4>Hỗ trợ</h4>
                    <ul>
                        <li>Từ 08h00 - 22h00</li>
                        <li>Hotline và hỗ trợ trực tuyến các ngày trong tuần</li>
                    </ul>
                </div>
            </div>
            <div id="" class="introduces col-sm-12 col-md-6 col-lg-6">
                <i class="fas fa-user-clock col-sm-12 col-lg-3"></i>
                <div class="col-sm-12 col-lg-7">
                    <h4>Hỗ trợ</h4>
                    <ul>
                        <li>Từ 08h00 - 22h00</li>
                        <li>Hotline và hỗ trợ trực tuyến các ngày trong tuần</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="tour register container">
        <h2><i class="fas fa-reply"></i>Đăng kí nhận thông tin<i class="fas fa-reply"></i></h2>
        <form action="#">
            <input type="email" class="form-control shadow" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Email">
            <button type="submit"><i class="fas fa-envelope"></i></button>
        </form>
    </div>
</div>
<!--  -->

@endsection
