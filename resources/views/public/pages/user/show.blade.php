@extends('layouts.publicMaster')

@section('title', 'Profile')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            {{-- Alerts --}}
            @include('public.partials._alerts')

            <div class="title-wrap">
                <h2 class="section-title">Profile</h2>
            </div>
            
            <div class="row">
                <div class="col-sm-3 offset-sm-2">
                    <img class="rounded" src="{{ $user->profileImage() }}" alt="Profile Image">
                </div>
                <div class="col-sm-7">
                    <p><strong class="pr-1">Name: </strong>{{ $user->name }}</p>
                    <p><strong class="pr-1">Email: </strong>{{ $user->email }}</p>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="btn btn-secondary btn-red" href="{{ route('public.user.edit') }}" title="Edit Profile">Edit Profile</a></li>
                        <li class="list-inline-item"><a class="btn btn-secondary btn-red" href="{{ route('public.password.edit') }}" title="Change Password">Change Password</a></li>
                    </ul>       
                </div>
            </div>
        </div>
    </div>   
</section>

@endsection