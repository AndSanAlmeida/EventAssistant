@extends('layouts.authMaster')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">

	<div class="col-sm-8 col-lg-5">

		<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<div class="col-lg-12">
						<div class="p-5">
							<div class="text-center">
								<h1 class="h4 mb-4">Welcome Back!</h1>
							</div>
							<form class="user" method="POST" action="{{ route('login') }}">
								@csrf

								<div class="form-group">

									<input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required aria-describedby="emailHelp" autocomplete="email" placeholder="Enter Email Address..." autofocus>

									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

								</div>
								<div class="form-group">

									<input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="current-password">

									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

								</div>


								<div class="form-group">
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									  <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
									</div>

									{{-- <div class="custom-control custom-checkbox small">

										<input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

										<label class="custom-control-label" for="remember">
											{{ __('Remember Me') }}
										</label>

									</div> --}}
								</div>

								<button type="submit" class="btn btn-red btn-block">
									{{ __('Login') }}
								</button>

								<hr>

								<a href="{{ route('redirectGoogle') }}" class="btn btn-darkblue btn-block">
									<i class="fab fa-google fa-fw"></i> Login with Google
								</a>

								{{--<a href="index.html" class="btn btn-facebook btn-user btn-block">
									<i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
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

							@if (Route::has('register'))
								<div class="text-center">
									<a class="small" href="{{ route('register') }}">
										{{ __('Create an Account!') }}
									</a>
								</div>
							@endif

							<div class="text-center">
								<a class="small" href="{{ url('/') }}">
									{{ __('Back to Website') }}
								</a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection