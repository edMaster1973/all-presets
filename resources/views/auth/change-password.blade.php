<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alterar Senha - All Presets</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group input.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .password-requirements {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 8px;
            font-size: 13px;
            color: #666;
        }

        .password-requirements h4 {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .password-requirements ul {
            list-style: none;
            padding-left: 0;
        }

        .password-requirements li {
            padding: 2px 0;
            padding-left: 20px;
            position: relative;
        }

        .password-requirements li:before {
            content: "•";
            position: absolute;
            left: 6px;
            color: #667eea;
        }

        .btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Alterar Senha</h1>
                <p>Sistema de Presets de Pedaleiras</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Atenção!</strong> Por favor, corrija os erros abaixo.
                </div>
            @endif

            <form method="POST" action="{{ route('password.change.update') }}">
                @csrf

                <div class="form-group">
                    <label for="current_password">Senha Atual</label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        class="@error('current_password') is-invalid @enderror"
                        required
                        autocomplete="current-password"
                    >
                    @error('current_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">Nova Senha</label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        class="@error('new_password') is-invalid @enderror"
                        required
                        autocomplete="new-password"
                    >
                    @error('new_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    
                    <div class="password-requirements">
                        <h4>Requisitos da senha:</h4>
                        <ul>
                            <li>Mínimo de 8 caracteres</li>
                            <li>Letras maiúsculas e minúsculas</li>
                            <li>Números</li>
                            <li>Símbolos especiais</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirmar Nova Senha</label>
                    <input 
                        type="password" 
                        id="new_password_confirmation" 
                        name="new_password_confirmation" 
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="btn">
                    Alterar Senha
                </button>
            </form>

            <div class="back-link">
                <a href="{{ url('/') }}">← Voltar ao Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
