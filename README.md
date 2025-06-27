
# Bem-vindo ao meu Desafio Técnico – Desenvolvedor PHP

Este sistema foi desenvolvido como um desafio técnico para a GestaOnline para a vaga de Desenvolvedor PHP

## Requisitos

- PHP 7.4 ou superior
- Composer
- MySQL ou outro banco de dados suportado pelo Laravel

## Passos para Instalação e Execução

### 1. **Clonar o Repositório**

Clone o repositório para o seu ambiente local:

```bash
git clone https://github.com/luanmgdo/gerenciador-de-autoridades-certificadoras.git
cd nome-do-repositorio
```

### 2. **Instalar as Dependências**

Após clonar o repositório, instale as dependências do projeto usando o **Composer**:

```bash
composer install
```

### 3. **Configurar o Banco de Dados**

- Crie um banco de dados MySQL (ou qualquer outro banco suportado).
- Renomeie o arquivo `.env.example` para `.env` e configure as credenciais do banco de dados:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. **Gerar a Chave de Aplicação**

No terminal, gere a chave da aplicação Laravel:

```bash
php artisan key:generate
```

### 5. **Rodar as Migrações**

Para criar as tabelas no banco de dados, execute as migrações:

```bash
php artisan migrate
```

### 6. **Executar o Servidor de Desenvolvimento**

Por fim, inicie o servidor de desenvolvimento do Laravel:

```bash
php artisan serve
```

O servidor estará rodando em **`http://127.0.0.1:8000`**.

### 7. **Acessando a Aplicação**

Agora, você pode acessar a aplicação no seu navegador:

- **Página de login**: `/login`
- **Página de cadastro**: `/register`
- **Listagem de ACs**: `/ac`
- **Listagem de ACN2s**: `/ac_n2`
- **Listagem de ARs**: `/ar`

Cada página de listagem possui um botão para **gerar o QR Code** para as entidades e exibi-lo em um modal.

