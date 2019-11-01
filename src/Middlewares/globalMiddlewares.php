<?php
use Slim\App;

return function (App $app) {

    $settings = $app->getContainer()
        ->get('settings');

    // default
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware($settings['displayErrors'], false, false);

    // custom global
    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};
