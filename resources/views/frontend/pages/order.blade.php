@extends('layouts.user')

@section('content')

<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Orders</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ confirmation part start =================-->
    <section class="confirmation_part section_padding">
        <div class="container">
            @if (!count($orders))
            You haven't ordered anything Yet.
            @else
            @foreach ($orders as $order)
            <div class="row" style="margin-top: -100px">
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Order Info</h4>
                        <ul>
                            <li>
                                <p>Order number</p><span>: {{ $order->secret_token_code }}</span>
                            </li>
                            <li>
                                <p>Date</p><span>: {{ $order->created_at->format('d M, Y') }} </span>
                            </li>
                            <li>
                                <p>Total</p><span>: {{ $order->price }} TK</span>
                            </li>
                            <li>
                                <p>Payment Method</p><span>: {{ $order->payment_method }} </span>
                            </li>
                        </ul>
                    </div>
                </div>
                @guest
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>shipping Address</h4>
                        <ul>
                            <li>
                                <p>Name</p><span>: {{ $order->shipping_name }} </span>
                            </li>
                            <li>
                                <p>Phone Number</p><span>: {{ $order->shipping_phone }} </span>
                            </li>
                            <li>
                                <p>Address</p><span>: {{ $order->shipping_address }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Billing Address</h4>
                        <ul>
                            <li>
                                <p>Name</p><span>: {{ $order->user->name }} </span>
                            </li>
                            <li>
                                <p>Phone Number</p><span>: {{ $order->user->phone }} </span>
                            </li>
                            <li>
                                <p>Address</p><span>: {{ $order->user->address }} </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>shipping Address</h4>
                        <ul>
                            <li>
                                <p>Name</p><span>: {{ $order->shipping_name }} </span>
                            </li>
                            <li>
                                <p>Phone Number</p><span>: {{ $order->shipping_phone }} </span>
                            </li>
                            <li>
                                <p>Address</p><span>: {{ $order->shipping_address }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @endguest
                <div class="col-lg-12">
                    <div class="order_details_iner">
                        <h3>Order Details</h3>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->carts as $cart)
                                <tr>
                                    <th colspan="2"><span>{{ $cart->product->name }}</span></th>
                                    <th>x {{$cart->quantity}} </th>
                                    <th> <span>{{ $cart->product->price * $cart->quantity }}</span>
                                    </th>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3">Subtotal</th>
                                    <th> <span>{{ $order->price }}</span></th>
                                </tr>
                                <tr>
                                    <th colspan="3">shipping</th>
                                    <th>
                                        <span>
                                            @if ($order->delivery_method == 'inside')
                                            Free
                                            @else
                                            100 TK
                                            @endif
                                        </span>
                                    </th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">Total Items</th>
                                    <th><span>{{ $order->quantity }}</span></th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">
                                        <span>
                                            @if ($order->delivery_method == 'inside')
                                            {{ $order->price }} TK
                                            @else
                                            {{ $order->price + 100 }} TK
                                            @endif
                                        </span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <br> <br> <br> <br> <br> <br> <br> <br>
            @endforeach
            @endif
        </div>
    </section>
    <!--================ confirmation part end =================-->
</main>

@endsection