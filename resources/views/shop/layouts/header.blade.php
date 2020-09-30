<header class="shadow">
    <div class="header-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav header-left">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img id="nav-logo" src=" {{ $settings->image }} " alt=""></a>
                    </li> 
                    <li class="nav-item" title="Trang chủ">
                        <a class="nav-link 
                            @if( isset($check) )
                                {{ ($check == 'index') ? 'check-nav' : '' }}
                            @endif
                        " href=""><i class="fas fa-home"></i>Trang chủ</a>
                    </li>
                    <li class="nav-item" title="Đặt Tour">
                        <a class="nav-link
                            @if( isset($check) )
                                {{ ($check == 'tour') ? 'check-nav' : '' }}
                            @endif
                        " href="{{ route('shop.list-categories') }}"><i class="fas fa-ticket-alt"></i>Đặt Tour</a>
                    </li>
                    <li class="nav-item" title="Đặt Vé Máy Bay">
                        <a class="nav-link" href="#"><i class="fas fa-plane-departure"></i>Đặt Vé Máy Bay</a>
                    </li>
                    <li class="nav-item" title="Đặt Khách Sạn">
                        <a class="nav-link" href="#"><i class="fas fa-hotel"></i>Đặt Khách Sạn</a>
                    </li>
                    {{-- <li class="nav-item" title="Cẩm nang">
                        <a class="nav-link" href="#"><i class="fas fa-umbrella-beach"></i>Cẩm nang</a>
                    </li> --}}
                    <li class="nav-item" title="Liên hệ">
                        <a class="nav-link
                            @if( isset($check) )
                                {{ ($check == 'contact') ? 'check-nav' : '' }}
                            @endif
                        " href=" {{ route('shop.contact') }} "><i class="fas fa-umbrella-beach"></i>Liên hệ</a>
                    </li>
                </ul>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown" title="Tài khoản">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="home_dynamic.html">Đăng kí</a>
                            <a class="dropdown-item" href="home-unique.html">Đăng nhập</a>
                        </div>
                    </li>
                    <li class="nav-item" title="Tin nhắn">
                        <a class="nav-link" href="#"><i class="fas fa-comments"></i></a>
                    </li>
                    <li class="nav-item" title="Thông báo">
                        <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                    </li>
                </ul>
            </div>
            <!--  -->
        </nav>
    </div>
</header>