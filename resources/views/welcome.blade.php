<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta charset="UTF8">
    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" href="/css/bootstrap.min.css">

	<link rel="stylesheet" href="/css/style.css">
	<script src="/js/script.js"></script>
</head>
<body>
    
    <div class="container">
        <div class="row">
            @if(Session::get('success'))
                <div class="col-12 alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::get('fail'))
                <div class="col-12 alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>