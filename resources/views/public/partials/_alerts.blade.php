@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	  	<h4 class="alert-heading">Well done!</h4>
	  	<p>{{ session('success') }}</p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		 </button>
	</div>
@endif

@if (session('warning'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	  	<h4 class="alert-heading">Warning!</h4>
	  	<p>{{ session('warning') }}</p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  	<h4 class="alert-heading">Error!</h4>
	  	<p>{{ session('error') }}</p>
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	</div>

@endif