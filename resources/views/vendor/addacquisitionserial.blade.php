@extends('layouts.nav')
@section('content')
{!! Form::open(array('route'=>'addSerialAcquisition')) !!}
<div class="container">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 box">
      <div class="form-group">
          {!! Form::label('serial_no','Serial No') !!}
          {!! Form::text('serial_no',$serial_no,['class'=>'form-control','required','disabled']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('serial_title','Serial Title') !!}
          {!! Form::text('serial_title',$serial_title,['class'=>'form-control','required','disabled']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('vendortitle','Vendor') !!}
          {!! Form::text('vendortitle',null,['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('issueno','Issue No') !!}
          {!! Form::text('issueno',null,['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('volume','Volume') !!}
            {!! Form::number('volume',null,['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('month','Month') !!}
            {!! Form::select('month',array('January'=>'January','February'=>'February','March'=>'March','April'=>'April','May'=>'May','June'=>'June','July'=>'July','August'=>'August','September'=>'September','October'=>'October','November'=>'November','December'=>'December'),null,array('class'=>'form-control','required')) !!}
      </div>
      <div class="form-group">
            {!! Form::label('year','Year') !!}
            {!! Form::number('year','2015',['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('price','Price') !!}
          {!! Form::number('price',null,['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('quantity','Quantity') !!}
            {!! Form::number('quantity',null,['class'=>'form-control','required']) !!}
      </div>
      <button type="submit" class="btn btn-primary form-control">Add</button>
    </div>
    <div class="col-md-4"></div>
</div>
{!! Form::close() !!}
@stop
