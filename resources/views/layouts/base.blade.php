<!DOCTYPE html>
<html ng-app="calibrary">
<head>
		<link rel="icon" type="image/gif" href="{{ URL::asset('assets/favicon/favicon.gif') }}"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{ $title }}</title>
    @include('partials.styles')
</head>
<body>
  @yield('navbar')
  @yield('content')
	@if(Auth::user())
		@if(Auth::user()->type == 'admin')
			<div class="container text-center">
				<p>
					Total Publication in the library : {{ Session::get('total_pubication') }}<br />
					Total Books issued till date : {{ Session::get('total_circulation') }}<br />
					Total Fine collected till date : &#8377;{{ Session::get('total_fine') }}
				</p>
			</div>
		@endif
	@endif
  <footer class="footer">
    <p>&copy; Computer Applications (CA Dept) Library</p>
		<p><a href="/developers" target="_blank">Developers</a>
  </footer>
  @include('partials.scripts')
</body>
</html>
