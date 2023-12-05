<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UH White Pages Management System</title>
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script
        src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/dataTableCustom.css', 'resources/css/modalContent.css'])
</head>
<body>
<div id="app">
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">

                    <img src="/images/logo/UH_LOGO.png" alt="UH White Page" class="navbar-logo" style="height: 50%; width: 33%">

                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">

                    <span class="navbar-toggler-icon"></span>

                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav me-auto">



                    </ul>



                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->

                        @guest

                        @if (Route::has('login'))

                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                        </li>

                        @endif



                        @if (Route::has('register'))

                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                        </li>

                        @endif

                        @else

                        <li><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>

                        <li><a class="nav-link" href="{{ route('roles.index') }}">Role</a></li>


                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                {{ Auth::user()->name }}

                            </a>



                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    <script>
                                        console.log("clicked");
                                    </script>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>
    </header>
    <div class="main-content">
        @guest
        @else
        <aside>
            @include('Layout.Partials.sidebar')
        </aside>
        @endguest
        <main>
            @yield('content')
        </main>
    </div>
    <footer>
        @include('Layout.Partials.footer')
    </footer>

</div>


<!-- Include your JavaScript and Vue app here -->

</body>
</html>
