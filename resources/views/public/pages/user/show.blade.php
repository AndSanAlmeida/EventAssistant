@extends('layouts.publicMaster')

@section('title', 'Profile')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            <div class="title-wrap">
                <h2 class="section-title">Profile</h2>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    {{-- Alerts --}}
                    @include('public.partials._alerts')

                    <div class="row">
                        <div class="col-md-5">
                            <img class="rounded" src="{{ $user->profileImage() }}" alt="Profile Image">
                        </div>
                        <div class="col-md-7">
                            <ul class="list-unstyled mt-4">
                                <li><p><strong>Name: </strong>{{ $user->name }}</p></li>
                                <li><p><strong>Email: </strong>{{ $user->email }}</p></li>
                            </ul>
                            
                            <ul class="list-inline mt-4">
                                <li class="list-inline-item"><a href="{{ url('/') }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                <li class="list-inline-item"><a class="btn btn-secondary btn-red" href="{{ route('public.user.edit') }}" title="Edit Profile">Edit Profile</a></li>
                                <li class="list-inline-item"><a class="btn btn-secondary btn-red" href="{{ route('public.password.edit') }}" title="Change Password">Change Password</a></li>
                            </ul>       
                        </div>
                    </div>

                </div>
            </div>
            
            
        </div>
    </div>   
</section>

@endsection