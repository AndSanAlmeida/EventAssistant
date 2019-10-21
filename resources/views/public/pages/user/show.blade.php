@extends('layouts.app')

@section('title', 'Profile')

@section('content')
	<div class="container">
		<h1>Profile</h1>
		<div>
			<p>Name: {{ $user->name }}</p>
			<p>Email: {{ $user->email }}</p>
		</div>		
	</div>	
@endsection