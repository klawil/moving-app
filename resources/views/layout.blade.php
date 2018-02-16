<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if(isset($title))
            <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>
        @else
            <title>{{ config('app.name', 'Laravel') }}</title>
        @endif

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                </div>

                <!-- Nav Items -->
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        @include('components.navlink', [
                            'route' => 'rooms.index',
                            'text' => 'Rooms',
                            'params' => [],
                        ])
                        @include('components.navlink', [
                            'route' => 'boxes.index',
                            'text' => 'Boxes',
                            'params' => [],
                        ])
                        @include('components.navlink', [
                            'route' => 'items.index',
                            'text' => 'Items',
                            'params' => [],
                        ])
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @include('components.breadcrumbs')

            @if(Session::has('message'))
                <div class="container">
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                </div>
            @elseif(Session::has('error'))
                <div class="container">
                    <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
