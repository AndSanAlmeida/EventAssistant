@extends('layouts.publicMaster')

@section('title', 'Upload File')

@section('content')

<section class="bg-white topBox-rounded">
	<div class="container">

		<div class="section-content-extra">

			<div class="title-wrap">
				<h2 class="section-title">Upload Files</h2>
			</div>

			<div class="row">
				<div class="col-md-8 offset-md-2">

					{{-- Alerts --}}
                    @include('public.partials._alerts')

					<form action="{{ route('public.files.store') }}" enctype="multipart/form-data" method="POST">
						@csrf

						<input name="event_id" value="{{$event->id}}" class="d-none" readonly>

						<h4 class="my-4">Import Your File</h4>

						{{-- Caption  --}}
						<div class="form-group row">
							<label for="caption" class="col-md-2 col-form-label">Caption</label>
							<div class="col-md-10">
								<input id="caption"
									type="text"
									class="form-control {{ $errors->has('caption') ? ' is-invalid' : '' }}"
									name="caption"
									value="{{ old('caption') }}"
									required
									placeholder="Ex: Event Invite" 
									autocomplete="Caption" autofocus>
								@if ($errors->has('caption'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('caption') }}</strong>
									</span>
								@endif
							</div>							
						</div>

						{{-- File --}}
						<div class="form-group row files">
			                <label for="file" class="col-12 col-form-label">Upload Your File</label>
			                <div class="col-12">
				                <input id="file" 
					                type="file" 
					                name="file" 
					                class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
					                required
					                value="{{ old('file') }}">
				                @if ($errors->has('file'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('file') }}</strong>
									</span>
								@endif
					        </div>
			            </div>

						{{-- Actions --}}
						<div class="form-group row">
							<div class="col-12">
								<ul class="list-inline float-right">
									<li class="list-inline-item"><a href="{{ route('public.dashboard') }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
									<li class="list-inline-item"><button type="submit" class="btn btn-secondary btn-red" title="Submit">Import File</button></li>
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