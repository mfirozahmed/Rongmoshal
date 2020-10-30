@extends('frontend.user')

@section('content')

<div class="slider-area">
    <div class="single-slider slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-details section-padding30">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8" style="padding-left: 80px">
                    <h3>Please fill up all the information</h3>
                    @include('frontend.partials.message')
                    <form class="row contact_form" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="col-md-12 form-group p_star">
                            <input id="name" type="text" class="form-control" value="" name="name" placeholder="Name" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input id="number" type="text" class="form-control" value="" name="phone"
                                placeholder="Phone number" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input id="email" type="email" class="form-control" value="" name="email"
                                placeholder="Email Address" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input id="password" type="password" class="form-control" @error('password') is-invalid
                                @enderror value="" name="password" placeholder="Password" required />

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input id="password_confirmation" type="password" class="form-control"
                                @error('password_confirmation') is-invalid @enderror value=""
                                name="password_confirmation" placeholder="Confirm Password" required />

                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <textarea id="address" class="form-control" name="address" rows="1"
                                placeholder="Address"></textarea>
                        </div>
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" value="submit" class="btn_3">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4" style="padding-left: 100px; padding-top:100px">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>Already Have an Acoount?</h2>
                            <p>Welcome Back. Login to your Account.</p>
                            <a href="{{ route('login') }}" class="btn_3">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection