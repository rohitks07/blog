<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{  asset('public/css/admin.css')}}" rel="stylesheet">
    <link href="{{  asset('node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet">

</head>
<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('admin.dashboard')}}">Virat Eletricals</a>
            <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @yield('breadcrumbs')
                        </ol>
                    </nav>
                </div>
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    @include('admin.partials.navbar')
                </nav>
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('public/js/app.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('node_modules/select2/dist/js/select2.min.js') }}"> </script>
    @yield('scripts')

</body>
</html>
