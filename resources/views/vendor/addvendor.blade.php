@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'addVendor')) !!}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 box">
                @include('partials.vendor')
                <button type="submit" class="btn btn-primary form-control">Add</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
