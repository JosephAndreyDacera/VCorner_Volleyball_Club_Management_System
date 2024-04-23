<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'VCorner') }}</title> --}}
    <title>VCorner | Volleyball Club Management System</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body class="">
    <div id="app">
        {{-- Navigation Bar --}}
        <nav class="navbar navbar-expand-md shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('img/vcms_logo_nav.png')}}" alt="Logo" srcset="" height="40">
                </a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
                <div class="offcanvas offcanvas-end off_canvas" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header shadow">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{asset('img/VCornerLogo.png')}}" alt="Logo" srcset="" height="50">
                        </a>
                        <button type="button" class="btn-close  bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @if (request()->is('home'))
                                <li class="nav-item nav_link nav_link_active me-1">
                                    <a class="nav-link nav_link_font nav_link_font_active ps-2" aria-current="page" href="{{route('home')}}">
                                        <span><i class="fa-solid fa-house"></i></span>
                                        Home
                                    </a>
                                </li>
                            @else
                                <li class="nav-item nav_link me-1">
                                    <a class="nav-link nav_link_font ps-2" aria-current="page" href="{{route('home')}}">
                                        <span><i class="fa-solid fa-house"></i></span>
                                        Home
                                    </a>
                                </li>
                            @endif

                            @if (request()->is('clubs'))
                                <li class="nav-item nav_link nav_link_active me-1">
                                    <a class="nav-link nav_link_font nav_link_font_active ps-2" aria-current="page" href="{{route('clubs')}}">
                                        <span><i class="fa-solid fa-people-group"></i></span>
                                        My Clubs
                                    </a>
                                </li>
                            @else
                                <li class="nav-item nav_link me-1">
                                    <a class="nav-link nav_link_font ps-2" aria-current="page" href="{{route('clubs')}}">
                                        <span><i class="fa-solid fa-people-group"></i></span>
                                        My Clubs
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item nav_link dropdown me-1">
                                <a id="navbarDropdown" class="nav-link nav_link_font dropdown-toggle  ps-2 nav_link_font_active" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span><i class="fa-solid fa-people-roof"></i></span>
                                    Manage
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="#" class="dropdown-item">
                                        Membership
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Teams
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Events
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item nav_link dropdown me-1">
                                <a id="navbarDropdown" class="nav-link nav_link_font dropdown-toggle  ps-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span><i class="fa-solid fa-user"></i></span>
                                    Profile
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>



        {{-- Main content below the navigation bar--}}
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/jquery-3.7.1.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
</body>
</html>
