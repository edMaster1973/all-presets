@extends('master-auth')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 py-md-6 py-lg-10 py-xl-20">
                        <h4 class=mb-0>Bem-vindo(a) <span class="text-warning">{{ Auth::user()->name }}</span></h4>
                        <p class="mt-3 text-body-secondary">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
                <div class="d-none d-md-block col-md-4 col-lg-6">
                    <img src="{{ asset('storage/images/img-fundo-4.png') }}" alt="Imagem de boas-vindas" width="580">
                </div>
            </div>
        </div>
    </div>

    <div class="bd-main-content">
        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">

            @foreach ($errors->all() as $error)
            <div class="row g-8">
                <div class="col-md-12">
                    <div class="text-center alert alert-primary alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            @endforeach

                    <form action="{{ route('search.files') }}" method="POST">

                        @csrf

                        <div class="row g-8">

                            {{-- Select segment_id --}}
                            <div class="col-md-2">
                                <div class="mb-3 input-group">
                                    <select class="form-select" id="segment" name="segment_id" aria-label="Selecione">
                                        <option value=""> - Segmento - </option>
                                        @foreach ($segments as $s)
                                            <option value="{{ $s->id }}">{{ $s->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-3 input-group">
                                    <select class="form-select" id="marca" name="marca_id" aria-label="Selecione a Marca">
                                        <option value=""> - Marca - </option>
                                        @foreach ($marcas as $m)
                                            <option value="{{ $m->id }}">{{ $m->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-3 input-group">
                                    <select class="form-select" id="equipamento" name="equipament_id" aria-label="Selecione o Modelo">
                                        <option> - Selecione - </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-3 input-group">
                                    <select class="form-select" name="instrumento" aria-label="Selecione o Instrumento">
                                        <option value=""> - Instrumento - </option>
                                        <option value="Guitarra">Guitarra</option>
                                        <option value="Violão">Violão</option>
                                        <option value="Baixo">Baixo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 input-group">
                                    {{-- <input type="text" class="form-control" placeholder="Busca" name="search" value="{{ request('search') }}"> --}}
                                    <button class="btn btn-outline-secondary" type="submit" id="button-search">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                    </form>

                <div class="row g-8">

                    @if(!empty($files))
                    {{-- inicio search files --}}
                    @foreach ($files as $f)
                        {{-- inicio card files --}}
                            <div class=col-md-4>
                                <div class="border-0 card bd-card">
                                    <div class=card-body>
                                        <p>
                                            <span class="text-warning small">{{ $f->produto_nome }}</span>
                                        </p>
                                        <div class="row">
                                            <div class="col-2 text-end">
                                                <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center">
                                                    @if(!empty($f->foto))
                                                    <img src="{{ asset($f->foto) }}" class="rounded-circle" width="65" height="65">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <span>{{ $f->user_name }}</span>
                                                <br>
                                                <small class="text-secondary fst-italic">{{ $f->total_seguidores }} seguidores</small>
                                            </div>
                                        </div>

                                        <h2 class="card-title h5 d-flex align-items-center">{{ $f->nome }}</h2>

                                        <div class="row">
                                            @if(!empty($f->img))
                                                <div class="col-6">
                                                    <img src="{{ asset($f->img) }}" class="h-auto w-100 rounded-3">
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-body-tertiary fs-sm">
                                                        {{ $f->descricao }}
                                                    </p>
                                                    <p><span class="text-info small">{{ \Carbon\Carbon::parse($f->data)->format('d M Y') }}</span></p>
                                                </div>
                                            @else
                                            <div class="col-12">
                                                <p class="text-body-tertiary fs-sm">
                                                    {{ $f->descricao }}
                                                </p>
                                            </div>
                                            @endif
                                        </div>

                                        <br>

                                        <div class="row">
                                            <p class="text-body-secondary fs-xs">
                                                <span class="badge bg-info">#{{ $f->instrumento }}</span>
                                                @foreach ($styles as $style)
                                                    @if($style->file_id == $f->id)
                                                    <span class="badge bg-warning">#{{ $style->style }}</span>
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <p class="text-body-secondary fs-xs">
                                                    <a href="{{ route('saiba_mais',['file' => $f->id]) }}">Saiba Mais ></a>
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="gap-2 row">
                                            <div class="col text-start">

                                                <p class="text-body-secondary fs-xs">

                                                    <i class="fa-solid fa-share-nodes"></i>
                                                    <span class="text-info">{{ $f->total_shares }}</span>

                                                    <i class="fa-solid fa-comment"></i>
                                                    <span class="text-info">{{ $f->total_comments }}</span>

                                                    <i class="fa-solid fa-heart"></i>
                                                    <span class="text-info">{{ $f->total_likes }}</span>

                                                    <i class="fa-solid fa-download"></i>
                                                    <span class="text-info">{{ $f->total_downloads }}</span>

                                                </p>
                                            </div>
                                            <div class="col text-end">
                                                <form method="POST" action="{{ route('download.arquivos') }}">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $f->file_path }}">
                                                    <input type="hidden" name="file_id" value="{{ $f->id }}">
                                                    <button class="btn btn-sm btn-outline-primary" type="submit">
                                                        Download
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- fim card --}}
                    @endforeach

                    {{-- fim search files --}}
                    @endif

                    @if (!empty($presets))
                    {{-- inicio presets --}}
                    @foreach ($presets as $p)

                        {{-- inicio card --}}
                            <div class=col-md-4>
                                <div class="border-0 card bd-card">
                                    <div class=card-body>
                                        <p>
                                            <span class="text-warning small">{{ $p->produto_nome }}</span>
                                        </p>
                                        <div class="row">
                                            <div class="col-2 text-end">
                                                <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center">
                                                    @if(!empty($p->foto))
                                                    <img src="{{ asset($p->foto) }}" class="rounded-circle" width="65" height="65">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <span>{{ $p->user_name }}</span>
                                                <br>
                                                <small class="text-secondary fst-italic">{{ $p->total_seguidores }} seguidores</small>
                                            </div>
                                        </div>

                                        <h2 class="card-title h5 d-flex align-items-center">{{ $p->nome }}</h2>

                                        <div class="row">
                                            @if(!empty($p->img))
                                                <div class="col-6">
                                                    <img src="{{ asset($p->img) }}" class="h-auto w-100 rounded-3">
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-body-tertiary fs-sm">
                                                        {{ $p->descricao }}
                                                    </p>
                                                    <p><span class="text-info small">{{ \Carbon\Carbon::parse($p->data)->format('d M Y') }}</span></p>
                                                </div>
                                            @else
                                            <div class="col-12">
                                                <p class="text-body-tertiary fs-sm">
                                                    {{ $p->descricao }}
                                                </p>
                                            </div>
                                            @endif
                                        </div>

                                        <br>

                                        <div class="row">
                                            <p class="text-body-secondary fs-xs">
                                                <span class="badge bg-info">#{{ $p->instrumento }}</span>
                                                @foreach ($styles as $style)
                                                    @if($style->file_id == $p->id)
                                                    <span class="badge bg-warning">#{{ $style->style }}</span>
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <p class="text-body-secondary fs-xs">
                                                    <a href="{{ route('saiba_mais',['file' => $p->id]) }}">Saiba Mais ></a>
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="gap-2 row">
                                            <div class="col text-start">

                                                <p class="text-body-secondary fs-xs">

                                                    <i class="fa-solid fa-share-nodes"></i>
                                                    <span class="text-info">{{ $p->total_shares }}</span>

                                                    <i class="fa-solid fa-comment"></i>
                                                    <span class="text-info">{{ $p->total_comments }}</span>

                                                    <i class="fa-solid fa-heart"></i>
                                                    <span class="text-info">{{ $p->total_likes }}</span>

                                                    <i class="fa-solid fa-download"></i>
                                                    <span class="text-info">{{ $p->total_downloads }}</span>

                                                </p>
                                            </div>
                                            <div class="col text-end">
                                                <form method="POST" action="{{ route('download.arquivos') }}">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $p->file_path }}">
                                                    <input type="hidden" name="file_id" value="{{ $p->id }}">
                                                    <button class="btn btn-sm btn-outline-primary" type="submit">
                                                        Download
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- fim card --}}

                    @endforeach
                    {{-- fim presets --}}
                    @endif




                </div>

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

                    </div>
                </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButton = document.getElementById('copyButton');
        const feedbackElement = document.getElementById('copyFeedback');

        if (copyButton) {
            copyButton.addEventListener('click', function() {
                // 1. Pega o ID do elemento alvo do atributo de dados
                const targetId = this.getAttribute('data-clipboard-target').substring(1); // Remove o '#'
                const targetElement = document.getElementById(targetId);

                if (!targetElement) {
                    console.error("Elemento alvo não encontrado.");
                    return;
                }

                const textToCopy = targetElement.value || targetElement.textContent; // Pega o valor do input ou o texto de outro elemento

                // 2. Tenta copiar usando a API Clipboard (Método preferido)
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(textToCopy)
                        .then(() => {
                            // 3. Sucesso: Exibe feedback visual
                            feedbackElement.style.display = 'inline';
                            setTimeout(() => {
                                feedbackElement.style.display = 'none';
                            }, 2000);
                        })
                        .catch(err => {
                            console.error('Falha ao copiar usando API Clipboard: ', err);
                            // Tenta o método de fallback (Seleção do DOM)
                            fallbackCopyTextToClipboard(targetElement);
                        });
                } else {
                    // 4. Se a API não estiver disponível (navegadores mais antigos, HTTP)
                    fallbackCopyTextToClipboard(targetElement);
                }
            });
        }

        // Método de Fallback (Menos elegante, exige manipulação do DOM)
        function fallbackCopyTextToClipboard(targetElement) {
            let successful = false;
            try {
                // Apenas funciona com <input> ou <textarea>
                targetElement.select();
                document.execCommand('copy');
                successful = true;
            } catch (err) {
                console.error('Falha ao usar execCommand: ', err);
            }

            if (successful) {
                feedbackElement.style.display = 'inline';
                setTimeout(() => {
                    feedbackElement.style.display = 'none';
                }, 2000);
            } else {
                alert('Não foi possível copiar o texto. Tente novamente.');
            }
        }
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const selectMarca = document.getElementById('marca');
        const selectEquipamento = document.getElementById('equipamento');

        selectMarca.addEventListener('change', function() {

            // Pega o ID da marca selecionada
            const marcaId = this.value;

            // Limpa a select de equipamento
            selectEquipamento.innerHTML = '<option value="">Carregando...</option>';

            if (marcaId) {

                // Constrói a URL para a requisição AJAX
                const url = `/equipaments/por-marca/${marcaId}`;

                // 1. Faz a requisição AJAX (usando Fetch API)
                fetch(url)
                .then(response => response.json()) // 2. Transforma a resposta em JSON
                .then(data => {

                    // 3. Limpa e popula a select Equipamento
                    selectEquipamento.innerHTML = '<option value="">Selecione o Equipamento</option>';

                    if (data.length > 0) {

                        data.forEach(equipamento => {
                            const option = document.createElement('option');
                            option.value = equipamento.id;
                            option.textContent = equipamento.nome; // Supondo que a coluna seja 'nome'
                            selectEquipamento.appendChild(option);
                        });
                    } else {
                        selectEquipamento.innerHTML = '<option value="">Nenhum equipamento encontrado</option>';
                    }
                })
                                    .catch(error => {
                                        console.error('Erro ao buscar equipamentos:', error);
                                        selectEquipamento.innerHTML = '<option value="">Erro ao carregar dados</option>';
                                    });
            } else {
                // Se nenhuma marca for selecionada, reseta a select de equipamento
                selectEquipamento.innerHTML = '<option value="">Selecione o Equipamento</option>';
            }
        });
    });
    </script>

@endsection
