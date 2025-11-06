# Projeto WebService

Sistema de gerenciamento de chamados (Tickets) desenvolvido em **PHP 8** com **PostgreSQL** e **Nginx**.  
Segue o padrão **MVC simplificado**, utilizando **Composer** para autoload e controle de dependências.

---

## Tecnologias

- **PHP** 8.1 ou superior (extensões `pdo`, `mbstring`, `json`, `openssl`)
- **PostgreSQL** 14 ou superior
- **Nginx** (servidor web)
- **Composer** (gerenciador de dependências)
- **Pecee Simple Router** (roteamento)
- **Phinx** (migrations)
- **Dotenv** (configuração de ambiente)

---

## Estrutura do Projeto

```
ProjetoWebService/
├── src/
│   ├── control/
│   ├── model/
│   ├── repository/
│   ├── view/
│   └── Database.php
├── migrations/
├── public/
│   └── index.php
├── vendor/
├── composer.json
├── .env
└── README.md
```

---

## Configuração do Ambiente

### 1. Instalar dependências

```bash
composer install
```

### 2. Configurar variáveis de ambiente

Crie um arquivo `.env` na raiz do projeto com as credenciais do banco de dados:

```ini
DB_HOST=localhost
DB_PORT=5432
DB_NAME=webservice_dev
DB_USER=seu_usuario
DB_PASS=sua_senha
```

O arquivo `.env` é lido pela classe `Database`, que inicializa automaticamente a conexão PDO com o PostgreSQL.

---

## Banco de Dados

O sistema utiliza **PostgreSQL** como banco principal.  
As migrações são controladas pelo **Phinx**.

### Executar migrações

```bash
vendor/bin/phinx migrate -e development
```

### Criar nova migração

```bash
vendor/bin/phinx create NomeDaMigracao
```

### Estrutura básica do schema

- **users** – informações de login e perfis (hash com bcrypt)
- **tickets** – controle de chamados e status
- **logs** – histórico de operações

---

## Scripts do Composer

| Script | Descrição |
|--------|------------|
| `start` | Inicia o servidor embutido do PHP (`php -S localhost:8080 -t public`) |
| `migrate` | Executa as migrações do banco (`phinx migrate`) |
| `seed` | Popula o banco com dados iniciais (`phinx seed:run`) |
| `testdb` | Testa a conexão com o banco (`php testDB.php`) |

### Exemplo de execução

```bash
composer start
```

---

## Configuração do Nginx

### Exemplo para Linux (`/etc/nginx/sites-available/webservice`)

```nginx
server {
    listen 80;
    server_name projetowebservice.local;

    root /home/<usuario>/Projetos/ProjetoWebService/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php-fpm/php-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

Após editar, teste e recarregue o serviço:

```bash
sudo nginx -t
sudo systemctl restart nginx
```

---

## Estrutura Lógica

- **Model** – representa as entidades do sistema (`User`, `Ticket`, etc.)
- **Repository** – manipula o banco de dados via PDO
- **Control** – lógica de negócios e resposta às rotas
- **View** – renderização do frontend (HTML/PHP)
- **Router** – definição das rotas em `public/index.php` usando o SimpleRouter

---

## Execução

Após configurar o ambiente e o banco de dados:

```bash
composer start
```

Acesse no navegador:

```
http://localhost:8080
```

---

## Autores

Desenvolvido por **Jean Carlos** e **André Emílio**  
para o curso de **Análise e Desenvolvimento de Sistemas** – **UTFPR**
