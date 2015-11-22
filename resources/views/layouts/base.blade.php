<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/sortable-theme-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
</head>
<body>
@yield('navbar')
@yield('content')
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/sortable.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.base64.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/sprintf.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jspdf.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/base64.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/style.js') }}"></script>
</body>
</html>
