@extends('layouts.publicMaster')

@section('title', 'Preview Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            <div class="title-wrap">
                <h2 class="section-title">{{ $event->name }}</h2>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <h4 class="mb-4">General Information</h4>

                    <h4 class="mb-4">Event Files</h4>

                    @if ($event->files->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            There are no Files associated with the event.
                            <a href="{{ route('public.files.create', $event) }}" class="alert-link">Click here to Import</a>
                        </div>
                    @else
                        @foreach ($event->files as $file)
                            <!-- Event File -->
                            <div class="eventFiles">
                                <div class="eventFiles-item d-flex justify-content-start align-items-start">
                                    <div class="eventFiles-item-wrapper">
                                        <img src="{{ asset('storage/'.$file->file) }}" alt="{{ $file->caption }}" class="rounded">
                                        <div class="eventFiles-info">
                                            <div class="eventFiles-link d-flex justify-content-center">
                                                <a class="img-pop" data-rel="lightcase" href="{{ asset('storage/'.$file->file) }}" title="{{ $file->caption }}">
                                                    <i class="fas fa-search-plus"></i>                                                
                                                </a>
                                            </div>
                                            <div class="eventFiles-title">
                                                <h4>{{ $file->caption }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <h4 class="mb-4">Event Localizations</h4>

                    @if ($event->localizations->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            There are no Localizations associated with the event.
                            <a href="{{ route('public.localizations.create', $event) }}" class="alert-link">Click here to Import</a>
                        </div>
                    @else
                        @foreach ($event->localizations as $localization)
                            <p>{{ $localization->localization}}</p>
                        @endforeach
                    @endif

                </div>
            </div>            
            
        </div>
    </div>   
</section>

@endsection