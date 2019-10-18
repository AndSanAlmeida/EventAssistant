<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('admin.partials._head')
	<body id="page-top">
		<!-- Page Wrapper -->
		<div id="wrapper">
			@include('admin.includes.sidebar')
			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">
				<!-- Main Content -->
				<div id="content">
					@include('admin.includes.topbar')
					<!-- Begin Page Content -->
					<div class="container-fluid">

						{{-- Alert Messages --}}
						@include('admin.partials._alerts')
						{{-- Main Content  --}}
						@yield('content')

					</div>
					<!-- /.container-fluid -->
				</div>
				<!-- End of Main Content -->
					@include('admin.includes.footer')
			</div>
			<!-- End of Content Wrapper -->
		</div>
		<!-- End of Page Wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>
		@include('admin.partials._scripts')
	</body>
</html>