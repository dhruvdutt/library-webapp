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
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cataloging<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Publications</li>
            <li><a href="{{ URL::to('/cataloging/publication/add') }}"><span class="glyphicon glyphicon-plus"></span> Add Book</a></li>
            <li><a href="{{ URL::to('/cataloging/publication/find') }}"><span class="glyphicon glyphicon-edit"></span> Update Book</a></li>
            <li class="dropdown-header">Serials</li>
            <li><a href="{{ URL::to('/cataloging/serial/add') }}"><span class="glyphicon glyphicon-plus"></span> Add Serial</a></li>
            <li><a href="{{ URL::to('/cataloging/serial/find') }}"><span class="glyphicon glyphicon-edit"></span> Update Serial</a></li>
          </ul>
        </li>
        <li><a href="/reader/find"><span class="glyphicon glyphicon-repeat"></span> Circulation</a></li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-submenu role="button" aria-haspopup="true" aria-expanded="false">Reader<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/reader/add"><span class="glyphicon glyphicon-plus"></span> Add Reader</a></li>
            <li><a href="/reader/find"><span class="glyphicon glyphicon-edit"></span> Update Reader</a></li>
            <li><a href="/reader/find"><span class="glyphicon glyphicon-refresh"></span> Reset Password</a></li>
            <li class="dropdown-submenu">
              <a tabindex="0" href="javascript:void(0)">Migrate Readers</a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">B.C.A.</li>
                <li><a tabindex="0" href="/migrate/fybca"><span class="glyphicon glyphicon-arrow-right"></span> FYBCA</a></li>
                <li><a tabindex="0" href="/migrate/sybca"><span class="glyphicon glyphicon-arrow-right"></span> SYBCA</a></li>
                <li><a tabindex="0" href="/migrate/tybca"><span class="glyphicon glyphicon-arrow-right"></span> TYBCA</a></li>
                <li class="dropdown-header">M.Sc.</li>
                <li><a tabindex="0" href="/migrate/fymsc"><span class="glyphicon glyphicon-arrow-right"></span> FYMSC</a></li>
                <li><a tabindex="0" href="/migrate/symsc"><span class="glyphicon glyphicon-arrow-right"></span> SYMSC</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acquisition<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Publication</li>
            <li><a href="{{ URL::to('/acquisition/publication') }}"><span class="glyphicon glyphicon-plus"></span> Add Acquisition Details</a></li>
            <li class="dropdown-header">Serial</li>
            <li><a href="{{ URL::to('/acquisition/serial') }}"><span class="glyphicon glyphicon-plus"></span> Add Acquisition Details</a></li>
            <li class="dropdown-header">Vendors</li>
            <li><a href="{{ URL::to('/vendor/add') }}"><span class="glyphicon glyphicon-plus"></span> Add Vendor</a></li>
            <li><a href="{{ URL::to('/vendor/find') }}"><span class="glyphicon glyphicon-edit"></span> Update Vendor</a></li>
          </ul>
        </li>
        <li><a href="/reports"><span class="glyphicon glyphicon-list-alt"></span> Reports</a></li>
        <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-backdrop="false" role="button" aria-haspopup="true" aria-expanded="false">Misc.<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a ng-href="#" data-toggle="modal" data-target="#issueRestrictionModal" data-backdrop="false"><span class="glyphicon glyphicon-chevron-right"></span> Issue Restriction</a></li>
                    <li><a href="{{ URL::to('/publication/accession') }}"><span class="glyphicon glyphicon-edit"></span> Accession Control</a></li>
                    <li><a ng-href="#" data-toggle="modal" data-target="#collectFineModal" data-backdrop="false"><span class="glyphicon glyphicon-chevron-right"></span> Collect Fine</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#oldRecordsModal" data-backdrop="false"><span class="glyphicon glyphicon-repeat"></span> Old Records</a></li>
                </ul>
        </li>
        {!! Form::open(array('route'=>'search','method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search','id'=>'searchform')) !!}
            <div class="form-group">
              <span class="glyphicon glyphicon-search"></span>
              {!! Form::text('search',null,['class'=>'form-control','autocomplete'=>'off','placeholder'=>'Search','id'=>'search']) !!}
              by
              {!! Form::select('type', array('publisher' => 'Publisher', 'author' => 'Author','title'=>'Title'),null,array('class'=>'form-control','id'=>'query')) !!}
            </div>
        {!! Form::close() !!}
        <li><a href="/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
@include('errors.list')
@include('partials.modals')
@stop
