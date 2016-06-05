@extends('layouts.student_nav')
@section('content')
    @include('errors.list')
    <div class="container box">
        @if(sizeof($records) == 0)
          <div class="text-center">
            <h3>No Records</h3>
            <p>When you issue a book the record will appear here.</p>
          </div>
        @else
        <div class="row">
            <div class="col s12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Returned Date</th>
                        <th>Fine (&#8377;)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->isbn }}</td>
                            <td>{{ $record->author }}</td>
                            <td>{{ $record->title }}</td>
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
@stop
