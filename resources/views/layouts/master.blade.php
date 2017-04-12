<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">

    <!-- Calendar CSS & JS -->
    <script src="{{ URL::asset('js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('lib/fullcalendar/fullcalendar.js') }}"></script>
    <link rel='stylesheet' href="{{ URL::asset('lib/fullcalendar/fullcalendar.css') }}" />

    <!-- Sweet Alert -->
    <script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
    <link rel='stylesheet' href="{{ URL::asset('css/sweetalert.css') }}" />

    <!-- Custom JS -->
    <script src="{{ URL::asset('js/custom.js') }}"></script>
</head>

<body>

@include('sweet::alert')
    <div id="wrapper" class="container-fluid body-wrapper toggled">
        @include('layouts.sidebar')
        <div class="content-wrapper">
        @yield('content')
        </div>
    </div>


    @yield('page-script')

</body>

</html>
