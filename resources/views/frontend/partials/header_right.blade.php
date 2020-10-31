<!-- Header Right -->
<div class="header-right">
    <ul>
        <li>
            <div class="nav-search search-switch">
                <span class="flaticon-search"></span>
            </div>
        </li>
        @guest
        <li class="nav-item dropdown">
            <a id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                v-pre><span class="flaticon-user"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"
                style="text-align: center; min-width: 12rem;">

                <a class="dropdown-item" href="{{ route('login') }}" style="color: #ff0000">Login</a>
                <a class="dropdown-item" href="{{ route('orders') }}" style="color: #ff0000">Orders</a>

            </div>
        </li>
        <li>
            <a href="{{ route('cart') }}">
                <span class="flaticon-shopping-cart"></span>
                <span class='badge badge-warning' id='lblCartCount'>
                    {{ App\Models\Cart::totalItems() }} </span>
            </a>
        </li>
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                v-pre><span class="flaticon-user"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"
                style="text-align: center; min-width: 12rem;">

                <span class="flaticon-user"> {{ Auth::user()->name }}</span>
                <a class="dropdown-item" href="{{ route('user.dashboard') }}" style="color: #ff0000">Profile</a>
                <a class="dropdown-item" href="{{ route('user.orders') }}" style="color: #ff0000">Orders</a>
                <a class="dropdown-item" href="{{ route('user.logout') }}" style="color: #ff0000" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('user.logout') }}" style="display: none;">
                    @csrf

                </form>
            </div>
        </li>
        <li>
            <a href="{{ route('cart') }}">
                <span class="flaticon-shopping-cart"></span>
                <span class='badge badge-warning' id='lblCartCount'>
                    {{ App\Models\Cart::totalItems() }} </span>
            </a>
        </li>
        @endguest
    </ul>
</div>