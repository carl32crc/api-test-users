<?php
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// config dependencies
$dependencies = require __DIR__ . '/Config/dependencies.php';
$dependencies();

// slim instance
$app = AppFactory::create();

$database = require __DIR__ . '/Config/database.php';
$database($app->getContainer()->get('settings')['db']);

// middlewares
$globalMiddlewares = require __DIR__ . '/Middlewares/globalMiddlewares.php';
$globalMiddlewares($app);

// routes
$usersRouter = require __DIR__ . '/Router/users.php';
$usersRouter($app);

// api route not found
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

$app->run();
