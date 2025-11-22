@extends('master-user')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 text-center py-md-6 py-xl-2">
                        <h5>Alterar Senha</h5>
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
                                <a href="{{ route('inicio') }}" style="text-decoration: none;">
                                    <i class="bi bi-arrow-left-circle"></i> Voltar
                                </a>
                            </div>
                        </div>

                        {{-- alert --}}
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

                        <form method="POST" action="{{ route('update_password') }}">

                            @csrf @method('put')

                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-bold">Senha Atual</label>
                                <input type="password" class="form-control" id="current_password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label fw-bold">Nova Senha</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-bold">Confirmar Nova Senha</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Alterar Senha</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
