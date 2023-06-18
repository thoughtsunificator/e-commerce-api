# e-commerce-api

Symfony API built for [e-commerce-client](https://github.com/thoughtsunificator/e-commerce-client).

## Getting Started

## Prerequisites

- Symfony CLI
- Composer 2.0
- MariaDB 10.4
- php 8.2 (with pdo_mysql and openssl)

## Database

- ``php bin\console doctrine:schema:update --force``
- ``php bin\console doctrine:fixtures:load -n``

## JTW

Generate the SSH keys for JWT authentication:

- ``openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096``
- ``openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout``

## Run

- ``symfony server:start``
