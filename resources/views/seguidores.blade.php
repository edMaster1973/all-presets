@extends('master-auth')

@section('content')

<div class="bd-main-content">
    <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
        <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">
            <div class="text-center row g-8">
                <h5 class="text-primary">Estão seguindo você</h5>
            </div>
            <div class="row g-8">
                @if(!empty($followers))
                    <div class="table-responsive">
                        <table class="table data-table stripe hover" id="minhaTabela">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Membro desde</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($followers as $f)
                                <tr>
                                    <td class="table-plus">
                                        <img src="{{ $f->foto }}" alt="User Photo" width="50" class="rounded-circle">
                                    </td>
                                    <td>
                                        {{ $f->user_name }}
                                    </td>
                                    <td>
                                        <span class="text-secondary">{{ $f->user_email }}</span>
                                    </td>
                                    <td class="text-warning">
                                        {{ \Carbon\Carbon::parse($f->created_at)->format('d M Y H:i:s') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
@endsection
