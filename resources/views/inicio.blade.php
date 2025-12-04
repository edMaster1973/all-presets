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
                    <img src="{{ Vite::asset('resources/images/img-fundo-4.png') }}" alt="Imagem de boas-vindas" width="580">
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

                            <div class="col-md-3">
                                <div class="mb-3 input-group">
                                    <select class="form-select" id="marca" name="marca_id" aria-label="Selecione a Marca">
                                        <option value=""> - Marca - </option>
                                        @foreach ($marcas as $m)
                                            <option value="{{ $m->id }}">{{ $m->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
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

                            <div class="col-md-2">
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
                                            <span class="fw-bold">{{ $f->segmento }}</span> <span class="text-warning small">{{ $f->produto_nome }}</span>
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
                                                        <span class="badge bg-secondary">{{ $s->style }}</span>
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <p class="text-body-secondary fs-xs">
                                                    <a href="{{ route('saiba_mais',['file' => $f->id]) }}" target="_blank">
                                                        Saiba Mais >
                                                    </a>
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="gap-2 row">
                                            <div class="col text-start">

                                                <p class="text-body-secondary">

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

                    <div class="row g-8">
                        <div class="items-center mt-3 justify-content-center">
                            <nav aria-label="Page navigation example">
                                {{ $files->links() }}
                            </nav>
                        </div>
                    </div>

                {{-- fim search files --}}
                @endif

            </div>

@endsection
