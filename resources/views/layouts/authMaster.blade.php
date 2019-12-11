<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>@yield('title', 'Auth') | {{ config('app.name') }}</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		{{-- Styles --}}
		@include('public.partials._styles')

	</head>
	<body>
    	<div class="container">
			{{-- Content --}}
	    	@yield('content')
	    </div>
	    {{-- Scripts --}}
		@include('public.partials._scripts')

	</body>
</html>