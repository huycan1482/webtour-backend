@extends('shop.layouts.main')
@section('content')
<div class="lg-banner">
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
        <h2><i class="fas fa-map-marker-alt"></i>Điểm Đến Nổi Bật Trong Nước<i class="fas fa-map-marker-alt"></i></h2>
        <div class="article">

            @foreach ($country as $item)
            <div class="tours col-sm-12 col-md-6 col-lg-3 wow bounceInUp">
                <a href="categories/{{ $item->slug }}">
                    <div class="zoom">
                    <img src="{{ $item->image }}" class="img-tour-content" alt="{{ $item->name }}" title="{{ $item->name }}">
                    </div>
                    <div class="tour-content">
                        <h5>{{ $item->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
        <div class="extension">
            <a href="#">Xem tất cả các Tour<i class="fas fa-caret-right"></i></a>
        </div>
    </div>
    <div class="tour">
        <h2><i class="fas fa-location-arrow"></i>Điểm Đến Nổi Bật Nước Ngoài<i class="fas fa-location-arrow"></i></h2>
        <div class="article">

            @foreach ($foreign as $item)
            <div class="tours col-sm-12 col-md-6 col-lg-3 wow bounceInUp">
                <a href="/{{ $item->slug }}">
                    <div class="zoom">
                        <img src="{{ $item->image }}" class="img-tour-content" alt="{{ $item->name }}" title="{{ $item->name }}">
                    </div>
                    <div class="tour-content">
                        <h5>{{ $item->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
        <div class="extension">
            <a href="#">Xem thêm<i class="fas fa-caret-right"></i></a>
        </div>
    </div>
</div>
@endsection
