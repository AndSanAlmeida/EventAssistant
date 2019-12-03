@extends('layouts.publicMaster')

@section('title', 'Preview Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            <div class="title-wrap">
                <h1 class="section-title">{{ $event->name }}</h1>
            </div>

            <div class="row">
                <div class="col-md-9 offset-md-1">

                    <h4 class="my-4">General Information</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Date: </strong>{{ date('F d, Y', strtotime($event->date)) }}</p>
                            <p><strong>Start Hour: </strong>{{ date('h:i\h', strtotime($event->hour)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status: </strong>{!! $event->isActive() !!}</p>
                        </div>
                    </div>

                    <h4 class="my-4">Event Files</h4>

                    <div class="row">
                        <div class="col-12">

                            @if ($event->files->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    There are no Files associated with the event.
                                    <a href="{{ route('public.files.create', $event) }}" class="alert-link">Click here to Import</a>
                                </div>
                            @else
                                <div class="eventFiles">
                                @foreach ($event->files as $file)
                                    <div class="eventFiles-item">
                                        <div class="eventFiles-item-wrapper">
                                            <img src="{{ asset('storage/'.$file->file) }}" alt="{{ $file->caption }}" class="rounded">
                                            <div class="eventFiles-info">
                                                <div class="eventFiles-link d-flex justify-content-center">
                                                    <a class="img-pop" data-rel="lightcase" href="{{ asset('storage/'.$file->file) }}" title="{{ $file->caption }}">
                                                        <i class="fas fa-search-plus"></i>                                                
                                                    </a>
                                                </div>
                                                <div class="eventFiles-title">
                                                    <h5>{{ $file->caption }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <h4 class="my-4">Event Localizations</h4>

                    <div class="row">
                        <div class="col-12">
                            @if ($event->localizations->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    There are no Localizations associated with the event.
                                    <a href="{{ route('public.localizations.create', $event) }}" class="alert-link">Click here to Import</a>
                                </div>
                            @else
                                <ul class="list-unstyled">
                                @foreach ($event->localizations as $localization)
                                    <li class="py-2">
                                        <i class="fas fa-map-marker-alt fa-lg text-lightblue mr-4"></i>
                                        <a href="https://www.google.pt/maps/dir//{{ $localization->latitude}},{{ $localization->longitude}}" target="_blank" data-toggle="tooltip" title="Directions to: {{ $localization->localization}}">
                                            {{ $localization->localization}}
                                        </a>
                                        <small class="mx-4">({{ $localization->latitude}}, {{ $localization->longitude}})</small>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('public.dashboard') }}" title="Back" class="float-right">Back</a>
                        </div>
                    </div>

                </div>
            </div>            
            
        </div>
    </div>   
</section>

@endsection