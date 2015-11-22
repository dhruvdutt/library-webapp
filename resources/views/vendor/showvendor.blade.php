@extends('layouts.nav')
@section('content')
<div class="container">
@if(sizeof($vendors)==0)
	<h2>No Records</h2>
@else
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Contact</th>
				<th>Address</th>
				<th>Note</th>
			</tr>
		</thead>
		<tbody>
		@foreach($vendors as $vendor)
			<tr>
				<td>{{$vendor->id}}</td>
				<td>{{$vendor->name}}</td>
				<td>{{$vendor->contact}}</td>
				<td>{{$vendor->address}}</td>
				<td>{{$vendor->note}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endif
</div>
@stop
