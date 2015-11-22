@extends('layouts.nav')
@section('content')
<div class="container">
{!! Form::open(array('route'=>'findreader')) !!}
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('readerTitle','Reader Name') !!}
                {!! Form::text('readerTitle',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
    	<div class="col-md-4"></div>
    	<div class="col-md-4">
    		<button type="submit" class="btn btn-primary form-control">Find</button>
    	</div>
    	<div class="col-md-4"></div>
    </div>
</div>
@stop