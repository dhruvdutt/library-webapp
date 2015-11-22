@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'returnPublication')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('readerid','Reader ID') !!}
                    {!! Form::text('readerid',null,['class'=>'form-control','required']) !!}
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('accession_no','Accession Number') !!}
                    {!! Form::text('accession_no',null,['class'=>'form-control','required']) !!}
                </div>
            <div class="button">
                <button type="submit" class="btn btn-primary form-control">Proceed</button>
            </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
