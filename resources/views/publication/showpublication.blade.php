@extends('layouts.nav')
@section('content')
<div class="container box">
@if(sizeof($publications)==0)
	<h2>No Records</h2>
@else
	<table class="table">
		<thead>
			<tr>
				<th>ISBN</th>
				<th>Title</th>
				<th>Author</th>
				<th>Publisher</th>
			</tr>
		</thead>
		<tbody>
		@foreach($publications as $publication)
			<tr>
				<td>{{$publication->isbn}}</td>
				<td>{{$publication->title}}</td>
				<td>{{$publication->author}}</td>
				<td>{{$publication->publisher}}</td>
				<td>
					<a class="btn btn-primary btn-xs" href="/cataloging/publication/update/{{$publication->isbn}}">Update</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endif
</div>
@stop
