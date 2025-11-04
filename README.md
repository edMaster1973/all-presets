# All Presets

Sistema de armazenamento e compartilhamento de presets de pedaleiras desenvolvido com Laravel.

## Características

- ✅ Autenticação completa (login, registro, recuperação de senha)
- ✅ CRUD de Presets (Create, Read, Update, Delete)
- ✅ Vite para build de assets
- ✅ Interface responsiva com Tailwind CSS

## Tecnologias

- Laravel 12.x
- Laravel Breeze (Autenticação)
- Vite
- Tailwind CSS
- SQLite

## Instalação

1. Clone o repositório
2. Instale as dependências:
   ```bash
   composer install
   npm install
   ```
3. Configure o arquivo `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Execute as migrações:
   ```bash
   php artisan migrate
   ```
5. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   npm run dev
   ```

## Uso

Acesse a aplicação em `http://localhost:8000` e faça o registro para começar a gerenciar seus presets de pedaleiras.

## Licença

Este projeto é open-source e está licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
