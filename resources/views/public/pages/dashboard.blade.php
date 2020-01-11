@extends('layouts.publicMaster')

@section('title', 'Dashboard')

@section('content')

<section class="bg-white topBox-rounded">
	<div class="container">

		<div class="section-content-extra">

			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif

            <div class="title-wrap">
                <h2 class="section-title">Dashboard</h2>
            </div>

            <div class="row">
            	<div class="col-md-10 offset-md-1">

            		{{-- Alerts --}}
                    @include('public.partials._alerts')
            		
		            <div class="row">
						<div class="col-6">
							<h4 class="my-4">List of Events</h4>
						</div>
						<div class="col-6">
							<a href="{{ route('public.events.create') }}" class="btn btn-secondary btn-red float-right my-4" ><i class="fas fa-plus"></i>Add New Event</a>
						</div>
					</div>

					<div class="row">
						@if (auth()->user()->getUserEvents()->isEmpty())
							<div class="col-12 mt-4">
								<div class="alert alert-danger" role="alert">
								  	<h4 class="alert-heading">Error!</h4>
								  	<p>There is no events yiet! You must first create one.</p>						  	
								</div>		              					
							</div>
						@else
							<div class="col-12 mt-4">
								<div class="table-responsive">
								    <table id="dashboard" class="table table-hover table-borderless">
								        <thead>
								            <tr>
								                <th>Name</th>
								                <th>Date</th>
								                <th>Status</th>
								                <th>Add</th>
								                <th>Actions</th>
								                <th>Link</th>
								            </tr>
								        </thead>
								        <tbody>
								        	@foreach (auth()->user()->events as $event)
								            	<tr>
								                	<td>{{ $event->name }}</td>
								                	<td>{{ date('F d, Y', strtotime($event->date)) }}</td>
								                	<td>{!! $event->isActive() !!}</td>
								                	<td>
								                		<ul class="list-inline my-0">
								                			<li class="list-inline-item">
								                				<a href="{{ route('public.files.create', $event) }}" class="text-darkblue" data-toggle="tooltip" title="Add Files / Images"><i class="fas fa-file-import"></i></a>
								                			</li>
								                			<li class="list-inline-item">
								                				<a href="{{ route('public.localizations.create', $event) }}" class="text-darkblue" data-toggle="tooltip" title="Add Localizations"><i class="fas fa-map-marked-alt"></i></a>
								                			</li>
								                		</ul>
								                	</td>
								                	<td>
								                		<ul class="list-inline my-0">
								                			<li class="list-inline-item">
								                				<a href="{{ route('public.events.index', $event) }}" class="text-orange" data-toggle="tooltip" title="Preview"><i class="far fa-eye"></i></a>
								                			</li>
								                			<li class="list-inline-item">
								                				<a href="{{ route('public.events.edit', $event) }}" class="text-cyan" data-toggle="tooltip" title="Update"><i class="far fa-edit"></i></a>
								                			</li>
								                			<li class="list-inline-item" data-toggle="modal" data-target="#deleteModal" >
								                				<a href="javascript:;" 
								                					class="text-red" 
								                					data-toggle="tooltip" 
								                					title="Delete"
								                					onclick="deleteData({{$event->id}})">
								                					<i class="fas fa-trash-alt"></i>
								                				</a>
								                			</li>
								                		</ul>
								                	</td>
								                	<td>
								                		@if (!is_null($event->transaction->getTransactionStatus()))
								                			<button id="share" class="btn btn-lightblue btn-sm mb-3" data-toggle="tooltip" title="Copy to Clipboard" onclick="CopyToClipboard( '{{ route('public.events.show', ['id'=>$event->id,'slug'=>$event->slug]) }}', true, 'Link is now Copied!')"><i class="fas fa-share-alt"></i> Share</button>
								                		@else
						                					<button data-toggle="modal" data-target="#transactionModal"  class="btn btn-red btn-sm mb-3"><i class="fas fa-money-check-alt"></i> Payment</button>
								                		@endif
													</td>
								            	</tr>
								            @endforeach
								        </tbody>
								    </table>
								</div>
							</div>	
							
						@endif

					</div>

            	</div>
            </div>

		</div>
	</div>
</section>

<!-- Modal Delete Event -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Delete <i class="fas fa-trash-alt"></i></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">You really want do delete this event?</div>
			<div class="modal-footer">
				<button class="btn btn-orange" type="button" data-dismiss="modal">Cancel</button>
				<form id="deleteForm" action="" method="POST">
					@csrf 
					@method('DELETE')
					<button type="submit" class="btn btn-red" data-dismiss="modal" onclick="formSubmit()">
						<span class="text">Delete</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Payment -->
<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="transactionModalLabel">Checkout <i class="fas fa-shopping-cart"></i></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" id="payment-form" action="{{ route('public.transaction.checkout', $event->id) }}">
                @csrf
				<div class="modal-body"> 
					<p><b>To share this event you must first purchase the link access.</b></p>
					<p>Make the purchase? <b class="ml-4">Amount: </b>10€</p>
                    
                    <section>
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>

                    <input id="nonce" name="payment_method_nonce" hidden />

				</div>
			<div class="modal-footer">
				<button class="btn btn-orange" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-red" type="submit"><span>Make Transaction</span></button>
			</div>
            </form>
		</div>
	</div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.21.0/js/dropin.min.js"></script>
<script type="text/javascript">
	function deleteData(id) {
		 var id = id;
		 var url = '{{ route('public.events.destroy', ":id") }}';
		 url = url.replace(':id', id);
		 $("#deleteForm").attr('action', url);
	}

	function formSubmit(){
	 	$("#deleteForm").submit();
	}

	var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";
    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'vault',
        buttonStyle: {
	      size: 'responsive',
	      color: 'blue',
	      shape: 'pill'
	    }
      }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
</script>

@endsection




