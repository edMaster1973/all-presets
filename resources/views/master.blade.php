<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">
    <head>

        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="shortcut icon" href="{{ Vite::asset('resources/images/favicon.ico') }}" >
        <title>All Presets</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>
        <header class="py-0 navbar navbar-expand-lg sticky-top bd-navbar">
            <nav class="container-fluid px-md-3 px-lg-4">
                <a class="p-0 m-0 rounded navbar-brand d-inline-flex align-items-center me-lg-6 me-xl-9 text-reset" href="/">
                    <span class=text-primary>
                        <img src="{{ Vite::asset('resources/images/all-presets-logo.png') }}" alt="Logo All Presets" width="68" height="68">
                    </span>
                    <h2 class="mb-0 d-none d-md-block fw-semibold fs-5 ls-wide ms-2"></h2>
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav navbar-nav-underline ps-lg-5 flex-grow-1">
                        <li class=nav-item>
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class=nav-item>
                            <a class="nav-link {{ Route::is('mais_baixados') ? 'active' : '' }}" href="{{ route('mais_baixados') }}">Em Alta</a>
                        </li>
                    </ul>
                </div>
                <div class="gap-3 d-flex align-items-center ms-auto me-2 me-lg-3">

                    <div class=position-relative>
                        <a href="{{ route('entrar') }}" class="link" style="text-decoration: none;">
                            <i class="bi bi-person-circle" title="Login"></i>
                        </a>
                    </div>

                    <div class=position-relative>
                        <button class="border-0 btn" id="themeToggle">
                            <i class="bi bi-brightness-high" id="sunIcon"></i>
                            <i class="bi bi-moon-stars" id="moonIcon"></i>
                        </button>
                    </div>

                    <button id="search-button" class="py-1 bg-transparent border border-2 fs-sm text-body-secondary rounded-2 bd-w-56 text-start ps-2 d-none d-lg-block" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i>
                        <span>Search</span>
                    </button>
                    <button class="btn d-lg-none" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="nav-link d-none d-lg-block" href="{{ route('registrar_se') }}" rel="nofollow">
                        <button class="btn btn-primary" type="button">Registrar-se</button>
                    </a>
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

            {{-- mensagem pix doação --}}
            <div class="mt-4 row g-8">
                <div class=col-md-12>
                    <div class="border-0 card bd-card h-100">
                        <div class=card-body>
                            <div class="mb-4 align-items-start d-flex">
                                <h1><i class="bi bi-emoji-heart-eyes-fill"></i></h1>
                            </div>
                            <div class="text-center">
                                <h2 class="card-title h5 d-flex align-items-center">
                                    Ajude a manter esta comunidade viva!
                                </h2>
                            </div>
                            <p class="text-body-tertiary fs-sm">
                                Esta plataforma nasceu do desejo de criar um espaço onde músicos pudessem compartilhar presets, descobrir novos timbres e se conectar com outros apaixonados por música.
                                Todo o conteúdo que você encontra aqui — uploads, downloads, comentários, curtidas, seguidores, tudo — acontece graças a uma comunidade ativa e a um sistema que exige dedicação e custos mensais para continuar funcionando.

                                Se este projeto já te ajudou de alguma forma, considere contribuir com uma doação.
                                Qualquer valor, por menor que seja, ajuda no pagamento de servidores, melhorias, segurança e novas funcionalidades.

                                Seu apoio mantém este sonho de pé. Obrigado por fazer parte disso! 🎸✨
                            </p>
                            <div class="mb-4 justify-content-center align-items-center d-flex">
                                <img src="{{ Vite::asset('resources/images/qr-code-2.jpeg') }}" alt="QR Code" width="120">
                            </div>
                            <p>
                                <span class="fw-bold">Chave PIX para doações:</span>
                                <br>
                                <span class="text-info small">

                                </span>
                                {{-- inicio --}}
                                <div class="mb-3 input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="linkToCopy"
                                        value="00020126430014br.gov.bcb.pix0121ed_master@hotmail.com5204000053039865802BR5917EDSON ALVES FILHO6007NITEROI62070503***6304BE10"
                                        readonly
                                    >

                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-outline-secondary"
                                            type="button"
                                            id="copyButton"
                                            data-clipboard-target="#linkToCopy"
                                            title="Copiar para a Área de Transferência"
                                        >
                                            <i class="fas fa-copy"></i> Copiar
                                        </button>
                                    </div>
                                </div>

                                <span
                                id="copyFeedback"
                                style="color: green; margin-left: 10px; display: none;">
                                    Copiado!
                                </span>

                                {{-- fim --}}
                            </p>
                        </div>
                    </div>
                </div>

        </div>
        {{-- fim mensagem pix doação --}}

            <div class="footer">
                <div class="container">
                    <div class="mt-4 row g-8">
                        <div class="col-md-12">
                            <div class="text-center">
                                <p class="text-body-tertiary fs-sm"> © {{ date('Y') }} All Presets • Todos os direitos reservados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </main>

    </div>

    <button id="scrollToTopBtn" title="Voltar ao Topo" class="back-to-top btn btn-primary">&#8679;</button>

</body>
</html>
