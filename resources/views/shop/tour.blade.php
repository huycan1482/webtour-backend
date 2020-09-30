@extends('shop.layouts.main')
@section('content')

<div class="lg-banner">
    <div class="shadow">
        <h2>Bạn muốn du lịch ở đâu</h2>
        <form action="{{ route('shop.search') }}"" method=" GET">
            <input type="text" class="form-control shadow" value="{{ isset($keyword) ? $keyword : '' }}"
                placeholder="Nhập địa danh..." name="tim-kiem">
            <button><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>
<div class="container">
    <div>
        <h2>Tour {{ $cate }} ({{ $total }} kết quả)</h2>
    </div>
    <div class="tour-detail-content">

        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="top-content">
                <span>Sắp xếp:</span>
                <ul class="sort">
                    <li id="s1" class="click-sort">Ngày khởi hành<i class="s1 fas
                            {{-- @if ($date == 'tang-dan')
                                {{ 'fa-long-arrow-alt-up' }}
                            @elseif ($date == 'giam-dan')
                                {{ 'fa-long-arrow-alt-down' }}
                            @endif --}}
                        " value=""></i></li>
                    <li id="s2" class="click-sort">Theo giá<i class="s2 fas " value=""></i></li>
                    <li id="s3" class="click-sort">Theo thời gian<i class="s3 fas " value=""></i></li>
                </ul>
            </div>
            <div class="main-content">
                <div class="test">

                @foreach ($list as $item)
                <div class="tour-list">
                    <div class="col-lg-5">
                        <a class="href-1"
                            href="{{route('shop.tour-detail',  ['slug' => $item->slug , 'id' => $item->id])}}">
                            <img class="image" src="{{ $item->image }}" alt="" width="100%">
                        </a>
                    </div>
                    <div class="col-lg-7">
                        <a class="href-2"
                            href="{{route('shop.tour-detail',  ['slug' => $item->slug , 'id' => $item->id])}}">
                            <h4 class="tour-name">{{ $item->name }}</h4>
                            <div class="tour-time">
                                <span>Thời gian</span>
                                <span>{{ $item->days }} ngày</span>
                            </div>
                            <div class="box-price">
                                <span class="number" href="">Số chỗ còn nhận:
                                    {{ ($item->total_num - $item->member_num) }} </span>
                                <span class="price">{{ number_format($item->price,0,",",".") }}đ</span>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

                </div>

                <ul class="pagination" role="navigation">
                    <li id="prev" class="page-item" aria-label="&laquo; Previous"><span class="page-link">&lsaquo;</span></li>
                    @for ($i = 1; $i <= $total_page; $i++)
                        <li class="page-item" id=" {{ $i }} "><span class='page-link'> {{ $i }} </span></li>
                    @endfor
                    <li id="Next" class="page-item" aria-label="&raquo; Next"><span class="page-link">&rsaquo;</span></li>
                </ul>
        </div>
    </div>
    <div class="sidebar col-sm-12 col-md-12 col-lg-4">
        <div class="top-sidebar">
            <div class="click-sidebar">
                <h3>Lọc tour theo</h3><i class="fas fa-angle-down"></i>
            </div>
            <form class="sidebar-form" action="#">
                <div class="form-group">
                    <label for="">Nơi khởi hành</label>
                    <select class="form-control" id="position">
                        <option value=""> Chọn nơi khởi hành</option>
                        <option value="ha-noi">Hà Nội</option>
                        <option value="hcm">TP. Hồ chí Minh</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Giá Tour</label>
                    <select class="form-control" id="price">
                        <option value="">Chọn giá tour</option>
                        <option value="1-2000000">Dưới 2 triệu </option>
                        <option value="2000000-4000000" >Từ 2 đến 4 triệu</option>
                        <option value="4000000-6000000" >Từ 4 triệu tới 6 triệu</option>
                        <option value="6000000-8000000" >Từ 6 triệu tới 8 triệu</option>
                        <option value="8000000-10000000" >Từ 8 triệu tới 10 triệu</option>
                        <option value="10000000-">Trên 10 triệu</option>
                    </select>
                </div>
                {{-- <button>Tìm kiếm<i class="fas fa-search"></i></button> --}}
            </form>

        </div>
    </div>
</div>
</div>
@endsection

@section('my_script')
<script type="text/javascript">
    var pathname = window.location.pathname;
    var urlParams = new URLSearchParams(window.location.search);

    let sort_date = '';
    let sort_price = '';
    let sort_time = '';

    let position = '';
    let price = '';

    let current_page = 1;
    let last_page;
    let page_val ='';

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    $(document).load(function() {
        send(sort_date, sort_price, sort_time, '');
    });

    $(document).on('click', 'li[class="page-item"]', function () {
        page_val = $(this).attr("id");
        // console.log(page_val);

        if (page_val == 'prev') {
            var page = current_page - 1; 
            if (page > 0) {
                page_val = page;
            }
        } else if (page_val == 'Next') {
            page_val = 2;
        } else if (page_val == 'next') {
            page = current_page + 1;
            if (page <= last_page) {
                page_val = page;
            } else {
                page_val = current_page;
            }
        }
        console.log(page_val);
        send(sort_date, sort_price, sort_time, price, position, page_val);
        
    });

    $(document).on('change', '#position', function () {
        position = $(this).val();
        send('', '', '', '', position, '');

    });

    $(document).on('change', '#price', function () {
        price = $(this).val();
        send('', '', '', price, '', '')
    });

    function send( sort_date, sort_price, sort_time, price, position, page) {
        $.ajax({
            url: base_url + '/categories/sort', // base_url được khai báo ở đầu page == http://webshop.local
            type: 'GET',
            data: {
                "sort_date": sort_date,
                "sort_price": sort_price,
                "sort_time": sort_time,
                "price": price,
                "position": position,
                "page" : page,
            },
            dataType: "json", // kiểu dữ liệu trả về
            success: function (response) { // success : kết quả trả về sau khi gửi request ajax
                // if (response.status != 'undefined' && response.status == true) {
                //     alert('hi');
                // }

                console.log(response.list)

                current_page = response.list.current_page;
                last_page = response.list.last_page;

                var previous =" <li id='prev' class='page-item' aria-label='&laquo; Previous'><span class='page-link'>&lsaquo;</span></li> ";
                var next = " <li id='next' class='page-item' aria-label='&raquo; Next'><span class='page-link'>&rsaquo;</span></li> ";

                var html = "";
                for (var j = 1; j <= response.list.last_page; j++) {
                    html += "<li class='page-item' id='" + j + "'><span class='page-link'>" + j + "</span></li>";
                }
                
                $('.pagination').html(previous + html + next);

                var text = '';

                for (let i = 0; i < response.list.data.length; i++) {
                    let href = base_url + '/chi-tiet-tour/' + response.list.data[i].slug + '_' + response.list.data[i].id;
                    let image = response.list.data[i].image;
                    let tour_name = response.list.data[i].name;
                    let days = response.list.data[i].days;
                    let number = response.list.data[i].total_num - response.list.data[i].member_num;
                    let price = formatNumber(response.list.data[i].price) + 'đ';

                    // let val_name = $('.tour-name')[i];
                    // let val_num = $('.number')[i];
                    // let val_price = $('.price')[i];

                    // $('.href-1')[i].href = href;
                    // $('.href-2')[i].href = href;
                    // $('.image')[i].src = image;
                    // $(val_name).text(tour_name);
                    // $(val_num).text('Số chỗ còn nhận: ' + number);
                    // $(val_price).text(formatNumber(price) + 'đ');
                    
                    text += " <div class='tour-list'><div class='col-lg-5'><a class='href-1'href='"+ href +"'><img class='image' src='"+ image +"' alt='' width='100%'></a></div><div class='col-lg-7'><a class='href-2'href='"+ href +"'><h4 class='tour-name'>"+ tour_name +"</h4><div class='tour-time'><span>Thời gian</span><span>"+ days +" ngày</span></div><div class='box-price'><span class='number'href=''>Số chỗ còn nhận: "+ number +"</span><span class='price'>"+ price +"</span></div></a></div></div>";
                };

                $('.test').html(text);
            },
            error: function (e) { // lỗi nếu có
                console.log(e.message);
            }
        });
    }

    $(document).on('click', '#s1', function () {

        sort_date = $('.s1').attr('value');

        send(sort_date,'', '','','', '');
        // let sort_price = $('.s2').attr('value');
        // let sort_time = $('.s3').attr('value');

        // if ( str && str.slice(-1) === '&' ) {
        //     var indexPath = str.lastIndexOf('&');
        //     str = str.substring(0, indexPath);
        // }

        

        // if (sort_date != '') {
        //     urlParams.set('start_date', sort_date);
        // }
        // else
        //     urlParams.delete('start_date');
        // console.log(urlParams)


        // window.location.href = pathname + "?"+ decodeURIComponent(urlParams.toString());

    });

    $(document).on('click', '#s2', function() {
        sort_price = $('.s2').attr('value');
        send('',sort_price, '','','', '');

        
    });

    $(document).on('click', '#s3', function() {
        sort_time = $('.s3').attr('value');
        send('','',sort_time,'','', '');

    });


</script>
@endsection
