<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('storage/images/favicon.ico') }}" >
        <title>All Presets</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="py-0 navbar navbar-expand-lg sticky-top bd-navbar">
            <nav class="container-fluid px-md-3 px-lg-4">
                <a class="p-0 p-1 m-0 rounded navbar-brand d-inline-flex align-items-center me-lg-6 me-xl-9 text-reset" href="/">
                    <span class=text-primary>
                        <img src="{{ asset('storage/images/all-presets-logo.png') }}" alt="Logo All Presets" width="50" height="50">
                    </span>
                    <h2 class="mb-0 d-none d-md-block fw-semibold fs-5 ls-wide ms-2">All Presets</h2>
                </a>

                <div class="gap-3 d-flex align-items-center ms-auto me-2 me-lg-3">

                    <div class=position-relative>
                        <button class="border-0 btn" id="themeToggle">
                            <i class="bi bi-brightness-high" id="sunIcon"></i>
                            <i class="bi bi-moon-stars" id="moonIcon"></i>
                        </button>
                    </div>

                    <button class="btn d-lg-none" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i>
                    </button>

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
