@extends('layouts.publicMaster')

@section('title', 'Create Event')

@section('content')

<section class="main">
	<div class="row gtr-200">
	  <div class="col-12">
		<h2>Event</h2>
	  </div>
	</div>

	<div class="row gtr-uniform">
		<div class="col-12">
			<h4>Add New Event</h4>
		</div>
	</div>

  <br>

	<form action="{{ route('public.event.store') }}" enctype="form-data" method="POST">
      @csrf

      <div class="col-12">  
        <div class="row gtr-uniform">

          {{-- Name --}}
          <div class="col-2 alg-self-center">
            <label for="name">Name</label>
          </div>
          <div class="col-10">              
            <input id="name"
                   type="text"
                   class="{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   name="name"
                   required
                   autocomplete="Name" autofocus>

              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
          </div>

          {{-- Date --}}
          <div class="col-2 alg-self-center">
            <label for="date">Date</label>
          </div>
          <div class="col-4 col-10-small">
            <input id="date"
                   type="date"
                   class="{{ $errors->has('date') ? ' is-invalid' : '' }}"
                   name="date"
                   required
                   autocomplete="Date" autofocus>

            @if ($errors->has('date'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('date') }}</strong>
                </span>
            @endif
          </div>

          {{-- Hour --}}
          <div class="col-2 alg-self-center">
            <label for="hour">Hour</label>
          </div>
          <div class="col-4 col-10-small">
            <input id="hour"
                   type="time"
                   class="{{ $errors->has('hour') ? ' is-invalid' : '' }}"
                   name="hour"
                   required
                   autocomplete="Hour" autofocus>

            @if ($errors->has('hour'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hour') }}</strong>
                </span>
            @endif
          </div>

          <div class="col-12">
            <ul class="actions float-right">
              <li><a href="{{ route('public.dashboard') }}" class="button button small" title="Back">Back</a></li>
              <li><button class="button primary button small" title="Submit">Create Event</button></li>
            </ul>
          </div>

        </div>  
      </div>
  </form>
</section>

<script>
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  today = mm + '-' + dd + '-' + yyyy;

  document.getElementById("date").min = today;
</script>

@endsection