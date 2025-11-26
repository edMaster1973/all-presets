@extends('master')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 py-md-6 py-lg-10 py-xl-20">
                        <h1 class=mb-0>Presets</h1>
                        <p class="mt-3 text-body-secondary">
                            Bem-vindo à plataforma onde músicos se encontram, criam, compartilham e evoluem juntos.
                            Aqui, cada preset enviado, cada comentário, cada curtida e cada troca de ideia ajuda a construir uma verdadeira comunidade de apaixonados por timbres e música.
                        </p>
                    </div>
                </div>
                <div class="d-none d-md-block col-md-4 col-lg-6">
                    <img src="{{ asset('storage/images/img-fundo-3.png') }}" alt="Imagem de boas-vindas" width="640">
                </div>
            </div>
        </div>
    </div>

    <div class="bd-main-content">
        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">
                <div class="row g-8">

                    @foreach ($presets as $p)
                        @if($p->privacidade == 'publico')
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
                                                        <img src="{{ asset($p->foto) }}" class="rounded-circle" width="40" height="40">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <span>{{ $p->user_name }}</span>
                                                <br>
                                            {{-- exibir data no formato dia mes_abreviado ano --}}
                                                <span class="text-info small">{{ \Carbon\Carbon::parse($p->data)->format('d M Y') }}</span>
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
                                            <div class="col-12">
                                                <p class="text-body-secondary fs-xs">
                                                    {{ $p->tags }}
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        @php
                                        // contador compartilhamentos //
                                        $downloadsCount=0;
                                        foreach ($downloads as $download) {
                                            if ($download->file_id == $p->id) {
                                                $downloadsCount++;
                                            }
                                        }
                                        @endphp

                                        <div class="gap-2 row">
                                            <div class="col text-start">
                                                <p class="text-body-secondary fs-xs">

                                                    <i class="fa-solid fa-share-nodes"></i>
                                                    <span class="text-info"> {{ $p->total_shares }}</span>

                                                    <i class="fa-solid fa-comment"></i>
                                                    <span class="text-info">{{ $p->total_comments }}</span>

                                                    <i class="fa-solid fa-heart"></i>
                                                    <span class="text-info">{{ $p->total_likes }}</span>

                                                    <i class="fa-solid fa-download"></i>
                                                    <span class="text-info">{{ $p->total_downloads }}</span>

                                                </p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        {{-- fim card --}}
                        @endif
                    @endforeach

                    <div class="row g-8">
                        <div class="mt-3 items-center justify-content-center">
                            <nav aria-label="Page navigation example">
                                {{ $presets->links() }}
                            </nav>
                        </div>
                    </div>
            </div>

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
                                <img src="{{ asset('storage/images/qr-code-2.jpeg') }}" alt="QR Code" width="120">
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

                                <span id="copyFeedback" style="color: green; margin-left: 10px; display: none;">Copiado!</span>

                                {{-- fim --}}
                            </p>
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

@endsection
