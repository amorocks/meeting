<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Meeting</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    @stack('head')
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>

<body>

    <nav class="navbar navbar-light bg-info">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="navbar-brand" href="{{ route('home') }}">Meeting</a>
                </li>
                @yield('more-breadcrumbs')
            </ol>
            <div class="btn-group">
                @yield('buttons-right')
                <a class="btn btn-outline-light" href="/amoclient/logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="container main">
        @yield('content')
    </div>

    <footer class="container">
        <p><small>Found a bug? Please create an issue at our <a href="https://github.com/StudioKaa/current/issues" target="_blank">GitHub</a> repository.</small><br /><small>Designed, built and powered by <a target="_blank" href="http://studiokaa.co">studioKaa</a>, for Team ICO at Radius College.</small></p>
    </footer>

</body>
</html>
