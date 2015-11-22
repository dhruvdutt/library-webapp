<div class="row">
    <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('isbn','Book Title or ISBN') !!}
                {!! Form::text('isbn',null,['class'=>'form-control','required']) !!}
            </div>
            <button type="submit" class="btn btn-primary form-control">Proceed</button>
        </div>
    <div class="col-md-4"></div>
</div>