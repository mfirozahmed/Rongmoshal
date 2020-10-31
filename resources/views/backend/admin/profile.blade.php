@extends('backend.admin')

@section('title', 'Profile')

@section('style')
<style>
    .btn_3 {
        display: inline-block;
        padding: 18px 36px;
        border-radius: 5px;
        background-color: transparent;
        border: 1px solid #2577fd;
        font-size: 15px;
        font-weight: 700;
        color: #2577fd;
        text-transform: uppercase;
        font-weight: 400;
        -webkit-transition: .5s;
        -moz-transition: .5s;
        -o-transition: .5s;
        transition: .5s
    }

    .btn_3:hover {
        background-color: #2577fd;
        color: #fff
    }
</style>
@endsection

@section('content')
<div class="page-content--bgf7">
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item">Profile
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout_area section_padding">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        @include('backend.partials.message')
                        <form class="row contact_form" action="{{ route('admin.profile.update') }}" method="get">
                            @csrf
                            <div class="col-md-4 form-group p_star" style="color:#415094">Name</div>
                            <div class="col-md-6 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $token_user->name }}</span>

                            </div>
                            <div class="col-md-4 form-group p_star" style="color:#415094">Email Address</div>
                            <div class="col-md-6 form-group p_star">
                                <span class="form-control"
                                    style="color:#828bb2; padding-top:8px">{{ $token_user->email }}</span>
                            </div>

                            <div class="col-md-12 form-group p_star" style="padding-left: 250px; padding-top: 20px">
                                <button class="btn_3" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box" style="background: #ffff">
                            <img src="{{ asset('backend/images/profile.png') }}" height="350px" width="350px">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>







</div>
@endsection



@section('script')

@endsection