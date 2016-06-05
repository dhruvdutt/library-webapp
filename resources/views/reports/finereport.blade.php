@extends('layouts.nav')
@section('content')
	<div class="container box">
	@if(sizeof($reports) == 0)
		<h3 class="text-center">No Records</h3>
	@else
	<button class="btn btn-primary" onclick="download('{{$message}}')">Download</button>
	<div id="report">
	<h5>Total Fine : &#8377;{{ $fine }}</h5>
	<table class="table">
			<thead>
					<tr>
							<th>Reader ID</th>
							<th>Name</th>
							<th>Year</th>
							<th>Fine For</th>
							<th>Amount (&#8377;)</th>
							<th>Date</th>
					</tr>
			 </thead>
					<tbody>
					@foreach ($reports as $report)
							<tr>
									<td>{{ $report->readerid }}</td>
									<td>{{ $report->name }}</td>
									<td>{{ strtoupper($report->year) }}</td>
									<td>{{ strtoupper($report->fine_for) }}</td>
									<td>{{ $report->fine_amount }}</td>
									<td>{{ $report->date }}</td>
							</tr>
					@endforeach
					</tbody>
			</table>
		</div>
		@endif
	</div>
@stop
