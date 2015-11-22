@extends('layouts.nav')
@section('content')
    @if($last_accession != null && $last_class != null)
        <div class="container">
        <div class="row">
            <div class="col-md-4">Last Accession Number : {{ $last_accession }}</div>
            <div class="col-md-4">Last Class Number : {{ $last_class }}</div>
            <div class="col-md-4"></div>
        </div>
    @endif
        {!! Form::open(array('url'=>'accession/add')) !!}
        @for($i=1;$i <= $quantity;$i++)
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('accession'.$i,'Accession Number') !!}
                        {!! Form::text('accession'.$i,null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('classno'.$i,'Class Number') !!}
                        {!! Form::text('classno'.$i,null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('status'.$i,'Status') !!}
                        {!! Form::select('status'.$i, array('available' => 'Available', 'notavailable' => 'Not available'),null,array('class'=>'form-control')) !!}
                    </div>
                </div>
            </div>
        @endfor
        <div class="button">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        {!! Form::close() !!}
    </div>
@stop