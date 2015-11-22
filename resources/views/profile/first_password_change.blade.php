@extends('layouts.nav')
@section('content')
<dic class="container">
{!! Form::open(array('route'=>'change','id'=>'firsttime')) !!}
<h4 id="message">{{ $welcome_message }}</h4>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('newpassword','New Password') !!}
                {!! Form::password('newpassword',['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('confirmpassword','Confirm Password') !!}
                {!! Form::password('confirmpassword',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div id="passwordmatcherror" style="color:red"></div>
            <button type="submit" class="btn btn-primary form-control">Change</button>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
{!! Form::close() !!}
</div>
@stop
