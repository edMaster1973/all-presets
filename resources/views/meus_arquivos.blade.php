@extends('master-auth')

@section('content')

    <div class="bd-main-content">

        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">

            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">

                {{-- alert success --}}
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

                <div class="row g-8">

                    @if(!empty($files))

                    <div class="table-responsive">
                        <table class="table data-table stripe hover" id="minhaTabela">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th>Tipo</th>
                                    <th>Equipamento</th>
                                    <th>Arquivo</th>
                                    <th>Privacidade</th>
                                    <th>Data</th>
                                    <th>Downloads</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $f)
                                <tr>
                                    <td class="table-plus">{{ $f->id }}</td>
                                    <td>
                                        <span class="text-info">{{ $f->segmento }}</span>
                                        <br>
                                        <span class="text-secondary">{{ $f->instrumento }}</span>
                                    </td>
                                    <td class="text-secondary">{{ $f->produto_nome }}</td>
                                    <td class="text-secondary">{{ $f->nome }}</td>
                                    <td class="text-secondary">{{ $f->privacidade }}</td>
                                    <td class="text-warning">
                                        {{ \Carbon\Carbon::parse($f->data)->format('d M Y') }}
                                        <br>
                                        <span class="text-secondary">{{ \Carbon\Carbon::parse($f->data)->format('H:i:s') }}</span>
                                    </td>
                                    <td> {{ $f->total_downloads ?? 0 }} </td>
                                    <td class="text-end" width="15%">
                                        <button class="btn btn-sm btn-warning" title="Visualizar" data-bs-toggle="modal" data-bs-target="#visualizar{{ $f->id }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Baixar">
                                            <i class="fa fa-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" title="Editar" data-bs-toggle="modal" data-bs-target="#editar{{ $f->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Excluir">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal visualizar -->
                                <div class="modal fade" id="visualizar{{ $f->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Visualizar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $f->id }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- fim modal visualizar --}}

                                <!-- Modal editar -->
                                <div class="modal fade" id="editar{{ $f->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Editar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('file.update', ['file' => $f->id]) }}" enctype="multipart/form-data">

                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">

                                                <div style="overflow-y: scroll; max-height: 350px;">

                                                {{-- input nome --}}
                                                <div class="mb-3">
                                                    <label for="nome{{ $f->id }}" class="form-label">Nome do arquivo</label>
                                                    <input type="text" class="form-control" id="nome{{ $f->id }}" name="nome" value="{{ $f->nome }}" required>
                                                </div>
                                                {{-- textarea descricao --}}
                                                <div class="mb-3">
                                                    <label for="descricao{{ $f->id }}" class="form-label">Descrição</label>
                                                    <textarea class="form-control" id="descricao{{ $f->id }}" name="descricao" rows="3" required>{{ $f->descricao }}</textarea>
                                                </div>

                                                {{-- input tags --}}
                                                <div class="mb-3">
                                                    <label for="tags{{ $f->id }}" class="form-label">Tags (separadas por vírgula)</label>
                                                    <input type="text" class="form-control" id="tags{{ $f->id }}" name="tags" value="{{ $f->tags }}" required>
                                                </div>

                                                {{-- input link_audio --}}
                                                <div class="mb-3">
                                                    <label for="link_audio{{ $f->id }}" class="form-label">Link do Áudio</label>
                                                    <input type="text" class="form-control" id="link_audio{{ $f->id }}" name="link_audio" value="{{ $f->link_audio }}" required>
                                                </div>

                                                {{-- input link_video --}}
                                                <div class="mb-3">
                                                    <label for="link_video{{ $f->id }}" class="form-label">Link do Vídeo</label>
                                                    <input type="text" class="form-control" id="link_video{{ $f->id }}" name="link_video" value="{{ $f->link_video }}" required>
                                                </div>

                                                {{-- select instrumento --}}
                                                <div class="mb-3">
                                                    <label for="instrumento{{ $f->id }}" class="form-label">Instrumento</label>
                                                    <select class="form-select" id="instrumento{{ $f->id }}" name="instrumento" required>
                                                        <option value="Guitarra" {{ $f->instrumento == 'Guitarra' ? 'selected' : '' }}>Guitarra</option>
                                                        <option value="Baixo" {{ $f->instrumento == 'Baixo' ? 'selected' : '' }}>Baixo</option>
                                                        <option value="Bateria" {{ $f->instrumento == 'Bateria' ? 'selected' : '' }}>Bateria</option>
                                                        <option value="Teclado" {{ $f->instrumento == 'Teclado' ? 'selected' : '' }}>Teclado</option>
                                                        <option value="Voz" {{ $f->instrumento == 'Voz' ? 'selected' : '' }}>Voz</option>
                                                    </select>
                                                </div>

                                                {{-- file input image_path --}}
                                                <div class="mb-3">
                                                    <label for="image_path{{ $f->id }}" class="form-label">Imagem</label>
                                                    <input class="form-control" type="file" id="image_path{{ $f->id }}" name="image_path">
                                                </div>

                                                {{-- radio privacidade --}}
                                                <div class="mb-3">
                                                    <label class="form-label">Privacidade</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="privacidade" id="priv1{{ $f->id }}" value="publico" @if($f->privacidade == 'publico') checked @endif >
                                                        <label class="form-check-label" for="priv1{{ $f->id }}">
                                                            Público
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="privacidade" id="priv2{{ $f->id }}" value="privado" @if($f->privacidade == 'privado') checked @endif>
                                                        <label class="form-check-label" for="priv2{{ $f->id }}">
                                                            Privado
                                                        </label>
                                                    </div>
                                                </div>

                                                </div>

                                            </div>

                                            <hr>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                            </div>

                                        </form>


                                        </div>
                                    </div>
                                </div>
                                {{-- fim modal editar --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif
            </div>

@endsection
