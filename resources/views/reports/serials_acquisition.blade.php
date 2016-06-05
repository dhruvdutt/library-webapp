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
							<th>Vendor Name</th>
							<th>Address</th>
							<th>Contact</th>
              <th>Serial No.</th>
							<th>ISSN</th>
							<th>Title</th>
							<th>Frequency</th>
              <th>Issue Number</th>
              <th>Month</th>
              <th>Year</th>
              <th>Volume</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Purchased Date</th>
              <th>Note</th>
					</tr>
			 </thead>
					<tbody>
					@foreach ($reports as $report)
							<tr>
									<td>{{ $report->name }}</td>
									<td>{{ $report->address }}</td>
									<td>{{ strtoupper($report->contact) }}</td>
                  <td>{{ $report->serial_no }}</td>
									<td>{{ strtoupper($report->issn) }}</td>
									<td>{{ $report->title }}</td>
									<td>{{ $report->frequency }}</td>
                  <td>{{ $report->issue_no }}</td>
                  <td>{{ $report->month }}</td>
                  <td>{{ $report->year }}</td>
                  <td>{{ $report->volume }}</td>
                  <td>{{ $report->quantity }}</td>
                  <td>{{ $report->price }}</td>
                  <td>{{ $report->purchased_date }}</td>
                  @if($report->note)
                    <td>{{ $report->note }}</td>
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
