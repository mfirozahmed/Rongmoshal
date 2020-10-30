@extends('frontend.user')

@section('styles')
<style>
    .btnx {
        background: transparent;
        font-family: "Josefin Sans", sans-serif;
        text-transform: uppercase;
        color: #ff0000;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 0.03em;
        padding: 30px 28px;
        border-radius: 0px;
        display: inline-block;
        line-height: 0;
        cursor: pointer;
        margin-bottom: 0;
        margin: 10px;
        cursor: pointer;
        transition: color 0.4s linear;
        position: relative;
        z-index: 1;
        -moz-user-select: none;
        border: 0;
        overflow: hidden;
        margin: 0;
    }

    .btny {
        background: transparent;
        color: #2577fd;
        font-size: 17px;
        font-weight: 500;
        padding: 30px 28px;
        border-radius: 0px;
        line-height: 0;
        cursor: pointer;
        margin-bottom: 0;
        cursor: pointer;
        transition: color 0.4s linear;
        position: relative;
        z-index: 1;
        -moz-user-select: none;
        border: 0;
        overflow: hidden;
        margin: 0;
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
                            <h2>Cart List</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================Cart Area =================-->
    <section class="cart_area section_padding">
        <div class="container">
            @include('frontend.partials.message')
            <div class="cart_inner">
                <div class="table-responsive">
                    <form method="POST" action="{{ route('cart.update') }}">
                        @csrf
                        @if (count($carts) == 0)
                        <h1> Your Cart is Empty. </h1>
                        @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                    $total_price = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="/storage/images/{{ $cart->product->image }}" alt=""
                                                    width="50px" height="50px" />
                                            </div>
                                            <div class="media-body">
                                                <p>
                                                    <a class="btny" href="/shop/product/{{ $cart->product_id }}">
                                                        {{ $cart->product->name }}
                                                    </a>
                                                    <button class="btnx" type="submit"
                                                        formaction="{{ route('cart.delete', $cart->product_id) }}">(Remove)</button>
                                                </p>
                                                <input type="hidden" name="products[]" value="{{ $cart->product_id }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>&#x9f3; {{ $cart->product->price }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input class="form-control" style="color:#415094; font-size:14px"
                                                name="quantity[]" type="number" value="{{ $cart->quantity }}" min="1"
                                                max="100">
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                        $total_price += $cart->product->price * $cart->quantity;
                                        @endphp
                                        <h5>&#x9f3;{{ $cart->product->price * $cart->quantity }}</h5>
                                    </td>
                                    <td></td>
                                </tr>

                                @endforeach

                                <tr class="bottom_button">
                                    <td>
                                        <button class="btn_1" type="submit"
                                            formaction="{{ route('cart.update') }}">Update</button>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Subtotal</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $total_price }} TK</h5>
                                    </td>
                                </tr>
                                <tr class="shipping_area">
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Shipping</h5>
                                    </td>
                                    <td>
                                        <div class="shipping_box">
                                            <ul class="list">
                                                <li>
                                                    Inside Dhaka City <br> (Free Shipping)
                                                    <input type="radio" value="inside" name="delivery"
                                                        aria-label="Radio button for following text input" checked>
                                                </li>
                                                <li>
                                                    Outside Dhaka City <br> (Standard Courier Charge: 150 TK)
                                                    <input type="radio" value="outside" name="delivery"
                                                        aria-label="Radio button for following text input">
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="checkout_btn_inner float-right">
                            <a class="btn_1" cursor="pointer" href="/shop">Continue Shopping</a>
                            <button class="btn_1" cursor="pointer" type="submit"
                                formaction="{{ route('cart.submit') }}">
                                Proceed to checkout</button>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
</main>>
@endsection