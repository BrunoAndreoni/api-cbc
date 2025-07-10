<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Para rodar o projeto você deve ter instalado em sua maquina: 

# php ^8.2
# composer 
# laravel ^12.0
# Mysql

Baixe e instale o XAMPP e você já tera o php e o Mysql instalados e pronto para uso.

Execute o comando composer install na pasta do projeto para instalr as dependencias.

Após baixar as dependencias, configure o .env para se conectar com o mseu mysql: 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bd_cbc
DB_USERNAME=root
DB_PASSWORD=

Depois execute esse comando na raiz do projeto "php artisan migrate" para subir as tabelas no banco.

Inicie o apache e o mysql no XAMPP.
Agora é só executar o comando para rodar o servidor
php artisan serve


Logo na pagina inicial será mostrado os endpoits e um exemplo de requisição. 
Caso queira o projeto tem alguns testes unitarios para testar os endpoints.