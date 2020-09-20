<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>RongMoshal | @yield('title')</title>

    @include('backend.partials.styles')

</head>

<body class="animsition">
    <div class="page-wrapper" style="padding-bottom: 0">

        @include('backend.partials.header_desktop')

        @include('backend.partials.header_mobile')

        <!-- PAGE CONTENT-->
        @yield('content')

        @include('backend.partials.footer')

    </div>

    @include('backend.partials.scripts')

</body>

</html>
<!-- end document-->