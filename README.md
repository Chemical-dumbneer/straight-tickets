# WebService – Sistema de Chamados (Projeto da Disciplina de Web Servidor)

## Integrantes da Equipe
- **Jean Pires de Carlos**
- **André Luiz Pereira Emílio**

<details>
<summary><strong>Relatório do Projeto</strong></summary>

### ✔️ Funcionalidades Implementadas
- Cadastro e autenticação de usuários.
- Abertura, visualização, edição e interação em chamados.
- Atribuição de chamados a técnicos.
- Registro de interações com diferentes tipos (FollowUp, Solução, etc.).
- Regras de negócio encapsuladas em **classes de serviço**.
- Interface utilizando **Livewire 3**.
- Seeders iniciais contendo um técnico e um usuário.
- Dashboard com métricas por tipo de usuário.

### ❗ Funcionalidades Faltantes / Bugs Conhecidos
- **API REST ainda não implementada**, embora toda a lógica esteja preparada.
- **Registro aberto**: qualquer usuário pode criar conta.
- **UI simples**: interface ainda não totalmente refinada.

### 👥 Participação dos Integrantes

#### Jean Pires de Carlos
- Arquitetura geral do projeto.
- Implementação de Models, Migrations, Services e Repositories.
- Desenvolvimento dos componentes Livewire.
- Implementação das regras de negócio.
- Configuração do PostgreSQL e testes.

#### André Luiz Pereira Emílio
- Suporte nas regras de negócio.
- Testes funcionais.
- Colaboração na modelagem das entidades.
- Apoio na documentação.

</details>

<details>
<summary><strong>Instalação e Execução do Projeto</strong></summary>

### 1. Pré-requisitos

#### Laravel
Guia oficial: https://laravel.com/docs/master/installation

Requisitos:
- PHP 8.2+
- Composer
- Extensão pdo_pgsql

#### PostgreSQL
Guia: https://www.postgresql.org/download/

Criação do banco:

```sql
CREATE DATABASE straight-tickets;
```

### 2. Clonar o projeto
```bash
git clone git@github.com:Chemical-dumbneer/straight-tickets.git
cd straight-tickets
```

### 3. Instalar dependências
```bash
composer install
```

### 4. Configurar o .env
```bash
cp .env.example .env
```

Ajuste para PostgreSQL:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=straight-tickets
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
```

Gerar chave:
```bash
php artisan key:generate
```

### 5. Migrações e Seeders
```bash
php artisan migrate --seed
```

### 6. Frontend (opcional)
```bash
npm install
npm run build
```

### 7. Executar servidor
```bash
php artisan serve
```

Acessar: http://localhost:8000

</details>

<details>
<summary><strong>Observações Finais</strong></summary>

- O sistema está pronto para receber um módulo de API no futuro.
- A lógica de negócio está isolada e reutilizável.
- A arquitetura permite expansão simples para outras camadas (como REST).

</details>
