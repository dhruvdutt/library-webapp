@extends('layouts.nav')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 box">
          <h4 class="text-center">Publication Details</h4>
          <hr />
          <div>
            ISBN : {{ $accession->isbn }}<br />
            Title : {{ $accession->title }}<br />
            Author : {{ $accession->author }}<br />
            Accession : {{ $accession->accession_no }}<br />
            Status : {{ strtoupper($accession->status) }}
          </div>
          <hr />
          @if($accession->status != 'notavailable')
          {!!  Form::model($accession,['method'=>'PATCH','route'=>['updateAccession']]) !!}
            <div class="form-group">
                {!! Form::label('status','Update Status') !!}
                {!! Form::select('status', array('available' => 'Available', 'weedout' => 'Weed Out', 'missing' => 'Missing'),null,array('class'=>'form-control')) !!}
            </div>
            <button type="submit" class="btn btn-primary form-control">Update</button>
          {!! Form::close() !!}
          @else
            <h5>
              The Book is Currently Not Available for updating the status.It is with
              <a href="javascript:void(0)" data-placement="right" data-toggle="popover" data-trigger="focus" title="Reader Details" data-html="true" data-content="Name : {{$accession->name}} <br /> Year : {{$accession->year}}">{{$accession->id}}</a>
            </h5>
          @endif
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
@stop
