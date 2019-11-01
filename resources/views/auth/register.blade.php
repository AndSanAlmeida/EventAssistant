{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.authMaster')

@section('title', 'Regiter')

@section('content')

<div class="row justify-content-center">

    <div class="col-sm-12 col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="form-group">

                                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="First and Last Name" autocomplete="name" autofocus>

                                    {{-- Span for Ajax Validation Error --}}
                                    <span id="checkName"></span>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-group">

                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address" autocomplete="email">

                                    {{-- Span for Ajax Validation Error --}}
                                    <span id="checkEmail"></span>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">

                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="new-password">

                                        {{-- Span for Ajax Validation Error --}}
                                        <span id="checkPassword"></span>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="col-sm-6">

                                        <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required placeholder="Repeat Password" autocomplete="new-password">

                                        {{-- Span for Ajax Validation Error --}}
                                        <span id="checkPasswordConfirm"></span>

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Register') }}
                                </button>

                                {{-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> --}}

                            </form>
                            <hr>

                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a class="small" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif

                            @if (Route::has('login'))
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">
                                        {{ __('Already have an account? Login!') }}
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- =============================== --}}
{{-- AJAX for Email and Password --}}
{{-- =============================== --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>

    $("#name").keyup(function(e) {       
        
        var name = e.target.value.length;
        var errorName = 'Name should have more then 2 charaters';

        if(name <= 2) {
            $('#name').attr('class', 'form-control form-control-user is-invalid');
            $('#checkName').attr('class', 'invalid-feedback')
                           .attr('role', 'alert')
                           .html('<strong>' + errorName + '</strong>');
        } else {
            $('#name').attr('class', 'form-control form-control-user');
            $('#checkName').html('');
        }
    });    

    $("#email").keyup(function(e) {       

        var APP_URL = {!! json_encode(url('/')) !!};
        var email = e.target.value;

        $.ajax({
            url: APP_URL + '/api/user/check/' + email,
        }).done(function(response) {
            // console.log(response)
            if(response.containsError) {
                $('#email').attr('class', 'form-control form-control-user is-invalid');
                $('#checkEmail').attr('class', 'invalid-feedback')
                                .attr('role', 'alert')
                                .html('<strong>' + response.error + '</strong>');
            } else {
                $('#email').attr('class', 'form-control form-control-user');
                $('#checkEmail').html('');
            }
        });
    });

    $("#password").keyup(function(e) {       
        
        var password = e.target.value.length;
        var errorPassword = 'Password should have more than 7 charaters';

        if(password <= 7) {
            $('#password').attr('class', 'form-control form-control-user is-invalid');
            $('#checkPassword').attr('class', 'invalid-feedback')
                               .attr('role', 'alert')
                               .html('<strong>' + errorPassword + '</strong>');
        } else {
            $('#password').attr('class', 'form-control form-control-user');
            $('#checkPassword').html('');
        }
    });  

    $("#password-confirm").keyup(function(e) {       
        
        var password = e.target.value;
        var errorPasswordConfirm = 'Passwords are different!';

        if(password !== $('#password').val()) {
            $('#password-confirm').attr('class', 'form-control form-control-user is-invalid');
            $('#checkPasswordConfirm').attr('class', 'invalid-feedback')
                                      .attr('role', 'alert')
                                      .html('<strong>' + errorPasswordConfirm + '</strong>');
        } else {
            $('#password-confirm').attr('class', 'form-control form-control-user');
            $('#checkPasswordConfirm').html('');
        }
    });  
</script>
@endsection