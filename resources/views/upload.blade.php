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

                        <div class="mb-4 row g-2">
                            <div class="align-items-center">
                                <span class="fw-bold">{{ Auth::user()->name }}</span>
                                <br>
                                <span class="small">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                        @foreach ($errors->all() as $error)
                        <div class="text-center alert alert-primary alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach

                        <form method="POST" action="{{ route('file.store') }}" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="segment_id" value="{{ $segment->id }}">

                            @if ($segment->nome=='Tones')
                            {{-- select category_id --}}
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-bold">Categoria <span class="text-danger">*</span></label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value=""> - Selecione - </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            @if($segment->nome=='Tones')
                            {{-- select style_id --}}
                            <div class="mb-3">
                                <label for="style_id" class="form-label fw-bold">Estilo <span class="text-danger">*</span></label>
                                <select class="form-select" id="style_id" name="style_id" required>
                                    <option value=""> - Selecione - </option>
                                    @foreach ($styles as $style)
                                        @if($style->segment_id == $segment->id)
                                            <option value="{{ $style->id }}">{{ $style->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @else
                                {{-- input checkbox styles populado pela tabela styles --}}
                                <label class="form-label fw-bold">Estilos</label>
                                @foreach ($styles as $style)
                                    @if($style->segment_id == $segment->id)
                                    <div class="mb-2 form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $style->id }}" id="style_{{ $style->id }}" name="styles[]">
                                        <label class="form-check-label" for="style_{{ $style->id }}">
                                            {{ $style->nome }}
                                        </label>
                                    </div>
                                    @endif
                                @endforeach
                            @endif

                            {{-- select marca_id --}}
                            <div class="mb-3">
                                <label for="marca" class="form-label fw-bold">Marca <span class="text-danger">*</span></label>
                                <select class="form-select" id="marca" name="marca_id" required>
                                    <option value=""> - Selecione - </option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- select equipament_id --}}
                            <div class="mb-3">
                                <label for="equipamento" class="form-label fw-bold">Equipamento <span class="text-danger">*</span></label>
                                <select class="form-select" id="equipamento" name="equipament_id" required>
                                    <option> - Selecione - </option>
                                </select>
                            </div>

                            {{-- select instrumento --}}
                            <div class="mb-3">
                                <label for="instrumento" class="form-label fw-bold">Instrumento <span class="text-danger">*</span></label>
                                <select class="form-select" id="instrumento" name="instrumento" required>
                                    <option value=""> - Selecione - </option>
                                    <option value="Guitarra">Guitarra</option>
                                    <option value="Baixo">Baixo</option>
                                    <option value="Violão">Violão</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nome" class="form-label fw-bold">Nome <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label fw-bold">Descrição</label>
                                <input type="text" class="form-control" id="descricao" name="descricao">
                            </div>

                            {{-- input file_path --}}
                            <div class="mb-3">
                                <label for="file" class="form-label fw-bold">Arquivo <span class="text-warning">({{ $segment->nome }})</span> <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="file" name="file" accept=".16p,.16t,.prst,.tsl,.syx,.kpr,.kpa,.nam,.nfp,.mo,.GNR,.GIR,.wav,.K8,.mfx,.tone,.clo" required>
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

{{-- <script>
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
</script> --}}

@endsection
