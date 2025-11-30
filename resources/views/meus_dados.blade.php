@extends('master-user')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 text-center py-md-6 py-xl-2">
                        <h5>Meus Dados</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">

        <div class="row g-2 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="py-4 text-center py-md-4 py-xl-2">
                    <p>
                        <a href="{{ route('inicio') }}" style="text-decoration: none;">
                            <i class="bi bi-arrow-left-circle"></i> Voltar
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20">

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
                <div class="col-md-6">
                    <div class="border-0 card bd-card">
                        <div class="card-body">
                            <div class="pt-4 card-body profile-card d-flex flex-column align-items-center">
                            @if(!empty(Auth::user()->foto_perfil))
                                <img src="{{ asset(Auth::user()->foto_perfil) }}" class="mb-3 rounded-circle" width="120" alt="Foto de Perfil">
                            @else
                                <img src="{{ asset('storage/images/user-1.png') }}" class="mb-3" width="120" alt="Foto de Perfil">
                            @endif
                            </div>
                            <h5 class="card-title h5 d-flex align-items-center">Foto de Perfil</h5>
                            <form method="POST" action="{{ route('foto_perfil') }}" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="image" accept="image/*">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Alterar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border-0 card bd-card">
                        <div class="card-body">
                            <div class="card-body profile-card d-flex flex-column">
                                <span class="fw-bold">Nome</span> {{ Auth::user()->name }}
                                <br>
                                <span class="fw-bold">Email</span> {{ Auth::user()->email }}.
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col text-end">
                                    <span class="fw-bold">Criando em</span> {{ strftime("%d/%m/%Y", strtotime(Auth::user()->created_at))  }} {{ strftime("%H:%M:%S", strtotime(Auth::user()->created_at))  }} <br>
                                    <span class="fw-bold">Atualizado em</span> {{ strftime("%d/%m/%Y", strtotime(Auth::user()->updated_at))  }} {{ strftime("%H:%M:%S", strtotime(Auth::user()->updated_at))  }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
