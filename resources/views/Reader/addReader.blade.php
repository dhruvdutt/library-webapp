@extends('layouts.nav')
@section('content')
<div class="container">
{!! Form::open(array('route'=>'addReader')) !!}
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 box">
      @include('partials.reader')
      <div class="form-group">
        {!! Form::label('year','Year') !!}
        {!! Form::select('year',array('fybca'=>'FYBCA','sybca'=>'SYBCA','tybca'=>'TYBCA','fymsc'=>'FYMSC','symsc'=>'SYMSC','faculty'=>'Faculty'),null,array('class'=>'form-control')) !!}
      </div>
      <button type="submit" class="btn btn-primary form-control">Add</button>
    </div>
    <div class="col-md-4"></div>
  </div>
{!! Form::close() !!}
</div>
@stop
