@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'updatevendor')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                {!! Form::label('id','Vendor ID') !!}
                {!! Form::text('id',null,['class'=>'form-control','required']) !!}
            </div>
            <button type="submit" class="btn btn-primary form-control">Proceed</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
