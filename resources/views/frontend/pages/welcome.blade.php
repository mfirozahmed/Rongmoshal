@extends('frontend.user')

@section('styles')

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

@endsection

@section('content')
@include('frontend.partials.message')
<div class="slider-area ">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center slide-bg">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="hero__caption">
                            <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Select Your New
                                Perfect Style</h1>
                            <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">###</p>
                            <!-- Hero-btn -->
                            <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                <a href="{{ route('shop') }}" class="btn hero-btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                        <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                            <img src="{{ asset('frontend/img/hero/test.png') }}" alt="" class=" heartbeat">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center slide-bg">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="hero__caption">
                            <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Select Your New
                                Perfect Style</h1>
                            <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">###</p>
                            <!-- Hero-btn -->
                            <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                <a href="industries.html" class="btn hero-btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                        <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                            <img src="{{ asset('frontend/img/hero/test.png') }}" alt="" class=" heartbeat">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->
<!-- ? New Product Start -->
<section class="new-product-area section-padding30">
    <div class="container">
        <!-- Section tittle -->
        <div class="row">
            <div class="col-xl-12">
                <div class="section-tittle mb-70">
                    <h2>New Arrivals</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($new_items as $item)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-new-pro mb-30 text-center">
                    <div class="product-img">
                        <img src="/storage/images/{{ $item->image }}" alt="">
                    </div>
                    <div class="product-caption">
                        <h3><a href="{{ route('specific_product', $item->id) }}">{{ $item->name}}</a></h3>
                        <span>{{ $item->price }} TK</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--  New Product End -->
<!--? Gallery Area Start -->
<div class="gallery-area">
    <div class="container-fluid p-0 fix">
        <div class="row">
            <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                <div class="single-gallery mb-30">
                    <div class="gallery-img big-img" style="background-image: url(./frontend/img/hero/test1.jpeg);">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="single-gallery mb-30">
                    <div class="gallery-img big-img" style="background-image: url(./frontend/img/hero/test2.jpeg);">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img small-img"
                                style="background-image: url(./frontend/img/hero/test3.jpeg);"></div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12  col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img small-img"
                                style="background-image: url(./frontend/img/hero/test4.jpeg);"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Gallery Area End -->
<!--? Popular Items Start -->
<div class="popular-items section-padding30">
    <div class="container">
        <!-- Section tittle -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-70 text-center">
                    <h2>Signature Items</h2>
                    <p>##</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($signature_items as $item)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-popular-items mb-50 text-center">
                    <div class="popular-img">
                        <img src="/storage/images/{{ $item->image }}" alt="">
                        <form method="POST" action="{{ route('cart.store') }}">
                            @csrf
                            <div class="img-cap" onclick="addtoCart({{ $item->id }})">
                                <span>Add to cart</span>
                            </div>
                        </form>
                    </div>
                    <div class="popular-caption">
                        <h3><a href="{{ route('specific_product', $item->id) }}">{{ $item->name }}</a></h3>
                        <span>{{ $item->price }} TK</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Button -->
        <div class="row justify-content-center">
            <div class="room-btn pt-70">
                <a href="{{ route('shop')}}" class="btn view-btn1">View More Products</a>
            </div>
        </div>
    </div>
</div>
<!-- Popular Items End -->

<!--? Shop Method Start-->
<div class="shop-method-area">
    <div class="container">
        <div class="method-wrapper">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-method mb-40">
                        <i class="ti-package"></i>
                        <h6>Free Shipping Method</h6>
                        <p></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-method mb-40">
                        <i class="ti-unlock"></i>
                        <h6>Secure Payment System</h6>
                        <p></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-method mb-40">
                        <i class="ti-reload"></i>
                        <h6>Secure Home Delivery System</h6>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"').attr('content')
        }
    }); 


    function addtoCart(product_id){
        //alert(product_id);
        //alert(user_id);
        
        $.post("http://127.0.0.1:8000/user/cart/store", {
            
            product_id: product_id,
        }).done(function (data) {
            //alert("Data Loaded: " + data);
            data = JSON.parse(data);
            if (data.status == 'ok') {
                alertify.set('notifier','position', 'bottom-right');
                alertify.success('Item added to cart successfully.');


                $("#lblCartCount").html(data.totalItems)
            }
        });
    }

    function submitform() {
        document.getElementById("myForm").submit();
    }

</script>

@endsection