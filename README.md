## TaTooL
TatooL é a ferramenta que todos os tatuadores necessitavam. Mostre o seu trabalho para todos de forma fácil, tenha agendamentos e crie uma conexão com seus clientes.

### Dependências

- Docker
- Docker Compose

### To run

#### Clone Repository

```
$ git clone git@github.com:SI-DABE/tatool-php.git
$ cd tatool-php
```

#### Define the env variables

```
$ cp .env.example .env
```

#### Install the dependencies

```
$ ./run composer install
```

#### Up the containers

```
$ docker compose up -d
```

ou

```
$ ./run up -d
```

#### Create database and tables

```
$ ./run db:reset
```

#### Populate database

```
$ ./run db:populate
```

### Fixed uploads folder permission

```
sudo chown www-data:www-data public/assets/uploads
```

#### Run the tests

```
$ docker compose run --rm php ./vendor/bin/phpunit tests --color
```

ou

```
$ ./run test
```

#### Run Acceptance tests

```
$ ./run codecept build
```

```
$ ./run test:browser
```

#### Run the linters

[PHPCS](https://github.com/PHPCSStandards/PHP_CodeSniffer/)

```
$ ./run phpcs
```

[PHPStan](https://phpstan.org/)

```
$ ./run phpstan
```

Access [localhost](http://localhost)

### Teste de API

```shell
curl -H "Accept: application/json" localhost/appointments
```
