@extends('layouts.nav')
@section('content')
<div class="container box">
@if(sizeof($serials)==0)
	<h2>No Records</h2>
@else
	<table class="table">
		<thead>
			<tr>
				<th>Serial No.</th>
				<th>ISSN</th>
				<th>Title</th>
				<th>Frequency</th>
			</tr>
		</thead>
		<tbody>
		@foreach($serials as $serial)
			<tr>
				<td>{{$serial->serial_no}}</td>
				<td>{{$serial->issn}}</td>
				<td>{{$serial->title}}</td>
				<td>{{$serial->frequency}}</td>
				<td>
					<a class="btn btn-primary btn-xs" href="/cataloging/serial/update/{{$serial->serial_no}}">Update</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endif
</div>
@stop
