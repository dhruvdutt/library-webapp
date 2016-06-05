@extends('layouts.nav')
@section('content')
<div class="container">
{!! Form::open(array('route'=>'findvendor')) !!}
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 box">
            <div class="form-group">
                {!! Form::label('vendortitle','Vendor Name') !!}
                {!! Form::text('vendortitle',null,['class'=>'form-control','required','autocomplete'=>'off']) !!}
            </div>
            <button type="submit" class="btn btn-primary form-control">Find</button>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@stop
