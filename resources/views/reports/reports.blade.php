@extends('layouts.nav')
@section('content')
{!! Form::open(array('route'=>'generatereports')) !!}
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('type','Type') !!}
                {!! Form::select('type', array('issue' => 'Issue Reports', 'fine' => 'Fine Reports','weedout' => 'List of Weed out Publications','missing'=>'List of Missing Publications','acquisition'=>'Acquisition Report'),null,array('class'=>'form-control')) !!}
             </div>
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4" id="vendor"></div>
			<div class="col-md-4"></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="form-group">
                   <label for="issuedatetimepicker" class="control-label">From</label>
                    <div class='input-group date' id='issuedatetimepicker'>
                    {!! Form::text('from',null,['class'=>'form-control','id'=>'issuedatetimepicker','required']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="form-group">
                   <label for="returndatetimepicker" class="control-label">To</label>
                    <div class='input-group date' id='returndatetimepicker'>
                    {!! Form::text('to',null,['class'=>'form-control','id'=>'returndatetimepicker','required']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary form-control">Generate Report</button>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
{!! Form::close() !!}
@stop
