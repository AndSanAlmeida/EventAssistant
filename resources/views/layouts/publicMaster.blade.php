<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>@yield('title', 'Home') | {{ config('app.name') }}</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		{{-- Styles --}}
		@include('public.partials._styles')

	</head> 
	{{-- <body data-spy="scroll" data-target="#navbar-nav-header" class="static-layout" style="background-image: url('{{ asset('img/bg.jpg') }}');"> --}}
	<body data-spy="scroll" data-target="#navbar-nav-header" class="static-layout">

		@include('public.partials._toasts')

    	<div class="boxed-page">
			{{-- Header --}}
			@include('public.includes.header')

			{{-- Main Page Content --}}
			@yield('homeContent')

			{{-- Content --}}
		    @yield('content')

	        {{-- Footer --}}
			@include('public.includes.footer')
	    </div>

	    {{-- Scripts --}}
		@include('public.partials._scripts')

		{{-- <script>
			window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
			ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
		</script>
		<script src="https://www.google-analytics.com/analytics.js" async defer></script> --}}
	</body>
</html>