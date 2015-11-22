@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'migratereaders')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('from','From') !!}
                    {!! Form::select('from', array('fy' => 'FY', 'sy' => 'SY','ty'=>'TY'),null,array('class'=>'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('to','To') !!}
                {!! Form::select('to', array('fy' => 'FY', 'sy' => 'SY','ty'=>'TY'),null,array('class'=>'form-control')) !!}
            </div>
        <button type="submit" class="btn btn-primary form-control">Update</button>
        </div>
        <div class="col-md-4"></div>
    </div>
        {!! Form::close() !!}
    </div>
@stop