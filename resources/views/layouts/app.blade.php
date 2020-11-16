<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito"
        rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
        crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                    id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a href="{{ url('/') }}">Home</a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ url('/auth/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ url('/auth/register') }}">Sign Up</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#"
                                class="nav-link dropdown-toggle" role="button"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"
                                v-pre>{{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="navbarDropdown">
                                @if (Auth::user()->can_post())
                                <li class="dropdown-item">
                                    <a href="{{ url('/new-post') }}">Add new
                                        FoodShare</a>
                                </li>
                                <li class="dropdown-item">
                                    <a
                                        href="{{ url('/user/'.Auth::id().'/posts') }}">My
                                        FoodShares</a>
                                </li>
                                @endif
                                <li class="dropdown-item">
                                    <a href="{{ url('/user/'.Auth::id()) }}">My
                                        Profile</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="{{ url('/logout') }}">Logout</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @if (Session::has('message'))
            <div class="alert alert-info text-center">
                <p class="card-body">
                    {{ Session::get('message') }}
                </p>
            </div>
            @endif
            @if ($errors->any())
            <div class='alert alert-danger text-center'>
                <ul class="card-body">
                    @foreach ( $errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <h2>@yield('title')</h2>
                            @yield('title-meta')
                        </div>
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 text-center">
                <div class="col-md-10 offset-md-1">
                    <p>Copyright © 2020 | <span><a href="#"
                                class="btn btn-outline-success">BOEY</a>
                            HGS
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="./coverage/bs-custom-file-input.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
                bsCustomFileInput.init()
            });
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous">
    </script>
</body>

</html>
