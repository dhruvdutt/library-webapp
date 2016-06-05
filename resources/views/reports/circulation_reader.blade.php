@extends('layouts.nav')
@section('content')
	<div class="container box">
@if(sizeof($reports) == 0)
    <h3 class="text-center">No Records</h3>
@else
<button class="btn btn-primary" onclick="download('{{$message}}')">Download</button>
<div id="report">
	<table class="table">
			<thead>
					<tr>
							<th>Reader ID</th>
							<th>Name</th>
							<th>Year</th>
							<th>ISBN</th>
							<th>Title</th>
              <th>Author</th>
							<th>Accession No.</th>
              <th>Issue Date</th>
              <th>Return Date</th>
              <th>Returned Date</th>
              <th>Fine</th>
					</tr>
			 </thead>
					<tbody>
					@foreach ($reports as $report)
							<tr>
									<td>{{ $report->readerid }}</td>
									<td>{{ $report->name }}</td>
									<td>{{ strtoupper($report->year) }}</td>
									<td>{{ strtoupper($report->isbn) }}</td>
									<td>{{ $report->title }}</td>
									<td>{{ $report->author }}</td>
                  <td>{{ $report->accession_no }}</td>
                  <td>{{ $report->issuedate }}</td>
                  <td>{{ $report->returndate }}</td>
                  <td>{{ $report->returneddate }}</td>
                  @if($report->fine)
                    <td>{{ $report->fine }}</td>
                  @else
                    <td>-</td>
                  @endif
							</tr>
					@endforeach
					</tbody>
			</table>
		</div>
@endif
		</div>
@stop
