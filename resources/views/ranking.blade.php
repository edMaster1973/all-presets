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

@endsection
