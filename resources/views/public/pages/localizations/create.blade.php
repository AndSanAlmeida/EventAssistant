@extends('layouts.publicMaster')

@section('title', 'Add Localizations')

@section('content')

<section class="bg-white topBox-rounded">
	<div class="container">

		<div class="section-content-extra">

			<div class="title-wrap">
				<h2 class="section-title">Add New Localization</h2>
			</div>

			@include('public.partials._alerts')

			<form action="{{ route('public.localizations.store') }}" enctype="form-data" method="POST">
				@csrf

				<input name="event_id" value="{{$event->id}}" style="display: none">

				<div class="row">
					<div class="col-md-8 offset-md-2">

						<h4 class="mb-4">General Information</h4>

						{{-- Localization Name --}}
						<div class="form-group row">
							<label for="localization" class="col-md-2 col-form-label">Localization</label>
							<div class="col-md-10">
								<input id="localization"
									type="text"
									class="form-control {{ $errors->has('localization') ? ' is-invalid' : '' }}"
									name="localization"
									value="{{ old('localization') }}"
									required
									placeholder="Ex: Michael Home" 
									autocomplete="Caption" autofocus>
								@if ($errors->has('localization'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('localization') }}</strong>
									</span>
								@endif
							</div>							
						</div>

						<div class="form-group row">

							{{-- Latitude --}}
							<label for="latitude" class="col-md-2 col-form-label">Latitude</label>
							<div class="col-md-4">
								<input id="latitude"
									type="text"
									class="form-control {{ $errors->has('latitude') ? ' is-invalid' : '' }}"
									name="latitude"
									value="{{ old('latitude') }}"
									required
									placeholder="Ex: 38.721711" 
									autocomplete="Name" autofocus>
								@if ($errors->has('latitude'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('latitude') }}</strong>
									</span>
								@endif
							</div>

							{{-- Longitude --}}
							<label for="longitude" class="col-md-2 col-form-label">Longitude</label>
							<div class="col-md-4">
								<input id="longitude"
									type="text"
									class="form-control {{ $errors->has('longitude') ? ' is-invalid' : '' }}"
									name="longitude"
									value="{{ old('longitude') }}"
									required
									placeholder="Ex: -9.136848" 
									autocomplete="Name" autofocus>
								@if ($errors->has('longitude'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('longitude') }}</strong>
									</span>
								@endif
							</div>
						</div>

						{{-- Actions --}}
						<div class="form-group row">
							<div class="col-12">
								<ul class="list-inline float-right">
									<li class="list-inline-item"><a href="{{ route('public.dashboard') }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
									<li class="list-inline-item"><button type="submit" class="btn btn-secondary btn-red" title="Submit">Add Localization</button></li>
								</ul>
							</div>
						</div>

					</div>
				</div>				

			</form>

		</div>
	</div>
</section>

@endsection