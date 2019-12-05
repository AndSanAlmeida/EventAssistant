@extends('layouts.publicMaster')

@section('title', 'Edit File')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            {{-- Alerts --}}
            @include('public.partials._alerts')

            <div class="title-wrap">
                <h2 class="section-title">Update File</h2>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <form action="{{ route('public.files.update', $file) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-5">
                                {{-- Image --}}
                                <img class="rounded" src="" alt="">
                            </div>

                            <div class="col-md-7">
                                
                                

                                {{-- Actions --}}
                                <div class="form-group row">                          
                                    <div class="col-12">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><a href="{{ route('public.events.edit', $file->event->id) }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            <li class="list-inline-item"><button class="btn btn-secondary btn-red" title="Submit">Save File</button></li>
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