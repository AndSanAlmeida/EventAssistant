@extends('layouts.publicMaster')

@section('title', 'Dashboard')

@section('content')

<section class="bg-white topBox-rounded">
	<div class="container">

		<div class="section-content-extra">

			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif

			@include('public.partials._alerts')

            <div class="title-wrap">
                <h2 class="section-title">Dahsboard</h2>
            </div>

			<div class="row">
				<div class="col-6">
					<p class="h1">List of Events</p>
				</div>
				<div class="col-6">
					<a href="{{ route('public.event.create') }}" class="btn btn-secondary btn-red float-right" ><i class="fas fa-plus"></i>Add New Event</a>
				</div>
			</div>

			<div class="row">
				@if (auth()->user()->getUserEvents()->isEmpty())
					<div class="col-12 mt-4">
						<div class="alert alert-danger" role="alert">
						  	<h4 class="alert-heading">Error!</h4>
						  	<p>There is no events yiet! You must first create one.</p>						  	
						</div>		              					
					</div>
				@else

					<div class="col-12 mt-4">
						<div class="table-responsive">
						    <table class="table table-borderless table-hover">
						        <thead>
						            <tr>
						                <th>Name</th>
						                <th>Date</th>
						                <th>Status</th>
						                <th>Actions</th>
						                <th>Share</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach (auth()->user()->events as $event)
						            	<tr>
						                	<td>{{ $event->name }}</td>
						                	<td>{{ date('F d, Y', strtotime($event->date)) }}</td>
						                	<td>{!! $event->isActive() !!}</td>
						                	<td>
						                		<ul class="list-inline my-0">
						                			<li class="list-inline-item">
						                				<a href="#" class="btn btn-secondary btn-orange btn-sm" title="Details"><i class="far fa-eye"></i> Details</a>
						                			</li>
						                			<li class="list-inline-item">
						                				<a href="#" class="btn btn-secondary btn-cyan btn-sm" title="Update"><i class="far fa-edit"></i> Update</a>
						                			</li>
						                			<li class="list-inline-item">
						                				<a href="javascript:;" 
						                					class="btn btn-secondary btn-red btn-sm" 
						                					title="Delete"
						                					data-toggle="modal" 
						                					data-target="#deleteModal" 
						                					onclick="deleteData({{$event->id}})">
						                					<i class="far fa-trash-alt"></i> Delete
						                				</a>
						                			</li>
						                		</ul>
						                	</td>
						                	<td><a href="#" title="Link"><i class="fas fa-share-alt"></i> Link</a></td>
						            	</tr>
						            @endforeach
						        </tbody>
						    </table>
						</div>
					</div>	
					
				@endif

			</div>
		</div>
	</div>
</section>

<!-- Modal Delete Event -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Delete!</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">You really want do delete this event?</div>
			<div class="modal-footer">
				<button class="btn btn-secondary btn-orange" type="button" data-dismiss="modal">Cancel</button>
				<form id="deleteForm" action="" method="POST">
					@csrf 
					@method('DELETE')
					<button type="submit" class="btn btn-secondary btn-red" data-dismiss="modal" onclick="formSubmit()">
						<span class="text">Delete</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function deleteData(id) {
		 var id = id;
		 var url = '{{ route('public.event.destroy', ":id") }}';
		 url = url.replace(':id', id);
		 $("#deleteForm").attr('action', url);
	}

	function formSubmit(){
	 	$("#deleteForm").submit();
	}
</script>

@endsection