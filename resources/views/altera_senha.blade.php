@extends('master-user')

@section('content')

    <div class="bd-intro">

        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">

            <div class="row g-0 justify-content-center">

                <div class="col-12 col-md-6 col-lg-5">

                        <div class="row align-items-center">
                            <p>
                                <span class="fw-bold">{{ Auth::user()->name }}</span> <span class="small">{{ Auth::user()->email }}</span> <br>
                                <a href="{{ route('inicio') }}" class="link" style="text-decoration: none;">
                                <i class="bi bi-arrow-left-circle"></i> Voltar
                                </a>
                            </p>
                        </div>

                    <div class="py-4 py-md-4 py-lg-10 py-xl-20">

                        <h4 class=mb-0>Alterar Senha</h4>
                        <form method="POST" action="#">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Senha Atual</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nova Senha</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirmar Nova Senha</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Alterar Senha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
