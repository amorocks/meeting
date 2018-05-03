<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Meeting</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    @stack('head')
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>

<body>
    
    <div class="grid-container">
        <nav class="navbar navbar-light bg-info d-print-none">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="navbar-brand" href="{{ route('home') }}">Meeting</a>
                    </li>
                    @yield('more-breadcrumbs')
                </ol>
                <div class="btn-group">
                    @yield('buttons-right')
                    <span class="btn btn-outline-light">
                        <i class="far fa-user"></i> {{ Auth::id() }}
                    </span>
                </div>
            </div>
        </nav>

        <div class="container main">
            @yield('content')
        </div>

        <footer class="container d-print-none">
            <p><small>Found a bug? Please create an issue at our <a href="https://github.com/amorocks/meeting/issues" target="_blank">GitHub</a> repository.</small><br /><small>Designed, built and powered by <a target="_blank" href="http://studiokaa.co">studioKaa</a>, for Team ICO at Radius College.</small></p>
        </footer>
    </div>

</body>
</html>
