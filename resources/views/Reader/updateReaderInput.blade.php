@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'updateReader')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                {!! Form::label('readerID','Reader ID') !!}
                {!! Form::text('readerID',null,['class'=>'form-control','required']) !!}
            </div>
            <button type="submit" class="btn btn-primary form-control">Proceed</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop