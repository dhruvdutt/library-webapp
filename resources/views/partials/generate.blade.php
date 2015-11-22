  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
          {!! Form::label('isbn','ISBN') !!}
          {!! Form::text('isbn',$isbn,['class'=>'form-control','required','disabled']) !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
          {!! Form::label('vendortitle','Vendor') !!}
          {!! Form::text('vendortitle',null,['class'=>'form-control','required']) !!}
      </div>
    </div>
  </div>
  <div class="row">
        <div class="col-md-6">
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
        </div>
  </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('volume','Volume') !!}
                {!! Form::number('volume',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
                {!! Form::label('quantity','Quantity') !!}
                {!! Form::number('quantity',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="button" id="generate" class="btn btn-primary">Add</button>
        </div>
        <div class="col-md-6"></div>
    </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Generate Numbers</h4>
      </div>
      <div class="modal-body">
        <div id="generated"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Data</button>
      </div>
    </div>
  </div>
</div>