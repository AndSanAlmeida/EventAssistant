@extends('layouts.publicMaster')

@section('title', 'Dashboard')

@section('content')

	<section class="main">

		@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
		@endif

		@include('public.partials._alerts')

		<div class="row gtr-200">
		  <div class="col-12">
			<h2>Dashboard</h2>
		  </div>
		</div>

		<div class="row gtr-uniform">
			<div class="col-6">
				<h4>List of Events</h4>
			</div>
			<div class="col-6 align-right">
				<a href="{{ route('public.event.create') }}" class="button icon small"><i class="fas fa-plus"></i>Add New Event</a>
			</div>
			<div class="col-12">
				<div class="table-wrapper">
				    <table>
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
				                	<td>{{ $event->name }}</td>
				                	<td>{{ $event->date }}</td>
				                	<td>{!! $event->status() !!}</td>
				                	<td>
				                		<ul class="actions no-margin">
				                			<li><a href="#" class="button primary small" title="Details"><i class="far fa-eye"></i> Details</a></li>
				                			<li><a href="#" class="button primary small" title="Update"><i class="far fa-edit"></i> Update</a></li>
				                			<li><a href="#" class="button primary small" title="Delete"><i class="far fa-trash-alt"></i> Delete</a></li>
				                		</ul>
				                	</td>
				            	</tr>
				            @endforeach
				        </tbody>
				    </table>
				</div>
			</div>	   		
		</div>
	</section>

@endsection