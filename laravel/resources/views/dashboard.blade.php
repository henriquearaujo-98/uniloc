<!DOCTYPE html>
<html>
<head>
    <title>Back-Office</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light navbar-expand-lg " style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="counter">Back-Office</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item ml-auto">
                        <a class="nav-link"> {{Auth::user()->name}}</a>
                    </li>

            </ul>
                @endguest
                    <li class="nav-item navbar-nav">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
        </div>
    </div>
</nav>
@include('menu')
@yield('content')
</body>
</html>
