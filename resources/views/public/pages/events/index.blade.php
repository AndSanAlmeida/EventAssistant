@extends('layouts.publicMaster')

@section('title', 'Preview Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">
            <div class="title-wrap">
                <h1 class="section-title">{{ $event->name }}</h1>
                <p class="section-sub-title h2">
                    <i class="fas fa-stopwatch text-cyan"></i>
                    <span class="h4 text-muted">{{ $eventDate->diffForHumans() }}</span>
                </p>
            </div>

            <div class="row">
                <div class="col-md-10 offset-md-1">

                    <h4 class="my-4">General Information</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong class="mr-2"><i class="fas fa-calendar-day fa-lg text-red mr-4"></i>Date: </strong>{{ date('F d, Y', strtotime($event->date)) }}</p>
                            <p><strong class="mr-2"><i class="far fa-clock fa-lg text-red mr-4"></i>Starting Hour: </strong>{{ date('h:i\h', strtotime($event->hour)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong class="mr-2"><i class="fas fa-toggle-on fa-lg text-red mr-4"></i>Status: </strong>{!! $event->isActive() !!}</p>
                            <p><strong class="mr-2"><i class="fas fa-globe fa-lg text-red mr-4"></i>Website: </strong><a href="{{ $event->website }}" target="_blank" title="Website">{{ $event->website }}</a></p>
                        </div>
                    </div>

                    <h4 class="my-4">Event Files</h4>

                    <div class="row">
                        <div class="col-12">

                            @if ($event->files->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    There are no Files associated with the event!
                                    <a href="{{ route('public.files.create', $event) }}" class="alert-link">Click here to Import</a>
                                </div>
                            @else
                                <div class="eventFiles">
                                @foreach ($event->files as $file)
                                    <div class="eventFiles-item">
                                        <div class="eventFiles-item-wrapper">
                                            <img src="{{ ($file->getExtension($file->file) == 'pdf') ? asset('img/pdf.png') : asset('storage/'.$file->file) }}" alt="{{ $file->caption }}" class="rounded">
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
                                    There are no Localizations associated with the event! 
                                    <a href="{{ route('public.localizations.create', $event) }}" class="alert-link">Click here to Add</a>
                                </div>
                            @else
                                <ul class="list-unstyled">
                                @foreach ($event->localizations as $localization)
                                    <li class="py-2">
                                        <i class="fas fa-map-marker-alt fa-lg text-lightblue mr-4"></i>
                                        <a href="https://maps.google.com/?q={{ $localization->latitude}}, {{ $localization->longitude   }}" target="_blank" data-toggle="tooltip" title="Directions to: {{ $localization->localization}}">
                                            {{ $localization->localization}}
                                        </a>
                                        <small class="mx-4">(<b>Lat. </b>{{ $localization->latitude}}, <b>Long. </b>{{ $localization->longitude}})</small>
                                        <i class="far fa-clock fa-lg text-lightblue mr-4"></i>{{ date('h:i\h', strtotime($event->hour)) }}                                        
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <h4 class="my-4">Event QR Code</h4>

                    <div class="row">
                        <div class="col-12">
                            <img class="rounded" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->backgroundColor(253,186,81)->color(255,255,255)->generate(url('/') . '/' . $event->slug)) !!} " alt="QR Code">
                            <p class="my-4">                                
                                <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->backgroundColor(253,186,81)->color(255,255,255)->generate(url('/') . '/' . $event->slug)) !!}" download="QR Code"><i class="fas fa-file-download fa-lg text-orange mr-4" title="QR Code"></i>Download QR Code</a>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ redirect()->back()->getTargetUrl() }}" title="Back" class="float-right">Back</a>
                        </div>
                    </div>

                </div>
            </div>            
            
        </div>
    </div>   
</section>

@endsection