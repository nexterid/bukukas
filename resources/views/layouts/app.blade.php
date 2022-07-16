<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
    	<title>{{ config('app.name', 'aplikasi') }}</title>
		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
		<!-- Switchery css -->
		{{-- <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" /> --}}
		<!-- Bootstrap CSS -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- DATA TABLES -->
		<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- Custom CSS -->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datepicker/datepicker3.css') }}" >
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datepicker/bootstrap-datetimepicker.min.css') }}" >
		<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}" >

</head>
<body class="adminbody">
<div id="main">
	@include('layouts.partials.header')
	@include('layouts.partials.sidebar')
    <div class="content-page">
		<!-- Start content -->
		@yield('content')
		<!-- END content -->
    </div>
	<!-- END content-page -->
	<footer class="footer">
		<span class="float-right">
			Powered by <a target="_blank" href="https://nexterweb.id"><b>Nexterweb.id</b></a>
		</span>
	</footer>
</div>
{{-- <script src="{{ asset('assets/js/jQuery-2.1.4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/modernizr.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/detect.js') }}"></script>
<script src="{{ asset('assets/js/fastclick.js') }}"></script>
{{-- <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script> --}}
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
{{-- <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/toastr.min.js') }}" defer></script>
<!-- App js -->
<script src="{{ asset('assets/js/pikeadmin.js') }}"></script>
</body>
</html>
