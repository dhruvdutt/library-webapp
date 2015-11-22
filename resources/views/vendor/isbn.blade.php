@extends('layouts.nav')
@section('content')
    <div class="container">
        {!! Form::open(array('route'=>'fetchisbn')) !!}
            @include('partials.acquisition')
        {!! Form::close() !!}
    </div>
@stop