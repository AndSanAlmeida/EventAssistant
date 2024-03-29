<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
		<div class="sidebar-brand-icon">
			<i class="fas fa-calendar-alt"></i>
		</div>
		<div class="sidebar-brand-text mx-2">{{ config('app.name') }}</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="{{ route('admin.dashboard') }}">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Content
	</div>

	<li class="nav-item">
		<a class="nav-link" href="#">
		  <i class="fas fa-fw fa-table"></i>
		  <span>Example</span>
		</a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Admin
	</div>

	<li class="nav-item">
		<a class="nav-link" href="{{ route('admin.users.index') }}">
		  <i class="fas fa-fw fa-table"></i>
		  <span>Users Permitions</span>
		</a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->