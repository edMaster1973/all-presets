<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('storage/images/favicon.ico') }}">
    <title>All Presets</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="bd-layout">

        <main class=bd-main>

            <div class="px-0 mx-auto max-w-screen-lx px-md-0 px-lg-0 px-xl-0">

                <div class="px-12 my-8 px-md-12 px-lg-20 px-xl-20 ">

                    <div class="row g-8 items-center justify-content-center">

                        <div class=col-md-12>

                            <div class="items-center gap-3 mb-4 text-center">
                                <img src="{{ asset('images/all-presets-logo.png') }}" alt="Logo All Presets" width="75" height="75">
                            </div>

                            <div class="items-center gap-3 mb-4 text-center">
                                <h5>Nova Senha • All Presets</h5>
                            </div>

                            {{-- alert --}}
                            @foreach ($errors->all() as $error)
                            <div class="text-center alert alert-primary alert-dismissible fade show" role="alert">
                                {{ $error }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endforeach

                            <div class="border-0 card bd-card">
                                <div class=card-body>
                                    <div class="row">
                                        <div class="col-12">

                                            <form method="POST" action="{{ route('password.store') }}">
                                            @csrf

                                                <!-- Password Reset Token -->
                                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                                <div class="mb-2 form-group">

                                                    <div class="gap-2 mb-3 row">
                                                        <label for="email" class="text-primary">E-mail</label>
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="Digite Seu E-mail" :value="old('email', $request->email)" required autofocus autocomplete="username">
                                                    </div>

                                                    <div class="gap-2 mb-3 row">
                                                        <label for="password" class="text-primary">Nova senha</label>
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Digite a Nova senha" required>
                                                    </div>

                                                    <div class="gap-2 mb-3 row">
                                                        <label for="password_confirmation" class="text-primary">Confirmação de nova senha</label>
                                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirme a nova senha" required>
                                                    </div>

                                                    <div class="gap-2 mb-3 row">
                                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Redefinir Senha</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <p class="text-body-tertiary fs-sm"> © {{ date('Y') }} All Presets • Todos os direitos reservados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>

</body>

</html>
