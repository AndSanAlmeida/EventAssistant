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

		<style type="text/css">
			body:after {
			    position: absolute;
			    content: "";
			    left: 0;
			    top: 0;
			    width: 100%;
			    height: 100%;
			    position: fixed;
			    opacity: 0.8;
			    z-index: -1;
			    background: #f12711;
			    background: linear-gradient(to right, #f5af19, #f12711);
			}
		</style>

	</head>	
	<body class="bg-gradient-primary" style="background-image: url('{{ asset('img/bg.jpg') }}');">

  			<div class="container">
  				@yield('content')
  			</div>

		@include('admin.partials._scripts')
	</body>
</html>