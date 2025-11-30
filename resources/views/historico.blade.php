@extends('master-auth')

@section('content')

    <div class="bd-main-content">

        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">

            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">

                <div class="row g-8">

                    @if(!empty($downloads))

                    <div class="table-responsive">
                        <table class="table data-table stripe hover" id="minhaTabela">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th>By</th>
                                    <th>Tipo</th>
                                    <th>Equipamento</th>
                                    <th>Arquivo</th>
                                    <th>Data</th>
                                    <th>Baixado em</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($downloads as $d)
                                <tr>
                                    <td class="table-plus">
                                        <img src="{{ $d->user_foto }}" alt="User Photo" width="50" class="rounded-circle">
                                    </td>
                                    <td>
                                        {{ $d->user_name }}
                                        <br>
                                        <span class="text-secondary">{{ $d->user_email }}</span>
                                    </td>
                                    <td>
                                        <span class="text-info">{{ $d->segmento }}</span>
                                        <br>
                                        <span class="text-secondary">{{ $d->instrumento }}</span>
                                    </td>
                                    <td class="text-secondary">{{ $d->produto_nome }}</td>
                                    <td class="text-secondary">{{ $d->file_name }}</td>
                                    <td class="text-warning">
                                        {{ \Carbon\Carbon::parse($d->file_date)->format('d M Y') }}
                                        <br>
                                        <span class="text-secondary">{{ \Carbon\Carbon::parse($d->file_date)->format('H:i:s') }}</span>
                                    </td>
                                    <td class="text-success">
                                        {{ \Carbon\Carbon::parse($d->downloaded_at)->format('d M Y') }}
                                        <br>
                                        <span class="text-secondary">{{ \Carbon\Carbon::parse($d->downloaded_at)->format('H:i:s') }}</span>
                                    </td>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    @endif
            </div>

@endsection
