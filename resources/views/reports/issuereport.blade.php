@extends('layouts.nav')
@section('content')
<div class="container">
	@if(sizeof($reports) == 0)
		<h3>No Records</h3>
	@else
		<div class="row box">
			<button class="btn btn-primary" onclick="download('{{$message}}')">Download</button>
	        <div class="col-lg-12" id="report">
	           	<table class="table">
	                <thead>
	                    <tr>
	                    		<th>Reader ID</th>
													<th>Name</th>
													<th>Year</th>
													<th>Year Enrolled</th>
	                        <th>Accession Number</th>
													<th>ISBN</th>
													<th>Title</th>
													<th>Author</th>
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
															<td>{{ $report->year }}</td>
															<td>{{ $report->year_enrolled }}</td>
	                            <td>{{ $report->accession_no }}</td>
															<td>{{ $report->isbn }}</td>
															<td>{{ $report->title }}</td>
															<td>{{ $report->author }}</td>
	                            <td>{{ $report->issuedate }}</td>
	                            <td>{{ $report->returndate }}</td>
	                            @if ($report->returneddate == null)
	                                <td>-</td>
	                            @else
	                                <td>{{ $report->returneddate }}</td>
	                            @endif
	                            @if ($report->fine == null)
	                                <td>-</td>
	                            @else
	                                <td>{{ $report->fine }}</td>
	                            @endif
	                        </tr>
	                    @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
    @endif
</div>
@stop
