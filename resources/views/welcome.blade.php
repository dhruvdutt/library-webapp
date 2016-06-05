@extends('layouts.base')
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
      {!! Form::open(array('route'=>'search','method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search','id'=>'searchform')) !!}
            <div class="form-group">
              <span class="glyphicon glyphicon-search"></span>
              {!! Form::text('search',null,['class'=>'form-control','autocomplete'=>'off','placeholder'=>'Search','id'=>'search']) !!}
              by
              {!! Form::select('type', array('publisher' => 'Publisher', 'author' => 'Author','title'=>'Title'),null,array('class'=>'form-control','id'=>'query')) !!}
            </div>
    {!! Form::close() !!}
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
@include('errors.list')
@section('content')
    <div class="container">
      <h4 id="message">{{ $welcome_message }}</h4><br />
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 box">
                {!! Form::open(array('route'=>'sessions.store')) !!}
                <div class="form-group">
                    <span class="glyphicon glyphicon-user"></span>
                    {!! Form::label('userid','Username / ID') !!}
                    {!! Form::text('userid',null,['class'=>'form-control','autocomplete'=>'off','required']) !!}
                </div>
                <div class="form-group">
                    <span class="glyphicon glyphicon-lock"></span>
                    {!! Form::label('password','Password') !!}
                    {!! Form::password('password',['class'=>'form-control','required']) !!}
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@stop
