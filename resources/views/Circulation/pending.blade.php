@extends('layouts.nav')
@section('content')
<div class="container"> 
	{!! Form::open() !!}
		<div class="row">
			<div class="col-md-4"></div>
	        <div class="col-md-4">
	            <div class="form-group">
	                {!! Form::label('readerid','Reader ID') !!}
	               	{!! Form::text('readerid',null,['class'=>'form-control','autocomplete'=>'off','required']) !!}
	            </div>
	        </div>
	        <div class="col-md-4"></div>
	    </div>
	    <div class="row">
	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<button type="button" id="pending" class="btn btn-primary form-control">Get Information</button>
	    	</div>
	    	<div class="col-md-4"></div>
		</div>
	{!! Form::close() !!}
	<br />
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4" id="table">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Department</th>
						<th>Year</th>
						<th>Pending</th>
					</tr>
				</thead>
				<tbody>
					<tr id="pendingdata"></tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-4"></div>
	</div>
	<div id="response" style="text-align:center;color:red"></div>
</div>
@stop