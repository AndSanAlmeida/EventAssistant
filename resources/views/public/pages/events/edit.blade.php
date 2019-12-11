@extends('layouts.publicMaster')

@section('title', 'Edit Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            <div class="title-wrap">
                <h2 class="section-title">Update Event</h2>
            </div>

            <div class="row">
                <div class="col-md-10 offset-md-1">

                    {{-- Alerts --}}
                    @include('public.partials._alerts')

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
                                            required
                                            placeholder="Ex: Michael and Julia" 
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
                                            value="{{ old('hour') ?? date('h:i', strtotime($event->hour)) }}"
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
                                    <label for="active" class="col-md-2 col-form-label">Status</label>
                                    <div class="col-md-4">
                                        <select id="active" name="active" class="form-control {{ $errors->has('hour') ? ' is-invalid' : '' }}" >
                                            <option value="1" @if ($event->active == '1') selected @endif>Active</option>
                                            <option value="0" @if ($event->active == '0') selected @endif>Inactive</option>   
                                        </select>
                                        @if ($errors->has('active'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('active') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="form-group row">
                                    <div class="col-12">
                                        <ul class="list-inline float-right">
                                            <li class="list-inline-item"><a href="{{ route('public.dashboard') }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            <li class="list-inline-item"><button type="submit" class="btn btn-secondary btn-red" title="Submit">Save Changes</button></li>
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
                                                        <td>
                                                            <img class="rounded" src="{{ ($file->getExtension($file->file) == 'pdf') ? asset('img/pdf.png') : asset('storage/'.$file->file)}}" title="{{ $file->caption }}" height="150">
                                                        </td>
                                                        <td>{{ $file->caption }}</td>
                                                        <td>
                                                            <li class="list-inline-item">
                                                                <a href="{{ route('public.files.edit', $file) }}" class="text-cyan" data-toggle="tooltip" title="Update"><i class="far fa-edit"></i></a>
                                                            </li>
                                                            <li class="list-inline-item" data-toggle="modal" data-target="#deleteModalFile" >
                                                                <a href="javascript:;" 
                                                                    class="text-red" 
                                                                    data-toggle="tooltip" 
                                                                    title="Delete"
                                                                    onclick="deleteFileData({{$file->id}})">
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

                                    {{-- Actions --}}
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <ul class="list-inline float-right">
                                                <li class="list-inline-item"><a href="{{ route('public.dashboard') }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            </ul>
                                        </div>
                                    </div>

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
                                                                <a href="{{ route('public.localizations.edit', $localization) }}" class="text-cyan" data-toggle="tooltip" title="Update"><i class="far fa-edit"></i></a>
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

                                    {{-- Actions --}}
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <ul class="list-inline float-right">
                                                <li class="list-inline-item"><a href="{{ route('public.dashboard') }}" class="btn btn-secondary btn-orange" title="Back">Back</a></li>
                                            </ul>
                                        </div>
                                    </div>

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
<div class="modal fade" id="deleteModalFile" tabindex="-1" role="dialog" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFileModalLabel">Delete!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">You really want to delete this file?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-orange" type="button" data-dismiss="modal">Cancel</button>
                <form id="deleteFileForm" action="" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary btn-red" data-dismiss="modal" onclick="formSubmitFile()">
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
            <div class="modal-body">You really want to delete this localization?</div>
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

    // DATE
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    document.getElementById("date").min = today;

    // FILES
    function deleteFileData(id) {
         var id = id;
         var url = '{{ route('public.files.destroy', ":id") }}';
         url = url.replace(':id', id);
         $("#deleteFileForm").attr('action', url);
    }

    function formSubmitFile(){
        $("#deleteFileForm").submit();
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