<!-- HEADER MOBILE-->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('img/logo/logo2.png') }}" alt="RongMoshal" width="160px" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a class="js-arrow" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="has-sub">
                    <a href="{{ route('admin.orders') }}">
                        <i class="fas fa-shopping-basket"></i>Orders</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{ route('admin.orders') }}">All</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.properties.orders', 'not-delivered') }}">Not
                                Delivered</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.properties.orders', 'not-paid') }}">Not Paid</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="js-arrow" href="{{ route('admin.products') }}">
                        <i class="fas fa-tachometer-alt"></i>Products</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{ route('admin.categories') }}">
                        <i class="fas fa-tachometer-alt"></i>Categories</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{ route('admin.top') }}">
                        <i class="fas fa-tachometer-alt"></i>Top</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="sub-header-mobile-2 d-block d-lg-none">
    <div class="header__tool">
        <div class="header-button-item has-noti js-item-menu">
            <i class="zmdi zmdi-notifications"></i>
            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                <div class="notifi__title">
                    <p>You have 3 Notifications</p>
                </div>
                <div class="notifi__item">
                    <div class="bg-c1 img-cir img-40">
                        <i class="zmdi zmdi-email-open"></i>
                    </div>
                    <div class="content">
                        <p>You got a email notification</p>
                        <span class="date">April 12, 2018 06:50</span>
                    </div>
                </div>
                <div class="notifi__item">
                    <div class="bg-c2 img-cir img-40">
                        <i class="zmdi zmdi-account-box"></i>
                    </div>
                    <div class="content">
                        <p>Your account has been blocked</p>
                        <span class="date">April 12, 2018 06:50</span>
                    </div>
                </div>
                <div class="notifi__item">
                    <div class="bg-c3 img-cir img-40">
                        <i class="zmdi zmdi-file-text"></i>
                    </div>
                    <div class="content">
                        <p>You got a new file</p>
                        <span class="date">April 12, 2018 06:50</span>
                    </div>
                </div>
                <div class="notifi__footer">
                    <a href="#">All notifications</a>
                </div>
            </div>
        </div>
        <div class="header-button-item js-item-menu">
            <i class="zmdi zmdi-settings"></i>
            <div class="setting-dropdown js-dropdown">
                <div class="account-dropdown__body">
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-account"></i>Account</a>
                    </div>
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-settings"></i>Setting</a>
                    </div>
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                    </div>
                </div>
                <div class="account-dropdown__body">
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-globe"></i>Language</a>
                    </div>
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-pin"></i>Location</a>
                    </div>
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-email"></i>Email</a>
                    </div>
                    <div class="account-dropdown__item">
                        <a href="#">
                            <i class="zmdi zmdi-notifications"></i>Notifications</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="account-wrap">
            <div class="account-item account-item--style2 clearfix js-item-menu">
                <div class="image">
                    {{-- <img src="images/icon/avatar-01.jpg" alt="John Doe" /> --}}
                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#">john doe</a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="info clearfix">
                        <div class="image">
                            <a href="#">
                                {{-- <img src="images/icon/avatar-01.jpg" alt="John Doe" /> --}}
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="name">
                                <a href="#">john doe</a>
                            </h5>
                            <span class="email">johndoe@example.com</span>
                        </div>
                    </div>
                    <div class="account-dropdown__body">
                        <div class="account-dropdown__item">
                            <a href="#">
                                <i class="zmdi zmdi-account"></i>Account</a>
                        </div>
                        <div class="account-dropdown__item">
                            <a href="#">
                                <i class="zmdi zmdi-settings"></i>Setting</a>
                        </div>
                        <div class="account-dropdown__item">
                            <a href="#">
                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                        <a href="{{ route('admin.logout') }}">
                            <i class="zmdi zmdi-power"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HEADER MOBILE -->