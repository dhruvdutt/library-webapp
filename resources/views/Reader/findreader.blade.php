@extends('layouts.nav')
@section('content')
<div class="container">
{!! Form::open(array('route'=>'findreader')) !!}
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 box">
            <div class="form-group">
              <div>
                {!! Form::label('readerTitle','Reader Name') !!}
                {!! Form::text('readerTitle',null,['class'=>'form-control typeahead','required']) !!}
              </div>
            </div>
            <button type="submit" class="btn btn-primary form-control">Proceed</button>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@stop
