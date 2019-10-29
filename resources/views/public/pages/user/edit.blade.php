@extends('layouts.publicMaster')

@section('title', 'Edit Profile')

@section('content')

<section class="main">

  {{-- Alerts --}}
  @include('public.partials._alerts')
  
  <div class="row gtr-200">
    <div class="col-12">
      <h2>Update Profile</h2>
    </div>
  </div>

  <form action="{{ route('public.user.update') }}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PATCH')

      <div class="row gtr-200">

          <div class="col-3 col-12-small">
            <span class="image fit">
              <img src="{{ $user->profileImage() }}" alt="Profile Image">
            </span>

            

          </div>

          <div class="col-9 col-12-small">  
            <div class="row gtr-uniform">

              {{-- Name --}}
              <div class="col-2 alg-self-center">
                <label for="name">Name</label>
              </div>
              <div class="col-10">              
                <input id="name"
                       type="text"
                       class="{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       name="name"
                       value="{{ old('name') ?? $user->name }}"
                       autocomplete="Name" autofocus>

                  @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
              </div>

              {{-- Email --}}
              <div class="col-2 alg-self-center">
                <label for="email">Email</label>
              </div>
              <div class="col-10">
                <input id="email"
                       type="email"
                       class="{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email"
                       value="{{ old('email') ?? $user->email }}"
                       autocomplete="Email" autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>

              <div class="col-12 form-field-file">
              {{-- Profile Image --}}
              <label for="avatar"><i class="fas fa-upload"></i>Change Profile Image</label>
              <input type="file" id="avatar" name="avatar" class="button">

              @if ($errors->has('avatar'))
                  <strong>{{ $errors->first('avatar') }}</strong>
              @endif
            </div>

              <div class="col-12">
                <ul class="actions">
                  <li><button class="button primary button small" title="Submit">Save Profile</button></li>
                  <li><a href="{{ route('public.user.show', $user->id) }}" class="button small" title="Back">Back</a></li>
                </ul>
              </div>

            </div>  
          </div>
      </div>
  </form>
</section>

@endsection