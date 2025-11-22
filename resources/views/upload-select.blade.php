@extends('master-user')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 text-center py-md-6 py-xl-2">
                        <h5>
                            <a href="{{ route('inicio') }}" style="text-decoration: none;" title="Voltar">
                                <i class="bi bi-arrow-left-circle"></i>
                            </a> Upload
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bd-main-content">
        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20">

                @foreach ($errors->all() as $error)
                        <div class="text-center alert alert-primary alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                @endforeach

                <div class="mt-4 row g-8">
                    @foreach ($segments as $s)
                        <a href="{{ route('upload.segment', ['id' => $s->id]) }}" style="text-decoration: none;">
                            <div class=col-md-6>
                                <div class="border-0 card bd-card h-100">
                                    <div class=card-body>
                                        <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center bd-icon-purple">
                                            <i class="bi bi-file-earmark-music-fill"></i>
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">{{ $s->nome }}</h2>
                                        <p class="text-body-tertiary fs-sm">
                                            {{ $s->descricao }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
