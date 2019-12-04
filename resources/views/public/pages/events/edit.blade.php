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

            <div class="row">
                <div class="col-md-10 offset-md-1">

                    {{-- TABS LINKS --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="event-tab" data-toggle="tab" href="#event" role="tab" aria-controls="event" aria-selected="true">Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">Files</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="localizations-tab" data-toggle="tab" href="#localizations" role="tab" aria-controls="localizations" aria-selected="false">Localizations</a>
                        </li>
                    </ul>
                    {{-- END TABS LINKS --}}

                    {{-- TABS --}}
                    <div class="tab-content" id="myTabContent">
                        {{-- Event Update --}}
                        <div class="tab-pane fade show active" id="event" role="tabpanel" aria-labelledby="event-tab">

                            <form action="{{ route('public.events.update', $event) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PATCH')

                                <h4 class="my-4">General Information</h4>

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

                                {{-- Status --}}
                                <div class="form-group row">
                                    <label for="status" class="col-md-2 col-form-label">Status</label>
                                    <div class="form-group col-md-2">
                                        <select id="status" name="status" class="form-control {{ $errors->has('hour') ? ' is-invalid' : '' }}" >
                                            <option value="1" {{ ($event->active == '1') ? 'selected' : '' }}>
                                                {{ old('status') ?? ($event->active == '1') ? 'Active' : 'Inactive' }}
                                            </option>  
                                            <option value="0" {{ ($event->active == '0') ? 'selected' : '' }}>
                                                {{ old('status') ?? ($event->active == '0') ? 'Active' : 'Inactive' }}
                                            </option>        
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="form-group row">
                                    <div class="col-12">
                                        <ul class="list-inline float-right">
                                            <li class="list-inline-item"><a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            <li class="list-inline-item"><button type="submit" class="btn btn-secondary btn-red" title="Submit">Update Event</button></li>
                                        </ul>
                                    </div>
                                </div>                           

                            </form>

                        </div>
                        {{-- End Event Update --}}
                        {{-- Files Update --}}
                        <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
                            <div class="row">
                                <div class="col-12">

                                    <h4 class="my-4">Manage Files</h4>

                                    {{-- Files --}}
                                    @if ($event->files->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            There are no Files associated with the event! 
                                            <a href="{{ route('public.files.create', $event) }}" class="alert-link">Click here to Import</a>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table id="files" class="table table-hover table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Caption</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($event->files as $file)
                                                    <tr>
                                                        <td><img class="rounded" src="{{ asset('storage/'.$file->file) }}" title="{{ $file->caption }}" height="150"></td>
                                                        <td>{{ $file->caption }}</td>
                                                        <td>
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-cyan" data-toggle="tooltip" title="Update"><i class="far fa-edit"></i></a>
                                                            </li>
                                                            <li class="list-inline-item" data-toggle="modal" data-target="#deleteModalFiles" >
                                                                <a href="javascript:;" 
                                                                    class="text-red" 
                                                                    data-toggle="tooltip" 
                                                                    title="Delete"
                                                                    onclick="deleteData({{$file->id}})">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            </li>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        {{-- End Files Update --}}
                        {{-- Localization Update --}}
                        <div class="tab-pane fade" id="localizations" role="tabpanel" aria-labelledby="localizations-tab">
                            <div class="row">
                                <div class="col-12">

                                    <h4 class="my-4">Manage Localizations</h4>

                                    {{-- Localizations --}}
                                    @if ($event->localizations->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            There are no Localizations associated with the event! 
                                            <a href="{{ route('public.localizations.create', $event) }}" class="alert-link">Click here to Add</a>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table id="localization"  class="table table-hover table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Localization</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($event->localizations as $localization)
                                                    <tr>
                                                        <td>{{ $localization->localization }}</td>
                                                        <td>{{ $localization->latitude }}</td>
                                                        <td>{{ $localization->longitude }}</td>
                                                        <td>
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-cyan" data-toggle="tooltip" title="Update"><i class="far fa-edit"></i></a>
                                                            </li>
                                                            <li class="list-inline-item" data-toggle="modal" data-target="#deleteModalLocalization" >
                                                                <a href="javascript:;" 
                                                                    class="text-red" 
                                                                    data-toggle="tooltip" 
                                                                    title="Delete"
                                                                    onclick="deleteLocalizationData({{$localization->id}})">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            </li>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                              </tbody>
                                            </table>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END TABS --}}

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal Delete Files -->
<div class="modal fade" id="deleteModalFiles" tabindex="-1" role="dialog" aria-labelledby="deleteFilesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFilesModalLabel">Delete!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">You really want do delete this file?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-orange" type="button" data-dismiss="modal">Cancel</button>
                <form id="deleteFilesForm" action="" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary btn-red" data-dismiss="modal" onclick="formSubmitFiles()">
                        <span class="text">Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Localization -->
<div class="modal fade" id="deleteModalLocalization" tabindex="-1" role="dialog" aria-labelledby="deleteLocalizationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLocalizationModalLabel">Delete!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">You really want do delete this localization?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-orange" type="button" data-dismiss="modal">Cancel</button>
                <form id="deleteLocalizationForm" action="" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary btn-red" data-dismiss="modal" onclick="formSubmitLocalization()">
                        <span class="text">Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // FILES
    function deleteFilesData(id) {
         var id = id;
         var url = '{{ route('public.files.destroy', ":id") }}';
         url = url.replace(':id', id);
         $("#deleteFilesForm").attr('action', url);
    }

    function formSubmitFiles(){
        $("#deleteFilesForm").submit();
    }

    // LOCALIZATIONS
    function deleteLocalizationData(id) {
         var id = id;
         var url = '{{ route('public.localizations.destroy', ":id") }}';
         url = url.replace(':id', id);
         $("#deleteLocalizationForm").attr('action', url);
    }

    function formSubmitLocalization(){
        $("#deleteLocalizationForm").submit();
    }
</script>

@endsection