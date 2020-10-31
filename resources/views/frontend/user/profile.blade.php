@extends('frontend.user')

@section('content')

<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================Checkout Area =================-->
    <section class="checkout_area section_padding">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        @include('frontend.partials.message')
                        <form class="row contact_form" action="{{ route('user.profile.update') }}" method="get">
                            @csrf
                            <div class="col-md-4 form-group p_star" style="color:#415094">Name</div>
                            <div class="col-md-12 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $token_user->name }}</span>

                            </div>
                            <div class="col-md-6 form-group p_star" style="color:#415094">Phone Number</div>
                            <div class="col-md-6 form-group p_star" style="color:#415094">Email Address</div>
                            <div class="col-md-6 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $token_user->phone }}</span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $token_user->email }}</span>
                            </div>
                            <div class="col-md-4 form-group p_star" style="color:#415094">Address</div>
                            <div class="col-md-12 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px; height:100px">{{ $token_user->address }}</span>
                            </div>

                            <div class="col-md-12 form-group p_star" style="padding-left: 250px; padding-top: 20px">
                                <button class="btn_3" type="submit">Update Information</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box" style="background: #ffff">
                            <img src="{{ asset('frontend/img/profile.png') }}" height="350px" width="350px">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
</main>
@endsection