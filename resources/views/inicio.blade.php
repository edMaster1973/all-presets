@extends('master-auth')

@section('content')

    <div class=bd-intro>
        <div class="px-4 bd-bg-light px-md-6 px-lg-10 px-xl-20">
            <div class="row g-0">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="py-4 py-md-6 py-lg-10 py-xl-20">
                        <h4 class=mb-0>Bem-vindo(a) {{ Auth::user()->name }}</h4>
                        <p class="mt-3 text-body-secondary">
                            {{ Auth::user()->email }}.
                        </p>
                    </div>
                </div>
                <div class="d-none d-md-block col-md-4 col-lg-6">
                    <img class="h-auto max-w-sm w-100" src="{{ asset('storage/images/get-started@2x.png') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="bd-main-content">
        <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">
            <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">
                <div class="row g-8">
                    <div class="col-md-4">
                        <div class="border-0 card bd-card">
                            <div class="card-body">
                                <p>
                                    <span class="text-warning small">Hotone Ampero 2 Stomp (v2.3.1)</span>
                                </p>
                                <div class="row">
                                    <div class="col-2 text-end">
                                        <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center">
                                                    <img src="{{ asset('storage/profiles/edson.jpeg') }}" class="rounded-circle" width="40" height="40">
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <span>edMaster1973</span>
                                                <br>
                                                <span class="text-body-secondary fs-xs">24 set 2025</span>
                                            </div>
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">NCM Vitória</h2>
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="{{ asset('storage/images/p-vitoria.png') }}" class="h-auto w-100 rounded-3">
                                            </div>
                                            <div class="col-6">
                                                <p class="text-body-tertiary fs-sm">
                                                    Preset para música Vitória - NC Music (Novos Começos Niterói).
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <p class="text-body-secondary fs-xs">
                                                <span class="badge bg-primary">#Guitarra</span>
                                                <span class="badge bg-secondary">#Pop</span>
                                                <span class="badge bg-secondary">#Rock</span>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="text-body-secondary fs-xs">
                                                    1 Arquivo(s)
                                                </p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="text-body-secondary fs-xs">
                                                    <a href="#">Saiba Mais ></a>
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="gap-2 col text-start">
                                                <p class="text-body-secondary fs-xs">
                                                    <i class="fa-solid fa-share-nodes"></i> 7
                                                    <i class="fa-solid fa-comment"></i> 2
                                                    <i class="fa-solid fa-thumbs-up"></i> 5
                                                    <i class="fa-solid fa-download"></i> 79
                                                </p>
                                            </div>
                                            <div class="col text-end">
                                                <button class="btn btn-primary">Download</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class=col-md-4>
                                <div class="border-0 card bd-card">
                                    <div class=card-body>
                                        <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center bd-icon-purple">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">Quick Start</h2>
                                        <p class="text-body-tertiary fs-sm">
                                            Get started with FastBootstrap in no time.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class=col-md-4>
                                <div class="border-0 card bd-card">
                                    <div class=card-body>
                                        <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center bd-icon-purple">
                                            <i class="fa-solid fa-moon"></i>
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">
                                            Dark Mode<span class="lozenge me-2 me-lg-4 text-uppercase fw-medium fs-xs new ms-auto">beta</span>
                                        </h2>
                                        <p class="text-body-tertiary fs-sm">Using our new dark mode on your site.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 row g-8">

                            <div class=col-md-6>
                                <div class="border-0 card bd-card h-100">
                                    <div class=card-body>
                                        <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center bd-icon-purple">
                                            <i class="fa-brands fa-js"></i>
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">Javascript</h2>
                                        <p class="text-body-tertiary fs-sm">
                                            Bootstrap JS components implemented with TypeScript. Learn about each plugin, our data and programmatic API options, and more.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class=col-md-6>
                                <div class="border-0 card bd-card h-100">
                                    <div class=card-body>
                                        <div class="mb-4 rounded bd-w-12 bd-h-12 d-flex justify-content-center align-items-center bd-icon-purple">
                                            <i class="fa-brands fa-js"></i>
                                        </div>
                                        <h2 class="card-title h5 d-flex align-items-center">Javascript</h2>
                                        <p class="text-body-tertiary fs-sm">
                                            Bootstrap JS components implemented with TypeScript. Learn about each plugin, our data and programmatic API options, and more.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    </div>

@endsection
