@extends('layouts.publicMaster')

@section('title', 'Edit Password')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            <div class="title-wrap">
                <h2 class="section-title">Update Password</h2>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    {{-- Alerts --}}
                    @include('public.partials._alerts')

                    <form method="POST" action="{{ route('public.password.update') }}">
                        @csrf        

                        {{-- Old Password --}}
                        <div class="form-group row">
                            <label for="oldPassword" class="col-md-4 col-form-label">{{ __('Old Password') }}</label>
                            <div class="col-md-8">
                                <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" required autocomplete="oldPassword" autofocus>

                                @error('oldPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- New Password --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label">{{ __('New Password') }}</label>
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        {{-- Repeat Password --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>
                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="form-group row">
                            <div class="col-12">
                                <ul class="list-inline float-right">
                                    <li class="list-inline-item"><a href="{{ route('public.user.show', Auth::user()->id) }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                    <li class="list-inline-item"><button type="submit" class="btn btn-secondary btn-red" title="Submit">{{ __('Change Password') }}</button></li>
                                </ul>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection