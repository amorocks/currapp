<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <script src="{{ mix('/js/app.js') }}"></script>
        <title>Hello, world!</title>
        @stack('head')
    </head>
    <body>

        <nav class="navbar topnav navbar-dark bg-primary navbar-expand-lg justify-content-between">
            <div class="d-flex align-items-center">
                <h1><a class="navbar-brand" href="{{ route('home') }}">Curr<span>App</span></a></h1>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item @if(Route::currentRouteName() == 'home') active @endif">
                            <a class="nav-link" href="{{ route('home') }}">Start</a>
                        </li>
                        <li class="nav-item @if(starts_with(Route::current()->uri, 'courses')) active @endif">
                            <a class="nav-link" href="{{ route('courses.index') }}">Vakken</a>
                        </li>
                        <li class="nav-item @if(starts_with(Route::current()->uri, 'now')) active @endif">
                            <a class="nav-link" href="{{ route('now.index') }}">Dit jaar</a>
                        </li>
                        <li class="nav-item @if(starts_with(Route::current()->uri, 'curriculum')) active @endif">
                            <a class="nav-link" href="{{ route('qualifications.index') }}">Cohorten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Rapportages</a>
                        </li>
                        
                        <li class="nav-item dropdown" data-controller="dropdown">
                            <a class="nav-link dropdown-toggle" data-target="dropdown.button" data-action="click->dropdown#toggle click@window->dropdown#hide" aria-expanded="false">Overige</a>
                            <div class="dropdown-menu" data-target="dropdown.menu">
                                <a href="{{ route('tags.index') }}" class="dropdown-item">Tags</a>
                                <a href="{{ route('tag-types.index') }}" class="dropdown-item">Soorten tags</a>
                                <a href="{{ route('types.index') }}" class="dropdown-item">Soorten vakken</a>
                                <a href="{{ route('periodisations.index') }}" class="dropdown-item">Datums voor periodes</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-group d-none d-md-flex">
                @yield('buttons')
            </div>
        </nav>
        @yield('subnav')
        <div class="@yield('container', 'container')">
            @include('layouts.status')
            @yield('content')
        </div>
    </body>
</html>
