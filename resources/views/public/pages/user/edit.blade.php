@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <form action="{{ route('public.user.update') }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row mb-4">
          <div class="col-12">
            <h1>Update Profile</h1>
          </div>
        </div>
        <div class="row">
            <div class="col-3">
              <img src="{{ $user->profileImage() }}" class="rounded-circle w-100" width="200px" height="200px">
            </div>
            <div class="col-9">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Name</label>

                    <input id="name"
                           type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name"
                           value="{{ old('name') ?? $user->name }}"
                           autocomplete="Name" autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label">Email</label>

                    <input id="email"
                           type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email"
                           value="{{ old('email') ?? $user->email }}"
                           autocomplete="Email" autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <label for="avatar" class="col-md-4 col-form-label">Profile Image</label>

                    <input type="file" class="form-control-file" id="avatar" name="avatar">

                    @if ($errors->has('avatar'))
                        <strong>{{ $errors->first('avatar') }}</strong>
                    @endif
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                    <a href="{{ route('public.user.show', $user->id) }}" class="btn btn-secondary">Back</a>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection