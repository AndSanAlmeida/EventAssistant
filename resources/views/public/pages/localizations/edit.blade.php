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
                <div class="col-md-8 offset-md-2">

                    <form action="{{ route('public.localizations.update', $localization) }}" enctype="form-data" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12">
                                
                                

                                {{-- Actions --}}
                                <div class="form-group row">                          
                                    <div class="col-12">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><a href="{{ route('public.events.edit', $localization->event->id) }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            <li class="list-inline-item"><button class="btn btn-secondary btn-red" title="Submit">Save Localization</button></li>
                                        </ul>                               
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection