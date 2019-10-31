<?php
use Slim\App;


return function (App $app) {

    $settings = $app->getContainer()
                    ->get('settings');
    // Default
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware($settings['displayErrors'], false, false);

    // custom global example middlewares
    // $app->add($authMiddleware);
};