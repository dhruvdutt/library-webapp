<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		@if (Session::has('flash_message'))
        <div class="alert alert-dismissible alert-info" style="text-align:center">
						<button type="button" class="close" data-dismiss="alert">x</button>
            {{ Session::get('flash_message') }}
        </div>
		@endif
		@if(sizeof($errors) != 0)
			<div class="alert alert-danger text-center">
				@foreach ($errors->all() as $error)
					{{$error}}<br />
				@endforeach
			</div>
		@endif
		@if(isset($message))
			<h4 class="text-center">{{ $message }}</h4>
		@endif
	</div>
	<div class="col-md-4"></div>
</div>
