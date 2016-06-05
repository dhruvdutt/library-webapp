<div class="form-group">
    {!! Form::label('name','Name') !!}
    {!! Form::text('name',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('type','Type') !!}
    {!! Form::select('type', array('student' => 'Student', 'faculty' => 'Faculty'),null,array('class'=>'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('department','Department') !!}
    {!! Form::text('department','CA',['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
  {!! Form::label('year_enrolled','Year Enrolled') !!}
  {!! Form::number('year_enrolled',null,['class'=>'form-control']) !!}
</div>
