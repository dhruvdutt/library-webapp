@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'findpublication')) !!}
            <div class="row">
    			<div class="col-md-4"></div>
        		<div class="col-md-4 box">
            		<div class="form-group">
                	{!! Form::label('publication_isbn','Book Title or ISBN') !!}
                	{!! Form::text('publication_isbn',null,['class'=>'form-control','required']) !!}
            	</div>
            <button type="submit" class="btn btn-primary form-control">Proceed</button>
        		</div>
    			<div class="col-md-4"></div>
			</div>
        {!! Form::close() !!}
    </div>
@stop
