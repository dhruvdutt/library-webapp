@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'resetPassword')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('id','Reader ID') !!}
                    {!! Form::text('id',null,['class'=>'form-control','required']) !!}
                </div>
                <button type="submit" class="btn btn-primary form-control">Reset Password</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop