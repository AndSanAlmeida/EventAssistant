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
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach (auth()->user()->events as $event)
						            	<tr>
						                	<td class="align-middle">{{ $event->name }}</td>
						                	<td class="align-middle">{{ date('d, F, Y', strtotime($event->date)) }}</td>
						                	<td class="align-middle">{!! $event->isActive() !!}</td>
						                	<td class="align-middle">
						                		<ul class="list-inline my-0">
						                			<li class="list-inline-item">
						                				<a href="#" class="btn btn-secondary btn-orange btn-sm" title="Details"><i class="far fa-eye"></i> Details</a>
						                			</li>
						                			<li class="list-inline-item">
						                				<a href="#" class="btn btn-secondary btn-cyan btn-sm" title="Update"><i class="far fa-edit"></i> Update</a>
						                			</li>
						                			<li class="list-inline-item">
						                				<a href="#" class="btn btn-secondary btn-red btn-sm" title="Delete"><i class="far fa-trash-alt"></i> Delete</a>
						                			</li>
						                		</ul>
						                	</td>
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

@endsection