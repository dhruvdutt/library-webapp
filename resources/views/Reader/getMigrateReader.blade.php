@extends('layouts.nav')
@section('content')
    <div class="container box">
      {!! $readers->render() !!}
        {!! Form::open(array('route'=>'migratereaders')) !!}
        <table class="table">
          <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Year</th>
          </thead>
          <tbody>
            @foreach($readers as $reader)
            <tr>
              <td>{{ $reader->id }}</td>
              <td>{{ $reader->name }}</td>
              <td>{{ $reader->department }}</td>
              <td>{{ strtoupper($reader->year) }}</td>
              <td><input type="checkbox" name="ids[]" value="{{$reader->id}}" checked /> Migrate</td>
            </tr>
            @endforeach
            <button type="submit" class="btn btn-primary">Migrate</button>
          </tbody>
        </table>
        {!! Form::close() !!}
    </div>
@stop
