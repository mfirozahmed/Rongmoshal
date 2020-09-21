<!-- Logo -->
<div class="logo">
    <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/logo/logo1.png') }}" alt="" height="100px"
            width="200px"></a>
</div>
<!-- Main-menu -->
<div class="main-menu d-none d-lg-block">
    <nav>
        <ul id="navigation">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="{{ route('shop') }}">Categories</a>
                <ul class="submenu">
                    @foreach ($main_categories as $main_category)
                    <li><a href="{{ route('category', $main_category->name) }}">{{ $main_category->name }}</a>
                        @if ($sub_categories[$main_category->id]->count() > 0)
                        <ul class="subsubmenu">
                            @foreach ($sub_categories[$main_category->id] as $sub_category)
                            <li><a
                                    href="{{ route('sub_category', [$main_category->name, $sub_category->name]) }}">{{ $sub_category->name }}</a>
                                @if ($sub_sub_categories[$sub_category->id]->count() > 0)
                                <ul class="subsubsubmenu">
                                    @foreach ($sub_sub_categories[$sub_category->id] as
                                    $sub_sub_category)
                                    <li><a
                                            href="{{ route('sub_sub_category', [$main_category->name, $sub_category->name, $sub_sub_category->name]) }}">{{ $sub_sub_category->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </nav>
</div>