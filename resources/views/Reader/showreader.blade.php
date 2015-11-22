@extends('layouts.nav')
@section('content')
<div class="container">
@if(sizeof($readers)==0)
	<h2>No Records</h2>
@else
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Department</th>
				<th>Year</th>
			</tr>
		</thead>
		<tbody>
		@foreach($readers as $reader)
			<tr>
				<td>{{$reader->id}}</td>
				<td>{{$reader->name}}</td>
				<td>{{$reader->department}}</td>
				<td>{{$reader->year}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endif
</div>
@stop