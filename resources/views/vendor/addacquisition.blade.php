@extends('layouts.nav')
@section('content')
{!! Form::open(array('route'=>'addAcquisition')) !!}
<div class="container">
@include('partials.generate')
</div>
{!! Form::close() !!}
@stop