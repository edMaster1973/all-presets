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
                        <img src="{{ asset('images/all-presets-logo.png') }}" alt="Logo All Presets" width="68" height="68">
                    </span>
                    <h2 class="mb-0 d-none d-md-block fw-semibold fs-5 ls-wide ms-2"></h2>
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav navbar-nav-underline ps-lg-5 flex-grow-1">
                        <li class=nav-item>
                            <a class="nav-link {{ Route::is('inicio') ? 'active' : '' }}" href="{{ route('inicio') }}">Início</a>
                        </li>
                        <li class=nav-item>
                            <a class="nav-link {{ Route::is('ranking') ? 'active' : '' }}" href="{{ route('ranking') }}">Ranking</a>
                        </li>
                    </ul>
                </div>
                <div class="gap-3 d-flex align-items-center ms-auto me-2 me-lg-3">

                    <div class=position-relative>
                        <a href="{{ route('upload') }}" class="link">
                            <button type="button" class="btn btn-primary">Upload</button>
                        </a>
                    </div>

                    <div class="position-relative">
                        <button class="border-0 btn" id="themeToggle">
                            <i class="bi bi-brightness-high" id="sunIcon"></i>
                            <i class="bi bi-moon-stars" id="moonIcon"></i>
                        </button>
                    </div>

                    <div class="position-relative">
                        <button class="border-0 btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                            <li>
                                <div class="items-center pt-3 pb-2">
                                    <span class="dropdown-item-text">#1. Notification</span>
                                </div>
                            </li>
                            <li>
                                <div class="items-center pt-3 pb-2">
                                    <span class="dropdown-item-text">#2. Notification</span>
                                </div>
                            </li>
                            <li>
                                <div class="items-center pt-3 pb-2">
                                    <span class="dropdown-item-text">#3. Notification</span>
                                </div>
                            </li>
                        </ul>
                    </div>



                    @if(!empty(Auth::user()->foto_perfil))
                        <img src="{{ asset(Auth::user()->foto_perfil) }}" class="rounded-circle" width="35" alt="Foto de Perfil">
                    @else
                        <img src="{{ asset('storage/images/user-1.png') }}" class="rounded-circle" width="35" alt="Imagem de Perfil">
                    @endif

                    <button class="border-0 btn" type="button" data-bs-toggle="dropdown">
                        <span class="text-body-secondary">{{ Auth::user()->name }}</span>
                    </button>
                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                            <li>
                                <div class="items-center pt-3 pb-2 text-center">
                                    <div class="gap-2 px-5 mb-2 row">
                                        <span class="fw-bold">{{ Auth::user()->email }}</span>
                                    </div>
                                    <div class="gap-2 px-5 mb-2 row">
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

        {{-- <div class="offcanvas offcanvas-end w-100 mw-100" tabindex="-1" id="bdNavbar">
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
        </div> --}}

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

            {{-- início mensagem pix doação --}}
            <div class="mt-4 row g-8">

                            <div class=col-md-6>
                                <div class="border-0 card bd-card h-100">
                                    <div class=card-body>
                                        <div class="mb-4 d-flex align-items-start">
                                            <img src="{{ asset('storage/images/all-presets-logo.png') }}" alt="Logo All Presets" width="100" height="100">
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">O que nos move...</h2>
                                        <p class="text-body-tertiary fs-sm">
                                            Nossa proposta vai além de compartilhamento de arquivos:
                                            é sobre conectar pessoas, inspirar novas sonoridades e transformar experiências individuais em crescimento coletivo.
                                        </p>
                                        <span class="text-info">Seja você um iniciante explorando suas primeiras pedaleiras ou um músico experiente em busca de novas possibilidades, este é o seu espaço para:</span>
                                        <p>
                                            🎧 Descobrir presets criados por músicos profissionais <br>
                                            📤 Compartilhar seus próprios timbres <br>
                                            💬 Trocar experiências reais com quem vive o universo da música <br>
                                            🤝 Seguir e interagir com outros membros da comunidade <br>
                                            🚀 Evoluir seu som através da colaboração
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class=col-md-6>
                                <div class="border-0 card bd-card h-100">
                                    <div class=card-body>
                                        <div class="mb-4 d-flex align-items-start">
                                            <h1><i class="bi bi-emoji-heart-eyes-fill"></i></h1>
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">Apoie este projeto!</h2>
                                        <p class="text-body-tertiary fs-sm justify-items-stretch">
                                            Nossa plataforma foi criada para ajudar músicos a compartilhar presets, trocar experiências e evoluir juntos. Mantê-la no ar envolve custos de servidores, manutenção e melhorias constantes.
                                            Se este espaço tem sido útil para você, considere fazer uma doação e contribuir para que ele continue existindo e crescendo.
                                            Sua ajuda faz toda a diferença! ❤️
                                        </p>
                                        <p>
                                            {{-- criar um botão ou input copiável --}}
                                            <div class="mb-4 d-flex align-items-start">
                                                <img src="{{ asset('storage/images/qr-code-2.jpeg') }}" alt="QR Code" width="100" height="100">
                                            </div>
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

                                                <span id="copyFeedback" style="color: green; margin-left: 10px; display: none;">Copiado!</span>
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

        </main>

    </div>

    <button id="scrollToTopBtn" title="Voltar ao Topo" class="back-to-top btn btn-primary">&#8679;</button>

</body>
</html>
