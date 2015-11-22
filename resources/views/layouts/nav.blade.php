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
        <li><a href="/home">Home</a></li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cataloging<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('/publication/add') }}">Add Book</a></li>
            <li><a href="{{ URL::to('/publication/update') }}">Update Book</a></li> 
            <li><a href="{{ URL::to('/publication/accession') }}">Accession Control</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Circulation<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('issuePublication') }}">Issue Book</a></li>
            <li><a href="{{ route('returnPublication') }}">Return Book</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reader Management<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('/reader/add') }}">Add Reader</a></li>
            <li><a href="{{ URL::to('/reader/update') }}">Update Reader</a></li>
            <li><a href="{{ URL::to('/reader/find') }}">Find Reader</a></li>
            <li><a href="{{ URL::to('/reader/migrate') }}">Migrate Readers</a></li>
            <li><a href="{{ URL::to('/reader/resetpassword') }}">Reset Password</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acquisition<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('/vendor/add') }}">Add Vendor</a></li>
            <li><a href="{{ URL::to('/vendor/update') }}">Update Vendor</a></li>
            <li><a href="{{ URL::to('/vendor/find') }}">Find Vendor</a></li>
            <li><a href="{{ URL::to('/acquisition') }}">Add Acquisition Details</a></li>
          </ul>
        </li>
        <li><a href="/reports">Reports</a></li>
        <li><a href="/logout">Logout</a></li>
        {!! Form::open(array('route'=>'search','method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search','id'=>'searchform')) !!}
            <div class="form-group">
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
@stop