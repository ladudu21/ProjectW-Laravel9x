<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->
                <a href="{{route('homepage')}}" class="logo">
                    <img src="/img/logo.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{route('homepage')}}">Trang chủ</a>
                        </li>
                        <li class="label1" data-label1="hot">
                            <a href="#">Danh mục</a>
                            <ul class="sub-menu">

                                {!! showCategoryClient($categories) !!}

                            </ul>
                        </li>
                        <li>
                            <a href="">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="">Liên hệ</a>
                        </li>
                    </ul>
                </div>
                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">  
                    <div class="d-flex">
                        @auth
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="{{ count($items) }}">
                        <a href="{{ route('show_cart') }}" class="text-dark">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </a>
                        </div>
                        <div class="dropdown icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <a href="" class="text-dark" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user fa-sm"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                                <li><a class="dropdown-item" href="{{ route('account') }}">Thông tin tài khoản</a></li>
                            </ul>
                        </div>
                        @endauth
                        @guest
                        <div class="dropdown icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <a href="{{route('login')}}" class="text-dark">
                            <i class="fa-solid fa-user fa-sm"></i>
                        </a>
                    </div>
                        @endguest
                    </div>
                    @auth
                    @if (Auth::user()->isAdmin())
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <a href="{{route('admin.index')}}" class="text-dark">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    </div>
                    @endif
                    @endauth
                </div>
            </nav>
        </div>
    </div>
</header>
