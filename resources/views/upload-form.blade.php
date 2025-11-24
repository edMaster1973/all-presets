@extends('master-user')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 text-center py-md-6 py-xl-2">
                        <h5>Upload • <span class="text-primary">{{ $segment->nome }}</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bd-intro">
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0 justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="py-4 py-md-4 py-lg-10 py-xl-20">

                        <div class="mb-4 row g-2">
                            <div class="align-items-center">
                            <a href="{{ route('upload') }}" style="text-decoration: none;" title="Voltar">
                                <i class="bi bi-arrow-left-circle"></i> Voltar
                            </a>
                            </div>
                        </div>

                        @foreach ($errors->all() as $error)
                        <div class="text-center alert alert-primary alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach

                        <div class="mb-4 row g-2">
                            <div class="align-items-center">
                                <span class="fw-bold">{{ Auth::user()->name }}</span>
                                <br>
                                <span class="small">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('file.store') }}" encrytype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="segment_id" value="{{ $segment->id }}">

                            {{-- select category_id --}}
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-bold">Categoria</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value=""> - Selecione - </option>
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- select marca_id --}}
                            <div class="mb-3">
                                <label for="marca_id" class="form-label fw-bold">Marca</label>
                                <select class="form-select" id="marca_id" name="marca_id" required>
                                    <option value=""> - Selecione - </option>
                                    <option></option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- select equipament_id --}}
                            <div class="mb-3">
                                <label for="equipament_id" class="form-label fw-bold">Equipamento</label>
                                <select class="form-select" id="equipament_id" name="equipament_id" required>
                                    <option value=""> - Selecione - </option>
                                    <option></option>
                                    @foreach ($equipaments as $equipament)
                                        <option value="{{ $equipament->id }}">{{ $equipament->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- select instrumento --}}
                            <div class="mb-3">
                                <label for="instrumento" class="form-label fw-bold">Instrumento</label>
                                <select class="form-select" id="instrumento" name="instrumento" required>
                                    <option value=""> - Selecione - </option>
                                    <option value=""></option>
                                    <option value="Guitarra">Guitarra</option>
                                    <option value="Baixo">Baixo</option>
                                    <option value="Violão">Violão</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nome" class="form-label fw-bold">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label fw-bold">Descrição</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" required>
                            </div>

                            {{-- input file image --}}
                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold">Imagem</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>

                            {{-- input text tags --}}
                            <div class="mb-3">
                                <label for="tags" class="form-label fw-bold">Tags</label>
                                <input type="text" class="form-control" id="tags" name="tags">
                            </div>

                            {{-- input text link_audio --}}
                            <div class="mb-3">
                                <label for="link_audio" class="form-label fw-bold">Link Áudio</label>
                                <input type="text" class="form-control" id="link_audio" name="link_audio">
                            </div>

                            {{-- input text link_video --}}
                            <div class="mb-3">
                                <label for="link_video" class="form-label fw-bold">Link Vídeo</label>
                                <input type="text" class="form-control" id="link_video" name="link_video">
                            </div>

                            {{-- radio privacidade com valores Público e Privado --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Privacidade</label>
                                <div>
                                    <input type="radio" id="publico" name="privacidade" value="publico" required checked>
                                    <label for="publico" class="form-label">Público</label>
                                </div>
                                <div>
                                    <input type="radio" id="privado" name="privacidade" value="privado" required>
                                    <label for="privado" class="form-label">Privado</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
