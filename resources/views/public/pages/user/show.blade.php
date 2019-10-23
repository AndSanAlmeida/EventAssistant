@extends('layouts.app')

@section('title', 'Profile')

@section('content')
	<div class="container">
		<h1>Profile</h1>
		<div class="row">
	        <div class="col-3 p-5">
	            <img src="{{ $user->profileImage() }}" class="rounded-circle w-100" width="200px" height="200px">
	        </div>
	        <div class="col-9 pt-5">
				<p>Name: {{ $user->name }}</p>
				<p>Email: {{ $user->email }}</p>
				<a href="{{ route('publicAdmin.user.edit', $user->id) }}">Edit Profile</a>
				<a href="{{ route('publicAdmin.user.editPassword', $user->id) }}">Change Password</a>
			</div>
		</div>		
	</div>	
@endsection