@extends('layouts.nav')
@section('content')
    <div class="container">
    {!! Form::open(array('route'=>'issuePublication')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('readerid','Reader ID') !!}
                    {!! Form::text('readerid',$readerid,['class'=>'form-control','autocomplete'=>'off','required','disabled']) !!}
                </div>
            </div>
            <div class="col-md-4"></div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('accession_no','Accession anumber') !!}
                    {!! Form::number('accession_no',null,['class'=>'form-control','autocomplete'=>'off','required']) !!}
                </div>
            </div>
            <div class="col-md-4"></div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="issuedatetimepicker" class="control-label">Issue Date</label>
                    <div class='input-group date' id='issuedatetimepicker'>
                    {!! Form::text('issuedate',$issuedate,['class'=>'form-control','id'=>'issuedatetimepicker']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="returndatetimepicker" class="control-label">Return Date</label>
                    <div class='input-group date' id='returndatetimepicker'>
                    {!! Form::text('returndate',null,['class'=>'form-control','id'=>'returndatetimepicker']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-primary form-control">Issue</button>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
