@extends('master-auth')

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
                                        <button class="btn btn-sm btn-warning" title="Visualizar">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Baixar">
                                            <i class="fa fa-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Excluir">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif
            </div>

@endsection
