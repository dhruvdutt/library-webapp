@extends('layouts.nav')
@section('content')
    <div class="container">
    {!! Form::model($publication,['route'=>['updatePublication'],'method'=>'PUT']) !!}
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 box">
        @include('partials.publication')
        <button type="submit" class="btn btn-primary form-control">Update</button>
      </div>
      <div class="col-md-4"></div>
    </div>
    {!! Form::close() !!}
    </div>
@stop
