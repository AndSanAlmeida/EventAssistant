<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>@yield('title') | Auth</title>

		@include('admin.partials._styles')

	</head>	
	<body class="bg-gradient-primary">

  			<div class="container">
  				@yield('content')
  			</div>

		@include('admin.partials._scripts')
	</body>
</html>