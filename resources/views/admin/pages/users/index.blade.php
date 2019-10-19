@extends('layouts.adminMaster')

@section('title', 'Users Permitions')

@section('content')
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Users Permitions</h1>
	</div>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Users Permitions Table</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead class="thead-dark">
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
										<button type="button" class="btn btn-warning btn-icon-split btn-sm">
											<span class="icon text-white-50">
												<i class="fas fa-edit"></i>
											</span>											
											<span class="text">Edit Roles</span>
										</button>
									</a>
									<a href="javascript:;" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$user->id}})">
										<button type="button" class="btn btn-danger btn-icon-split btn-sm ml-2 deleteUser">
											<span class="icon text-white-50">
												<i class="fas fa-trash"></i>
											</span>
											<span class="text">Delete</span>
										</button>
									</a>

									<!-- Modal Delete User -->
									<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="deleteModalLabel">Delete!</h5>
													<button class="close" type="button" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-body">You really want do delete this user?</div>
												<div class="modal-footer">
													<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
													<form id="deleteForm" action="" method="POST">
														@csrf 
														@method('DELETE')
														<button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">
															<span class="text">Delete</span>
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>

									<!-- Delete User without Modal -->
									{{-- <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
										@csrf 
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger btn-icon-split btn-sm ml-2" title="Delete">
											<span class="icon text-white-50">
												<i class="fas fa-trash"></i>
											</span>
											<span class="text">Delete</span>
										</button>
									</form> --}}
								</td>
							</tr>						
						@endforeach
					</tbody>
				</table>				
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteData(id) {
			 var id = id;
			 var url = '{{ route('admin.users.destroy', ":id") }}';
			 url = url.replace(':id', id);
			 $("#deleteForm").attr('action', url);
		}

		function formSubmit(){
		 	$("#deleteForm").submit();
		}
  	</script>
@endsection