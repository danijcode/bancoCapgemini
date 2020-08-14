# Projeto Banco Capgemini
Projeto de avaliação utilizando as tecnologias Laravel 5.6, VueJS 2.5 e Banco PostgreSQL.

- Segue descritos os passos para configurar e subir os projetos front e backend local.

## Server
- Instale o [PHP] (http://fi2.php.net/downloads.php) e o banco de dados: [PostgreSQL] (https : //www.postgresql.org/download/)
- Instale [Composer](https://getcomposer.org/) e [nodeJS](https://nodejs.org).
- Vá para a pasta `Server` e execute `composer install` para instalar as dependencias do projeto e crie o banco utilizando o arquivo `createDatabase.sql`.
- Defina suas conexões de banco de dados em `.env`: DB_CONNECTION , DB_DATABASE, DB_PORT, DB_USERNAME, DB_PASSWORD. 
- Após definir as configurações de banco de dados execute `php artisan migrate` para criar as tabelas e inserir os dados nas respectivas tabelas para que possa ser possivel realizar os testes de deposito e saque.
- Existem também os serviços expostos para serem consumidos via API:
### POST - Deposito
http://localhost:8000/api/transactions
```
{
    "idConta": 1,
    "valorDeposito": 5000
}
```
### PUT - Saque
http://localhost:8000/api/transactions/{idConta}
```
{
    "valorSaque": 5000
}
```
### GET - Consultar Saldo de uma conta
http://localhost:8000/api/transactions/{idConta}

### GET - Recupera todas as contas
http://localhost:8000/api/transactions


## Client
- Instale [nodeJS](https://nodejs.org)
- Va para pasta Client e execute `npm install`

## Rodando Aplicação (Desenvolvimento)
- Execute `npm start` dentro da pasta *Client* para subir o frontend. Navegue `http://localhost:8080/`.
- Execute `php artisan serve --port=8000` dentro da pasta *Server* para subir o backend.
- Execute `npm start` na pasta raiz do projeto caso queira executar frontend e backend juntos.
- O usuario de acesso a aplicação é: `admin@bancocap.com.br` senha: `password`.

## OBS
- Optei por não trabalhar com valores de casa decimal para o saldo, pois estava dando alguns problemas e consumindo tempo (coisa que eu infelizmente não tive muito por conta das demandas do trabalho atual) 