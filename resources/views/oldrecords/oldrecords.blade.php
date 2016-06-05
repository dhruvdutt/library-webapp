@extends('layouts.nav')
@section('content')
<div class="container box" ng-controller="OldRecordsController">
  <table class="table">
    <thead>
      <tr>
          <th>Reader ID</th>
          <th>Name</th>
          <th>Year</th>
          <th>Department</th>
          <th>Year Enrolled</th>
      </tr>
    </thead>
    <tbody>
      @foreach($records as $record)
      <tr>
        <td>{{ $record->id }}</td>
        <td>{{ $record->name }}</td>
        <td>{{ $record->year }}</td>
        <td>{{ $record->department }}</td>
        <td>{{ $record->year_enrolled }}</td>
        {!! Form::open(array('route'=>'generatereports','novalidate')) !!}
          <input type="hidden" name="readerTitle" value="{{$record->id}}">
          <input type="hidden" name="type" value="old_circulation_reader">
          <td><button type="submit" class="btn btn-primary btn-xs">Circulation Reports</button></td>
        {!! Form::close() !!}
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
