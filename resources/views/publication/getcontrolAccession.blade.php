@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'controlAccession')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('accession','Book Accession') !!}
                    {!! Form::text('accession',null,['class'=>'form-control','required']) !!}
                </div>
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop