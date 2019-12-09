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
                <div class="col-md-10 offset-md-1">

                    <form action="{{ route('public.files.update', $file->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')

                        {{-- Event ID  --}}
                        <input name="event_id" value="{{ $file->event_id }}" class="d-none" readonly>

                        <div class="row">
                            <div class="col-md-5">
                                {{-- Image --}}
                                <img class="rounded"src="{{ ($file->getExtension($file->file) == 'pdf') ? asset('img/pdf.png') : asset('storage/'.$file->file) }}" alt="{{ $file->caption }}">
                            </div>

                            <div class="col-md-7">

                                <div class="form-group mt-4">
                                    {{-- Caption --}}
                                    <label for="caption">Caption</label>            
                                    <input id="caption"
                                        type="text"
                                        class="form-control {{ $errors->has('caption') ? ' is-invalid' : '' }}"
                                        name="caption"
                                        placeholder="Ex: Event Invite" 
                                        value="{{ old('caption') ?? $file->caption }}"
                                        autocomplete="Caption" autofocus>

                                    @if ($errors->has('caption'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('caption') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group files">
                                    {{-- File --}}
                                    <label for="file">Upload Your File</label>
                                    <input id="file" type="file" name="file" 
                                        class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}">
                                    @if ($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- Actions --}}
                                <div class="form-group row">                          
                                    <div class="col-12">
                                        <ul class="list-inline float-right">
                                            <li class="list-inline-item"><a href="{{ route('public.events.edit', $file->event->id) }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            <li class="list-inline-item"><button class="btn btn-secondary btn-red" title="Submit">Save Changes</button></li>
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