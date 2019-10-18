@extends('layouts.adminMaster')

@section('title', 'Manage Users')

@section('content')
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Manage {{ $user->name }} Permitions</h1>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Permitions Available</h6>
				</div>
				<div class="card-body">
					<form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
						
						@csrf
						{{ method_field('PUT') }}

						@foreach ($roles as $role)
							<div class="form-check">
								<input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->hasAnyRole($role->name) ? 'checked': '' }}>
								<label>{{ ucfirst($role->name) }}</label>
							</div>							
						@endforeach

						<button type="submit" class="btn btn-primary btn-icon-split float-right">
							<span class="icon text-white-50">
		                      	<i class="fas fa-arrow-right"></i>
		                    </span>
		                    <span class="text">Submit</span>
						</button>

					</form>						
				</div>
			</div>
		</div>
	</div>
	
@endsection