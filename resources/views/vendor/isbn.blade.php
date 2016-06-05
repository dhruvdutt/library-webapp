@extends('layouts.nav')
@section('content')
    <div class="container">
      <div class="col-md-4"></div>
      <div class="col-md-4 box">
        {!! Form::open(array('route'=>'fetchisbn')) !!}
        <div class="form-group">
            {!! Form::label('publication_isbn','Book Title or ISBN') !!}
            {!! Form::text('publication_isbn',null,['class'=>'form-control','required']) !!}
        </div>
        <button type="submit" class="btn btn-primary form-control">Proceed</button>
        {!! Form::close() !!}
      </div>
      <div class="col-md-4"></div>
    </div>
@stop
