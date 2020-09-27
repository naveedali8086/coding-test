<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', '') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('company') }}">Create Company</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show_companies') }}">List Companies</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employee') }}">Create Employee</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show_employees') }}">List Employees</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <main id="app" class="py-4">
        {!! $component !!}
    </main>
</div>
</body>
</html>
