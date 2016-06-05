@extends('layouts.nav')
@section('content')
{!! Form::open(array('route'=>'addAcquisition')) !!}
<div class="container box" ng-controller="AccessionController">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
          {!! Form::label('isbn','ISBN') !!}
          {!! Form::text('isbn',$isbn,['class'=>'form-control','required','readonly']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('vendortitle','Vendor') !!}
          {!! Form::text('vendortitle',null,['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('price','Price') !!}
          {!! Form::number('price',null,['class'=>'form-control','required']) !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
            {!! Form::label('cd','CD') !!}
            {!! Form::number('cd',null,['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('volume','Volume') !!}
          {!! Form::number('volume',null,['class'=>'form-control','required']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('quantity','Quantity') !!}
            {!! Form::number('quantity',null,['class'=>'form-control','required','ng-model'=>'quantity']) !!}
      </div>
    </div>
    <div class="text-center">
      <button type="button" ng-click="generateNumbers(quantity)" class="btn btn-primary">Add</button>
    </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="accessionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Generate Numbers</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6"><h6>Last Accession Number : <% accession %></div>
            <div class="col-md-6"><h6>Last Class Number : <% class %></div>
          </div>
          <div ng-repeat="i in range(quantity)">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Accession</label>
                      <input type="number" class=form-control autocomplete=off name="accession[]" ng-value=(accession+i)+1>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Class</label>
                      <input type=number class=form-control autocomplete=off name="class[]" ng-value=(class+i)+1>
                  </div>
              </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Data</button>
        </div>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
@stop
