@extends('layouts.nav')
@section('content')
    <div class="container">
        {!!  Form::model($accession,['method'=>'PATCH','route'=>['updateAccession']]) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('accession_no','Accession Number') !!}
                    {!! Form::text('accession_no',null,['class'=>'form-control','disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('class_no','Class Number') !!}
                    {!! Form::text('class_no',null,['class'=>'form-control','disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('status','Status') !!}
                    {!! Form::select('status', array('available' => 'Available', 'weedout' => 'Weed Out', 'missing' => 'Missing'),null,array('class'=>'form-control')) !!}
                </div>
                <button type="submit" class="btn btn-primary form-control">Proceed</button>
            </div>
        </div>
        
        {!! Form::close() !!}
    </div>
@stop