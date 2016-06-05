@extends('layouts.base')
@section('navbar')
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        {!! Form::open(array('route'=>'search','method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search','id'=>'searchform')) !!}
            <div class="form-group">
              {!! Form::text('search',null,['class'=>'form-control','autocomplete'=>'off','placeholder'=>'Search','id'=>'search']) !!}
               by
              {!! Form::select('type', array('publisher' => 'Publisher', 'author' => 'Author','title'=>'Title'),null,array('class'=>'form-control','id'=>'query')) !!}
            </div>
        {!! Form::close() !!}
      <li><a href="/me"><span class="glyphicon glyphicon-user"></span> {{$reader->name}}</a></li>
      <li><a href="/logout">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
@stop
