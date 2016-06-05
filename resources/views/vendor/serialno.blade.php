@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'fetchserialno')) !!}
            @include('partials.acquisition_serial_inp')
        {!! Form::close() !!}
    </div>
@stop