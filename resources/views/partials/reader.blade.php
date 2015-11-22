<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('name','Name') !!}
            {!! Form::text('name',Input::old('name'),['class'=>'form-control','required']) !!}
        </div>
        </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('type','Type') !!}
            {!! Form::select('type', array('student' => 'Student', 'faculty' => 'Faculty'),null,array('class'=>'form-control')) !!}
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('department','Department') !!}
            {!! Form::text('department',null,['class'=>'form-control','required']) !!}
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
      <div class="form-group">
          {!! Form::label('year','Year') !!}
          {!! Form::select('year', array('fy' => 'FY', 'sy' => 'SY','ty'=>'TY','faculty'=>'Faculty'),null,array('class'=>'form-control')) !!}
      </div>
  </div>
  <div class="col-md-4"></div>
</div>
