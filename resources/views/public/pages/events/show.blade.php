@extends('layouts.publicMaster')

@section('title', 'Show Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            @if ($event->getStatus($event->active) == '1')
                <div class="title-wrap">
                    <h1 class="section-title">{{ $event->name }}</h1>
                </div>

                <div class="row">
                    <div class="col-md-10 offset-md-1">

                        <h4 class="my-4">General Information</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong class="mr-2">Date: </strong>{{ date('F d, Y', strtotime($event->date)) }}</p>
                                <p><strong class="mr-2">Start Hour: </strong>{{ date('h:i\h', strtotime($event->hour)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong class="mr-2">Status: </strong>{!! $event->isActive() !!}</p>
                            </div>
                        </div>

                        @if (!$event->files->isEmpty())
                            <h4 class="my-4">Event Files</h4>

                            <div class="row">
                                <div class="col-12">
        
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
                                </div>
                            </div>
                                
                        @endif

                        @if (!$event->localizations->isEmpty())  
                            <h4 class="my-4">Event Localizations</h4>

                            <div class="row">
                                <div class="col-12">
                                        
                                    <ul class="list-unstyled">
                                    @foreach ($event->localizations as $localization)
                                        <li class="py-2">
                                            <i class="fas fa-map-marker-alt fa-lg text-lightblue mr-4"></i>
                                            <a href="https://www.google.pt/maps/dir//{{ $localization->latitude}},{{ $localization->longitude}}" target="_blank" data-toggle="tooltip" title="Directions to: {{ $localization->localization}}">
                                                {{ $localization->localization}}
                                            </a>
                                            <small class="mx-4">(<b>Lat. </b>{{ $localization->latitude}}, <b>Long. </b>{{ $localization->longitude}})</small>
                                        </li>
                                    @endforeach
                                    </ul>

                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            @else

               <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p>This Event isn't Active. Try again later!</p>                            
                        </div>
                    </div>
                </div> 

            @endif                      
            
        </div>
    </div>   
</section>

@endsection