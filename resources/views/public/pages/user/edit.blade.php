@extends('layouts.publicMaster')

@section('title', 'Edit Profile')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            {{-- Alerts --}}
            @include('public.partials._alerts')

            <div class="title-wrap">
                <h2 class="section-title">Update Profile</h2>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <form action="{{ route('public.user.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-5">
                                {{-- Image --}}
                                <img class="rounded" src="{{ $user->profileImage() }}" alt="Profile Image">
                            </div>

                            <div class="col-md-7">
                                
                                <div class="form-group row">
                                    {{-- Name --}}
                                    <label for="name" class="col-md-2 col-form-label">Name</label>
                                    <div class="col-md-10">              
                                        <input id="name"
                                            type="text"
                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name"
                                            value="{{ old('name') ?? $user->name }}"
                                            autocomplete="Name" autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{-- Email --}}
                                    <label for="email" class="col-md-2 col-form-label">Email</label>
                                    <div class="col-md-10">
                                        <input id="email"
                                            type="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email"
                                            value="{{ old('email') ?? $user->email }}"
                                            autocomplete="Email" autofocus>

                                         @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group form-field-file btn btn-darkblue">
                                    {{-- Profile Image --}}
                                    <label for="avatar"><i class="fas fa-upload"></i>Change Profile Image</label>
                                    <input type="file" id="avatar" name="avatar">

                                    @if ($errors->has('avatar'))
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    @endif
                                </div>

                                {{-- Actions --}}
                                <div class="form-group row">                          
                                    <div class="col-12">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><a href="{{ route('public.user.show', $user->id) }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            <li class="list-inline-item"><button class="btn btn-secondary btn-red" title="Submit">Save Profile</button></li>
                                        </ul>                               
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection