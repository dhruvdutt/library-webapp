@extends('layouts.nav')
@section('content')
{!! Form::open(array('route'=>'generatereports','novalidate')) !!}
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 box">
			<div class="form-group">
				{!! Form::label('type','Type') !!}
        {!! Form::select('type', array('issue' => 'Issue Reports','circulation_reader'=>'Issue Report by Reader','unreturned_publications'=>'Unreturned Publications', 'fine' => 'Fine Reports','fine_reader' => 'Fine Reports by reader','weedout' => 'List of Weed out Publications','missing'=>'List of Missing Publications','publication_acquisition'=>'Publication Acquisition Report','serial_acquisition'=>'Serial Acquisition Report'),null,array('class'=>'form-control')) !!}
				<div id="vendor" style="display:none">
					{!! Form::label('vendortitle','Vendor Name') !!}
					{!! Form::text('vendortitle',null,['class'=>'form-control','required','autocomplete'=>'off']) !!}
				</div>
				<div id="reader" style="display:none">
					{!! Form::label('readerTitle','Reader Name') !!}
					{!! Form::text('readerTitle',null,['class'=>'form-control','required','autocomplete'=>'off']) !!}
				</div>
      </div>
			<div class="form-group">
				 <label for="issuedatetimepicker" class="control-label">From</label>
					<div class='input-group date' id='issuedatetimepicker'>
						{!! Form::text('from',null,['class'=>'form-control','id'=>'issuedatetimepicker','required']) !!}
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
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
