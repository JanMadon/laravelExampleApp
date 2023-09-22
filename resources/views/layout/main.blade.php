<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>
            Application: {{$appBladeName}}
        {{-- @yield('title', $appBladeName) --}}
        </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/">Świat gier</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form></li>
                    </ul>
                </li>
            </ul>
        </nav>
        @auth
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Panel</div>
                            <a class="nav-link" href="{{route('get.users')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Użytkownicy
                            </a>
{{-- ------------------------------------------------------------------------------- --}}

                            <div class="sb-sidenav-menu-heading">Gry</div>
                            <a class="nav-link" href="{{route('games.dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge"></i></div>
                                dashboard
                            </a>
                            <a class="nav-link" href="{{route('games.list')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gamepad"></i></div>
                                lista
                            </a>
{{-- ------------------------------------------------------------------------------- --}}

                            <div class="sb-sidenav-menu-heading">Gry Builder</div>
                            <a class="nav-link" href="{{route('games.b.dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge"></i></div>
                                dashboard
                            </a>
                            <a class="nav-link" href="{{route('games.b.list')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gamepad"></i></div>
                                lista
                            </a>
{{-- ------------------------------------------------------------------------------- --}}

                            <div class="sb-sidenav-menu-heading">Gry Eloquent</div>
                            <a class="nav-link" href="{{route('games.e.dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge"></i></div>
                                dashboard
                            </a>
                            <a class="nav-link" href="{{route('games.e.list')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gamepad"></i></div>
                                lista
                            </a>

                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('contentMain')
                </main>
            </div>
        </div>
        @else
            <div id="content-logout">
                <main>
                    @yield('contentMain')
                </main>
            </div>
        @endauth


        <script src="/js/scripts.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
