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
							<th>ISBN</th>
							<th>Title</th>
							<th>Author</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>CD</th>
              <th>Purchased Date</th>
					</tr>
			 </thead>
					<tbody>
					@foreach ($reports as $report)
							<tr>
									<td>{{ $report->name }}</td>
									<td>{{ $report->address }}</td>
									<td>{{ strtoupper($report->contact) }}</td>
									<td>{{ strtoupper($report->isbn) }}</td>
									<td>{{ $report->title }}</td>
									<td>{{ $report->author }}</td>
                  <td>{{ $report->quantity }}</td>
                  <td>{{ $report->price }}</td>
                  <td>{{ $report->cd }}</td>
                  <td>{{ $report->purchased_date }}</td>
							</tr>
					@endforeach
					</tbody>
			</table>
		</div>
@endif
		</div>
@stop
