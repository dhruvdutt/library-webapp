<div class="form-group">
    {!! Form::label('isbn','Book ISBN') !!}
    {!! Form::number('isbn',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('title','Book Title') !!}
    {!! Form::text('title',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('author','Author') !!}
    {!! Form::text('author',null,['class'=>'form-control','required']) !!}
</div>
<div class="form-group">
    {!! Form::label('publisher','Publisher') !!}
    {!! Form::text('publisher',null,['class'=>'form-control','required']) !!}
</div>
