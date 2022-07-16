<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'aplikasi') }}</title>
	<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/my-login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}" >
</head>
<body class="my-login-page">
    <section class="h-100">
        @yield('content')
    </section>
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/my-login.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}" defer></script>
</body>
</html>
