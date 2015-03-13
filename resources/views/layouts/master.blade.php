<!doctype html>
<html lang="en">
<head>
    <base href="{{url('./')}}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">

    <title>@section('title')Travel Agent Junkie @show</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.paper.css"/>
    <link rel="stylesheet" href="assets/css/app.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    @yield('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
    @include('partials/navbar')

    @yield('content')

    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
    @yield('js')
</body>
</html>