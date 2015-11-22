@extends('layouts.nav')
@section('content')
    <div class="container">
        {!!  Form::model($reader,['method'=>'PATCH','route'=>['update',$reader->id]]) !!}
        @include('partials.reader')
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary form-control">Update</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop