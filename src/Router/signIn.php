<?php
use App\Controllers\SignInController;
use Slim\App;

return function (App $app) {

    $settings = $app->getContainer()
                    ->get('settings');

    $app->post($settings['basePath'] . 'authenticate', SignInController::class . ':authenticate');
};
