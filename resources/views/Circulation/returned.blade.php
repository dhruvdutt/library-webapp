@extends('layouts.nav')
@section('content')
    <div class="container">
      @if (sizeof($records) == 0)
        <h3 style="text-align:center">No Records</h3>
      @else
      <table class="table">
          <thead>
          <tr>
              <th data-field="id">Reader ID</th>
              <th data-field="name">Publication ID</th>
              <th data-field="price">Issue Date</th>
              <th data-field="price">Return Date</th>
              <th data-field="price">Returned Date</th>
              <th data-field="price">Fine</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($records as $record)
              <tr>
                  <td>{{ $record->readerid }}</td>
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
      {!! Form::open(array('route'=>'returnedPublication')) !!}
      <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('note','Note') !!}
              {!! Form::text('note',null,['class'=>'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-primary">Return</button>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4"></div>
      </div>
      {!! Form::close() !!}
      @endif
    </div>
@stop