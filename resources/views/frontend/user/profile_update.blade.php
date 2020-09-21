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
                            <h2>Update Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="checkout_area section_padding">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        @include('partials.message')
                        <form class="row contact_form" action="{{ route('user.profile.submit') }}" method="post">
                            @csrf
                            <div class="col-md-4 form-group p_star" style="color:#415094">Name</div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" value="{{ $token_user->name }}" name="name"
                                    placeholder="Name" />
                            </div>
                            <div class="col-md-6 form-group p_star" style="color:#415094">Phone Number</div>
                            <div class="col-md-6 form-group p_star" style="color:#415094">Email Address</div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="{{ $token_user->phone }}" name="phone"
                                    placeholder="Phone number" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $token_user->email }}</span>
                            </div>
                            <div class="col-md-4 form-group p_star" style="color:#415094">Address</div>
                            <div class="col-md-12 form-group p_star">
                                <textarea class="form-control" name="address"
                                    placeholder="Address">{{ $token_user->address }}</textarea>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" value="" name="password"
                                    placeholder="Password" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" value="" name="new_password"
                                    placeholder="New Password" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" value="" name="confirm_password"
                                    placeholder="Confirm New Password" />
                            </div>
                            <div class="col-md-12 form-group p_star" style="padding-left: 300px; padding-top: 20px">
                                <button class="btn_3" type="submit">Done?</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box" style="background: #ffff; padding-left: 100px; padding-top: 100px">
                            <img src="/storage/images/profile.png" height="350px" width="350px">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
@endsection