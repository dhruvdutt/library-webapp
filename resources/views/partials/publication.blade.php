<div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('isbn','Book ISBN') !!}
                {!! Form::number('isbn',null,['class'=>'form-control','autocomplete'=>'off','required']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('title','Book Title') !!}
                {!! Form::text('title',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('author','Author') !!}
                {!! Form::text('author',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('publisher','Publisher') !!}
                {!! Form::text('publisher',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
    </div>