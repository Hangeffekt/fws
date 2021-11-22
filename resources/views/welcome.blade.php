<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta charset="UTF8">
    <meta name="robots" content="index,follow">
    <meta name='revisit-after' content='5 days' >
    <meta name='author' content='Coding: Nagy Lorant' >
    <meta name='language' content='hu' >
    <title>@yield('title')</title>

	<script src="/js/jquery-3.5.1.js"></script>
	<!--bootstrap-->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src="/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="/css/style.css">
	<script src="/js/script.js"></script>
</head>
<body>
    
    <div class="container">
        <div class="row">
            @if(Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::get('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>