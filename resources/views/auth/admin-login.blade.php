<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Login</title>

    @include('backend.partials.styles')

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('backend/images/logo1.png') }}" alt="" height="100px" width="190px">
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

    @include('backend.partials.scripts')

</body>

</html>
<!-- end document-->