@extends('layouts.nav')
@section('content')
    <div class="container box" ng-controller="CirculationController">
      <h4 ng-bind="flash_message" style="color:red"></h4>
      <h5>ID : {{$reader->id}}</h4>
      <h5>Name : {{$reader->name}}</h5>
      <h5>Year : {{strtoupper($reader->year)}}</h5>
      @if($issue)
        <button class="btn btn-primary" ng-click="issue=true">Issue</button>
      @else
        <h4 style="color:red">{{$error_message}}</h4>
      @endif
      {!! str_replace('/?', '?', $circulations->render()) !!}
        <table class="table">
          <thead>
            <th>Accession No.</th>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Issue Date</th>
            <th>Return Date</th>
            <th>Returned Date</th>
            <th>Fine (&#8377;)</th>
            <th>Note</th>
          </thead>
          <tbody>
            @if(sizeof($circulations) == 0)
              <tr ng-hide="issue">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>No Records</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            @endif
            <tr ng-show="issue">
              <input type="hidden" ng-model="reader.readerid" ng-value="{{$reader->id}}" ng-init="reader.readerid='{{$reader->id}}'"/>
              <td><input type="text" ng-model="reader.accession_no" class="form-control" placeholder="Accession no." ng-blur="getPublicationInfo(reader.accession_no)" />
              <td ng-bind="isbn"></td>
              <td ng-bind="title"></td>
              <td ng-bind="author"></td>
              <td>{{$issuedate}}</td>
              <td>{{$returndate}}</td>
              <td>-</td>
              <td>-</td>
              <td><input type="text" ng-model="reader.note" class="form-control" placeholder="Note" />
              <td><button class="btn btn-primary" ng-click="issuePublication(reader)">Issue</button></td>
            </tr>

          @foreach($circulations as $circulation)
            <tr>
              <td>{{ $circulation->accession_no }}
              <td>{{ $circulation->isbn }}
              <td>{{ $circulation->title }}
              <td>{{ $circulation->author }}
              <td>{{ $circulation->issuedate }}
              <td>{{ $circulation->returndate }}
              @if($circulation->returneddate)
                <td>{{ $circulation->returneddate }}
              @else
                <td>-</td>
              @endif
              @if($circulation->fine)
                <td>{{ $circulation->fine }}
              @else
                <td>-</td>
              @endif
              @if($circulation->note)
                <td ng-hide="edit">{{ $circulation->note }}
              @else
                <td ng-hide="edit">-</td>
              @endif
              <td><input type="checkbox" ng-model="edit">Edit</td>
              <td ng-show="edit"><input class="form-control" type="text" ng-value="{{$circulation->note}}" ng-model="return.note" /></td>
              <td ng-show="edit"><button class="btn btn-primary btn-xs">Update</button></td>
              @if(!$circulation->returneddate)
                  <td><button ng-click="returnPublication({{$circulation}})" class="btn btn-danger btn-xs">Return</button></td>
              @endif
            </tr>
          @endforeach
        </tbody>
        </table>
    </div>
@stop
