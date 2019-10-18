@extends('layouts.adminMaster')

@section('title', 'Users Permitions')

@section('content')
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Users Permitions</h1>
	</div>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Users Permitions Table</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Role(s)</th>
							<th>Actions</th>					
						</tr>
					</thead>
					<tbody>					
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ implode(' | ', $user->roles()->pluck('name')->toArray()) }}</td>
								<td class="d-flex">									
									<a href="{{ route('admin.users.edit', $user->id) }}">
										<button type="button" class="btn btn-warning btn-circle" title="Edit">
											<i class="fas fa-edit"></i>
										</button>
									</a>
									<form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
										
										@csrf 
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger btn-circle ml-2" title="Delete">
											<i class="fas fa-trash"></i>
										</button>
									</form>
								</td>
							</tr>						
						@endforeach
					</tbody>
				</table>				
			</div>
		</div>
	</div>
@endsection