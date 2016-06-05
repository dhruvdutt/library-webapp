@extends('layouts.nav')
@section('content')
<div class="container box">
	@if(sizeof($datas) == 0)
		<h3>No Records</h3>
	@else
		<div class="row">
			<button class="btn btn-primary" onclick="download('{{$message}}')">Download</button>
	        <div class="col s12" id="report">
	           	<table class="table">
	                <thead>
	                    <tr>
	                        <th>Accession Number</th>
                          <th>Class Number</th>
													<th>ISBN</th>
													<th>Title</th>
													<th>Author</th>
	                        <th>Status</th>
	                        <th>Date</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach ($datas as $data)
	                        <tr>
	                            <td>{{ $data->accession_no }}</td>
	                            <td>{{ $data->class_no }}</td>
															<td>{{ $data->isbn }}</td>
															<td>{{ $data->title }}</td>
															<td>{{ $data->author }}</td>
	                            <td>{{ strtoupper($data->status) }}</td>
	                           	<td>{{ $data->updated_at }}</td>
	                        </tr>
	                    @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
    @endif
</div>
@stop
