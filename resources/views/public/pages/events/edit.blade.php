@extends('layouts.publicMaster')

@section('title', 'Edit Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            {{-- Alerts --}}
            @include('public.partials._alerts')

            <div class="title-wrap">
                <h2 class="section-title">Update Event</h2>
            </div>

            <form action="{{ route('public.events.update', $event) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <h4 class="mb-4">General Information</h4>

                        {{-- Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">              
                                <input id="name"
                                    type="text"
                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name"
                                    value="{{ old('name') ?? $event->name }}"
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
                                    value="{{ old('date') ?? $event->date }}"
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
                                    value="{{ old('hour') ?? $event->hour }}"
                                    required
                                    autocomplete="Name" autofocus>
                                @if ($errors->has('hour'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('hour') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <h4 class="my-4">Files / Localizations</h4>

                        <div class="row">
                            <div class="col-12">

                                {{-- Files / Localizations --}}
                                @if ($event->files->isEmpty() && $event->localizations->isEmpty())
                                    <div class="alert alert-warning" role="alert">
                                        There are no Files and Localizations associated with the event! 
                                        <br> 
                                        <a href="{{ route('public.files.create', $event) }}" class="alert-link mr-4">Click here to Import</a>
                                        <a href="{{ route('public.localizations.create', $event) }}" class="alert-link">Click here to Add</a>
                                    </div>
                                @else

                                    {{-- Files --}}
                                    @if ($event->files->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            There are no Files associated with the event! 
                                            <a href="{{ route('public.files.create', $event) }}" class="alert-link">Click here to Import</a>
                                        </div>
                                    @else
                                        <h5 class="my-4">
                                            <i class="fas fa-file-import fa-lg text-darkblue mr-4"></i>
                                            <a href="#">Manage Localizations</a>
                                        </h5>
                                    @endif
                                    
                                    {{-- Localizations --}}
                                    @if ($event->localizations->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            There are no Localizations associated with the event! 
                                            <a href="{{ route('public.localizations.create', $event) }}" class="alert-link">Click here to Add</a>
                                        </div>
                                    @else
                                        <h5 class="my-4">
                                            <i class="fas fa-map-marked-alt fa-lg text-darkblue mr-4"></i>
                                            <a href="#">Manage Localizations</a>
                                        </h5>
                                    @endif

                                @endif
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="form-group row">
                            <div class="col-12">
                                <ul class="list-inline float-right">
                                    <li class="list-inline-item"><a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                    <li class="list-inline-item"><button type="submit" class="btn btn-secondary btn-red" title="Submit">Save Event</button></li>
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