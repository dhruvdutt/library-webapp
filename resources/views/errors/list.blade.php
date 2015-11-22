<div class="container">
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		@if (Session::has('flash_message'))
        <div class="alert alert-info" style="text-align:center">
            {{ Session::get('flash_message') }}
        </div>
		@endif
	</div>
	<div class="col-md-4"></div>
</div>
</div>

 @if(sizeof($errors) != 0)
      <div class="container alert alert-danger">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          @foreach ($errors->all() as $error)
            {{$error}}<br />
          @endforeach
        </div>
        <div class="col-md-4"></div>
      </div> 
      </div>
@endif

@if(isset($message))
   <div class="container" style="text-align:center">
     <div class="row">
       <div class="col-md-4"></div>
       <div class="col-md-4">
         <div>
            <h4>{{ $message }}</h4>
          </div>
       </div>
       <div class="col-md-4"></div>
     </div>
   </div>  
@endif