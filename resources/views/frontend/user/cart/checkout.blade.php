@extends('frontend.user')

@section('styles')
<style>
    /* The container */
    .checker {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default radio button */
    .checker input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
        position: absolute;
        top: -4px;
        left: -5px;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .checker:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .checker input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .checker input:checked~.checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .checker .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }
</style>
@endsection
@section('content')
<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================Checkout Area =================-->
    <section class="checkout_area section_padding">
        <div class="container" style="margin-top: -100px;">
            <div class="cupon_area">
                <div class="check_title">
                    <h2>
                        Have a coupon?
                    </h2>
                </div>
                <input type="text" placeholder="Enter coupon code" disabled />
                <a class="tp_btn" href="#">Apply Coupon</a>
            </div>
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        @include('partials.message')
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="{{ route('order.submit') }}" method="post">
                            @csrf

                            @guest

                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" value="" name="billing_name"
                                    placeholder="Name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="" name="billing_number"
                                    placeholder="Phone number" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="email" class="form-control" value="" name="billing_email"
                                    placeholder="Email Address" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" value="" name="billing_address"
                                    placeholder="Address" />
                            </div>

                            @else

                            <div class="col-md-4 form-group p_star" style="color:#415094">Name</div>
                            <div class="col-md-12 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $carts[0]->user->name }}</span>
                            </div>
                            <div class="col-md-6 form-group p_star" style="color:#415094">Phone Number</div>
                            <div class="col-md-6 form-group p_star" style="color:#415094">Email Address</div>
                            <div class="col-md-6 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $carts[0]->user->phone }}</span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $carts[0]->user->email }}</span>
                            </div>
                            <div class="col-md-4 form-group p_star" style="color:#415094">Address</div>
                            <div class="col-md-12 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px; height:100px">{{ $carts[0]->user->address }}</span>
                            </div>

                            @endguest

                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <input type="checkbox" id="f-option3" name="selector" value="yes" />
                                    <label for="f-option3">Same as Billing address?</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" value="" name="shipping_name"
                                    placeholder="Name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="" name="shipping_number"
                                    placeholder="Phone number" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="email" class="form-control" value="" name="shipping_email"
                                    placeholder="Email Address" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" value="" name="shipping_address"
                                    placeholder="Address" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="" name="shipping_city"
                                    placeholder="City" />
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" name="message" rows="1"
                                    placeholder="Any Notes??"></textarea>
                            </div>
                            <input type="hidden" value="{{ $delivery }}" name="delivery">
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="{{ route('cart') }}">Product
                                        <span>Total</span>
                                    </a>
                                </li>
                                @php
                                $total_item = 0;
                                $total_price = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                <li>
                                    <a href="/shop/product/{{ $cart->product_id }}">{{ $cart->product->name }}
                                        <span class="middle">X {{ $cart->quantity }}</span>
                                        @php
                                        $total_price += $cart->product->price * $cart->quantity;
                                        $total_item += $cart->quantity;
                                        @endphp
                                        <span class="last">{{ $cart->product->price * $cart->quantity }} tk</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a>Subtotal
                                        <span>{{ $total_price }} tk</span>
                                    </a>
                                </li>
                                <li>
                                    <a>Shipping
                                        <span>
                                            @if ($delivery == '15d95018')
                                            Free
                                            @else
                                            100 TK
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>Total
                                        <span>
                                            @if ($delivery == '15d95018')
                                            {{ $total_price }} TK
                                            @else
                                            {{ $total_price + 100 }} TK
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>Check payments</a>
                                </li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    @if ($delivery == '15d95018')
                                    <label class="checker"> Cash on Delivery
                                        <input type="radio" name="payment" value="Cash On Delivery" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                    @else
                                    <label class="checker"> Cash on Delivery
                                        <input type="radio" name="payment" value="Cash On Delivery" disabled>
                                        <span class="checkmark"></span>
                                    </label>
                                    @endif
                                    <label class="checker"> Bkash
                                        <input type="radio" name="payment" value="Bkash">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>
                                        <b> Go to your sent money option and </b>
                                    </p>
                                    <label class="checker"> Rocket
                                        <input type="radio" name="payment" value="Rocket">
                                        <span class="checkmark"></span>
                                    </label>
                                    <input type="text" class="form-control" name="transection" id="transection"
                                        placeholder="Transection ID ">
                                </div>
                            </div>
                            <input type="hidden" value="{{ $total_price }}" name="total_price">
                            <input type="hidden" value="{{ $total_item }}" name="total_item">
                            <button class="btn_3" type="submit">Proceed to Place Order</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
</main>
@endsection