@extends('layouts.base')
@section('content')
<dic class="container">
{!! Form::open(array('route'=>'change')) !!}
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 box">
            <div class="form-group">
                {!! Form::label('newpassword','New Password') !!}
                {!! Form::password('newpassword',['class'=>'form-control','required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('confirmpassword','Confirm Password') !!}
                {!! Form::password('confirmpassword',['class'=>'form-control']) !!}
            </div>
            <div id="error_message" style="text-align:center;color:red"></div><br />
            <button type="submit" class="btn btn-primary form-control" id="changepassword">Change</button>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
{!! Form::close() !!}
</div>
@stop
