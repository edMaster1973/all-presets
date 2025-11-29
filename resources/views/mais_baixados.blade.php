@extends('master')

@section('content')

    <div class="bd-main-content">

        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">

            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">

                <div class="row g-8">

                    @if(!empty($files))

                    <div class="table-responsive">
                        <table class="table data-table stripe hover" id="minhaTabela">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th>Tipo</th>
                                    <th>Produto</th>
                                    <th>Usuário</th>
                                    <th>Arquivo</th>
                                    <th>Data</th>
                                    <th>Downloads</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $f)
                                <tr>
                                    <td class="table-plus">{{ $f->id }}</td>
                                    <td class="text-info">{{ $f->segmento }}</td>
                                    <td class="text-secondary">{{ $f->produto_nome }}</td>
                                    <td class="text-secondary">{{ $f->user_name }}</td>
                                    <td class="text-secondary">{{ $f->nome }}</td>
                                    <td class="text-warning">{{ \Carbon\Carbon::parse($f->data)->format('d M Y') }}</td>
                                    <td> {{ $f->total_downloads ?? 0 }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif
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

@endsection
