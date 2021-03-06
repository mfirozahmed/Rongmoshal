<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('backend/images/logo2.png') }}" alt="RongMoshal" width="160px" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="has-sub">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub">
                        <a href="{{ route('admin.orders') }}">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="bot-line"></span>Orders</a>
                        <ul class="header3-sub-list list-unstyled">
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
                        <a href="{{ route('admin.products') }}">
                            <i class="fas fa-trophy"></i>
                            <span class="bot-line"></span>Products</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories') }}">
                            <i class="fas fa-trophy"></i>
                            <span class="bot-line"></span>Categories</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.top') }}">
                            <i class="fas fa-trophy"></i>
                            <span class="bot-line"></span>Top</a>
                    </li>
                </ul>
            </div>
            <div class="header__tool">
                {{-- <div class="header-button-item has-noti js-item-menu">
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
                </div> --}}
                {{-- <div class="header-button-item js-item-menu">
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
                </div> --}}
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            {{-- <img src="images/icon/avatar-01.jpg" alt="John Doe" /> --}}
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="">{{ Auth::user()->name}}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="">
                                        <img src="{{ asset('backend/images/profile.png')}}" alt="" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        {{ Auth::user()->name}}
                                    </h5>
                                    <span class="email">{{ Auth::user()->email}}</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="{{ route('admin.profile') }}">
                                        <i class="zmdi zmdi-account"></i>Account</a>
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
    </div>
</header>
<!-- END HEADER DESKTOP-->