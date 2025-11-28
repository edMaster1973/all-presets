@extends('master-user')

@section('content')

    <div class="bd-main-content">
        <div class="px-0 max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20">

                {{-- <div class="mb-4 row">
                    <a href="{{ route('inicio') }}" style="text-decoration: none;">
                        <i class="bi bi-arrow-left-circle"></i> Voltar
                    </a>
                </div> --}}

                @foreach ($errors->all() as $error)
                <div class="mb-4 g-8 row">
                    <div class="col-md-12">
                        <div class="text-center alert alert-primary alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-4 row g-8">

                    <div class="col-md-12">

                        <div id="status-message" class="text-center alert alert-primary alert-dismissible fade show" style="display: none;"></div>

                        <div class="border-0 card bd-card h-100">

                            <div class="card-head">
                                <div class="mb-4 row">
                                    <div class="col-12">
                                        <div class="p-4 card-title h4">
                                            {{ $file->segmento }} <span class="text-warning small">{{ $file->produto_nome }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=card-body>
                                <div class="mb-4 row">
                                    <div class="text-center col-12">
                                        {{-- foto perfil --}}
                                            @if(!empty($user->foto_perfil))
                                                <img src="{{ asset($user->foto_perfil) }}" class="rounded-circle" width="120" height="120">
                                            @else
                                                <img src="{{ asset('storage/images/sem-foto.png') }}" class="rounded-circle" width="120" height="120">
                                            @endif
                                        <br>
                                        <span>{{ $user->name }}</span>
                                        <br>
                                        <span class="text-secondary">{{ $user->email }}</span>
                                        <p>
                                            <span id="followers-count">{{ $user->followers->count() }}</span> seguidores <br>

                                            @auth
                                                @if (Auth::user()->id !== $user->id)
                                                    <button
                                                        id="follow-btn"
                                                        data-user-id="{{ $user->id }}"
                                                        class="btn {{ Auth::user()->followings->contains($user->id) ? 'btn-secondary' : 'btn-primary' }}"
                                                    >
                                                        {{ Auth::user()->followings->contains($user->id) ? 'Parar de Seguir' : 'Seguir' }}
                                                    </button>
                                                    @else
                                                    <span class="text-warning">Esse é o seu perfil.</span>
                                                @endif
                                            @endauth
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <div class="col-6">
                                        <p class="text-body-secondary">

                                            @switch($file->instrumento)

                                                @case('Guitarra')
                                                <span class="badge bg-primary">{{ $file->instrumento }}</span>
                                                @break

                                                @case('Violão')
                                                <span class="badge bg-warning">{{ $file->instrumento }}</span>
                                                @break

                                                @case('Baixo')
                                                <span class="badge bg-success">{{ $file->instrumento }}</span>
                                                @break

                                                @default

                                            @endswitch

                                            @foreach ($styles as $style)
                                                <span class="badge bg-secondary">{{ $style->style }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="float-end text-body-secondary">
                                            <span class="fw-bold">Tags:</span> {{ $file->tags }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                        @if(!empty($file->img))
                                        <div class="col-2">
                                            <img src="{{ asset($file->img) }}" class="rounded img-fluid" alt="{{ $file->nome }}" width="200">
                                        </div>
                                        <div class="col-10">
                                            <h2 class="card-title h5 d-flex align-items-center">{{ $file->nome }}</h2>
                                            <p class="text-body-tertiary fs-sm">
                                                {{ $file->descricao }}
                                            </p>
                                        </div>
                                        @else
                                        <div class="col-12">
                                            <h2 class="card-title h5 d-flex align-items-center">{{ $file->nome }}</h2>
                                            <p class="text-body-tertiary fs-sm">
                                                {{ $file->descricao }}
                                            </p>
                                        </div>
                                        @endif
                                </div>

                                <div class="mb-4 row">
                                    <div class="col-12">
                                        <span class="text-info small">{{ \Carbon\Carbon::parse($file->data)->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">

                                        <button
                                            id="share-button"
                                            data-file-id="{{ $file->id }}"
                                            class="btn btn-outline-primary"
                                            title="Compartilhar"
                                        >
                                            <i class="bi bi-share-fill"></i>
                                        </button>

                                        @php
                                            $i=0;
                                            foreach ($likes as $like){
                                                if ($like->file_id == $file->id && $like->user_id == auth()->id()){
                                                    $i=1;
                                                    $like_id=$like->id;
                                                }
                                            }
                                        @endphp

                                        @if($i==1)
                                        <form action="{{ route('like.destroy', $like_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary" title="Você curtiu">
                                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('like.store') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="file_id" value="{{ $file->id }}">
                                            <button type="submit" class="btn btn-outline-primary" title="Curtir">
                                                <i class="bi bi-hand-thumbs-up"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="col-6 text-end">
                                        <form method="POST" action="{{ route('download.arquivos') }}">
                                            @csrf
                                            <input type="hidden" name="file_path" value="{{ $file->file_path }}">
                                            <input type="hidden" name="file_id" value="{{ $file->id }}">
                                            <button class="btn btn-sm btn-outline-primary" type="submit">
                                                <i class="bi bi-download"></i> Download
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div id="share-link-container" style="margin-top: 15px; display: none;">
                                        <p>Link de Download Compartilhado:</p>
                                        <input type="text" id="share-link-input" readonly style="width: 100%;" class="form-group btn btn-secondary">
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <form method="POST" action="{{ route('comment.store') }}">
                                            @csrf
                                            <input type="hidden" name="file_id" value="{{ $file->id }}">
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Deixe um comentário</label>
                                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-chat-square"></i>
                                                    Comentar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-body-secondary">
                                            <i class="fa-solid fa-share-nodes"></i>
                                            <span class="text-info">{{ $total_shares }}</span>
                                            <i class="fa-solid fa-comment"></i>
                                            <span class="text-info">{{ $total_comments }}</span>
                                            <i class="fa-solid fa-heart"></i>
                                            <span class="text-info">{{ $total_likes }}</span>
                                            <i class="fa-solid fa-download"></i>
                                            <span class="text-info">{{ $file->total_downloads }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                @foreach ($comments as $comment)

                        <div class="col-md-12">
                            <div class="border-0 card bd-card h-100">
                                <div class="card-head">
                                    <div class="mb-4 row">
                                        <div class="col-12">
                                            <div class="p-4 card-title h4 text-warning">
                                                {{ $comment->user_name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4 row">
                                        <div class="col-2">
                                            @if(!empty($comment->user_foto))
                                                <img src="{{ asset($comment->user_foto) }}" class="rounded-circle" width="80" height="80">
                                            @else
                                                <img src="{{ asset('storage/images/user-1.png') }}" class="rounded-circle" width="80" height="80">
                                            @endif

                                        </div>
                                        <div class="col-10">
                                            <span class="text-secondary fst-italic">{{ $comment->user_email }}</span>
                                            <p>
                                                {{ $comment->texto }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <div class="col-6">
                                            <a href="#"><i class="bi bi-hand-thumbs-up"></i></a> 0
                                            <a href="#"><i class="bi bi-hand-thumbs-down"></i></a> 0
                                        </div>
                                        <div class="col-6 text-end">
                                            <span class="text-info small">{{ \Carbon\Carbon::parse($comment->created_at)->format('d M Y H:i:s') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                @endforeach

            </div>

        </div>

        <script>
            document.getElementById('share-button').addEventListener('click', function() {

                const fileId = this.getAttribute('data-file-id');
                const url = `/file/${fileId}/share`;
                const token = document.querySelector('meta[name="csrf-token"]').content;

                // Requisição AJAX para gerar o link
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Exibe o link assinado no campo de texto
                        const input = document.getElementById('share-link-input');
                        input.value = data.share_url;
                        document.getElementById('share-link-container').style.display = 'block';
                        input.select(); // Seleciona o texto para fácil cópia
                        alert(data.message);
                    } else {
                        alert('Erro ao gerar link.');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Ocorreu um erro ao processar a requisição.');
                });
            });
        </script>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    const followBtn = document.getElementById('follow-btn');
    const followersCountSpan = document.getElementById('followers-count');
    const messageBox = document.getElementById('status-message'); // O nosso "alert" estilizado

    if (followBtn) {
        followBtn.addEventListener('click', function() {
            const userIdToFollow = this.getAttribute('data-user-id');
            const url = `/user/${userIdToFollow}/follow`;
            const token = document.querySelector('meta[name="csrf-token"]').content;

            // Função para manipular a exibição da mensagem
            const displayMessage = (message, type) => {
                messageBox.style.display = 'block';
                messageBox.classList.remove('success', 'error', 'btn-primary', 'btn-secondary');
                messageBox.classList.add(type); // Adiciona 'success' ou 'error' para estilização
                messageBox.textContent = message;

                // Esconde a mensagem após 5 segundos
                setTimeout(() => {
                    messageBox.style.display = 'none';
                }, 5000);
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) {
                    // Trata respostas HTTP que não são 2xx (ex: 403, 500)
                    throw new Error('Ação não permitida ou erro no servidor.');
                }
                return response.json();
            })
            .then(data => {
                // 1. Atualiza o texto do botão
                if (data.status === 'following') {
                    followBtn.textContent = 'Parar de Seguir';
                    followBtn.classList.remove('btn-primary');
                    followBtn.classList.add('btn-secondary');
                } else {
                    followBtn.textContent = 'Seguir';
                    followBtn.classList.remove('btn-secondary');
                    followBtn.classList.add('btn-primary');
                }

                // 2. Atualiza a contagem de seguidores
                if (followersCountSpan && data.followers_count !== undefined) {
                    followersCountSpan.textContent = data.followers_count;
                }

                // 3. Exibe a mensagem de sucesso
                displayMessage(data.message, 'success');

            })
            .catch(error => {
                // Exibe a mensagem de erro (incluindo erros de rede/servidor)
                displayMessage('Erro: ' + error.message, 'error');
                console.error('Erro:', error);
            });
        });
    }
});
</script>







@endsection


