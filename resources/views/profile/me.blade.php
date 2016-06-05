@extends('layouts.student_nav')
@section('content')
    @include('errors.list')
    <div class="container box">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <h6>ID : {{$reader->id}} </h6>
          <h6>Name : {{$reader->name}} </h6>
          <h6>Department : {{strtoupper($reader->department)}} </h6>
          <h6>Year : {{strtoupper($reader->year)}} </h6>
          
        </div>
        <div class="col-md-4">
          <h6>Issue Limit <span class="text-muted">(No of Books)</span> : {{$restriction->books_for_issue}}</h6>
          <h6>Issue Limit <span class="text-muted">(No of Days)</span> : {{$restriction->days}}</h6>
          <h6>Fine per day : &#8377;{{$restriction->fine}}</h6>
          <!--{!! Form::text('confirmpassword',null,['class'=>'form-control','autocomplete'=>'off','placeholder'=>'Confirm Password','id'=>'confirmpassword']) !!}
          {!! Form::text('newpassword',null,['class'=>'form-control','autocomplete'=>'off','placeholder'=>'New Password','id'=>'newpassword']) !!}-->
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
@stop
