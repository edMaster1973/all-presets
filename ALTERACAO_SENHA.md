# Funcionalidade de Alteração de Senha

Esta funcionalidade implementa um sistema completo de alteração de senha seguindo o padrão MVC (Model-View-Controller) do Laravel.

## 📁 Estrutura de Arquivos

```
all-presets/
├── app/
│   └── Http/
│       └── Controllers/
│           └── PasswordChangeController.php    # Controller principal
├── resources/
│   └── views/
│       └── auth/
│           └── change-password.blade.php       # View do formulário
└── routes/
    └── web.php                                 # Definição das rotas
```

## 🎯 Componentes Implementados

### 1. Controller (PasswordChangeController.php)

Localizado em: `app/Http/Controllers/PasswordChangeController.php`

**Métodos:**
- `showChangeForm()`: Exibe o formulário de alteração de senha
- `changePassword(Request $request)`: Processa a alteração de senha

**Validações implementadas:**
- Senha atual é obrigatória
- Nova senha deve ter no mínimo 8 caracteres
- Nova senha deve conter letras maiúsculas e minúsculas
- Nova senha deve conter números
- Nova senha deve conter símbolos especiais
- Nova senha deve ser confirmada
- Nova senha deve ser diferente da senha atual
- Senha atual deve estar correta

### 2. View (change-password.blade.php)

Localizado em: `resources/views/auth/change-password.blade.php`

**Características:**
- Design moderno e responsivo
- Interface em português
- Feedback visual para erros
- Mensagens de sucesso
- Indicação dos requisitos de senha
- Estilo com gradiente roxo/azul
- Totalmente estilizado com CSS inline (sem dependências externas)

**Campos do formulário:**
- Senha Atual
- Nova Senha
- Confirmar Nova Senha

### 3. Routes (web.php)

Localizado em: `routes/web.php`

**Rotas definidas:**
- `GET /password/change` - Exibe o formulário (nome: `password.change.form`)
- `POST /password/change` - Processa a alteração (nome: `password.change.update`)

**Middleware:**
- As rotas utilizam o middleware `auth` para garantir que apenas usuários autenticados possam acessar

## 🔒 Segurança

- **CSRF Protection**: Proteção contra ataques Cross-Site Request Forgery
- **Hash de Senha**: Utiliza `bcrypt` através do `Hash::make()`
- **Validação de Senha Atual**: Verifica se o usuário conhece a senha atual
- **Requisitos de Senha Forte**: Força o uso de senhas complexas
- **Prevenção de Reutilização**: Impede usar a mesma senha

## 🚀 Como Usar

### Integração com Laravel

1. **Certifique-se de ter o Laravel configurado** com autenticação

2. **As rotas já estão configuradas** em `routes/web.php`

3. **Acesse a página de alteração de senha:**
   ```
   http://seu-dominio.com/password/change
   ```

4. **Ou use a rota nomeada no seu código:**
   ```php
   <a href="{{ route('password.change.form') }}">Alterar Senha</a>
   ```

### Exemplo de Uso no Blade

```blade
<!-- Link no menu do usuário -->
<a href="{{ route('password.change.form') }}" class="dropdown-item">
    Alterar Senha
</a>
```

## 📋 Requisitos de Senha

A nova senha deve atender aos seguintes critérios:
- ✅ Mínimo de 8 caracteres
- ✅ Letras maiúsculas e minúsculas
- ✅ Números
- ✅ Símbolos especiais (@, #, $, %, etc.)

## 💬 Mensagens do Sistema

### Mensagens de Erro

- "A senha atual é obrigatória."
- "A nova senha é obrigatória."
- "A confirmação da nova senha não corresponde."
- "A nova senha deve ter pelo menos 8 caracteres."
- "A senha atual está incorreta."
- "A nova senha deve ser diferente da senha atual."

### Mensagem de Sucesso

- "Senha alterada com sucesso!"

## 🎨 Personalização

### Modificar Cores

Edite o arquivo `resources/views/auth/change-password.blade.php` e altere as cores no CSS:

```css
background: linear-gradient(135deg, #SUA_COR_1 0%, #SUA_COR_2 100%);
```

### Modificar Requisitos de Senha

Edite o arquivo `app/Http/Controllers/PasswordChangeController.php`:

```php
Password::min(8)  // Altere o número mínimo de caracteres
    ->letters()   // Remova para não exigir letras
    ->mixedCase() // Remova para não exigir maiúsculas/minúsculas
    ->numbers()   // Remova para não exigir números
    ->symbols()   // Remova para não exigir símbolos
```

## 🔧 Testes

Para testar a funcionalidade:

1. Acesse `/password/change`
2. Preencha o formulário com:
   - Sua senha atual
   - Uma nova senha que atenda aos requisitos
   - Confirmação da nova senha
3. Clique em "Alterar Senha"
4. Verifique a mensagem de sucesso

## 📝 Notas Importantes

- Esta implementação assume que você está usando Laravel com autenticação configurada
- O modelo `User` deve ter o campo `password` configurado
- O middleware `auth` deve estar registrado
- As funções `Auth::user()` e `Hash` devem estar disponíveis

## 🐛 Solução de Problemas

### "Route not found"
- Certifique-se de que o arquivo `routes/web.php` está sendo carregado
- Limpe o cache de rotas: `php artisan route:clear`

### "Class not found"
- Execute: `composer dump-autoload`

### "CSRF token mismatch"
- Certifique-se de que as sessões estão configuradas
- Verifique se o middleware `VerifyCsrfToken` está ativo

## 📄 Licença

Este código faz parte do projeto All Presets - Sistema de armazenamento e compartilhamento de presets de pedaleiras.
