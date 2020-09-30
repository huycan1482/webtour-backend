@extends('shop.layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="detail-title">{{ $tour->name }}</h2>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($images as $key => $item)
                    <div class="carousel-item {{ ($key == 0) ? 'active' : '' }} ">
                        <img src="{{ $item->image }}" class="d-block w-100" alt="{{ $item->name }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div>
                <div class="box-tour" id="sec1">
                    <h3><i class="fas fa-info-circle"></i>Điểm nhấn hành trình</h3>
                    <table>
                        <tr>
                            <td>Hành trình</td>
                            <td>{{ $tour->name }}</td>
                        </tr>
                        <tr>
                            <td>Lịch trình</td>
                            <td>{{ abs(strtotime($tour->start_date) - strtotime($tour->end_date))/(60*60*24) + 1}} ngày {{ abs(strtotime($tour->start_date) - strtotime($tour->end_date))/(60*60*24)}} đêm</td>
                        </tr>
                        <tr>
                            <td>Ngày khởi hành</td>
                            <td>{{ date('d-m-Y', strtotime($tour->start_date)) }}</td>
                        </tr>
                        <tr>
                            <td>Ngày kết thúc</td>
                            <td>{{ date('d-m-Y', strtotime($tour->end_date)) }}</td>
                        </tr>
                        <tr>
                            <td>Vận chuyển</td>
                            <td>
                                @foreach ($transports as $item)
                                    {{ ($item->id == $tour->transport_id) ? "$item->name" : '' }}
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    <img src="{{ $tour->image }}" class="img-tour-content" alt="{{ $tour->name }}" title="{{ $tour->name }}">
                </div>
                <div class="box-tour" id="sec2">
                    <h3><i class="fas fa-map-marked-alt"></i>Lịch trình</h3>
                    {!! $tour->schedule !!}
                </div>
                <div class="box-tour" id="sec3">
                    <h3><i class="fas fa-clipboard"></i>Dịch vụ, lưu ý tour</h3>
                    {!! $tour->note !!}
                </div>
                {{-- <div class="box-tour" id="sec4">
                    <h3>Ghi chú</h3>
                    <p>Lưu ý</p>
                    <ol>
                        <li>Khi đăng ký tour khách hàng bắt buộc phải gởi giấy tờ tùy thân cho đơn vị du lịch để vào tên
                            xuất vé và mua bảo hiểm du lịch. Những giấy tờ cá nhân của khách hàng (CMND hoặc Passport)
                            thuộc về trách nhiệm của khách hàng. Mọi vấn đề như hình ảnh, thông tin giấy tờ trong bản
                            gốc bị mờ, không rõ ràng; Passport, CMND hết hạn,… không đúng quy định của pháp luật Việt
                            Nam, Du Lịch Việt sẽ không chịu trách nhiệm và sẽ không hoàn trả bất cứ chi phí phát sinh
                            nào.</li>
                        <li>Đối với khách Nước ngoài/Việt Kiều: Khi đi tour phải mang theo đầy đủ Passport (Hộ Chiếu),
                            Visa Việt Nam bản chính còn hạn sử dụng làm thủ tục lên máy bay theo qui định hàng không.
                        </li>
                        <li>Trẻ em (dưới 12 tuổi) khi đi du lịch mang theo giấy khai sinh (bản chính hoặc sao y có thị
                            thực còn hạn sử dụng) để làm thủ tục hàng không.</li>
                    </ol>
                </div> --}}
                {{-- <div class="box-tour" id="">
                    <h3>Bình luận</h3>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-4 right-sidebar">
            <div class="top-right-sidebar">
                Thông tin cơ bản
            </div>
            <ul class="tour-title">
                <li>
                    <p>{{ $tour->name }}</p>
                </li>
                <li>
                    <div>Giá từ: </div>
                    <div style="color: red; font-size: 20px; font-weight: 700"> {{ number_format($tour->price,0,",",".") }} đ</div>
                </li>
                <li>
                    <div>Thời gian: </div>
                    <div>{{ abs(strtotime($tour->start_date) - strtotime($tour->end_date))/(60*60*24) + 1}} ngày {{ abs(strtotime($tour->start_date) - strtotime($tour->end_date))/(60*60*24)}} đêm</div>
                </li>
                <li>
                    <div>Vận chuyển:</div>
                    <div>
                        @foreach ($transports as $item)
                            {{ ($item->id == $tour->transport_id) ? "$item->name" : '' }}
                        @endforeach
                    </div>
                </li>
                <li>
                    <div>Xuất phát từ:</div>
                    <div>
                        @foreach ($positions as $item)
                            {{ ($item->id == $tour->starting_position_id) ? "$item->name" : '' }}
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="book-tour">
                <a href="{{ route('shop.order', ['slug' => $tour->slug, 'id' => $tour->id ]) }}">Đặt Tour</a>
            </div>


            <div class="tour-gist">
                <ul>
                    <li><a href="#sec1"><i class="fas fa-info-circle"></i>Điểm nhấn hành trình</a></li>
                    <li><a href="#sec2"><i class="fas fa-map-marked-alt"></i>Lịch trình</a></li>
                    <li><a href="#sec3"><i class="fas fa-clipboard"></i>Dịch vụ, lưu ý tour</a></li>
                    {{-- <li><a href="#sec4"><i class="fas fa-info-circle"></i>Ghi chú</a></li> --}}
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
<!-- <div class="lg-banner">
        <div class="shadow">
            <h2>Bạn muốn du lịch ở đâu</h2>
            <form action="#">
                <input type="text" class="form-control shadow" placeholder="Nhập địa danh...">
                <button><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div> -->
