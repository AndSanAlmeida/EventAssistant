@extends('layouts.publicMaster')

@section('title', 'Create Event')

@section('content')

<section class="bg-white topBox-rounded">
	<div class="container">

		<div class="section-content-extra">

			<div class="title-wrap">
				<h2 class="section-title">Create Event</h2>
			</div>

			<div class="row">
				<div class="col-md-10 offset-md-1">

					{{-- Alerts --}}
                	@include('public.partials._alerts')

            		<form action="{{ route('public.events.store') }}" enctype="form-data" method="POST">
						@csrf

						<h4 class="my-4">General Information</h4>

						{{-- Name --}}
						<div class="form-group row">
							<label for="name" class="col-md-2 col-form-label">Name</label>
							<div class="col-md-10">
								<input id="name"
									type="text"
									class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
									name="name"
									value="{{ old('name') }}"
									required
									placeholder="Ex: Michael and Julia" 
									autocomplete="Name" autofocus>
								@if ($errors->has('name'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row">

							{{-- Date --}}
							<label for="date" class="col-md-2 col-form-label">Date</label>
							<div class="col-md-4">
								<input id="date"
									type="date"
									class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
									name="date"
									value="{{ old('date') }}"
									required
									autocomplete="Name" autofocus>
								@if ($errors->has('date'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('date') }}</strong>
									</span>
								@endif
							</div>

							{{-- Hour --}}
							<label for="hour" class="col-md-2 col-form-label">Hour</label>
							<div class="col-md-4">
								<input id="hour"
									type="time"
									class="form-control {{ $errors->has('hour') ? ' is-invalid' : '' }}"
									name="hour"
									value="{{ old('hour') }}"
									required
									autocomplete="Name" autofocus>
								@if ($errors->has('hour'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('hour') }}</strong>
									</span>
								@endif
							</div>
						</div>

						{{-- Website --}}
						<div class="form-group row">
							<label for="website" class="col-md-2 col-form-label">Website</label>
							<div class="col-md-10">
								<input id="website"
									type="url"
									class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}"
									name="website"
									value="{{ old('website') }}"
									placeholder="Ex: http://www.examplepage.com" 
									autocomplete="Website" autofocus>
								<small id="passwordHelpBlock" class="form-text text-muted">
                                  Must have: http:// or https://
                                </small>
								@if ($errors->has('website'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('website') }}</strong>
									</span>
								@endif
							</div>
						</div>	
						
						{{-- Actions --}}
						<div class="form-group row">
							<div class="col-12">
								<ul class="list-inline float-right">
									<li class="list-inline-item"><a href="{{ route('public.dashboard') }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
									<li class="list-inline-item"><button type="submit" class="btn btn-secondary btn-red" title="Submit">Create Event</button></li>
								</ul>
							</div>
						</div>

					</form>

				</div>
			</div>

		</div>
	</div>
</section>

<script>
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  today = yyyy + '-' + mm + '-' + dd;

  document.getElementById("date").min = today;
</script>

@endsection