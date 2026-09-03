## 📚 Sobre o Vellum

**Vellum** é um sistema completo de biblioteca virtual construído com o **TALL stack** (Tailwind, Alpine.js, Livewire, Laravel). A plataforma permite aos usuários explorar um vasto acervo de livros integrado com a API Gutendex, gerenciar perfis, participar de um clube do livro interativo e muito mais.

Este projeto demonstra funcionalidades modernas do Laravel, incluindo componentes Livewire (Volt), upload de arquivos, relações de banco de dados e interação dinâmica com JavaScript.

## 🚀 Funcionalidades Principais

### 🔐 Autenticação Completa
- Sistema de login, registro e gerenciamento de perfil
- Design customizado Vellum

### 📊 Dashboard Dinâmico
- Saudações personalizadas
- Carrosséis com Splide.js para "Top Downloads", "Favoritos" e "Gêneros"

### 🔍 Exploração de Livros
- Sistema de abas para gêneros com Alpine.js
- Filtro de tags (Gêneros Principais e Outras Tags)

### 📖 Modal de Detalhes do Livro
- Resumo, autores e capa
- Sistema de avaliação por estrelas (1-5) com recálculo automático
- Botão de favoritos com atualização em tempo real

### 👤 Gerenciamento de Perfil
- Atualização de nome e e-mail
- Upload de foto com recorte (Cropper.js)
- Exclusão segura de conta

### 📚 Clube do Livro Interativo
- Sistema de inscrição (Entrar/Sair)
- Livro do mês e histórico de leituras
- Fórum de discussão com comentários

### 🔄 Integração e Componentes
- API Gutendex para dados de livros
- Componentes reativos com atualização em tempo real

## 🛠️ Tecnologias Utilizadas

**Backend:**
- Laravel 11
- PHP 8.2+

**Frontend:**
- Livewire 3 (Volt)
- Blade Templates
- Tailwind CSS
- Alpine.js

**Bibliotecas JavaScript:**
- Splide.js (carrosséis)
- Cropper.js (recorte de imagens)

**Banco de Dados:**
- MySQL/PostgreSQL com Eloquent ORM

## 📦 Instalação

### Pré-requisitos
- PHP >= 8.2
- Composer
- Node.js & npm
- Banco de dados (MySQL, PostgreSQL, etc.)

### Passos de Instalação

   ```bash
  # 1. Clone o repositório
git clone https://github.com/isahlopess/vellum.git
cd vellum

# 2. Instale as dependências PHP e JavaScript
composer install
npm install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o arquivo .env com suas credenciais do banco
# Edite: DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 5. Execute as migrações do banco
php artisan migrate

# 6. Crie o link simbólico para storage
php artisan storage:link

# 7. (Opcional) Popule o banco com dados iniciais
php artisan db:seed

# 8. Compile os assets
npm run dev

# 9. Inicie o servidor de desenvolvimento
php artisan serve
   ``` 
   
