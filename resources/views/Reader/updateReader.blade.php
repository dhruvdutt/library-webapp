@extends('layouts.nav')
@section('content')
    <div class="container">
        {!!  Form::model($reader,['route'=>['updatereader'],'method'=>'PUT']) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 box">
              <div class="form-group">
                  {!! Form::label('id','ID') !!}
                  {!! Form::text('id',null,['class'=>'form-control','required','readonly']) !!}
              </div>
                @include('partials.reader')
                <button type="submit" class="btn btn-primary form-control">Update</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
