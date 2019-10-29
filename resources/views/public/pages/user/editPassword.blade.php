@extends('layouts.publicMaster')

@section('title', 'Edit Password')

@section('content')

<section class="main">

    {{-- Alerts --}}
    @include('public.partials._alerts')

    <div class="row gtr-200">
      <div class="col-12">
        <h2>Update Password</h2>
      </div>
    </div>

    <form method="POST" action="{{ route('public.password.update') }}">
        @csrf        

        {{-- Old Password --}}
        <div class="row gtr-uniform">
            <div class="col-2 col-12-small alg-self-center">
                <label for="oldPassword">{{ __('Old Password') }}</label>
            </div>
            <div class="col-6 col-12-small">
                <input id="oldPassword" type="password" class="@error('oldPassword') is-invalid @enderror" name="oldPassword" required autocomplete="oldPassword" autofocus>

                @error('oldPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <br>

        {{-- New Password --}}
        <div class="row gtr-uniform">
            <div class="col-2 col-12-small alg-self-center">
                <label for="password" >{{ __('New Password') }}</label>
            </div>
            <div class="col-6 col-12-small">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> 
        </div>

        <br>

        {{-- Repeat Password --}}
        <div class="row gtr-uniform">
            <div class="col-2 col-12-small alg-self-center">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
            </div>
            
            <div class="col-6 col-12-small">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            {{-- Actions --}}
            <div class="col-12">
                <ul class="actions">
                    <li><button type="submit" class="button primary small" title="Submit">{{ __('Change Password') }}</button></li>
                    <li><a href="{{ route('public.user.show', Auth::user()->id) }}" class="button small" title="Back">Back</a></li>
                </ul>
            </div>
        </div>

    </form>
</section>

@endsection