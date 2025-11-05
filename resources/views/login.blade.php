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
                <div class="row g-8 itens-center justify-content-center">
                    <div class=col-md-12>

                        <div class="text-center items-center gap-3 mb-4">
                            <img src="{{ asset('storage/images/favicon.ico') }}" alt="">
                        </div>
                        <div class="text-center items-center gap-3 mb-4">
                            <h5>Sign in • All Presets</h5>
                        </div>

                        <div class="border-0 card bd-card">
                            <div class=card-body>
                                <div class="row">
                                    <div class="col-12">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-2 form-group">
                                                <div class="gap-2 mb-3 row">
                                                    <label class="text-primary">E-mail</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu E-mail" :value="old('email')" required autofocus autocomplete="username">
                                                </div>
                                                <div class="gap-2 mb-3 row">
                                                    <label class="text-primary">Senha</label>
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua Senha" required autocomplete="current-password">
                                                </div>
                                                <div class="gap-2 mb-3 row">
                                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
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


        <script>
        function getTheme(){
            return localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"
            );
        }
        document.getElementById("themeToggle").addEventListener("click", function(){
            const currentTheme = getTheme();
            const newTheme = currentTheme === "dark" ? "light" : "dark";
            document.documentElement.setAttribute("data-bs-theme", newTheme);
            localStorage.setItem("theme", newTheme);
        });
        document.documentElement.setAttribute("data-bs-theme", getTheme());
    </script>

    </body>
</html>




