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
                    <img src="{{ Vite::asset('resources/images/img-fundo-3.png') }}" alt="Imagem de boas-vindas" width="640">
                </div>
            </div>
        </div>
    </div>

    <div class="bd-main-content">
        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">
                <div class="row g-8">

                    @foreach ($files as $f)
                        @if($f->privacidade == 'publico')
                        {{-- inicio card --}}
                            <div class=col-md-4>
                                <div class="border-0 card bd-card">
                                    <div class=card-body>
                                        <p>
                                            <span class="fw-bold">{{ $f->segmento }}</span> <span class="text-warning small">{{ $f->produto_nome }}</span>
                                        </p>
                                        <div class="row">
                                            <div class="col-2 text-end">
                                                <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center">
                                                    @if(!empty($f->foto))
                                                        <img src="{{ asset($f->foto) }}" class="rounded-circle" width="40" height="40">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <span>{{ $f->user_name }}</span>
                                                <br>
                                            {{-- exibir data no formato dia mes_abreviado ano --}}
                                                <span class="text-info small">{{ \Carbon\Carbon::parse($f->data)->format('d M Y') }}</span>
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
                                            <p class="text-body-secondary">
                                                @switch($f->instrumento)
                                                    @case('Guitarra')
                                                    <span class="badge bg-info">{{ $f->instrumento }}</span>
                                                    @break

                                                    @case('Violão')
                                                    <span class="badge bg-warning">{{ $f->instrumento }}</span>
                                                    @break

                                                    @case('Baixo')
                                                    <span class="badge bg-success">{{ $f->instrumento }}</span>
                                                    @break

                                                    @default

                                                @endswitch

                                                @foreach ($styles as $s)
                                                    @if($s->file_id == $f->id)
                                                        <span class="badge bg-secondary">
                                                            {{ $s->style }}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <p class="text-body-secondary">
                                                    {{ $f->tags }}
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="gap-2 row">
                                            <div class="col text-start">
                                                <p class="text-body-secondary">

                                                    <i class="fa-solid fa-share-nodes"></i>
                                                    <span class="text-info"> {{ $f->total_shares }}</span>

                                                    <i class="fa-solid fa-comment"></i>
                                                    <span class="text-info">{{ $f->total_comments }}</span>

                                                    <i class="fa-solid fa-heart"></i>
                                                    <span class="text-info">{{ $f->total_likes }}</span>

                                                    <i class="fa-solid fa-download"></i>
                                                    <span class="text-info">{{ $f->total_downloads }}</span>

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
                        <div class="items-center mt-3 justify-content-center">
                            <nav aria-label="Page navigation example">
                                {{ $files->links() }}
                            </nav>
                        </div>
                    </div>
            </div>

@endsection
