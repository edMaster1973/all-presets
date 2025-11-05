@extends('master-user')

@section('content')

    <div class="bd-intro">
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0 justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <a href="{{ route('inicio') }}" class="link" style="text-decoration: none;">
                                <i class="bi bi-arrow-left-circle"></i> Voltar
                            </a>
                    <div class="py-4 py-md-6 py-lg-10 py-xl-20">
                        <h4 class=mb-0>Meus Dados</h4>
                        <p class="mt-3 text-body-secondary">
                            <span class="fw-bold">Nome:</span> {{ Auth::user()->name }}<br>
                            <span class="fw-bold">Email:</span> {{ Auth::user()->email }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
