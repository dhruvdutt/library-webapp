<div class="form-group">
    {!! Form::label('serial_no','Serial No') !!}
    {!! Form::text('serial_no',null,['class'=>'form-control','autocomplete'=>'off','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('issn','ISSN') !!}
    {!! Form::number('issn',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('title','Title') !!}
    {!! Form::text('title',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('frequency','Frequency') !!}
    {!! Form::select('frequency', array('weekly' => 'Weekly', 'fortnightly'=>'Fortnightly','monthly' => 'Monthly','quaterly'=>'Quaterly','half-yearly'=>'Half Yearly','yearly'=>'Yearly'),null,array('class'=>'form-control')) !!}
</div>
