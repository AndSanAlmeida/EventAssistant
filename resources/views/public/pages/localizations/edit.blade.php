@extends('layouts.publicMaster')

@section('title', 'Edit Localization')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            {{-- Alerts --}}
            @include('public.partials._alerts')

            <div class="title-wrap">
                <h2 class="section-title">Update Localization</h2>
            </div>

            <div class="row">
                <div class="col-md-10 offset-md-1">

                    <form action="{{ route('public.localizations.update', $localization) }}" enctype="form-data" method="POST">
                        @csrf
                        @method('PATCH')
                                
                        {{-- Localization Name --}}
                        <div class="form-group row">
                            <label for="localization" class="col-md-2 col-form-label">Localization</label>
                            <div class="col-md-10">
                                <input id="localization"
                                    type="text"
                                    class="form-control {{ $errors->has('localization') ? ' is-invalid' : '' }}"
                                    name="localization"
                                    value="{{ old('localization') ?? $localization->localization}}"
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
                                    value="{{ old('latitude') ?? $localization->latitude }}"
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
                                    value="{{ old('longitude') ?? $localization->longitude}}"
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
                                    <li class="list-inline-item"><a href="{{ route('public.events.edit', $localization->event->id) }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                    <li class="list-inline-item"><button class="btn btn-secondary btn-red" title="Submit">Save Changes</button></li>
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