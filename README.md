# Projeto WebService

Este projeto é um sistema de gerenciamento de chamados (Tickets) desenvolvido em PHP, utilizando Nginx como servidor web.  
Este documento descreve os requisitos, a instalação e a configuração do ambiente tanto em **Linux (Arch Linux)** quanto em **Windows**.

---

## Requisitos

- PHP 8.1 ou superior (com extensões `pdo`, `mbstring`, `json`, `openssl`)
- Composer (gerenciador de dependências do PHP)
- Nginx (servidor web)
- Git (opcional, para clonar o repositório)

---

## Instalação no Linux (Arch Linux)

### 1. Instalar pacotes necessários
```bash
sudo pacman -S nginx php php-fpm composer git
```

### 2. Clonar o projeto
```bash
cd /srv/http
git clone https://seu-repo.git ProjetoWebService
cd ProjetoWebService
composer install
```

### 3. Configurar PHP-FPM
Edite `/etc/php/php.ini` e habilite extensões necessárias (removendo o `;` do início da linha):
```ini
extension=mbstring
extension=openssl
```

Inicie e habilite o serviço:
```bash
sudo systemctl enable --now php-fpm
```

### 4. Configurar Nginx
Crie o arquivo `/etc/nginx/sites-available/webservice` (e linke para `sites-enabled`, se usar essa convenção):

```nginx
server {
    listen 80 default_server;
    server_name projetowebservice.local;

    root  /home/<username>/Projetos/ProjetoWebService/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include        fastcgi_params;
        fastcgi_pass   unix:/run/php-fpm/php-fpm.sock;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

Teste e recarregue o Nginx:
```bash
sudo nginx -t
sudo systemctl restart nginx
```

---

## Instalação no Windows

### 1. Instalar pacotes
- Baixe e instale [PHP for Windows](https://windows.php.net/download/) (Thread Safe recomendado)
- Instale [Composer](https://getcomposer.org/download/)
- Baixe [Nginx for Windows](https://nginx.org/en/download.html)
- Instale Git se quiser clonar o repositório diretamente

### 2. Estrutura do Projeto
Coloque o projeto em `C:\nginx\html\ProjetoWebService`

Dentro da pasta rode:
```powershell
composer install
```

### 3. Configuração do PHP
Edite o arquivo `php.ini` e habilite extensões:
```ini
extension=mbstring
extension=openssl
```

### 4. Configuração do Nginx (`conf/nginx.conf`)
Adicione um bloco de servidor:

```nginx
server {
    listen 80 default_server;
    server_name projetowebservice.local;

    root  /home/<username>/Projetos/ProjetoWebService/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include        fastcgi_params;
        fastcgi_pass   unix:/run/php-fpm/php-fpm.sock;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

No Windows, é necessário rodar o PHP como FastCGI:
```powershell
php-cgi.exe -b 127.0.0.1:9000
```
Pode-se criar um script `.bat` para iniciar o PHP junto com o Nginx.

---

## Primeira execução
Após configurar e iniciar os serviços, abra no navegador:
```
[http://localhost](http://projetowebservice.local)
```
O sistema deve exibir a página inicial do ProjetoWebService.

---

## Desenvolvimento
- Código-fonte: `src/`
- Arquivos públicos: `public/`
- Arquivos de configuração: `bootstrap.php`, `header.php`

---

Desenvolvido pelos estudantes Jean Carlos e André Emilio para o curso de Análise e Desenvolvimento de Sistemas pela UTFPR.
