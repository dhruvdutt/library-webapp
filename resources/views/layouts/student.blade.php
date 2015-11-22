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
      {!! Form::open(array('route'=>'search','method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search','id'=>'searchform')) !!}
            <div class="form-group">
              {!! Form::text('search',null,['class'=>'form-control','autocomplete'=>'off','placeholder'=>'Search','id'=>'search']) !!}
              by
              {!! Form::select('type', array('publisher' => 'Publisher', 'author' => 'Author','title'=>'Title'),null,array('class'=>'form-control','id'=>'query')) !!}
            </div>
    {!! Form::close() !!}
      <li><a href="/logout">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    @include('errors.list')
    <div class="container">
        @if(sizeof($records) == 0)
            <h3>No Records</h3>
        @else
        <h3>{{ $welcome_message }}</h3>
        <div class="row">
            <div class="col s12">
                <table class="table">
                    <thead>
                    <tr>
                        <th data-field="name">Accession Number</th>
                        <th data-field="price">Issue Date</th>
                        <th data-field="price">Return Date</th>
                        <th data-field="price">Returned Date</th>
                        <th data-field="price">Fine</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->accession_no }}</td>
                            <td>{{ $record->issuedate }}</td>
                            <td>{{ $record->returndate }}</td>
                            @if ($record->returneddate == null)
                                <td>-</td>
                            @else
                                <td>{{ $record->returneddate }}</td>
                            @endif
                            @if ($record->fine == null)
                                <td>-</td>
                            @else
                                <td>{{ $record->fine }}</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Change Password</h4>
            <div class="row">
                {!! Form::open(array('route'=>'addReader')) !!}
                <div class="row">
                    <div class="input-field col s12">
                        {!! Form::label('currentpassword','Current Password') !!}
                        {!! Form::password('currentpassword',null,['class'=>'validate']) !!}
                    </div>
                    <div class="input-field col s12">
                        {!! Form::label('newpassword','New Password') !!}
                        {!! Form::password('newpassword',null,['class'=>'validate']) !!}
                    </div>
                    <div class="input-field col s12">
                        {!! Form::label('confirmpassword','Confirm Password') !!}
                        {!! Form::password('confirmpassword',null,['class'=>'validate']) !!}
                    </div>
                    <button type="submit" class="btn waves-effect waves-light">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
@stop
