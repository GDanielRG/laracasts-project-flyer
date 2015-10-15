<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project Flyer</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/libs.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">ProjectFlyer</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>

            @if ($signedIn)
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>
                </ul>
                <p class="navbar-text navbar-right">
                    Hello, {{ $user->name }}
                </p>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ action('Auth\AuthController@getRegister') }}">Register</a></li>
                    <li><a href="{{ action('Auth\AuthController@getLogin') }}">Login</a></li>
                </ul>
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="/js/libs.js"></script>
@yield('scripts.footer')

@include('flash')

</body>
</html>
