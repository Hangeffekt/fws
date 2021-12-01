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
                <div id="app">
                    <app></app>
                </div>
            </div>
        </div>
        
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>