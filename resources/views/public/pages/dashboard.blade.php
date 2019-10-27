@extends('layouts.publicMaster')

@section('title', 'Dashboard')

@section('content')

    <section class="main">
    	<header class="invert accent2">
	    	<h1>Dashboard</h1>
	    </header>

	    @if (session('status'))
	        <div class="alert alert-success" role="alert">
	            {{ session('status') }}
	        </div>
	    @endif
    </section>

@endsection