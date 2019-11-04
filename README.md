## USERS API

## Tools
* [Slim Framework](http://www.slimframework.com/docs/v4/)
* [Eloquent](https://laravel.com/docs/5.8/eloquent)
* [PHPUnit](https://phpunit.readthedocs.io/en/8.4/)

## Setup

> <p>composer install</p>
> <p>composer start</p>
> <p>create databasewith name usertest or rename value 'database' in file /Config/settings.php</p>

## Test coverage and init DB in this order

> <p>phpunit ../../tests/UserCreateTest.php --colors</p>
> <p>phpunit ../../tests/UserSignInTest.php --colors</p>

## Custom test

> <p>phpunit ../../tests/NameFileTest.php --colors</p>