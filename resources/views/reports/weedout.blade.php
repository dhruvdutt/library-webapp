@extends('layouts.nav')
@section('content')
<div class="container">
	@if(sizeof($datas) == 0)
		<h3>No Records</h3>
	@else
		<div class="row">
	        <div class="col s12">
	           	<table class="table sortable-theme-bootstrap" data-sortable>
	                <thead>
	                    <tr>
	                        <th data-field="name" data-sortable="false">Accession Number</th>
                          <th data-field="name" data-sortable="false">Class Number</th>
	                        <th data-field="price">Status</th>
	                        <th data-field="price">Date</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach ($datas as $data)
	                        <tr>
	                            <td>{{ $data->accession_no }}</td>
	                            <td>{{ $data->class_no }}</td>
	                            <td>{{ $data->status }}</td>
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
