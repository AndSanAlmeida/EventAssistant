@extends('layouts.publicMaster')

@section('title', 'Profile')

@section('content')

<section class="main">

    {{-- Alerts --}}
    @include('public.partials._alerts')

    <div class="row gtr-200">
      <div class="col-12">
        <h2>Profile</h2>
      </div>
    </div>

    <div class="row gtr-200">
        <div class="col-3 col-12-small">
            <span class="image fit">
                <img src="{{ $user->profileImage() }}" alt="Profile Image">
            </span>
        </div>
        <div class="col-9 col-12-small">
            <ul class="alt">
                <li><b>Name: </b>{{ $user->name }}</li>
                <li><b>Email: </b>{{ $user->email }}</li>
            </ul>
            <ul class="actions">
                <li><a class="button primary small" href="{{ route('public.user.edit') }}" title="Edit Profile">Edit Profile</a></li>
                <li><a class="button primary small" href="{{ route('public.password.edit') }}" title="Change Password">Change Password</a></li>
            </ul>       
        </div>
    </div>   
</section>

@endsection