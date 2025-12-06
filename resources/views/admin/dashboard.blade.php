@extends('admin.master')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 py-md-6 py-lg-10 py-xl-20">
                        <h4 class=mb-0>Admin <span class="text-warning">{{ Auth::user()->name }}</span></h4>
                        <p class="mt-3 text-body-secondary">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
                <div class="d-none d-md-block col-md-4 col-lg-6">
                    <img src="{{ Vite::asset('resources/images/img-fundo-4.png') }}" alt="Imagem de boas-vindas" width="580">
                </div>
            </div>
        </div>
    </div>

    <div class="bd-main-content">
        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">

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


                            <div class=col-md-4>
                                <div class="border-0 card bd-card">
                                    <div class=card-body>
                                        <p>
                                            <span class="fw-bold"> Texto </span> <span class="text-warning small"> ... </span>
                                        </p>
                                        <div class="row">
                                            <div class="col-2 text-end">
                                                <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center">
                                                    <img src="{{ Vite::asset('resources/images/user-1.png') }}" class="rounded-circle" width="65" height="65">
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <span> user_name </span>
                                                <br>
                                                <small class="text-secondary fst-italic">... seguidores</small>
                                            </div>
                                        </div>

                                        <h2 class="card-title h5 d-flex align-items-center">...</h2>

                                        <div class="row">

                                                <div class="col-6">
                                                    image
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-body-tertiary fs-sm">
                                                        Texto
                                                    </p>
                                                    <p><span class="text-info small">07 Dez 2025 19:22:57</span></p>
                                                </div>

                                            <div class="col-12">
                                                <p class="text-body-tertiary fs-sm">
                                                    Descrição do arquivo...
                                                </p>
                                            </div>

                                        </div>

                                        <br>

                                        <div class="row">
                                            <p class="text-body-secondary">
                                                <span class="badge bg-success">Baixo</span>
                                                <span class="badge bg-secondary">Blues</span>
                                            </p>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <p class="text-body-secondary fs-xs">
                                                    <a href="#">
                                                        Saiba Mais >
                                                    </a>
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="gap-2 row">
                                            <div class="col text-start">

                                                <p class="text-body-secondary">

                                                    <i class="fa-solid fa-share-nodes"></i>
                                                    <span class="text-info">809</span>

                                                    <i class="fa-solid fa-comment"></i>
                                                    <span class="text-info">355</span>

                                                    <i class="fa-solid fa-heart"></i>
                                                    <span class="text-info">1142</span>

                                                    <i class="fa-solid fa-download"></i>
                                                    <span class="text-info">5543</span>

                                                </p>
                                            </div>
                                            <div class="col text-end">
                                                <button class="btn btn-sm btn-outline-primary" type="button">
                                                    Download
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

            </div>

@endsection
