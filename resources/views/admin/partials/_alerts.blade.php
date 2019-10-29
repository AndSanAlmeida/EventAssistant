@if (session('success'))
	<div class="alert alert-success" role="alert">
	  <h4 class="alert-heading">Well done!</h4>
	  <p>{{ session('success') }}</p>
	</div>
@endif

@if (session('warning'))
	<div class="alert alert-warning" role="alert">
	  <h4 class="alert-heading">Warning!</h4>
	  <p>{{ session('warning') }}</p>
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">Error!</h4>
	  <p>{{ session('error') }}</p>
	</div>
@endif