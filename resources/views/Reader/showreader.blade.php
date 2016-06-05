@extends('layouts.nav')
@section('content')
<div class="container box">
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
				<td>{{strtoupper($reader->year)}}</td>
				<td><a class="btn btn-primary btn-sm" href="/circulation/issue/{{$reader->id}}">Issue</a>
				<a class="btn btn-primary btn-sm" href="/reader/update/{{$reader->id}}">Update</a>
				<a class="btn btn-danger btn-sm" href="/reader/resetpassword/{{$reader->id}}" id="resetpassword">Reset Password</a></td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endif
</div>
@stop
