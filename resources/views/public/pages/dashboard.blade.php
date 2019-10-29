@extends('layouts.publicMaster')

@section('title', 'Dashboard')

@section('content')

	<section class="main">

		@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
		@endif

		<div class="row gtr-200">
		  <div class="col-12">
			<h2>Dashboard</h2>
		  </div>
		</div>

		<div class="row gtr-uniform">
			<div class="col-12">
				<h4>List of Events</h4>
				<div class="table-wrapper">
			    <table>
			        <thead>
			            <tr>
			                <th>Name</th>
			                <th>Description</th>
			                <th>Price</th>
			            </tr>
			        </thead>
			        <tbody>
			            <tr>
			                <td>One</td>
			                <td>Ante turpis integer aliquet.</td>
			                <td>29.99</td>
			            </tr>
			            <tr>
			                <td>Two</td>
			                <td>Vis ac commodo adipiscing arcu.</td>
			                <td>19.99</td>
			            </tr>
			            <tr>
			                <td>Three</td>
			                <td> Morbi faucibus arcu accumsan.</td>
			                <td>29.99</td>
			            </tr>
			        </tbody>
			        <tfoot>
			            <tr>
			                <td colspan="2"></td>
			                <td>100.00</td>
			            </tr>
			        </tfoot>
			    </table>
			</div>
			</div>	   		
		</div>	

	</section>

@endsection