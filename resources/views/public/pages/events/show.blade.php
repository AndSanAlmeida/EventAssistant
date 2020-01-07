@extends('layouts.publicMaster')

@section('title', 'Show Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            @if ($event->getStatus($event->active) == '1')
                <div class="title-wrap">
                    <h1 class="section-title">{{ $event->name }}</h1>
                    <p class="section-sub-title h2">
                    <i class="fas fa-stopwatch text-cyan"></i>
                    <span class="h4 text-muted">{{ $eventDate->diffForHumans() }}</span>
                </p>
                </div>

                <div class="row">
                    <div class="col-md-10 offset-md-1">

                        {{-- Alerts --}}
                        @include('public.partials._alerts')

                        <h4 class="my-4">General Information</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <p data-toggle="tooltip" title="Click to add Event in Google Calendar">
                                    <strong class="mr-2"><i class="fas fa-calendar-day fa-lg text-red mr-4"></i>Date: </strong>
                                    <a href="#" data-toggle="modal" data-target="#modalGoogleCalendar">
                                        {{ date('F d, Y', strtotime($event->date)) }} 
                                    </a>
                                </p>
                                <p><strong class="mr-2"><i class="far fa-clock fa-lg text-red mr-4"></i>Starting Hour: </strong>{{ date('h:i\h', strtotime($event->hour)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong class="mr-2"><i class="fas fa-toggle-on fa-lg text-red mr-4"></i>Status: </strong>{!! $event->isActive() !!}</p>
                                @if (isset($event->website))
                                    <p><strong class="mr-2"><i class="fas fa-globe fa-lg text-red mr-4"></i>Website: </strong><a href="{{ $event->website }}" target="_blank" title="Website">{{ $event->website }}</a></p>
                                @endif
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
                                            <a href="https://maps.google.com/?q={{ $localization->latitude}}, {{ $localization->longitude}}" target="_blank" data-toggle="tooltip" title="Directions to: {{ $localization->localization}}">
                                                {{ $localization->localization}}
                                            </a>
                                            <small class="mx-4">(<b>Lat. </b>{{ $localization->latitude}}, <b>Long. </b>{{ $localization->longitude}})</small>
                                            <i class="far fa-clock fa-lg text-lightblue mr-4"></i>{{ date('h:i\h', strtotime($event->hour)) }}                                        
                                        </li>
                                    @endforeach
                                    </ul>

                                </div>
                            </div>
                        @endif

                        <h4 class="my-4">Event QR Code</h4>

                        <div class="row">
                            <div class="col-12">
                                <img class="rounded" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->backgroundColor(253,186,81)->color(255,255,255)->generate($event->slug)) !!} " alt="QR Code">
                                <p class="my-4">                                
                                    <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->backgroundColor(253,186,81)->color(255,255,255)->generate($event->slug)) !!}" download="QR Code"><i class="fas fa-file-download fa-lg text-orange mr-4" title="QR Code"></i>Download QR Code</a>
                                </p>
                            </div>
                        </div>

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

<!-- Google Calendar Modal -->
<div class="modal fade" id="modalGoogleCalendar" tabindex="-1" role="dialog" aria-labelledby="modalGoogleCalendarTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fab fa-google"></i>oogle Calendar <i class="far fa-calendar-alt"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="h3">You would like to add this Event to your Google Calendar?</p>
        <ul class="list-unstyled my-4 ml-4">
            <li><b>Event Name: </b>{{ $event->name }}</li>
            <li><b>Starting Time: </b>{{ date('h:i\h', strtotime($event->hour)) }}</li>
            <li><b>Description: </b>Link of this Event</li>
        </ul>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-orange" data-dismiss="modal">No</button>
        <a href="{{ route('public.googlecalendar.create', [$event->id, $event->slug]) }}" class="btn btn-secondary btn-red">Yes</a>
      </div>
    </div>
  </div>
</div>

@endsection