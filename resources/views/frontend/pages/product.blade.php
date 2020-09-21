@extends('layouts.user')

@section('styles')
<style>
    .img-center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
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
                            <h2>Jewellery Shop</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End-->
    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <img src="/storage/images/{{ $product->image}}" class="img-center">
                </div>
                <div class="col-lg-8">
                    <div class="single_product_text text-center">
                        <h3>{{ $product->name}}</h3>
                        <p>
                            {{ $product->description}}
                        </p>
                        <p>
                            <h4>{{ $product->price }} TK</h4>
                        </p>

                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <div class="card_area">
                                <div class="product_count_area">
                                    <p>Quantity</p>
                                    <div class="product_count">
                                        <input class="form-control" name="quantity" type="number" value="1" min="1"
                                            max="100">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <button type="submit" class="btn_3">Add to Cart</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

{{--  --}}