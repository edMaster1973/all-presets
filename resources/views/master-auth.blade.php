<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('storage/images/favicon.ico') }}" >
        <title>All Presets</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="py-0 navbar navbar-expand-lg sticky-top bd-navbar">
            <nav class="container-fluid px-md-3 px-lg-4">
                <a class="p-0 p-1 m-0 rounded navbar-brand d-inline-flex align-items-center me-lg-6 me-xl-9 text-reset" href="/">
                    <span class=text-primary>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#336aea" width="32" height="32" viewBox="0 0 32 32">
                            <rect x="6" y="6" width="20" height="4"/>
                            <rect x="6" y="14" width="20" height="4"/>
                            <rect x="6" y="18" width="6" height="8"/>
                        </svg>
                    </span>
                    <h2 class="mb-0 d-none d-md-block fw-semibold fs-5 ls-wide ms-2">All Presets</h2>
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav navbar-nav-underline ps-lg-5 flex-grow-1">
                        <li class=nav-item>
                            <a class="nav-link {{ Route::is('inicio') ? 'active' : '' }}" href="{{ route('inicio') }}">Início</a>
                        </li>
                        <li class=nav-item>
                            <a class="nav-link" href="#">IRs</a>
                        </li>
                        <li class=nav-item>
                            <a class="nav-link" href="#">Clones</a>
                        </li>
                    </ul>
                </div>
                <div class="gap-3 d-flex align-items-center ms-auto me-2 me-lg-3">

                    <div class=position-relative>
                        <button class="btn btn-primary">Upload</button>
                    </div>

                    <div class=position-relative>
                        <button class="border-0 btn" id="themeToggle">
                            <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
                                <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"/>
                            </svg>
                            <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16">
                                <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                            </svg>
                            {{-- <i class="bi bi-brightness-high"></i> --}}
                            {{-- <i class="bi bi-moon"></i> --}}
                        </button>
                    </div>

                    <button id="search-button" class="py-1 bg-transparent border border-2 fs-sm text-body-secondary rounded-2 bd-w-56 text-start ps-2 d-none d-lg-block" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i>
                        <span>Search</span>
                    </button>
                    <button class="btn d-lg-none" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="nav-link d-none d-lg-block" href="#" target="_blank" rel="nofollow">
                        <img src="{{ asset('storage/profiles/perfil2.jpeg') }}" style="width: 35px; border-radius: 50%;">
                    </a>
                        <button class="btn border-0" type="button" data-bs-toggle="dropdown">
                            <span class="text-body-secondary">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                            <li>
                                <div class="text-center items-center pt-3 pb-2">
                                    <div class="row gap-2 mb-2 px-5">
                                        <span class="fw-bold">{{ Auth::user()->email }}</span>
                                    </div>
                                    <div class="row gap-2 mb-2 px-5">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{ route('meus_dados') }}" class="link" style="text-decoration: none;">
                                    <button class="dropdown-item" type="button">
                                        <i class="bi bi-person-circle"></i>
                                        Meus dados
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('altera_senha') }}" class="link" style="text-decoration: none;">
                                    <button class="dropdown-item" type="button">
                                        <i class="bi bi-lock"></i>
                                        Alterar Senha
                                    </button>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Sair
                                    </button>
                                </form>
                            </li>
                        </ul>

                </div>
            </nav>
        </header>

        <div class="offcanvas offcanvas-end w-100 mw-100" tabindex="-1" id="bdNavbar">
            <div class="px-5 offcanvas-header border-bottom">
                <span class="text-primary">
                    <svg fill="currentcolor" width="24" height="24" viewBox="0 0 32 32">
                        <rect x="4" y="3" width="24" height="7" rx="3.5" ry="3.5"/>
                        <rect x="4" y="12" width="20" height="7" rx="3.5" ry="3.5"/>
                        <rect x="4" y="21" width="14" height="7" rx="3.5" ry="3.5"/>
                    </svg>
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="px-5 offcanvas-body">
                <div class="d-flex flex-column">
                    <a class="py-2 fw-bold text-reset" href="#">Home</a>
                    <a class="py-2 fw-bold text-reset" href="#">Get Started</a>
                    <a class="py-2 fw-bold text-reset" href="#">Tokens</a>
                    <a class="py-2 fw-bold text-reset" href="#">Docs</a>
                    <a class="py-2 fw-bold text-reset" href="#">Components</a>
                </div>
                <ul class="pt-5 mt-3 text-center list-inline border-top">
                    <li>
                        <a class="nav-link rounded-circle" data-bs-toggle=tooltip data-bs-title="Github repository" href=https://github.com/fastbootstrap/atlassian-design-for-bootstrap>
                            <i class="fa-brands fa-github fa-xl"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end" role="menu">
            <li>
                <button class="dropdown-item" type="button" id="light-theme-button" data-bs-theme-value="light">
                    <i class="fa-solid fa-sun fa-lg"></i>
                    <span class="ms-2">Light</span>
                </button>
            </li>
            <li>
                <button class="dropdown-item" type="button" id="dark-theme-button" data-bs-theme-value="dark">
                    <i class="fa-solid fa-moon fa-lg"></i>
                    <span class="ms-2">Dark</span>
                </button>
            </li>
        </ul>

        <div class="modal fade" tabindex="-1" id="searchModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="px-3 py-2 modal-header">
                        <div class="input-group input-group-prefix">
                            <input type="text" id="search-input" name="search-input" class="py-3 bg-transparent form-control" placeholder="Search documents">
                            <label class="input-group-text">
                                <i class="fa-solid fa-magnifying-glass fa-sm text-muted"></i>
                            </label>
                            <div id="searchLoading" class="position-absolute top-50 end-0 translate-middle visually-hidden me-3">
                                <i class="animate-spin text-primary fas fa-spinner"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 pt-0 modal-body"></div>
                </div>
            </div>
        </div>

    <div class="bd-layout">

        <main class=bd-main>

            @yield('content')

            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <p class="text-body-tertiary fs-sm"> © {{ date('Y') }} All Presets • Todos os direitos reservados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>

    <script>
        function getTheme(){
            return localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"
            );
        }
        document.getElementById("themeToggle").addEventListener("click", function(){
            const currentTheme = getTheme();
            const newTheme = currentTheme === "dark" ? "light" : "dark";
            document.documentElement.setAttribute("data-bs-theme", newTheme);
            localStorage.setItem("theme", newTheme);
        });
        document.documentElement.setAttribute("data-bs-theme", getTheme());
    </script>

</body>
</html>
