@extends('shop.layouts.main')

@section('content')
    <div class="container">
        <div class="title">
            <p>Thanh toán Tour</p>
        </div>
        <div class="row">
            <div class="left-order col-lg-5">
                <div>
                    <img src="{{ $tour->image }}" alt="">
                </div>
            </div>
            <ul class="right-order col-lg-7">
                <li>
                    {{ $tour->name }}
                </li>
                <li>
                    <div>Mã Tour:</div>
                    <div> {{ $tour->id }}</div>
                </li>
                <li>
                    <div>Thời gian:</div>
                    <div> {{abs(strtotime($tour->start_date) - strtotime($tour->end_date))/(60*60*24) + 1}} ngày</div>
                </li>
                <li>
                    <div>Giá:</div>
                    <div> {{ number_format($tour->price,0,",",".") }}đ</div>
                </li>
                <li>
                    <div>Ngày khởi hành:</div>
                    <div> {{ date('d-m-Y', strtotime($tour->start_date)) }} </div>
                </li>
                <li>
                    <div>Ngày về:</div>
                    <div> {{ date('d-m-Y', strtotime($tour->end_date)) }} </div>
                </li>
                <li>
                    <div>Nơi khởi hành:</div> 
                    <div>
                        @foreach ($position as $item)
                           {{ ($item->id == $tour->starting_position_id) ? "$item->name" : '' }}
                        @endforeach
                    </div>
                </li>
                <li>
                    <div>Số chỗ còn nhận: </div>
                </li>
            </ul>
        </div>
        <div class="note">
            <p>Các khoản phí phát sinh (nếu có) như: phụ thu dành cho khách nước ngoài, việt kiều; phụ thu phòng đơn; phụ thu chênh lệch giá tour… Nhân viên Du Lịch Việt sẽ gọi điện thoại tư vấn cho quý khách ngay sau khi có phiếu xác nhận booking. (Trong giờ hành chính)</p>
            <p>Trường hợp quý khách không đồng ý các khoản phát sinh, phiếu xác nhận booking của quý khách sẽ không có hiệu lực.</p>
        </div>
        <div class="order-detail">
            <p>Bảng giá Tour chi tiết</p>
            <table class="order">
                <thead>
                    <td>Loại giá/ Độ tuổi</td>
                    <td>Người lớn</td>
                    <td>Trẻ em (từ 5 đến 11 tuổi)</td>
                    <td>Trẻ em (từ 2 đến dưới 5 tuổi) </td>
                    <td>Trẻ sơ sinh (< 2 tuổi)</td>
                    <td>Visa</td>
                </thead>
                <tbody>
                    <td>Giá</td>
                    <td>{{ number_format($tour->price,0,",",".") }}đ</td>
                    <td>{{ number_format($tour->price_5_11,0,",",".")  }}đ</td>
                    <td>{{ number_format($tour->price_2_5,0,",",".")  }}đ</td>
                    <td>{{ number_format($tour->price_1_2,0,",",".")  }}đ</td>
                    <td>{{ number_format($tour->visa_price,0,",",".") }}đ</td>
                </tbody>
            </table>
        </div>
        @include('components.order')
        {{-- @yield('content') --}}
        {{-- @include('checkout') --}}
    </div>
    
@endsection
