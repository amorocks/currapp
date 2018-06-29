<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
        <title>Hello, world!</title>
    </head>
    <body>

        <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
            <h1><a class="navbar-brand" href="{{ route('home') }}">Curr<span>App</span></a></h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item @if(Route::currentRouteName() == 'home') active @endif">
                        <a class="nav-link" href="{{ route('home') }}">Start</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vakken</a>
                    </li>
                    <li class="nav-item @if(starts_with(Route::current()->uri, 'curriculum')) active @endif">
                        <a class="nav-link" href="{{ route('qualifications.index') }}">Curriculum</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
