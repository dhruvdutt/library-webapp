@extends('layouts.nav')
@section('content')
<div class="container">
	@if(sizeof($reports) == 0)
		<h3>No Records</h3>
	@else
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary" style="float:right" id="download">Download</button><br />
			</div>
		</div>
		<div class="row">
	        <div class="col-md-12" id="report">
	        	<h4>Issue Report</h4>
	           	<table class="table sortable-theme-bootstrap" data-sortable>
	                <thead>
	                    <tr>
	                    	<th data-field="name" data-sortable="false">Reader ID</th>
	                        <th data-field="name" data-sortable="false">Accession Number</th>
	                        <th data-field="price">Issue Date</th>
	                        <th data-field="price">Return Date</th>
	                        <th data-field="price">Returned Date</th>
	                        <th data-field="price">Fine</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach ($reports as $report)
	                        <tr>
	                        	<td>{{ $report->readerid }}</td>
	                            <td>{{ $report->accession_no }}</td>
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
