@extends('layouts.app')

@section('title', 'Profile')

@section('content')
	<div class="container">

		<div class="row mb-4">
          <div class="col-12">
            <h1>Profile</h1>
          </div>
        </div>

		<div class="row">
	        <div class="col-3">
	            <img src="{{ $user->profileImage() }}" class="rounded-circle w-100" width="200px" height="200px">
	        </div>
	        <div class="col-9">
	        	<div class="row">
	        		<label class="mr-2"><b>Name:</b></label>
	        		<p>{{ $user->name }}</p>
	        	</div>
	        	<div class="row">
	        		<label class="mr-2"><b>Email:</b></label>
	        		<p>{{ $user->email }}</p>
	        	</div>
        		<a class="btn btn-primary" href="{{ route('public.user.edit') }}">Edit Profile</a>
				<a class="btn btn-primary" href="{{ route('public.password.edit') }}">Change Password</a>			
			</div>
		</div>		
	</div>	
@endsection