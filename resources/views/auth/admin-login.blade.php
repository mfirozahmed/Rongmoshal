<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <link href="{{asset('coolAdmin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('coolAdmin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('coolAdmin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}"
        rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('coolAdmin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('coolAdmin/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('img/logo/logo1.png') }}" alt="" height="100px" width="190px">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('admin.login.submit') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full @error('email') is-invalid @enderror"
                                        id="email" type="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full @error('password') is-invalid @enderror"
                                        id="password" type="password" name="password" placeholder="Password" required
                                        autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>Remember Me
                                    </label>
                                    <label>
                                        @if (Route::has('password.request'))
                                        <a href="#">Forgotten Password?</a>
                                        @endif
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('coolAdmin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('coolAdmin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('coolAdmin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('coolAdmin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('coolAdmin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('coolAdmin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('coolAdmin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('coolAdmin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('coolAdmin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('coolAdmin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('coolAdmin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('coolAdmin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('coolAdmin/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('coolAdmin/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->